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
      $effective = date('Y-m-d h:i:s', strtotime($effective));
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
      $get_statuscode_report = json_encode(array('delete_statuscode' => $get_statuscode ));
      echo $get_statuscode_report;

 }

  	
}
