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

//groupe routes for tickets
Route::group([], function () {
    Route::get('/newticket', [TicketsController::class, 'create'])->middleware(['auth'])->name('newticket');
    Route::post('/newticket', [TicketsController::class, 'store'])->middleware(['auth']);
    Route::get('/my_tickets', [TicketsController::class, 'userTickets'])->middleware(['auth']);
    Route::get('/tickets/{ticket_id}', [TicketsController::class, 'show'])->middleware(['auth']);
}
);
Route::get('/comment', [CommentsController::class, 'create'])->middleware(['auth']);
Route::post('/comment', [CommentsController::class, 'store'])->middleware(['auth']);


// Route::middleware(['auth','admin'])->name('admin.')->prefix('admin')->group(function(){
//     Route::get('/', [AdminController::class, 'index'])->name('index');
// });

require __DIR__.'/auth.php';
