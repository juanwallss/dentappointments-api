<?php

use App\Models\Appointments;
use App\Models\Doctors;
use App\Models\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//------------ Inicia CRUD Doctores
Route::get('doctors', function() {
    return Doctors::with('specialties')->orderBy('id', 'desc')->get();
});
Route::get('doctors/{id}', function ($id) {
    return Doctors::find($id);
});
Route::post('doctors', function (Request $req) {
    $doc = Doctors::create($req->all);
    return $doc;
});

Route::put('doctors/{id}', function(Request $req, $id) {
    $doc = Doctors::findOrFail($id);
    $doc->update($req->all);
    return $doc;
});

Route::delete('doctors/{id}', function ($id) {
    $doc = Doctors::find($id)->delete();
    return 204;
});
//-------------- Termina CRUD Doctores

//-------------- CRUD Pacientes
Route::get('patients', function() {
    return Patients::orderBy('id', 'desc')->get();
});
Route::get('patients/{id}', function ($id) {
    return Patients::find($id);
});
Route::post('patients', function (Request $req) {
    $patient = Patients::create($req->all);
    return $patient;
});

Route::put('patients/{id}', function(Request $req, $id) {
    $patient = Patients::findOrFail($id);
    $patient->update($req->all);
    return $patient;
});

Route::delete('patients/{id}', function ($id) {
    Patients::find($id)->delete();
    return 204;
});
//-------------- FINAL CRUD PACIENTES

//-------------- CRUD Citas
Route::get('appointments', function() {
    return Appointments::with('patient', 'doctor')->orderBy('id', 'desc')->get();
});
Route::get('appointments/{id}', function ($id) {
    return Appointments::find($id);
});
Route::post('appointments', function (Request $req) {
    $appointment = Appointments::create($req->all);
    return $appointment;
});

Route::put('appointments/{id}', function(Request $req, $id) {
    $appointment = Appointments::findOrFail($id);
    $appointment->update($req->all);
    return $appointment;
});

Route::delete('appointments/{id}', function ($id) {
    Appointments::find($id)->delete();
    return 204;
});