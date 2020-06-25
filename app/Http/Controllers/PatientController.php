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
 	$patient_observation = \DB::SELECT("call sp_getPatientObservations()");
      $patient_ecgbos = \DB::SELECT("call sp_getECGObs()");

   echo json_encode(array('patientBasicObservation' =>$patient_observation));
//   echo json_encode(array('patientECGObservation' =>$patient_ecgbos));
     
    }
    public function getPatientConfig($patientid){
      $patient_config = \DB::SELECT("call sp_get_patient_config(?)",[$patientid]);
      echo json_encode($patient_config);

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
      $civil_status = $_POST['civil_status'];
      $classification = $_POST['classification'];
  		$bed_no = $_POST['bed_no'];
  		$addpatient = \DB::SELECT("call sp_addpatient(?,?,?,?,?,?,?,?,?,?,?,?
        ,?,?,?,?,?,?,?,?,?,?,?,?)",[$patientfname, $patientmname, $patientlname, $birthday,$gender,$age, $covid19, $remarks, $address, $city,$country,$contact, $email, $sss_gsis, $philhealth, $hmo,$admission,$ward,$emcontactname,$emcontactnumber,$emrelationship,$civil_status,$classification,$bed_no]);
		$output = json_encode(array('addpatient_report' => $addpatient ));
		echo $output;
    
  	}

public function deletePatient(){
  $patientid = $_POST['patientid'];
  $deletepatient = \DB::SELECT("call sp_deletepatient(?)",[$patientid]);
    $output = json_encode(array('deletepatient_report' => $deletepatient ));
    echo $output;
    
}

public function updatePatient(){
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
      $patientid = $_POST['patientid'];
      $civil_status = $_POST['civil_status'];
      $classification = $_POST['classification'];
      $bed_no = $_POST['bed_no'];

      $updatepatient = \DB::SELECT("call  sp_updatepatient(?,?,?,?,?,?,?,?,?,?,?,
        ?,?,?,?,?,?,?,?,?,?,?,?,?,?)",[$patientfname, $patientmname, $patientlname, $birthday,$gender,$age, $covid19, $remarks, $address, $city,$country,$contact, $email, $sss_gsis, $philhealth, $hmo,$admission,$ward,$emcontactname,$emcontactnumber,$emrelationship,$patientid,$civil_status,$classification,$bed_no]);
    $output = json_encode(array('updatepatient_report' => $updatepatient ));
    echo $output;
    
    }

  	public function getpatientlist(){
      $getpatientlist_report = \DB::SELECT("call sp_getpatientlist()");
    $output = json_encode(array('getpatientlist_report' => $getpatientlist_report ));
    echo $output;
    }

    public function addPatientConfig(){

  		$patientid = $_POST['patientid'];
  		$ecg_st_msec = $_POST['ecg_st_msec'];
  		$heartrate_upper_bpm = $_POST['heartrate_upper_bpm'];
  		$heartrate_lower_bpm = $_POST['heartrate_lower_bpm'];
  		$pulserate_upper_bpm = $_POST['pulserate_upper_bpm'];
      $pulserate_lower_bpm = $_POST['pulserate_lower_bpm'];
      $oxygen_upper_saturation = $_POST['oxygen_upper_saturation'];
      $oxygen_lower_saturation = $_POST['oxygen_lower_saturation'];
      $respiratory_upper_rpm = $_POST['respiratory_upper_rpm'];
      $respiratory_lower_rpm = $_POST['respiratory_lower_rpm'];
      $bp_systolic_upper = $_POST['bp_systolic_upper'];
      $bp_systolic_lower = $_POST['bp_systolic_lower'];
      $bp_diastolic_upper = $_POST['bp_diastolic_upper'];
      $bp_diastolic_lower = $_POST['bp_diastolic_lower'];
      $bp_time_frame = $_POST['bp_time_frame'];
      $temperature_upper = $_POST['temperature_upper'];
      $temperature_lower = $_POST['temperature_lower'];

  		$addpatient_config = \DB::SELECT("call sp_add_patient_config(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",[$patientid, $ecg_st_msec, $heartrate_upper_bpm,$heartrate_lower_bpm,$pulserate_upper_bpm, $pulserate_lower_bpm,
        $oxygen_upper_saturation,$oxygen_lower_saturation,$respiratory_upper_rpm ,$respiratory_lower_rpm ,
        $bp_systolic_upper ,$bp_systolic_lower,$bp_diastolic_upper,$bp_diastolic_lower, $bp_time_frame, 
        $temperature_upper,$temperature_lower
      ]);
		  $output = json_encode(array('addpatient_config_report' => $addpatient_config ));
		  echo $output;
  	
    }

    public function patientQue(){
          $patient_que = \DB::SELECT("SELECT concat('Patient/',rpi_patientid) reference FROM `r_patient_info` where rpi_patientstatus = 1");
$que = array(
    'id' => 'patient-queue',
    'type' => 'person',
    'member' => array()
);
foreach ($patient_que as $reference) {
    $que['member'][] = array (   
        'entity' => array('reference'=>$reference->reference)  
    );
}


echo json_encode($que);
    }

    public function patientDetails($patientid){
          $addpatient_config = \DB::SELECT("select *, concat(rpi_patientfname, ' ', rpi_patientmname, ' ', rpi_patientlname ) name , rpi_gender,  DATE_FORMAT(str_to_date(rpi_birthday, '%m/%d/%Y' ), '%Y-%m-%d')  rpi_birthday from r_patient_info where rpi_patientid = ?",[$patientid]);
  $name;
  $gender;
  $birthdate;

  if(count($addpatient_config) > 0) {
            foreach($addpatient_config as $row) { 
              $name = $row->name;  $gender =$row->rpi_gender; $birthdate=$row->rpi_birthday;}
        }
     
   $array = [
    'id' => $patientid,
    'identifier' => [['system'=>'sibol.rxbox.telehealth.ph', 'value'=>$patientid]],
    'name'=>[['use'=>'official','text'=>$name]],
    'gender'=>$gender,
    'birthdate'=>$birthdate
    
];
$patientdata = \DB::SELECT("select *  from r_patient_info where rpi_patientid = ?",[$patientid]);

echo json_encode($array);
    
    }

public function getPatientFullDetails($patientid){

  $patientdata = \DB::SELECT("select *  from r_patient_info where rpi_patientid = ?",[$patientid]);

$output = json_encode(array('PatientData_report' => $patientdata ));
    echo $output;
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
