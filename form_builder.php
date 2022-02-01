<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration Form</title>
	<style>
		
	</style>
</head>
<body>
	<h1 align="center">Registration Form</h1>
	<div class="container" id="container"></div>
	<script type="text/javascript">
		// Load json data from mysql
		var event_fields = <?php  
		  include('config/dbconn.php');

		  $sql = "SELECT * FROM form_setting";
		  $result = mysqli_query($conn, $sql);

		  $json_array = array();
		  while ($row = mysqli_fetch_assoc($result)) {
		  	$json_array[] = $row;
		  }
		  print(json_encode($json_array));
		?>;

		console.log(event_fields, typeof event_fields);

         const element = document.createElement("div");
		if (event_fields.length > 0) {
			for (var item in event_fields[0]) {
				var temp = "";
				const key = item + "";
				const value = event_fields[0][item];
				console.log("key: ", key);
				console.log("value: ", value);
				if (key.startsWith("field_") && value) {
					const field = value;
					const field_input_name = key + ""
					if (field.length > 0) {
						const div = document.createElement("div");
						const field_json = JSON.parse(field);
						// temp += "<div>";
						temp += "<label>" + field_json["name"] + "</label>";
						temp += "<input type=\"" + field_json["type"] + "\" name=\"" + field_input_name + "\" placeholder=\"" + field_json["hint"] + "\" />";
						div.innerHTML = temp;
						element.appendChild(div);
					}
				}
			}

			document.getElementById("container").appendChild(element);

			// if (field_1.length > 0) {
			// 	const field_1_json = JSON.parse(field_1);
			// 	temp += "<div>";
			// 	temp += "<label>" + field_1_json["name"] + "</label>";
			// 	temp += "<input type=\"" + field_1_json["type"] + "\" name=\"field_1_name\" placeholder=\"" + field_1_json["hint"] + "\" />";
			// 	temp += "</div>";
			// }

			// start for loop

			// event_fields.forEach((u) => {
			// 	console.log("field: ",u);
			// 	// temp += "<label>"+u.+"</label>";
			// });

			// close for loop
		}
	</script>
</body>
</html>