<?php

use App\Models\Appointments;
use App\Models\Doctors;
use App\Models\Patients;
use App\Models\Specialty;
use App\Models\Treatment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
    return Doctors::with('specialties')->where('deleted', 0)->orderBy('id', 'desc')->get();
});
Route::get('doctors/{id}', function ($id) {
    return Doctors::with('specialties')->find($id);
});
Route::post('doctors', function (Request $req) {
    $info = $req->all();
    $specialty_id = $info['specialty'];
    $docToCreate = [
        'name' => $info['name'],
        'father_lastname' => $info['father_lastname'],
        'mother_lastname' => $info['mother_lastname'],
        'phone' => $info['phone'],
        'email' => $info['email'],
        'professional_id' => $info['professional_id'],
        'gender' => $info['gender'],
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
    Doctors::insert($docToCreate);
    $doc = Doctors::where('professional_id', $info['professional_id'])->first();
    $doc->specialties()->syncWithoutDetaching($specialty_id);
    return $doc;
});

Route::put('doctors/{id}', function(Request $req, $id) {
    $info = $req->all();
    $doc = Doctors::findOrFail($info['id']);
    $doc->update($info);
    $doc->specialties()->sync($info['specialty']);
    Log::info($doc);
    return $doc;
});

Route::delete('doctors/{id}', function ($id) {
    $doc = Doctors::find($id);
    $doc->deleted = true;
    $doc->save();
    return 204;
});
//-------------- Termina CRUD Doctores

//-------------- CRUD Pacientes
Route::get('patients', function() {
    return Patients::where('deleted', 0)->orderBy('id', 'desc')->get();
});
Route::get('patients/{id}', function ($id) {
    $patient = Patients::with([
        'appointments' => function ($query) {
            $query->with('doctor', 'treatments');
        }
    ])->where('id',$id)->where('deleted', false)->first();
    if ($patient) {
        return $patient;
    } else {
        return response()->json(['message' => 'No se encontró el paciente.', 'status' => 404]);
    }
});
Route::post('patients', function (Request $req) {
    $info = $req->all();
    $patient = Patients::create($req->all());
    return $patient;
});

Route::put('patients/{id}', function(Request $req, $id) {
    $info = $req->all();
    $patient = Patients::findOrFail($info['id']);
    $patient->update($info);
    return $patient;
});

Route::delete('patients/{id}', function ($id) {
    $patient = Patients::find($id);
    $patient->deleted = true;
    $patient->save();
    return 204;
});
//-------------- FINAL CRUD PACIENTES
// --------------- CRUD Tratamientos
Route::get('treatments', function () {
    return Treatment::orderBy('id','asc')->get();
});

Route::get('treatments/{id}', function ($id) {
    $treatment = Treatment::find($id);
    if ($treatment) {
        return $treatment;
    } else {
        return response()->json(['message'=>'No se encontró la consulta.', 'status' => 404]);
    }
});

Route::post('treatments', function (Request $req) {
    $treatment = Treatment::create($req->all());
    return $treatment;
});

Route::put('treatments/{id}', function (Request $req, $id) {
    $treatment = Treatment::findOrFail($id);
    $treatment->update($req->all());
    return $treatment;
});
// --------------- FIN CRUD
//-------------- CRUD Citas
Route::get('appointments', function() {
    return Appointments::with('patient', 'doctor')->where('deleted', 0)->whereNot('status', 'CANCELADA')->whereNot('status', 'REALIZADA')->orderBy('date', 'asc')->get();
});
Route::get('appointments/{id}', function ($id) {
    return Appointments::find($id);
});
Route::post('appointments', function (Request $req) {
    $appointment = Appointments::create($req->all());
    return $appointment;
});

Route::put('appointments/{id}', function(Request $req, $id) {
    $appointment = Appointments::findOrFail($id);
    $appointment->update($req->all());
    return $appointment;
});

Route::delete('appointments/{id}', function ($id) {
    $appointment = Appointments::find($id);
    $appointment->status = "CANCELADA";
    $appointment->save();
    return 204;
});

//-------------------Crud especialidades
Route::get('/specialties',function () {
    return Specialty::all();
});

Route::get('specialties/{id}', function ($id) {
    $sp = Specialty::find($id);
    if ($sp) {
        return $sp;
    } else {
        return response()->json(['message' => 'No se encontró la especialidad.', 'status' => 404]);
    }
});
Route::post('specialties', function (Request $req) {
    $sp = Specialty::create($req->all());
    return $sp;
});

Route::put('specialties/{id}', function(Request $req, $id) {
    $info = $req->all();
    $patient = Specialty::findOrFail($info['id']);
    $patient->update($info);
    return $patient;
});