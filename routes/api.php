<?php

use App\Models\Appointments;
use App\Models\Doctors;
use App\Models\Patients;
use App\Models\Schedules;
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
Route::get('doctores', function() {
    return Doctors::with('especialidades')->where('eliminado', 0)->orderBy('id', 'desc')->get();
});
Route::get('doctores/{id}', function ($id) {
    $doctor = Doctors::with(['especialidades', 'citas' => function ($query) {
        $query->with('doctor', 'tratamientos', 'patient');
    }])->find($id);
    if ($doctor) {
        return $doctor;
    } else {
        return response()->json(['message' => 'No se encontró el doctor.', 'status' => 404]);
    }
});

Route::post('doctores', function (Request $req) {
    $info = $req->all();
    $specialty_id = $info['specialty'];
    $docToCreate = [
        'nombre' => $info['nombre'],
        'apellido_paterno' => $info['apellido_paterno'],
        'apellido_materno' => $info['apellido_materno'],
        'telefono' => $info['telefono'],
        'email' => $info['email'],
        'ced_prof' => $info['ced_prof'],
        'genero' => $info['genero'],
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
    Doctors::insert($docToCreate);
    $doc = Doctors::where('ced_prof', $info['ced_prof'])->first();
    $doc->especialidades()->syncWithoutDetaching($specialty_id);
    return $doc;
});

Route::put('doctores/{id}', function(Request $req, $id) {
    $info = $req->all();
    $doc = Doctors::findOrFail($info['id']);
    $doc->update($info);
    $doc->especialidades()->sync($info['specialty']);
    Log::info($doc);
    return $doc;
});

Route::delete('doctores/{id}', function ($id) {
    $doc = Doctors::find($id);
    $doc->eliminado = true;
    $doc->save();
    return 204;
});
//-------------- Termina CRUD Doctores

//-------------- CRUD Pacientes
Route::get('pacientes', function() {
    return Patients::where('eliminado', 0)->orderBy('id', 'desc')->get();
});
Route::get('pacientes/{id}', function ($id) {
    $patient = Patients::with([
        'citas' => function ($query) {
            $query->with('doctor', 'tratamientos');
        }
    ])->where('id',$id)->where('eliminado', false)->first();
    if ($patient) {
        return $patient;
    } else {
        return response()->json(['message' => 'No se encontró el paciente.', 'status' => 404]);
    }
});
Route::post('pacientes', function (Request $req) {
    $info = $req->all();
    $patient = Patients::create($req->all());
    return $patient;
});

Route::put('pacientes/{id}', function(Request $req, $id) {
    $info = $req->all();
    $patient = Patients::findOrFail($info['id']);
    $patient->update($info);
    return $patient;
});

Route::delete('pacientes/{id}', function ($id) {
    $patient = Patients::find($id);
    $patient->eliminado = true;
    $patient->save();
    return 204;
});
//-------------- FINAL CRUD PACIENTES
// --------------- CRUD Tratamientos
Route::get('tratamientos', function () {
    return Treatment::orderBy('id','asc')->get();
});

Route::get('tratamientos/{id}', function ($id) {
    $treatment = Treatment::find($id);
    if ($treatment) {
        return $treatment;
    } else {
        return response()->json(['message'=>'No se encontró la consulta.', 'status' => 404]);
    }
});

Route::post('tratamientos', function (Request $req) {
    $treatment = Treatment::create($req->all());
    return $treatment;
});

Route::put('tratamientos/{id}', function (Request $req, $id) {
    $treatment = Treatment::findOrFail($id);
    $treatment->update($req->all());
    return $treatment;
});
// --------------- FIN CRUD
//-------------- CRUD Citas
Route::get('citas', function() {
    return Appointments::with('patient', 'doctor')->where('eliminado', 0)->whereNot('status', 'CANCELADA')->whereNot('status', 'REALIZADA')->orderBy('date', 'asc')->get();
});
Route::get('citas/{id}', function ($id) {
    $app = Appointments::find($id);
    if ($app) {
        return $app;
    } else {
        return response()->json(['message' => 'No se encontró el doctor.', 'status' => 404]);
    }
});
Route::post('citas', function (Request $req) {
    // Obtener el doctor y las citas existentes para ese día
    $doctor = Doctors::findOrFail($req->input('doctor_id'));
    $date = $req->input('date');
    $hasApp = false;
    $existingAppointments = Appointments::where('doctor_id', $doctor->id)
        ->whereDate('date', $date)
        ->get();

    // Verificar si hay espacio disponible en las horas seleccionadas
    $initialTimeId = $req->input('initial_time_id');
    $endTimeId = $req->input('end_time_id');
    // foreach($existingAppointments as $app) {
    //     if($initialTimeId >= $app->initial_time_id || $initialTimeId < $endTimeId) {
    //         $hasApp = true;
    //     }
    // }
    $existingTimeIds = $existingAppointments->pluck('initial_time_id')->merge($existingAppointments->pluck('end_time_id'))->unique();
    Log::info($hasApp);
    if ($existingTimeIds->contains($initialTimeId) && $existingTimeIds->contains($endTimeId)) {
        // $earlier = Schedules::where('id', '<', $initialTimeId)->get();
        // $later = Schedules::where('id', '>', $initialTimeId)->get();
        // $data1 = $earlier[0]->time . ' a ' . $earlier[count($earlier) - 1]->time;
        return response()->json(['error' => 'El doctor ya tiene una cita en ese horario.'], 400);
    }
    // Crear la cita si pasa la validación
    $appointment = Appointments::create($req->all());
    return $appointment;
});

Route::put('citas/{id}', function(Request $req, $id) {
    $appointment = Appointments::findOrFail($id);
    $appointment->update($req->all());
    return $appointment;
});

Route::delete('citas/{id}', function ($id) {
    $appointment = Appointments::find($id);
    $appointment->status = "CANCELADA";
    $appointment->save();
    return 204;
});

//-------------------Crud especialidades
Route::get('/especialidades',function () {
    return Specialty::all();
});

Route::get('especialidades/{id}', function ($id) {
    $sp = Specialty::find($id);
    if ($sp) {
        return $sp;
    } else {
        return response()->json(['message' => 'No se encontró la especialidad.', 'status' => 404]);
    }
});
Route::post('especialidades', function (Request $req) {
    $sp = Specialty::create($req->all());
    return $sp;
});

Route::put('especialidades/{id}', function(Request $req, $id) {
    $info = $req->all();
    $patient = Specialty::findOrFail($info['id']);
    $patient->update($info);
    return $patient;
});

// REPORTES

Route::get('report_by_doctor', function () {
    return Doctors::with('citas')->get();
});

Route::get('horas', function () {
    return Schedules::all();
});