<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

$book = static function () {
    Route::get('book/create', [BookController::class, "create"])->name(".create");
    Route::get('book', [BookController::class, "index"])->name(".index");
    Route::get('book/{book}', [BookController::class, "show"])->name(".show");
    Route::get('book/{book}/edit', [BookController::class, "edit"])->name(".edit");
    Route::post('book/create', [BookController::class, "store"])->name(".store");
    Route::patch('book/{book}', [BookController::class, "update"])->name(".update");
    Route::delete('book/{book}', [BookController::class, "destroy"])->name(".destroy");
};




$author = static function () {
    Route::get('author', [AuthorController::class, "index"])->name(".index");
    Route::get('author/{author}', [AuthorController::class, "show"])->name(".show");
    Route::get('author/create', [AuthorController::class, "create"])->name(".create");
    Route::post('author/create', [AuthorController::class, "store"])->name(".store");
    Route::post('author/edit', [AuthorController::class, "edit"])->name(".edit");
    Route::patch('author/{author}', [AuthorController::class, "update"])->name(".update");
    Route::delete('author/{author}', [AuthorController::class, "destroy"])->name(".destroy");
};

Route::get('/', function () {
    return view('welcome');
});

Route::name("book")->group($book);
Route::name("author")->group($author);


require __DIR__.'/auth.php';
