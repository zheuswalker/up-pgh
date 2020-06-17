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
      $subject = $decodedobservation->subject->reference;
      $effective = $decodedobservation->effectiveDateTime;
      $effective = date('Y-m-d h:i:s', strtotime($effective));
      $status = $decodedobservation->status;
      $error;
      $errorsystem;
      try{
      $error =$decodedobservation->dataAbsentReason->coding->code;
      $errorsystem =$decodedobservation->dataAbsentReason->coding->system;
      }catch(\Exception $ex){
          $errorsystem = "none";
          $error = "none";
      }
      
      try{
      $code = $decodedobservation->code->coding{0}->code;
      $value = $decodedobservation->valueQuantity->value;
      $valuesystem = $decodedobservation->valueQuantity->system;
      $valuecode =  $decodedobservation->valueQuantity->code;
      $valueunit = $decodedobservation->valueQuantity->unit;

      
      $addpatient_observation = \DB::SELECT("call sp_addpatient_observation(?,?,?,?,?,?,?,?,?,?,?)",[$id, $code, $value, $subject, $effective,$status,$error, $errorsystem,$valuesystem,$valuecode,$valueunit]);
      $addpatient_observation_report = json_encode(array('addpatient_observation_report' => $addpatient_observation ));
      echo $addpatient_observation_report;
      
      }catch(\Exception $ex){
          foreach($decodedobservation->component as $obsarray_content){

            if(isset($obsarray_content->valueQuantity->value)){
      $code = $obsarray_content->code->coding{0}->code;
      $value = $obsarray_content->valueQuantity->value;
      $valuesystem = $obsarray_content->valueQuantity->system;
      $valuecode =  $obsarray_content->valueQuantity->code;
      $valueunit = $obsarray_content->valueQuantity->unit;
      $addpatient_observation = \DB::SELECT("call sp_addpatient_observation(?,?,?,?,?,?,?,?,?,?,?)",[$id, $code, $value, $subject, $effective,$status,$error, $errorsystem,$valuesystem,$valuecode,$valueunit]);
      $addpatient_observation_report = json_encode(array('addpatient_observation_report' => $addpatient_observation ));
      echo $addpatient_observation_report;
    }else if(isset($obsarray_content->valueSampledData->data)){

     
      $code = $obsarray_content->code->coding{0}->code;
      $valuesystem = $obsarray_content->code->coding{0}->system;
      $originvalue = $obsarray_content->valueSampledData->origin->value;
      $period = $obsarray_content->valueSampledData->period;
      $factor = $obsarray_content->valueSampledData->factor;
      $dimensions = $obsarray_content->valueSampledData->dimensions;
      $data = $obsarray_content->valueSampledData->data;
      $addpatient_observation = \DB::SELECT("call sp_insertECG(?,?,?,?,?,?,?,?,?,?)",[$id, $status, $valuesystem, $subject, $effective,$originvalue,$period, $factor,$dimensions,$data]);
      $addpatient_observation_report = json_encode(array('addpatient_observation_report' => $addpatient_observation ));
      echo $addpatient_observation_report;


    }

          }



      }
  
  }

 public function patientTimeFrame(){
  $patientid = trim($_GET['patient']);
  try{
  $patientid = substr($patientid, strpos($patientid,"/")+1, strlen($patientid));
     $patient_timeframe = \DB::SELECT("call sp_getpatienttimeframe(?)",[$patientid]);
  $period;
  if(count($patient_timeframe) > 0) {
            foreach($patient_timeframe as $row) { 
              $period = $row->rpc_time_frame;
            }
        }
     $patientinfo = "Patient/".$patientid;
   $array = [
    'type' => "searchset",
    'total' => 1,
    'entry' =>[[
    'intent' => "order",
    'codeCodeableConcept'=> ['code'=>"70665002", 'System'=>"http://hl7.org/fhir/ValueSet/device-kind"],
    'subject' => $patientinfo,
    'occurenceTiming'=>array("repeat"=>array("frequency"=>1,"period"=>$period, "periodunit"=>"m"))
    ]]   
];

echo json_encode($array);
}catch(\Exception $ex){
  $array = [
    'type' => "searchset",
    'total' => 0,
    'entry' => []
  ]
  echo $array;
}
     
    }

    public function getPatientRangedObservation(){

      try{
    $obscode = $_POST['obscode'];
    $spec_date = $_POST['spec_date'];
    $patientid = $_POST['patientid'];
    $patientinfo = "Patient/".$patientid;
    $PatientRangedObservation = \DB::SELECT("call  sp_getPatientObservationRange(?,?,?)",[$obscode,$spec_date,$patientid]);
      $PatientRangedObservation = json_encode(array('PatientRangedObservation' => $PatientRangedObservation ));
      echo $PatientRangedObservation;

      }catch(\Exception $ex){
          echo "invalid request";
      }

    }


   public function create_statuscode(Request $request){

    $name = $_POST['name'];
    $descr = $_POST['descr'];
    $category = $_POST['category'];
    $create_statuscode = \DB::SELECT("call  sp_createstatuscode(?,?,?)",[$name,$descr,$category]);
      $create_statuscode_report = json_encode(array('create_statuscode' => $create_statuscode ));
      echo $create_statuscode_report;

 }

 public function delete_statuscode(Request $request){

    $codeid = $_POST['codeid'];
    $delete_statuscode = \DB::SELECT("call  sp_deletestatuscode(?)",[$codeid]);
      $delete_statuscode_report = json_encode(array('delete_statuscode' => $delete_statuscode ));
      echo $delete_statuscode_report;

 }

  public function filter_statuscode(){

    $statuscode = $_GET['statuscode'];
    $filter_statuscode = \DB::SELECT("call  sp_filterstatuscode(?)",[$statuscode]);
      $filter_statuscode = json_encode( array('filter_statuscode_report'=>$filter_statuscode) );
      echo $filter_statuscode;

 }

  public function get_statuscode(Request $request){

    $get_statuscode = \DB::SELECT("call sp_getstatuscode()");
      $get_statuscode_report = json_encode(array('statuscode_report' => $get_statuscode ));
      echo $get_statuscode_report;

 }

  	
}
