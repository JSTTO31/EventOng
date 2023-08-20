<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventAttendeeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\ProfileController;
use App\Models\Event;
use App\Models\EventAttendee;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
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

// Route::get('/',A);

Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', DashboardController::class)->only(['index']);
    Route::resource('events', EventController::class);
    Route::resource('locations', LocationController::class)->only(['store']);
    Route::resource('organizers', OrganizerController::class)->only(['store']);
    Route::resource('inboxes', InboxController::class)->only(['index']);
    Route::post('inboxes/{attendee}/send-message', [InboxController::class, 'sendMessage'])->name('inboxes.send-message');
});


Route::get('/welcome', function(){
    return Inertia::render('Welcome', [
        'events' => Event::with(['date_time', 'health_guideline', 'location'])->paginate(9)
    ]);
})->name('welcome');

Route::get('/events/show/{event}', function(Request $request, Event $event){
    return Inertia::render('EventShow', [
        'event' => $event->load(['health_guideline', 'location', 'date_time', 'organizer']),
        'picture_welcome' => asset('storage/welcome.svg'),
        'picture_welcome_back' => asset('storage/welcome-back.svg'),
    ]);
})->name('guest.events.show');

Route::resource('events.event_attendee', EventAttendeeController::class)->only(['store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
