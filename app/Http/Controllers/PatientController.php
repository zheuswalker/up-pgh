<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;

class PatientController extends BaseController
{
  	public function addPatient(){
  		$patientfname = $_POST['patientfname'];
  		$patientmname = $_POST['patientmname'];
  		$patientlname = $_POST['patientlname'];
  		$diagnosis = $_POST['diagnosis'];
  		$age = $_POST['age'];
  		$addpatient = \DB::SELECT("call sp_addpatient(?,?,?,?,?)",[$patientfname, $patientmname, $patientlname, $diagnosis, $age]);
		$output = json_encode(array('addpatient_report' => $addpatient ));
		echo $output;
    
  	}

  	public function addPatientConfig(){
  		$patientid = $_POST['patientid'];
  		$respiration_rate = $_POST['respiration_rate'];
  		$oxygen_level = $_POST['oxygen_level'];
  		$bprate_sys = $_POST['bprate_sys'];
  		$bprate_dias = $_POST['bprate_dias'];
  		$heart_rate = $_POST['heart_rate'];
  		$addpatient_config = \DB::SELECT("call sp_patientconfig(?,?,?,?,?,?)",[$patientid, $respiration_rate, $oxygen_level,$bprate_sys,$bprate_dias, $heart_rate]);
		$output = json_encode(array('addpatient_config_report' => $addpatient_config ));
		echo $output;
  	}

      public function patientQue(){
          $addpatient_config = \DB::SELECT("SELECT concat('Patient/',rpi_patiendid) reference FROM `r_patient_info` ");

   $array = [
    'id' => 'patient-queue',
    'type' => 'person',
    'member' => [['entity'=>[$addpatient_config]]]
];
echo json_encode($array);
    }

    public function patientDetails($patientid){
          $addpatient_config = \DB::SELECT("select concat(rpi_patientfname, ' ', rpi_patientmname, ' ', rpi_patientlname ) name , rpi_gender, rpi_birthday from r_patient_info where rpi_patiendid = ?",[$patientid]);
  $name;
  $gender;
  $birthdate;

  if(count($addpatient_config) > 0) {
            foreach($addpatient_config as $row) { 
              $name = $row->name;  $gender =$row->rpi_gender; $birthdate=$row->rpi_birthday;}
        }
     
   $array = [
    'id' => $patientid,
    'identifier' => ['value'=>$patientid, 'system'=>'sibol.rxbox.telehealth.ph'],
    'name'=>['text'=>$name],
    'gender'=>$gender,
    'birthdate'=>$birthdate
    
];
echo json_encode($array);
    }

  	public function addPatientData(){
  		$patientid = $_POST['patientid'];
  		$respiration_rate = $_POST['respiration_rate'];
  		$oxygen_level = $_POST['oxygen_level'];
  		$bprate_sys = $_POST['bprate_sys'];
  		$bprate_dias = $_POST['bprate_dias'];
  		$heart_rate = $_POST['heart_rate'];
		$addPatientData = \DB::SELECT("call sp_addpatienthistory(?,?,?,?,?,?)",[$patientid, $respiration_rate, $oxygen_level,$bprate_sys,$bprate_dias, $heart_rate]);
		$output = json_encode(array('addPatientData_report' => $addPatientData ));
		echo $output;

  	}
  	
}
