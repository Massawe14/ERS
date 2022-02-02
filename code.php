<?php 
  include ('plugins/meRaviQr/qrlib.php');
  include ('plugins/config.php');
  include('includes/message.php');

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
	        echo "<script> window.location='forms.php?success=$qrimage&event_id=$event_id';</script>";
	        $_SESSION['status'] = "QR code created successfully";
	    	$_SESSION['status_code'] = "success";
	        header('Location: forms');
	        exit(0);
	    }
	    else {
	        // echo "<script>alert('cant create QR Code');</script>";
	        $_SESSION['status'] = "Can't create QR code";
	    	$_SESSION['status_code'] = "error";
	        header('Location: forms');
	        exit(0);
	    }

	    // if($fullname == "" && $branchname == "" && $zone == "") {
	    //   // echo "<script>alert('Please Fill all fields');</script>";
	    // 	$_SESSION['status'] = "Please Fill all fields";
	    // 	$_SESSION['status_code'] = "error";
	    //     header('Location: forms');
	    //     exit(0);
	    // }
	    // elseif($fullname == "") {
	    //   // echo "<script>alert('Please Enter Your Full Name');</script>";
	    // 	$_SESSION['status'] = "Please Enter Your Full Name";
	    // 	$_SESSION['status_code'] = "error";
	    //     header('Location: forms');
	    //     exit(0);
	    // }
	    // elseif($branchname == "") {
	    //   // echo "<script>alert('Please Enter Your Branch Name');</script>";
	    // 	$_SESSION['status'] = "Please Enter Your Branch Name";
	    // 	$_SESSION['status_code'] = "error";
	    //     header('Location: forms');
	    //     exit(0);
	    // }
	    // elseif($zone == "") {
	    //   // echo "<script>alert('Please Enter Your Zone');</script>";
	    // 	$_SESSION['status'] = "Please Enter Your Zone";
	    // 	$_SESSION['status_code'] = "error";
	    //     header('Location: forms');
	    //     exit(0);
	    // }
	    // else {
	    //   $qrimage = $qrImgName.".png";
	    //   $qrs = QRcode::png($qrimage,"userQr/$qrImgName.png","H","3","3");
	    //   $workDir = $_SERVER['HTTP_HOST'];
	    //   $qrlink = $workDir."/qrcode".$qrImgName.".png";
	    //   $insQr = $register->insertQr($event_id,$field_1,$field_2,$field_3,$field_4,$field_5,$field_6,$field_7,$qrimage,$qrlink);

	    //   if($insQr == true) {
	    //     echo "<script> window.location='form_builder.php?success=$qrimage&fname=$fullname';</script>";
	    //     $_SESSION['status'] = "QR code created successfully";
	    // 	$_SESSION['status_code'] = "success";
	    //     header('Location: forms');
	    //     exit(0);
	    //   }
	    //   else {
	    //     // echo "<script>alert('cant create QR Code');</script>";
	    //     $_SESSION['status'] = "Can't create QR code";
	    // 	$_SESSION['status_code'] = "error";
	    //     header('Location: forms');
	    //     exit(0);
	    //   }
	    // }
    }
?>