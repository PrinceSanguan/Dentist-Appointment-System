<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AssistantController;
use App\Http\Controllers\DentistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('welcome');

Route::get('/signup', [SignupController::class, 'index'])->name('signup');
Route::post('/signup', [SignupController::class, 'signup'])->name('signup-form');

Route::get('/signin', [IndexController::class, 'signin'])->name('signin');
Route::post('/signin', [LoginController::class, 'loginForm'])->name('login-form');

// Email verification routes
Route::get('/email/verify', function () {
  return view('auth.verify-email');  // View asking the user to verify their email
})->middleware('auth')->name('verification.notice');

// This route will handle the email verification process
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();  // Mark the user as verified and update the status

  return redirect('/welcome');  // Redirect the user to their dashboard after verification
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resend verification email if needed
Route::post('/email/resend', function (Request $request) {
  $request->user()->sendEmailVerificationNotification();

  return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


/**Admin Route */
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

Route::get('/admin/dentist', [AdminController::class, 'dentist'])->name('admin.dentist');
Route::post('/admin/dentist', [AdminController::class, 'addDentistAccount'])->name('admin.add-dentist');
Route::post('/admin/dentist/delete/{id}', [AdminController::class, 'dentistDeleteAccount'])->name('admin.dentist-delete');

Route::get('/admin/assistant', [AdminController::class, 'assistant'])->name('admin.assistant');
Route::post('/admin/assistant', [AdminController::class, 'addAssistantAccount'])->name('admin.add-assistant');
Route::post('/admin/assistant/delete/{id}', [AdminController::class, 'assistantDeleteAccount'])->name('admin.assistant-delete');

Route::get('/admin/schedule', [AdminController::class, 'schedule'])->name('admin.schedule');
Route::get('/admin/appointment', [AdminController::class, 'appointment'])->name('admin.appointment');

Route::get('/admin/audit-logs', [AdminController::class, 'auditLogs'])->name('admin.audit-logs');

Route::get('/admin/patient', [AdminController::class, 'patient'])->name('admin.patient');
Route::get('/admin/patient/view/{id}', [AdminController::class, 'viewPatient'])->name('patients.view');

Route::get('/admin/concern', [AdminController::class, 'concern'])->name('admin.concern');
Route::post('/admin/reply', [AdminController::class, 'concernReply'])->name('concern.reply');

Route::patch('/admin/patient/{id}', [AdminController::class, 'updatePatientStatus'])->name('admin.update-status');
Route::post('/admin/patient/delete/{id}', [AdminController::class, 'patientDeleteAccount'])->name('admin.patient-delete');
/**Admin Route */

/**Patient Route */
Route::get('/patient/dashboard', [PatientController::class, 'index'])->name('patient.dashboard');

Route::get('/patient/concern', [PatientController::class, 'concern'])->name('patient.concern');
Route::post('/patient/concern', [PatientController::class, 'userConcernInput'])->name('patient.concern-input');


Route::get('/patient/appointment', [PatientController::class, 'appointment'])->name('patient.appointment');

Route::get('/patient/dentist', [PatientController::class, 'dentist'])->name('patient.dentist');

Route::get('/patient/settings', [PatientController::class, 'settings'])->name('patient.settings');
Route::post('/patient/settings', [PatientController::class, 'editUserProfile'])->name('patient.edit-profile');
Route::post('/patient/settings/change-password', [PatientController::class, 'userChangePassword'])->name('patient.change-password');
Route::post('/patient/delete-account', [PatientController::class, 'userDelete'])->name('patient.delete-account');
/**Patient Route */

/**Assistant Route */
Route::get('/assistant/dashboard', [AssistantController::class, 'index'])->name('assistant.dashboard');

Route::get('/assistant/appointment-request', [AssistantController::class, 'appointmentRequest'])->name('assistant.appointment-request');
Route::get('/assistant/pending-account', [AssistantController::class, 'pendingAccount'])->name('assistant.pending-account');
Route::get('/assistant/settings', [AssistantController::class, 'settings'])->name('assistant.settings');

Route::patch('/assistant/pending-account/{id}', [AssistantController::class, 'updatePatientStatus'])->name('assistant.update-status');
Route::post('/assistant/delete-account', [AssistantController::class, 'userDelete'])->name('assistant.delete-account');
Route::post('/assistant/settings', [AssistantController::class, 'editAssistantProfile'])->name('assistant.edit-profile');
Route::post('/assistant/settings/change-password', [AssistantController::class, 'assistantChangePassword'])->name('assistant.change-password');
/**Assistant Route */

/**Dentist Route */
Route::get('/dentist/dashboard', [DentistController::class, 'index'])->name('dentist.dashboard');
Route::get('/dentist/settings', [DentistController::class, 'settings'])->name('dentist.settings');
Route::get('/dentist/session', [DentistController::class, 'session'])->name('dentist.session');

Route::post('/dentist/session/cancel', [DentistController::class, 'cancelSession'])->name('dentist.cancel-session');
Route::post('/dentist/session', [DentistController::class, 'addSession'])->name('dentist.add-session');
Route::post('/delete/delete-account', [DentistController::class, 'userDelete'])->name('dentist.delete-account');
Route::post('/dentist/settings', [DentistController::class, 'editDentistProfile'])->name('dentist.edit-profile');
Route::post('/dentist/settings/change-password', [DentistController::class, 'dentistChangePassword'])->name('dentist.change-password');
/**Dentist Route */

/**Logout Route */
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
Route::get('/logout/patient', [PatientController::class, 'logout'])->name('patient.logout');
Route::get('/logout/dentist', [DentistController::class, 'logout'])->name('dentist.logout');
Route::get('/logout/assistant', [AssistantController::class, 'logout'])->name('assistant.logout');
/**Logout Route */
