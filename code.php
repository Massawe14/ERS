<?php 
  include ('plugins/meRaviQr/qrlib.php');
  include ('plugins/config.php');
  include('config/dbconn.php');

  if(isset($_POST['create'])) {

    $fields = array(
      'event_id' => isset($_POST['event_id']) ? $_POST['event_id'] : '',
      'field_1' => isset($_POST['field_1']) ? $_POST['field_1'] : '',
      'field_2' =>  isset($_POST['field_2']) ? $_POST['field_2'] : '',
      'field_3' =>  isset($_POST['field_3']) ? $_POST['field_3'] : '',
      'field_4' =>  isset($_POST['field_4']) ? $_POST['field_4'] : '',
      'field_5' =>  isset($_POST['field_5']) ? $_POST['field_5'] : '',
      'field_6' =>  isset($_POST['field_6']) ? $_POST['field_6'] : '',
      'field_7' =>  isset($_POST['field_7']) ? $_POST['field_7'] : '',
    );

    $event_id = $fields['event_id'];
    $field_1 = $fields['field_1'];

    $qrImgName = "$field_1"."$event_id".rand();
    $qrimage = $qrImgName.".png";
    $qrs = QRcode::png($qrimage,"plugins/userQr/$qrImgName.png","H","3","3");
    $workDir = $_SERVER['HTTP_HOST'];
    $qrlink = $workDir."/qrcode".$qrImgName.".png";

    ksort($fields);

    // Defining a callback function
    function myFilter($var){
      return ($var !== NULL && $var !== FALSE && $var !== "");
    }

    // Filtering the array
    $fields = array_filter($fields, "myFilter");

    foreach ($fields as $key => $value) {
      $k[] = $key;
      $v[] = "'".$value."'";
    }

    $k = implode(",", $k);
    $v = implode(",", $v);

    $sql = "REPLACE INTO registered ($k,qrImage,qrlink) VALUES ($v,'$qrimage','$qrlink')";
    $result = mysqli_query($conn, $sql);

    if($result) {
      
      $sql = "SELECT name, image FROM event WHERE id = '$event_id'";

      // make query & get result
      $result = mysqli_query($conn, $sql);

      // fetch the resulting rows as an array
      $event = mysqli_fetch_all($result, 'MYSQLI_ASSOC');
      
      // This will move array elements one level up and you can access any array element without using [0] key
      $event = array_shift($event);

      $name = $event['name'];
      $image = $event['image'];

      // free result from memory
      mysqli_free_result($result);

      echo "<script>alert('Thank You. Success Create Your QR Code');
      window.location='forms.php?success=$qrimage&field=$field_1&name=$name&image=$image';</script>";
    }
    else {
      echo "<script>alert('cant create QR Code');
      window.location='forms.php?event_id=$event_id';</script>";
    }
  }
?>