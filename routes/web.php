<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\CommentsController;
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

// show new-ticket page and create new ticket with ticketscontroller
// Route::get('/newticket', [TicketsController::class, 'create'])->middleware(['auth'])->name('newticket');
// Route::post('/newticket', [TicketsController::class, 'store'])->middleware(['auth']);
// Route::get('/my_tickets', [TicketsController::class, 'userTickets'])->middleware(['auth']);

// groupe routes for tickets
Route::group([], function () {
    Route::get('/newticket', [TicketsController::class, 'create'])->middleware(['auth'])->name('newticket');
    Route::post('/newticket', [TicketsController::class, 'store'])->middleware(['auth']);
    Route::get('/my_tickets', [TicketsController::class, 'userTickets'])->middleware(['auth']);
    Route::get('/tickets/{ticket_id}', [TicketsController::class, 'show'])->middleware(['auth']);
});

// comments routes
Route::get('/comment', [CommentsController::class, 'create'])->middleware(['auth']);
Route::post('/comment', [CommentsController::class, 'store'])->middleware(['auth']);

// admin routes
Route::get('/admin/tickets/false', [TicketsController::class, 'index'])->middleware(['auth'])->name('admin.tickets');
Route::post('/admin/close_ticket/{ticket_id}', [TicketsController::class, 'close'])->middleware(['auth'])->name('admin.close_ticket');
Route::get('/admin/tickets/true', [TicketsController::class, 'index'])->middleware(['auth'])->name('admin.tickets.open');


require __DIR__.'/auth.php';
