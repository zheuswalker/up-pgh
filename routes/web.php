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
Route::get('/view/updatepatient', function () {

    return view('updatepatient');
});
Route::post('/addpatientapi','PatientController@addPatient');
Route::get('/Patient/{patientid}','PatientController@patientDetails');
Route::get('/PatientFullDetails/{patientid}','PatientController@getPatientFullDetails');
Route::post('/addPatientConfig','PatientController@addPatientConfig');
Route::post('/addPatientData','PatientController@addPatientData');
Route::get('/Group/patient-queue','PatientController@patientQue');
Route::post('/Observation','ObservationController@createObservation');
Route::get('/t', function () {

    event(new \App\Events\SendMessage());
    dd('Event Run Successfully.');

});
Route::get('/getpatientlist','PatientController@getpatientlist');
Route::get('/getPatientObservation','PatientController@getPatientObservation');
Route::post('/updatePatient','PatientController@updatePatient');
Route::post('/deletePatient','PatientController@deletePatient');

Route::post('/create_monitor','MonitorController@create_monitor');
Route::post('/delete_monitor','MonitorController@delete_monitor');
Route::post('/update_monitor','MonitorController@update_monitor');
Route::post('/get_monitor','MonitorController@get_monitor');
Route::post('/add_patient_toMonitor','MonitorController@add_patient_toMonitor');
Route::post('/remove_patient_toMonitor','MonitorController@remove_patient_toMonitor');

Route::post('/create_ward','WardController@create_ward');
Route::post('/delete_ward','WardController@delete_ward');
Route::post('/update_ward','WardController@update_ward');
Route::post('/get_ward','WardController@get_ward');

Route::get('/monitorWithPatient/{monitorname}','MonitorController@get_monitorPatients');

Route::post('/create_statuscode','ObservationController@create_statuscode');
Route::get('/filter_statuscode','ObservationController@filter_statuscode');
Route::get('/statuscodes/all','ObservationController@get_statuscode');
Route::post('/delete_statuscode','ObservationController@delete_statuscode');
Route::get('/PatientConfig/{patientid}','PatientController@getPatientConfig');
Route::get('/DeviceRequest','ObservationController@patientTimeFrame');

Route::post('/getPatientRangedObservation','ObservationController@getPatientRangedObservation');
Route::post('/requestBP','ObservationController@requestBP');
Route::post('/getOnDemandBP','ObservationController@getOnDemandBP');
Route::post('/sendrequestBP','ObservationController@sendrequestBP');
Route::post('/getRequestBPValue','ObservationController@getRequestBPValue');

Route::post('/checkpassword','MonitorController@checkpassword');
