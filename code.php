<?php 
  include ('plugins/meRaviQr/qrlib.php');
  include ('plugins/config.php');

  if(isset($_POST['create'])) {
        
    $event_id = $_POST['event_id'];
  	$field_1 =  $_POST['field_1'];

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
      echo "<script>alert('cant create QR Code');</script>";
    }
  }
?>