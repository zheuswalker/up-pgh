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



 public function create_monitor(Request $request){

 	$monitorname = $_POST['monitorname'];
 	$monitordesc = $_POST['monitordesc'];
 	$wardid = $_POST['wardid'];
  	$create_monitor = \DB::SELECT("call sp_addMonitor(?,?,?)",[$monitorname, $monitordesc,$wardid]);
      $create_monitor_report = json_encode(array('create_monitor_report' => $create_monitor ));
      echo $create_monitor_report;

 }
 public function delete_monitor(Request $request){

 	$monitorid = $_POST['monitorid'];
  	$delete_monitor = \DB::SELECT("call sp_deleteMonitor(?)",[$monitorid]);
      $delete_monitor_report = json_encode(array('delete_monitor_report' => $delete_monitor ));
      echo $delete_monitor_report;

 }
 public function update_monitor(Request $request){

 	$monitorid = $_POST['monitorid'];
 	$monitorname = $_POST['monitorname'];
 	$monitordesc = $_POST['monitordesc'];
 	$wardid = $_POST['wardid'];
  	$update_monitor = \DB::SELECT("call sp_UpdateMonitor(?,?,?,?)",[$monitorid,$monitorname, $monitordesc,$wardid]);
      $update_monitor_report = json_encode(array('update_monitor_report' => $update_monitor ));
      echo $update_monitor_report;

 }

public function get_monitor(Request $request){

  	$getMonitorList = \DB::SELECT("call sp_getMonitorList()");
      $getMonitorList_report = json_encode(array('getMonitorList_report' => $getMonitorList ));
      echo $getMonitorList_report;

 }

}