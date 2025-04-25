<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceMedia;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function serviceSave(Request $request)
    {
        // Добавление валидации данных
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Убедимся, что имя услуги заполнено и является строкой
            'description' => 'nullable|string', // Описание может быть пустым
            'service_type_id' => 'required|exists:service_types,id', // Убедимся, что тип услуги существует в таблице service_types
            'file' => 'nullable|file', // Файл не обязателен
        ]);

        function loadMedia($imgs, $service_id)
        {
            $counter = 1;
            foreach ($imgs as $image) {
                $fileName = time() . '_' . $counter . '.' . $image->extension();
                $imagePath = $image->storeAs('public/imgs/services', $fileName);
                ServiceMedia::create([
                    'service_id' => $service_id,
                    'image' => $fileName
                ]);
                $counter++;
            }
        }

        if (!$request->service_id) {
            $service_id = Service::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'file' => $request->file('file') ? $request->file('file')->store('public/files/services') : null,
                'service_type_id' => $validatedData['service_type_id']
            ])->id;

            if ($request->hasFile('images') && is_array($request->file('images'))) {
                loadMedia($request->images, $service_id);
            }
        } else {
            $service = Service::findOrFail($request->service_id);
            $service->update($validatedData);

            if ($request->hasFile('images') && is_array($request->file('images'))) {
                $oldFiles = ServiceMedia::where('service_id', $service->id)->get();
                foreach ($oldFiles as $oldFile) {
                    Storage::delete('public/imgs/services/' . $oldFile->image);
                    $oldFile->delete();
                }
                loadMedia($request->images, $service->id);
            }
        }

        return redirect()->route('seeService', ['id' => $service_id ?? $service->id]);
    }

    public function allServices(Request $request)
    {
        function takeData($query)
        {
            $data['services'] = $query->with('serviceMedia')->get();
            $data['count'] = $query->count();
            return $data;
        }

        if (!$request->filled('_token') && !$request->filled('category')) {
            $query = Service::join('service_types', 'services.service_type_id', 'service_types.id')->select('services.*', 'service_types.name as services.category');

            $title = 'Все услуги';
        } elseif ($request->filled('category')) {
            $query = Service::where('service_type_id', $request->category);

            $titleRaw = ServiceType::select('name')->where('id', $request->category)->get()->toArray();
        } else {
            $types = array_keys($request->except('_token', 'order_by', 'sequence'));

            $query = Service::whereIn('service_type_id', $types)
                ->orderBy($request->order_by, $request->sequence);

            $titleRaw = ServiceType::select('name')->whereIn('id', $types)->get()->toArray();
        }

        if (isset($titleRaw)) {
            $title = '';
            foreach ($titleRaw as $tr_tmp) {
                $title .= $tr_tmp['name'] . ', ';
            }
            $title = substr($title, 0, -2);
        }

        $data = takeData($query);

        // Логика для определения переменной $link
        foreach ($data['services'] as $service) {
            $serviceMedia = $service->serviceMedia->first();
            $service->link = $serviceMedia ? 'storage/imgs/services/' . $serviceMedia->image : 'imgs/default.png';
        }

        $types = ServiceType::all();

        $data += [
            'types' => $types,
        ];

        $data += [
            'title' => $title,
        ];

        return view("service.list", compact("data"));
    }

    public function seeService($id)
    {
        $service = Service::where("id", $id)->with('serviceMedia')->first();

        return view("service.only", compact("service"));
    }

    public function serviceEditor(Request $request, $id = null)
    {
        $service = null;
        if ($id) {
            $service = Service::find($id);
        }

        if (!$service) {
            $service = new Service(); // Создаем пустой объект, если услуга не найдена
        }

        $sTypes = ServiceType::all();
        $data = [
            'service' => $service,
            'sTypes' => $sTypes
        ];

        return view("service.editor", compact('data'));
    }

    public function serviceDelete(Request $request)
    {
        $oldFiles = ServiceMedia::select('image')->where('service_id', $request->id)->get();

        foreach ($oldFiles as $oldFile) {
            $filePath = 'public/imgs/services/' . $oldFile->image;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            ServiceMedia::where('service_id', $request->id)->delete();
        }

        $service = DB::table("services")->where('id', $request->id)->delete();

        return redirect()->route("allServices");
    }
}
