<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\OurWorksController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\PromoPageController;
use App\Http\Controllers\AdminPromoPageController;

use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'home'])->name('home');

Route::post('/post/new', [PostController::class, "postEditor"])->middleware('auth')->name('postNew');
Route::get('/forum', [PostController::class, "allPosts"])->name('forum'); 
Route::get('/post/{id}', [PostController::class, "seePost"])->name('seePost');
Route::post('/post/{id}/edit', [PostController::class, "postEditor"])->name('postEdit');
Route::post('/post/{id}/delete', [PostController::class, "postDelete"])->name('postDelete');
Route::post('/post/save', [PostController::class, "postSave"])->middleware('auth')->name('savePost');
Route::get('/post/reply-to/{idToReply}', [PostController::class, "postEditor"])->middleware('auth')->name('postReply');
Route::post('/post/reply-to/{idToReply}', [PostController::class, "postSave"])->middleware('auth')->name('postReply');

Route::get('/user', function () { return view('user.perArea'); })->middleware('auth')->name("user");
Route::get('/user/auth', function () { return view('user.authPage'); })->middleware('guest')->name("auth");
Route::get('/user/reg', function () { return view('user.regPage'); })->middleware('guest')->name("reg");
Route::post('/user/exit', [UserController::class, "logOut"])->middleware('auth')->name("logout");
Route::post('/user/new', [UserController::class, "signUp"])->name("signUp");
Route::post('/user/auth', [UserController::class, "signIn"])->name("signIn");
Route::post('/user/changeBalance', [UserController::class, "changeBalance"])->name("changeBalance");

Route::get('/catalogue', [ProductController::class, "allProducts"])->name('shop'); // в карту
Route::post('/product', [ProductController::class, "productEditor"])->middleware("auth")->name("productNew"); // в карту
Route::post('/product/save', [ProductController::class, "productSave"])->middleware("auth")->name("productSave");
Route::get('/product/{id}', [ProductController::class, "seeProduct"])->name('seeProduct');
Route::post('/product/{id}/delete', [ProductController::class, "productDelete"])->name('productDelete');
Route::post('/product/{id}/edit', [ProductController::class, "productEditor"])->name('productEdit');

// Добавляем маршруты для услуг
Route::get('/services', [ServiceController::class, 'allServices'])->name('allServices');
Route::get('/service/new', [ServiceController::class, 'serviceEditor'])->middleware('auth')->name('serviceNew');
Route::post('/service/save', [ServiceController::class, 'serviceSave'])->middleware('auth')->name('serviceSave');
Route::get('/service/{id}', [ServiceController::class, 'seeService'])->name('seeService');
Route::get('/service/{id}/edit', [ServiceController::class, 'serviceEditor'])->middleware('auth')->name('serviceEdit');
Route::post('/service/{id}/edit', [ServiceController::class, 'serviceSave'])->middleware('auth')->name('serviceUpdate');
Route::post('/service/{id}/delete', [ServiceController::class, 'serviceDelete'])->middleware('auth')->name('serviceDelete');

Route::post('/product/{id}/addToCart', [BasketController::class, "addToCart"])->middleware('auth')->name('addToCart');
Route::get('/cart', [BasketController::class, "getBasket"])->middleware('auth')->name('cart');
Route::post('/cart/exclude', [BasketController::class, "basketExclude"])->middleware('auth')->name('basketExclude');
Route::post('/cart/pay', [BasketController::class, "payBasket"])->middleware('auth')->name('payBasket');
Route::post('/order/{id}/get', [BasketController::class, "getOrder"])->middleware('auth')->name('getOrder');

Route::get('/admin/usrRedaction', [AdminController::class, "usrRedaction"])->middleware('auth')->name('usrRedaction');
Route::post('/admin/doMod/{id}', [AdminController::class, "doMod"])->middleware('auth')->name('doMod');
Route::post('/admin/undoMod/{id}', [AdminController::class, "undoMod"])->middleware('auth')->name('undoMod');
Route::post('/admin/ban/{id}', [AdminController::class, "ban"])->middleware('auth')->name('ban');
Route::post('/admin/unban/{id}', [AdminController::class, "unban"])->middleware('auth')->name('unban');

// Промо-админка (только для админов, через middleware)
Route::middleware(['auth', 'admin'])->group(function () {

     // Удаление изображения из слайдера
     Route::post('/admin/promos/{id}/image-delete/{index}', [AdminPromoPageController::class, 'deleteImage'])->name('admin.promos.image.delete');

     // CRUD промо-страниц
    Route::get('/admin/promos', [AdminPromoPageController::class, 'index'])->name('admin.promos.index');
    Route::get('/admin/promos/create', [AdminPromoPageController::class, 'create'])->name('admin.promos.create');
    Route::post('/admin/promos', [AdminPromoPageController::class, 'store'])->name('admin.promos.store');
    Route::get('/admin/promos/{id}/edit', [AdminPromoPageController::class, 'edit'])->name('admin.promos.edit');
    Route::put('/admin/promos/{id}', [AdminPromoPageController::class, 'update'])->name('admin.promos.update');
    Route::delete('/admin/promos/{id}', [AdminPromoPageController::class, 'destroy'])->name('admin.promos.destroy');

    // Управление таблицей (2 блок)
    Route::get('/admin/promos/{id}/table', [AdminPromoPageController::class, 'tableEditor'])->name('admin.promos.table.editor');
    Route::post('/admin/promos/{id}/table', [AdminPromoPageController::class, 'storeTableRow'])->name('admin.promos.table.store');
    Route::put('/admin/promos/table/{rowId}', [AdminPromoPageController::class, 'updateTableRow'])->name('admin.promos.table.update');
    Route::delete('/admin/promos/table/{rowId}', [AdminPromoPageController::class, 'deleteTableRow'])->name('admin.promos.table.delete');
    

});

Route::post('/ourWork/new', [OurWorksController::class, "editor"])->middleware('auth')->name('OWnew');
Route::get('/ourWork/{id}', [OurWorksController::class, "checkWork"])->name('OWview');
Route::post('/ourWork/{id}/edit', [OurWorksController::class, "editor"])->middleware('auth')->name('OWedit');
Route::post('/ourWork/{id}/delete', [OurWorksController::class, "delete"])->middleware('auth')->name('OWdelete');
Route::post('/ourWork/save', [OurWorksController::class, "save"])->middleware('auth')->name('OWsave');

Route::post('/letter/new', function () { return view('letter_editor'); })->middleware('auth')->name('letterNew');
Route::post('/letter/save', [LetterController::class, "save"])->middleware('auth')->name('letterSave');
Route::post('/letter/{id}/delete', [LetterController::class, "delete"])->middleware('auth')->name('letterDel');

Route::get('/franshiza', function () { return view('franshiza'); })->name('franchise');

Route::get('/vakansii', function () { return view('vakansii'); })->name('vakansii');

Route::get('/delivery', function () { return view('delivery'); })->name('delivery'); // в карту
Route::get('/about', function () { return view('about'); })->name('about'); // в карту
Route::get('/contacts', function () { return view('contacts'); })->name('contacts'); // в карту
Route::get('/file/{filePath}', [PageController::class, 'file'])->name('file');
Route::get('/articles/{ptype}', [PageController::class, 'viewPosts'])->name('viewPosts'); // в карту

// Промо
Route::get('/promo', [PromoPageController::class, 'list'])->name('promo.list');

// ниже всех остальных! 
Route::get('/{slug}', [PromoPageController::class, 'show'])->name('promo.show');
