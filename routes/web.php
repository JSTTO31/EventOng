<?php

use App\Http\Controllers\AttendeeVerificationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventAttendeeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\GuestEventController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ImageLibraryController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\EventAttendee;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
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
    Route::resource('notifications', NotificationController::class)->only('index');
    Route::controller(ImageLibraryController::class)->group(function(){
        Route::get('image-libraries/{folder?}', 'index')->name('image-libraries.index');
    });
    Route::controller(NotificationController::class)->group(function(){
        Route::post('/{notification}/mark-as-read', 'markAsRead')->name('notifications.mark-as-read');
        Route::get('/{notification}/mark-as-read', 'markAsReadAndVisit')->name('notifications.mark-as-read-and-visit');
        Route::post('/mark-as-read', 'markAsReadAll')->name('notifications.mark-as-read-all');
        Route::post('/mark-as-unread', 'markAsUnreadAll')->name('notifications.mark-as-unread-all');
        Route::post('/{notification}/mark-as-unread', 'markAsUnread')->name('notifications.mark-as-unread');
        Route::delete('/{notification}/remove', 'remove')->name('notifications.remove');
    });

    Route::resource('events.event_attendee', EventAttendeeController::class)->only(['store']);
    Route::controller(EventAttendeeController::class)->group(function(){
        Route::post('/events_attendee/{event_attendee}', 'notify')->name('event_attendees.notify');
    });
    Route::resource('folders', FolderController::class)->only(['store']);
    Route::resource('images', ImageController::class)->only(['store']);
});

Route::get('/welcome', WelcomeController::class)->name('welcome');


Route::get('attendee/{attendee}/verification', function(Request $request, EventAttendee $attendee){



})->name('attendee.verification');

Route::controller(AttendeeVerificationController::class)->group(function($query){
    Route::get('attendees/{attendee}/verification', 'verification')->name('attendees.verification');
    Route::get('attendees/verified', 'verified')->name('attendees.verified');
});

Route::get('/verified', function(){
})->name('verified');


Route::controller(GuestEventController::class)->group(function(){
    Route::get('events/{event}/show', 'show')->name('guest.events.show');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
