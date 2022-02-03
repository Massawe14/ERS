<?php 

  include('config/dbconn.php'); 

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
		}
		else{
			echo '{"error"{"message":"data not updated"}}';
		}
	}
?>