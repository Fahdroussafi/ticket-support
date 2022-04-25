<?php
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

// Auth::routes();
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// groupe routes for tickets
Route::group([], function () {
    Route::get('/newticket', [TicketsController::class, 'create'])->middleware(['auth'])->name('newticket');
    Route::post('/newticket', [TicketsController::class, 'store'])->middleware(['auth'])->name('newticket');
    Route::get('/my_tickets', [TicketsController::class, 'userTickets'])->middleware(['auth'])->name('my_tickets');
    Route::get('/tickets/{ticket_id}', [TicketsController::class, 'show'])->middleware(['auth'])->name('ticket');

});

// comments routes
Route::get('/comment', [CommentsController::class, 'create'])->middleware(['auth']);
Route::post('/comment', [CommentsController::class, 'store'])->middleware(['auth']);

// admin tickets routes
Route::get('/admin/tickets', [TicketsController::class, 'index'])->middleware(['auth'])->name('admin.tickets');
Route::post('/admin/close_ticket/{ticket_id}', [TicketsController::class, 'close'])->middleware(['auth'])->name('admin.close_ticket');
Route::post('/admin/open_ticket/{ticket_id}', [TicketsController::class, 'open'])->middleware(['auth'])->name('admin.open_ticket');

// admin categories routes
Route::get('/admin/add_category', [CategoryController::class, 'create'])->middleware(['auth'])->name('admin.categories_add');
Route::post('/admin/add_category', [CategoryController::class, 'store'])->middleware(['auth'])->name('admin.categories_add');

// admin users routes
Route::get('/admin/users', [UsersController::class, 'index'])->middleware(['auth'])->name('admin.users');
// delete users from the database
Route::delete('/admin/users/{id}', [UsersController::class, 'destroy'])->middleware(['auth'])->name('admin.users_delete');



require __DIR__.'/auth.php';
