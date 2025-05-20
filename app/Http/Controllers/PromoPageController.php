<?php

namespace App\Http\Controllers;

use App\Models\PromoPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PromoPageController extends Controller
{
    public function show($slug)
    {
        $page = PromoPage::where('slug', $slug)->firstOrFail();
        $tableRows = $page->tableRows;

        return view('promo.show', compact('page', 'tableRows'));
    }

    public function list()
    {
        $pages = PromoPage::orderBy('id')->get();
        return view('promo.list', compact('pages'));
    }
}