<?php

use App\Models\Doctors;
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

Route::get('doctors', function() {
    return Doctors::with('specialties')->get();
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
