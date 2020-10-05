<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Illuminate\Http\Request;


class MonitorController extends BaseController
{



public function add_patient_toMonitor(Request $request){

 	$monitorid = $_POST['monitorid'];
  $patientid = $_POST['patientid'];
  	$addPatienttoMonitor = \DB::SELECT("call sp_addPatienttoMonitor(?,?)",[$patientid, $monitorid]);
      $addPatienttoMonitor_report = json_encode(array('addPatienttoMonitor_report' => $addPatienttoMonitor ));
      echo $addPatienttoMonitor_report;

 }

public function remove_patient_toMonitor(Request $request){

  $monitorid = $_POST['monitorid'];
  $patientid = $_POST['patientid'];
    $removepatientMonitor_report = \DB::SELECT("call  sp_removepatientMonitor(?,?)",[$patientid, $monitorid]);
      $removepatientMonitor_report = json_encode(array('removepatientMonitor_report' => $removepatientMonitor_report ));
      echo $removepatientMonitor_report;

 }

 public function create_monitor(Request $request){

  try{
 	$monitorname = $_POST['monitorname'];
 	$monitordesc = $_POST['monitordesc'];
 	$wardid = $_POST['wardid'];
  $slotcount = $_POST['maxslot'];
  	$create_monitor = \DB::SELECT("call sp_addMonitor(?,?,?,?)",[$monitorname, $monitordesc,$wardid,$slotcount]);
      $create_monitor_report = json_encode(array('create_monitor_report' => $create_monitor ));
      echo $create_monitor_report;
  }catch(\Exception $ex){
         echo $ex->getMessage();
      }

 }
 public function delete_monitor(Request $request){

 	$monitorid = $_POST['monitorid'];
  	$delete_monitor = \DB::SELECT("call sp_deleteMonitor(?)",[$monitorid]);
      $delete_monitor_report = json_encode(array('delete_monitor_report' => $delete_monitor ));
      echo $delete_monitor_report;

 }
 public function update_monitor(Request $request){


  try{
 	$monitorid = $_POST['monitorid'];
 	$monitorname = $_POST['monitorname'];
 	$monitordesc = $_POST['monitordesc'];
 	$wardid = $_POST['wardid'];
	$maxslot =$_POST['maxslot'];
  	$update_monitor = \DB::SELECT("call sp_UpdateMonitor(?,?,?,?,?)",[$monitorid,$monitorname, $monitordesc,$wardid,$maxslot]);
      $update_monitor_report = json_encode(array('update_monitor_report' => $update_monitor ));
      echo $update_monitor_report;
       }catch(\Exception $ex){
          echo $ex->getMessage();
      }

 }

public function get_monitor(Request $request){

  	$getMonitorList = \DB::SELECT("call sp_getMonitorList()");
      $getMonitorList_report = json_encode( $getMonitorList );
      echo $getMonitorList_report;

 }

 public function get_monitorPatients($monitorname){

    $getPatientList = \DB::SELECT("call sp_getmonitorpatientlist(?)",[$monitorname]);
      $getPatientList = json_encode( $getPatientList );
      echo $getPatientList;

 }


}
