<?php

namespace App\Http\Controllers;

use App\Models\PromoPage;
use App\Models\PromoTableRow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPromoPageController extends Controller
{
    public function index()
    {
        $pages = PromoPage::all();
        return view('admin.promos.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.promos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => 'required|unique:promo_pages,slug',
            'title_promo' => 'nullable|string',
            'text_promo' => 'nullable|string',
            'slider_images.*' => 'nullable|image|max:2048',
        ]);

        $imagePaths = [];
        if ($request->hasFile('slider_images')) {
            foreach ($request->file('slider_images') as $file) {
                $filename = $file->getClientOriginalName();
                $file->storeAs('public/uploads/promo', $filename);
                $imagePaths[] = 'storage/uploads/promo/' . $filename;
            }
        }

        $data['slider_images'] = $imagePaths;

        PromoPage::create($data);

        return redirect()->route('admin.promos.index')->with('success', 'Страница создана');
    }

    public function edit($id)
    {
        $page = PromoPage::findOrFail($id);
        return view('admin.promos.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = PromoPage::findOrFail($id);

        $data = $request->validate([
            'slug' => 'required|unique:promo_pages,slug,' . $id,
            'title_promo' => 'nullable|string',
            'text_promo' => 'nullable|string',
            'slider_images.*' => 'nullable|image|max:2048',
        ]);

        $imagePaths = $page->slider_images ?? [];
        if ($request->hasFile('slider_images')) {
            foreach ($request->file('slider_images') as $file) {
                $filename = $file->getClientOriginalName();
                $file->storeAs('public/uploads/promo', $filename);
                $imagePaths[] = 'storage/uploads/promo/' . $filename;
            }
        }

        if ($request->hasFile('slider_images')) {
            $data['slider_images'] = $imagePaths; // если есть новые, заменить
        } else {
            unset($data['slider_images']); // иначе оставить как есть
        }

        $page->update($data);

        return redirect()->route('admin.promos.index')->with('success', 'Страница обновлена');
    }

    public function destroy($id)
    {
        $page = PromoPage::findOrFail($id);
        $page->delete();

        return redirect()->route('admin.promos.index')->with('success', 'Страница удалена');
    }

    // Управление таблицей

    public function tableEditor($id)
    {
        $page = PromoPage::findOrFail($id);
        $tableRows = $page->tableRows()->orderBy('id')->get();

        return view('admin.promos.table_editor', compact('page', 'tableRows'));
    }

    public function storeTableRow(Request $request, $id)
    {
        $request->validate([
            'columns' => 'required|array|min:1',
            'columns.*' => 'nullable|string|max:255',
        ]);

        PromoTableRow::create([
            'promo_page_id' => $id,
            'columns' => array_values($request->columns),
        ]);

        return redirect()->route('admin.promos.table.editor', $id)->with('success', 'Строка добавлена');
    }

    public function updateTableRow(Request $request, $rowId)
    {
        $row = PromoTableRow::findOrFail($rowId);

        $request->validate([
            'columns' => 'required|array|min:1',
            'columns.*' => 'nullable|string|max:255',
        ]);

        $row->update([
            'columns' => array_values($request->columns),
        ]);

        return redirect()->route('admin.promos.table.editor', $row->promo_page_id)->with('success', 'Строка обновлена');
    }

    public function deleteTableRow($rowId)
    {
        $row = PromoTableRow::findOrFail($rowId);
        $pageId = $row->promo_page_id;
        $row->delete();

        return redirect()->route('admin.promos.table.editor', $pageId)->with('success', 'Строка удалена');
    }

    public function deleteImage($id, $index)
    {
        $page = PromoPage::findOrFail($id);
        $images = $page->slider_images;
    
        if (isset($images[$index])) {
            // Преобразуем путь из 'storage/uploads/promo/xxx.jpg' в 'public/uploads/promo/xxx.jpg'
            $filePath = str_replace('storage/', 'public/', $images[$index]);
    
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
    
            array_splice($images, $index, 1);
            $page->slider_images = $images;
            $page->save();
        }
    
        return redirect()->back()->with('success', 'Изображение удалено');
    }

}
