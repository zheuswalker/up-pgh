<?php

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
    return view('addpatient');
});
Route::get('/addpatient', function () {

    return view('addpatient');
});
Route::post('/addpatientapi','PatientController@addPatient');
Route::get('/Patient/{patientid}','PatientController@patientDetails');
Route::get('/addPatientConfig','PatientController@addPatientConfig');
Route::get('/addPatientData','PatientController@addPatientData');
Route::get('/patientQue','PatientController@patientQue');
Route::post('/Observation','ObservationController@createObservation');
Route::get('/t', function () {

    event(new \App\Events\SendMessage());
    dd('Event Run Successfully.');

});

Route::get('/getPatientObservation','PatientController@getPatientObservation');