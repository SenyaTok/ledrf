<?php

namespace App\Http\Controllers;

use App\Models\OurWorks;
use App\Models\OurWorksMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OurWorksController extends Controller
{
    //Штуки для методов

        protected function loadCover($img)
        {
            $coverName = time() . '.' . $img->extension();
            $coverPath = $img->storeAs('public/imgs/our_works/covers/', $coverName);

            return $coverName;
        }

        protected function loadMediaOW($imgs, $work_id)
        {
            $counter = 1;
            foreach ($imgs as $image) {
                $fileName = time() . '_' . $counter . '.' . $image->extension();
                $imagePath = $image->storeAs('public/imgs/our_works/mediafiles/', $fileName);
                OurWorksMedia::create([
                    'work_id' => $work_id,
                    'image' => $fileName
                ]);
                $counter++;
            }

            return;
        }

        protected function delCoverOW($oldCover)
        {
            $coverPath = 'public/imgs/our_works/covers/' . $oldCover;

            if (Storage::exists($coverPath)) {
                Storage::delete($coverPath);
            }
            
            return;
        }
        
        protected function delMediaOW($oldFiles, $work_id)
        {
            foreach ($oldFiles as $oldFile) {
                $filePath = 'public/imgs/our_works/mediafiles/' . $oldFile->image;
                if (Storage::exists($filePath)) {
                    Storage::delete($filePath);
                }
                OurWorksMedia::where('work_id', $work_id)->delete();
            }

            return;
        }

        // Методы

    public function getAll()
    {
        $ourWorks = OurWorks::get();

        return view('oworks.list', compact('ourWorks'));
    }

    public function checkWork(Request $request)
    {
        $data = OurWorks::find($request->id);

        return view('oworks.only', compact('data'));
    }

    public function save(Request $request)
    {

        if (!$request->work_id) {

            // Добавление и я

            if ($request->hasFile('cover')) {
                $coverName = $this->loadCover($request->cover);
            }

            $work_id = OurWorks::insertGetId([
                'name' => $request->name,
                'description' => $request->description, 
                'what_we_do' => $request->what_we_do, 
                'year' => $request->year,
                'cover' => $coverName ?? 'default.png'
            ]);

            if ($request->hasFile('media') && is_array($request->file('media'))) {
                $this->loadMediaOW($request->media, $work_id);
            }
        } else {

            // Обновление

            $update['updated_at'] = null;

            if ($request->hasFile('cover')) {
                $oldCover = OurWorks::select('cover')->find($request->work_id);
                $this->delCoverOW($oldCover);

                $coverName = $this->loadCover($request->cover);
                OurWorks::where('id', '=', $request->work_id)
                    ->update([
                        'cover' => $coverName
                    ]);
            }

            if ($request->hasFile('media') && is_array($request->file('media'))) {
                $oldFiles = OurWorksMedia::select('image')->where('work_id', $request->work_id)->get();

                $this->delMediaOW($oldFiles, $request->work_id);

                $this->loadMediaOW($request->media, $request->work_id);
            }

            $toUPD = $request->toArray();
            $OurWorks = OurWorks::find($request->work_id);
            $testing = $OurWorks->toArray();

            // формирование массива обновленных данных на основе данных из базы и новых
            foreach ($testing as $key => $item) {
                switch ($key) {
                    case 'id':
                    case 'cover':
                    case 'created_at':
                    case 'updated_at':
                        break;
                    default:
                        if ($toUPD[$key] != $item) {
                            $update[$key] = $toUPD[$key];
                        }
                        break;
                }
            }

            // dd($update);

            $OurWorks->update($update);
            $work_id = $request->work_id;
        }

        return redirect()->route('OWview', ['id' => $work_id]);
    }

    public function editor(Request $request)
    {
        $data = OurWorks::find($request->id);

        return view("oworks.editor", compact('data'));
    }
    public function delete(Request $request)
    {
        $oldFiles = OurWorksMedia::select('image')->where('work_id', $request->id)->get();
        $oldCover = OurWorks::select('cover')->find($request->id);

        $this->delCoverOW($oldCover);
        $this->delMediaOW($oldFiles, $request->id);

        $OurWorks = OurWorks::where('id', $request->id)->delete();

        return redirect()->route("home");
    }
}



