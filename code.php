<?php 
  include ('plugins/meRaviQr/qrlib.php');
  include ('plugins/config.php');

  if(isset($_POST['create'])) {
  	
	  	$event_id = $_POST['event_id'];
	  	$field_1 =  $_POST['field_1'];
	    $field_2 = $_POST['field_2'];
	    $field_3 = $_POST['field_3'];
	    $field_4 = $_POST['field_4'];
	    $field_5 = $_POST['field_5'];
	    $field_6 = $_POST['field_6'];
	    $field_7 = $_POST['field_7'];

	    $qrImgName = "$event_id".rand();
	    $qrimage = $qrImgName.".png";
	    $qrs = QRcode::png($qrimage,"userQr/$qrImgName.png","H","3","3");
	    $workDir = $_SERVER['HTTP_HOST'];
	    $qrlink = $workDir."/qrcode".$qrImgName.".png";
	    $insQr = $register->insertQr($event_id,$field_1,$field_2,$field_3,$field_4,$field_5,$field_6,$field_7,$qrimage,$qrlink);

	    if($insQr == true) {
	        echo "<script>alert('Thank You. Success Create Your QR Code'); window.location='index.php?success=$qrimage&fname=$fullname';</script>";
	    }
	    else {
	        echo "<script>alert('cant create QR Code');</script>";
	    }
    }
?>