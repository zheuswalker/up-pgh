<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Illuminate\Http\Request;


class ObservationController extends BaseController
{

  public function createObservation(Request $request){

      // $observation = json_encode($_REQUEST['observation']);
      $decodedobservation =  $request->getContent();
      $decodedobservation = json_decode($decodedobservation);
      $id = $decodedobservation->id;
      $code = $decodedobservation->code->coding{0}->code;
      $value = $decodedobservation->valueQuantity->value;
      $subject = $decodedobservation->subject->reference;
      $effective = $decodedobservation->effectiveDateTime;
      $status = $decodedobservation->status;
      $valuesystem = $decodedobservation->valueQuantity->system;
      $valuecode =  $decodedobservation->valueQuantity->code;
      $valueunit = $decodedobservation->valueQuantity->unit;
      $error;
      $errorsystem;
      try{
      $error =$decodedobservation->dataAbsentReason->coding->code;
      $errorsystem =$decodedobservation->dataAbsentReason->coding->system;
      }catch(\Exception $ex){
          $errorsystem = "none";
          $error = "none";
      }
      
      $addpatient_observation = \DB::SELECT("call sp_addpatient_observation(?,?,?,?,?,?,?,?,?,?,?)",[$id, $code, $value, $subject, $effective,$status,$error, $errorsystem,$valuesystem,$valuecode,$valueunit]);
      $addpatient_observation_report = json_encode(array('addpatient_observation_report' => $addpatient_observation ));
      echo $addpatient_observation_report;

  
  }
  	
}
