<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;
use Illuminate\Http\Request;


class WardController extends BaseController
{


public function create_ward(Request $request){

 	$wardname = $_POST['wardname'];
 	$warddesc = $_POST['warddesc'];
  	$create_ward = \DB::SELECT("call  sp_addWard(?,?)",[$wardname, $monitordesc]);
      $create_ward_report = json_encode(array('create_ward_report' => $create_ward ));
      echo $create_ward_report;

 }

  public function update_ward(Request $request){

 	$wardid = $_POST['wardid'];
 	$wardname = $_POST['wardname'];
 	$warddesc = $_POST['warddesc'];
  	$update_ward = \DB::SELECT("call sp_UpdateMonitor(?,?,?)",[$wardid,$wardname, $warddesc]);
      $update_ward_report = json_encode(array('update_ward_report' => $update_ward ));
      echo $update_ward_report;

 }

 public function delete_ward(Request $request){

 	$wardid = $_POST['wardid'];
  	$delete_ward = \DB::SELECT("call  sp_RemoveWard(?)",[$wardid]);
      $delete_ward_report = json_encode(array('delete_monitor_report' => $delete_ward ));
      echo $delete_ward_report;

 }



public function get_ward(Request $request){

  	$get_ward = \DB::SELECT("call  sp_getWards ()");
      $get_ward_report = json_encode(array('get_ward_report' => $get_ward ));
      echo $get_ward_report;

 }
}