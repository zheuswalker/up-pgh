<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Request;

class ObservationController extends BaseController
{

  public function createObservation(Request $request){

      // $observation = json_encode($_REQUEST['observation']);
      $decodedobservation = $_REQUEST['observation'];
      $decodedobservation = json_decode($decodedobservation);
      $id = $decodedobservation->id;
      $code = $decodedobservation->code->coding->code;
      $value = $decodedobservation->valueQuantity->value;
      $subject = $decodedobservation->subject;
      $effective = $decodedobservation->effectiveDateTime;
      $status = $decodedobservation->status;
      $error =$decodedobservation->dataAbsentReason->coding->code;
      $errorsystem =$decodedobservation->dataAbsentReason->coding->system;
     
      $addpatient_observation = \DB::SELECT("call sp_addpatient_observation(?,?,?,?,?,?,?,?)",[$id, $code, $value, $subject, $effective,$status,$error, $errorsystem]);
      $addpatient_observation_report = json_encode(array('addpatient_observation_report' => $addpatient_observation ));
      echo $addpatient_observation_report;

  
  }
  	
}
