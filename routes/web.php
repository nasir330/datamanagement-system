<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\NeTypeController;
use App\Http\Controllers\SeverityTypeController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\HuAlarmController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;

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

Route::get('/test', function () {
    return view('test');
});

Route::get('/',[AppController::class, 'index'])->name('main');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

Route:: get('/dashboard-data',[DashboardController::class, 'index'])->name('dashboardData');
Route:: post('/dashboard-search-byDate',[DashboardController::class, 'dashboardSearchbyDate'])->name('dashboardSearchbyDate');
Route:: post('/dashboard-search-user',[DashboardController::class, 'dashboardSearchUser'])->name('dashboardSearchUser');
Route:: get('/notification',[DashboardController::class, 'notifications'])->name('notifications');
Route:: get('/all-notification',[DashboardController::class, 'allNotifications'])->name('allNotifications');

Route::get('notification-list',[NotificationController::class, 'index'])->name('notification-list');
Route::get('open-notification/{id}',[NotificationController::class, 'openNotification'])->name('openNotification');
Route::post('approve-notification',[NotificationController::class, 'approve'])->name('approveNotification');
Route::post('search-notification}',[NotificationController::class, 'searchNotification'])->name('searchNotification');

    Route::get('/users',[MembersController::class, 'index'])->name('allUsers');
    Route::post('/users-search',[MembersController::class, 'userSearch'])->name('userSearch');
    Route::post('/users-approve',[MembersController::class, 'userApprove'])->name('userApprove');
    Route::get('/users-edit/{id}',[MembersController::class, 'userEdit'])->name('userEdit');
    Route::post('/users-edit',[MembersController::class, 'userEditSave'])->name('userEditSave');
    Route::get('/users-deleete/{id}',[MembersController::class, 'userDelete'])->name('userDelete');

    Route::get('/members',[MembersController::class, 'members'])->name('allMembers');
    Route::post('/search-members-by-date',[MembersController::class, 'searchMembersByDate'])->name('searchMembersByDate');
    Route::post('/search-members',[MembersController::class, 'searchMembers'])->name('searchMembers');
    Route::get('/add-members',[MembersController::class, 'create'])->name('addMembers');
    Route::post('/add-members',[MembersController::class, 'store'])->name('addMembers');
    Route::get('/users-log',[MembersController::class, 'userLog'])->name('userLog');
    Route::post('/users-log-search-by-date',[MembersController::class, 'userLogsearchByDate'])->name('userLogsearchByDate');
    Route::post('/users-log-search-username',[MembersController::class, 'userLogsearchByUsername'])->name('userLogsearchByUsername');
    Route::get('/users-activitylog/{id}',[MembersController::class, 'userActivityLog'])->name('userActivityLog');
    Route::post('/export-users-log',[MembersController::class, 'exportUserLog'])->name('exportUserLog');
    
    Route::get('huAlarm',[HuAlarmController::class, 'index'])->name('huAlarm');
    Route::get('create-huAlarm',[HuAlarmController::class, 'create'])->name('createHuAlarm');
    Route::post('store-huAlarm',[HuAlarmController::class, 'store'])->name('storeHuAlarm');
    Route::get('edit-huAlarm/{id}',[HuAlarmController::class, 'edit'])->name('editHuAlarm');
    Route::post('update-huAlarm',[HuAlarmController::class, 'update'])->name('updateHuAlarm');
    Route::get('delete-huAlarm/{id}',[HuAlarmController::class, 'delete'])->name('deleteHuAlarm');
    Route::post('huAlarm-search-byDate',[HuAlarmController::class, 'searchHuAlarmbyDate'])->name('searchHuAlarmbyDate');
    Route::post('huAlarm-search-name',[HuAlarmController::class, 'searchHuAlarmbyName'])->name('searchHuAlarmbyName');
    Route::post('/export-hualarm',[HuAlarmController::class, 'exportHuAlarm'])->name('exportHuAlarm');
    Route::post('/import-hualarm',[HuAlarmController::class, 'importHuAlarm'])->name('importHuAlarm');
    Route::get('/summery-netype',[HuAlarmController::class, 'summeryNeType'])->name('summeryNeType');
    Route::post('/summery-search-netype',[HuAlarmController::class, 'summerySearchNeType'])->name('summerySearchNeType');
    Route::post('/summery-search-date',[HuAlarmController::class, 'summerySearchDate'])->name('summerySearchDate');

    Route::get('domain',[DomainController::class, 'index'])->name('domain');
    Route::post('create-domain',[DomainController::class, 'store'])->name('createDomain');
    Route::get('edit-domain/{id}',[DomainController::class, 'edit'])->name('editDomain');
    Route::post('update-domain',[DomainController::class, 'update'])->name('updateDomain');
    Route::get('/domain-deleete/{id}',[DomainController::class, 'domainDelete'])->name('domainDelete');
    
    Route::get('netype',[NeTypeController::class, 'index'])->name('netype');
    Route::post('create-netype',[NeTypeController::class, 'store'])->name('createNetype');
    Route::get('edit-netype/{id}',[NeTypeController::class, 'edit'])->name('editNetype');
    Route::post('update-netype',[NeTypeController::class, 'update'])->name('updateNetype');
    Route::get('netype-delete/{id}',[NeTypeController::class, 'delete'])->name('deleteNetype');


    Route::get('severity-type',[SeverityTypeController::class, 'index'])->name('severitytype');
    Route::post('create-severity',[SeverityTypeController::class, 'store'])->name('createSeverity');
    Route::get('edit-severity/{id}',[SeverityTypeController::class, 'edit'])->name('editSeverity');
    Route::post('update-severity',[SeverityTypeController::class, 'update'])->name('updateSeverity');
    Route::get('severity-delete/{id}',[SeverityTypeController::class, 'delete'])->name('deleteSeverity');

    Route::get('type',[TypeController::class, 'index'])->name('type');
    Route::post('create-type',[TypeController::class, 'store'])->name('createType');
    Route::get('edit-type/{id}',[TypeController::class, 'edit'])->name('editType');
    Route::post('update-type',[TypeController::class, 'update'])->name('updateType');
    Route::get('type-delete/{id}',[TypeController::class, 'delete'])->name('deleteType');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile-edit-photo', [ProfileController::class, 'editPhoto'])->name('edit.profile.photo');
    Route::get('/profile-edit-personal-info/{id}', [ProfileController::class, 'editPersonalInfo'])->name('profile.personalInfo.edit');
    Route::post('/profile-update-personal-info', [ProfileController::class, 'updatePersonalInfo'])->name('profile.personalInfo.update');
    Route::get('/profile-edit-info/{id}', [ProfileController::class, 'editProfileInfo'])->name('profile.info.edit');
    Route::post('/profile-update-info', [ProfileController::class, 'updateProfileInfo'])->name('profile.info.update');
    Route::get('/profile-membership-update/{id}', [ProfileController::class, 'updateProfileMembership'])->name('profile.membership.update');
    Route::post('/profile-request-membership', [ProfileController::class, 'requestUpdateMembership'])->name('profile.request.membership');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('settings',[AppController::class, 'setting'])->name('setting');
    Route::post('submit-settings',[AppController::class, 'storeSetting'])->name('storeSetting');
    Route::post('update-settings',[AppController::class, 'updateSetting'])->name('updateSetting');
});

require __DIR__.'/auth.php';