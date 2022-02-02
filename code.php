<?php 
  include ('plugins/meRaviQr/qrlib.php');
  include ('plugins/config.php');

  if(isset($_POST['create'])) {
        
    $event_id = isset($_POST['event_id']) ? $_POST['event_id'] : '';
  	$field_1 =  isset($_POST['field_1']) ? $_POST['field_1'] : '';
    $field_2 =  isset($_POST['field_2']) ? $_POST['field_2'] : '';
    $field_3 =  isset($_POST['field_3']) ? $_POST['field_3'] : '';
    $field_4 =  isset($_POST['field_4']) ? $_POST['field_4'] : '';
    $field_5 =  isset($_POST['field_5']) ? $_POST['field_5'] : '';
    $field_6 =  isset($_POST['field_6']) ? $_POST['field_6'] : '';
    $field_7 =  isset($_POST['field_7']) ? $_POST['field_7'] : '';

    if (isset($field_1) && isset($field_2) && isset($field_3) && isset($field_4) && isset($field_5) && isset($field_6) && isset($field_7)) {
      // code...
      $qrImgName = "$field_1".rand();
      $qrimage = $qrImgName.".png";
      $qrs = QRcode::png($qrimage,"plugins/userQr/$qrImgName.png","H","3","3");
      $workDir = $_SERVER['HTTP_HOST'];
      $qrlink = $workDir."/qrcode".$qrImgName.".png";
      $insQr = $register->insertQr($event_id,$field_1,$qrimage,$qrlink);

      if($insQr == true) {
          echo "<script>alert('Thank You. Success Create Your QR Code'); window.location='forms.php?success=$qrimage&field_1=$field_1';</script>";
      }
      else {
        echo "<script>alert('cant create QR Code');
        window.location='forms.php?event_id=$event_id';</script>";
      }
    }
    else {
      echo "<script>alert('Undefined field');
        window.location='forms.php?event_id=$event_id';</script>";
    }
  }
?>