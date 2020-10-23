<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'Observation',
        'getPatientObservation',
        'addpatientapi',
        'addPatientConfig',
        'patientQue',
        'Patient/{patientid}',
        'addPatientData',
        'updatePatient',
        'deletePatient',
        'create_monitor',
        'delete_monitor',
        'update_monitor',
        'get_monitor',
        'create_ward',
        'delete_ward',
        'update_ward',
        'get_ward',
        'add_patient_toMonitor',
        'PatientFullDetails',
        'remove_patient_toMonitor',
	'monitorWithPatient/{monitorid}',
    'create_statuscode',
    'filter_statuscode',
    'statuscodes/all',
    'delete_statuscode',
    '/PatientConfig/{patientid}',
    'DeviceRequest',
    'getPatientRangedObservation',
    'requestBP',
    'getOnDemandBP',
    'sendrequestBP',
    'getRequestBPValue',
    'checkpassword'

    ];
}
