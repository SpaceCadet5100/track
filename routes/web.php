<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CSVController;

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

Route::group(['middleware' => ['permission:limited-read']], function () {
	Route::get('/dashboard/incoming-packages', [PackageController::class, 'incomingPackages'])
	->name('incoming-packages');
});

Route::get('/', [AuthenticatedSessionController::class, 'create'])
               ->middleware('guest')->name('login');

Route::get('/dashboard/outgoing-packages', [PackageController::class, 'outgoingPackages'])
	->middleware(['permission:read'])->name('outgoing-packages');

Route::get('/dashboard/all-packages', [PackageController::class, 'allPackages'])
	->middleware(['role:admin|super-admin|packer'])->name('all-packages');

Route::get('/package/{id}', [PackageController::class, 'guestPackage'])
	->middleware('guest')->name('guest-package');

Route::post('/dashboard/print-lables', [LabelController::class, 'printLables'])
	->middleware(['permission:write'])->name('print-lables');

Route::get('/dashboard/review-delivery/{packageId}', [ReviewController::class, 'create'])
	->middleware(['permission:limited-read'])->name('review-delivery');

Route::get('/package/review-delivery/{packageId}', [ReviewController::class, 'createGuest'])
	->middleware('guest')->name('review-delivery-guest');

Route::get('/dashboard/create-labels', [PackageController::class, 'index'])
	->middleware(['permission:write'])->name('create-labels');

Route::post('/dashboard/store-labels', [PackageController::class, 'store'])
	->middleware(['permission:write'])->name('store-labels');

Route::post('/package/add-delivery-review', [ReviewController::class, 'storeGuest'])
	->middleware('guest')->name('add-delivery-review-guest');

Route::post('/dashboard/add-delivery-review', [ReviewController::class, 'store'])
	->middleware(['role:reciever'])->name('add-delivery-review');

Route::get('/dashboard/csv-uploader', [CSVController::class, 'create'])
	->middleware(['permission:write'])->name('csv-uploader');

Route::post('/dashboard/csv-upload', [CSVController::class, 'store'])
	->middleware(['permission:write'])->name('csv-upload');


Route::get('/API/key={key}&emailSender={sender}&emailRecipient={recipient}&SenderCountry{SenderCountry}&SenderStreetName{SenderStreetName}&SenderHouseNumber{SenderHouseNumber}&SenderPostalCode{SenderPostalCode}&SenderCity{SenderCity}&RecipientCountry{RecipientCountry}&RecipientStreetName{RecipientStreetName}&RecipientHouseNumber{RecipientHouseNumber}&RecipientPostalCode{RecipientPostalCode}&RecipientCity{RecipientCity}&FirstnameSender{FirstnameSender}&LastnameSender&{LastnameSender}&FirstnameRecipient{FirstnameRecipient}&LastnameRecipient{LastnameRecipient}
', [App\Http\Controllers\APIController::class, 'insert'])->name('insert');

Route::get('/API/key={key}&Changepackage{packageID}To{status}', [App\Http\Controllers\APIController::class, 'ChangeStatus'])->name('ChangeStatus');

Route::get('/dashboard/pick-up-plan-system', [AdminController::class, 'pickUpPlanSystem'])
    ->middleware(['permission:write'])->name('pick-up-plan-system');
Route::GET('/dashboard/changePickUp', [AdminController::class, 'changePickUp'])
    ->middleware(['permission:write'])->name('changePickUp');
Route::GET('/dashboard/ConfirmPickUpChange', [AdminController::class, 'ConfirmPickUpChange'])
    ->middleware(['permission:write'])->name('ConfirmPickUpChange');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['permission:limited-read'])->name('dashboard');

Route::get('/lang/{lang}',[
    'uses' => 'App\Http\Controllers\LanguageController@switchLang',
    'as'   => 'switch'
]);

require __DIR__.'/auth.php';
