<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DB;


class PatientController extends BaseController
{

    public function getPatientObservation(){
       

      $patient_observation = \DB::SELECT("SELECT * FROM t_patient_observation limit 1");

   echo json_encode($patient_observation);

    }
  	public function addPatient(){
  		$patientfname = $_POST['patientfname'];
  		$patientmname = $_POST['patientmname'];
  		$patientlname = $_POST['patientlname'];
      $birthday = $_POST['birthday'];
      $gender = $_POST['gender'];
      $age = $_POST['age'];
      $covid19 = $_POST['covid19'];
      $remarks = $_POST['remarks'];
      $address = $_POST['address'];
      $city = $_POST['city'];
      $country = $_POST['country'];
      $contact = $_POST['contact'];
      $email = $_POST['email'];
      $sss_gsis = $_POST['sss_gsis'];
      $philhealth = $_POST['philhealth'];
      $hmo = $_POST['hmo'];
      $admission = $_POST['admission'];
      $ward = $_POST['ward'];
      $emcontactname = $_POST['emcontactname'];
      $emcontactnumber = $_POST['emcontactnumber'];
  		$emrelationship = $_POST['emrelationship'];
  		$addpatient = \DB::SELECT("call sp_addpatient(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",[$patientfname, $patientmname, $patientlname, $birthday,$gender,$age, $covid19, $remarks, $address, $city,$country,$contact, $email, $sss_gsis, $philhealth, $hmo,$admission,$ward,$emcontactname,$emcontactnumber,$emrelationship]);
		$output = json_encode(array('addpatient_report' => $addpatient ));
		echo $output;
    
  	}

  	public function getpatientlist(){
      $getpatientlist_report = \DB::SELECT("call sp_getpatientlist()");
    $output = json_encode(array('getpatientlist_report' => $getpatientlist_report ));
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
