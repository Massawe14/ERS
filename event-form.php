<?php 

  include('config/dbconn.php');
  include('includes/message.php'); 

  if (isset($_POST['event_id']) && isset($_POST['fields'])) {
		$event_id = $_POST['event_id'];
		$fields = $_POST['fields'];
		// convert string to json in php
		$fields = json_decode($fields);

		$sql = "REPLACE INTO form_setting (event_id ";
		for ($i=0; $i < count($fields); $i++) { 
			$aa = $i + 1;
			$sql = $sql . ", field_" . $aa;
		}
		$sql = $sql . ") VALUES ('$event_id'";
		for ($j=0; $j < count($fields); $j++) { 
			$field = $fields[$j];
			$field = json_encode($field);
			$sql = $sql . ", '$field'";
		}
		$sql = $sql . ")";
		$query = $conn->query($sql);
		
		if ($query) {
			echo '{"success":{"message":"data updated"}}';
			$_SESSION['status'] = "Thank You. Form created successfully";
			$_SESSION['status_code'] = "success";
			header('Location: event');
			exit(0);
		}
		else{
			echo '{"error"{"message":"data not updated"}}';
			$_SESSION['status'] = "Sorry. Can't create Form";
			$_SESSION['status_code'] = "error";
			header('Location: form-setting');
			exit(0);
		}
	}
?>