<?php  
  error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/container.css">
	<link rel="stylesheet" href="plugins/bootstrap-5.0.2/css/bootstrap.min.css">
	<title>Event Container</title>
</head>
<body>
	<div class="Container">
		<div class="row">
			<div class="col-xl-12">
				<div class="multistep-container">
					<div class="multistep-form-area">
						<!--  -->
						<div class="form-box">
							<!-- -->
							<ul class="active-button">
								<li class="active">
									<span class="round-btn">1</span>
								</li>
								<li>
									<span class="round-btn">2</span>
								</li>
								<li>
									<span class="round-btn">3</span>
								</li>
							</ul>
							<!-- -->
							<h4>Create Event</h4>
							<form action="">
								<div class="form-group">
									<label for="eventName">Event Name</label>
		              <input type="text" name="eventname" placeholder="Enter Event Name" value="<?php echo $_POST['eventname']; ?>" class="form-control">
								</div>
								<div class="form-group">
									<label for="venue">Venue</label>
		              <input type="text" name="venue" placeholder="Enter Event Venue" value="<?php $_POST['venue']; ?>" class="form-control">
								</div>
								<div class="form-group">
									<label for="artwork">Artwork</label>
		              <input type="file" name="image" value="<?php echo $_POST['filename']; ?>" class="form-control">
								</div>
								<div class="button-row">
									<input type="button" name="" value="Next" class="next">
								</div>
							</form>
						</div>
						<!--  -->
						<div class="form-box">
							<!-- -->
							<ul class="active-button">
								<li class="active">
									<span class="round-btn">1</span>
									<span class="text">Event</span>
								</li>
								<li class="active">
									<span class="round-btn">2</span>
									<span class="text">Registration Form</span>
								</li>
								<li>
									<span class="round-btn">3</span>
									<span class="text">Preview Form</span>
								</li>
							</ul>
							<!-- -->
							<h4>Create Registration Form</h4>
							<form action="">
								<div class="wrapper">
									<div class="fields-container" id="fields-container"></div>
						        <div class="btn-container">
						            <div id="ok-btn" class="action-btn">Create</div>
						            <div id="add-btn" class="action-btn">Add Field</div>
						        </div>
								</div>
								<div class="button-row">
									<input type="button" name="" value="Previous" class="previous">
									<input type="button" name="" value="Next" class="next">
								</div>
							</form>
						</div>
						<!--  -->
						<div class="form-box">
							<!-- -->
							<ul class="active-button">
								<li class="active">
									<span class="round-btn">1</span>
									<span class="text">Event</span>
								</li>
								<li class="active">
									<span class="round-btn">2</span>
									<span class="text">Registration Form</span>
								</li>
								<li class="active">
									<span class="round-btn">3</span>
									<span class="text">Preview Form</span>
								</li>
							</ul>
							<!-- -->
							<h4>Preview Registration Form</h4>
							<form action="">
								<div class="forms-container" id="forms-container"></div>
								<div class="button-row">
									<input type="button" name="" value="Previous" class="previous">
									<input type="button" name="" value="Share Link" class="submit">
								</div>
							</form>
						</div>
						<!--  -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="plugins/jquery/jquery.min.js"></script>>
	<script>
		$(document).ready(function(){
			$(".multistep-container .form-box .button-row .next").click(function(){
				$(this).parents(".form-box").fadeOut('fast');
				$(this).parents(".form-box").next().fadeIn('fast');
			});
			$(".multistep-container .form-box .button-row .previous").click(function(){
				$(this).parents(".form-box").fadeOut('fast');
				$(this).parents(".form-box").prev().fadeIn('fast');
			});
		});
	</script>
	<script type="text/javascript">
      document.addEventListener("DOMContentLoaded", function() {
			document.getElementById("home").className = "";
			document.getElementById("event").className = "";
			document.getElementById("report").className = "";
			document.getElementById("form-setting").className = "btn-active";
		});
    const fields_container = document.getElementById("fields-container");
    const add_btn = document.getElementById("add-btn");
    const ok_btn = document.getElementById("ok-btn");

    var fields_count = 0;
    var is_updating = false;

    add_btn.onclick = () => {
      if (is_updating) return;
      if (fields_count <= 6) {
        addField(fields_count + 1, "", "", "text");
      }
      if (fields_count <= 6) {
        add_btn.style.display = "flex";
      } else {
        add_btn.style.display = "none";
      }
    };

    const addField = (i, name, hint, type) => {
      is_updating = true;
      const list_item_view = document.createElement('div');
      list_item_view.className = 'field';
      list_item_view.id = `field-${i}`;
      if (i == 1) {
        list_item_view.innerHTML = `
          <label id="label-${i}">Field ${i}</label>
          <input type="text" id="name-${i}" placeholder="field title">
          <input type="text" id="hint-${i}" placeholder="hint / placeholder">
          <select id="selector-${i}">
              <option value="text">field type: 1. Text</option>
              <option value="number">field type: 2. Number</option>             
              <option value="email">field type: 3. Email Address</option>             
              <option value="phone">field type: 4. Phone Number</option>          
          </select>
        `;
      } else {
        list_item_view.innerHTML = `
          <label id="label-${i}">Field ${i}</label>
          <input type="text" id="name-${i}" placeholder="field title">
          <input type="text" id="hint-${i}" placeholder="hint / placeholder">
          <select id="selector-${i}">
              <option value="text">field type: 1. Text</option>
              <option value="number">field type: 2. Number</option>             
              <option value="email">field type: 3. Email Address</option>             
              <option value="phone">field type: 4. Phone Number</option>             
          </select>
          <div class="close-field-btn" id="delete-${i}">Remove</div>
        `;
      }

      fields_container.appendChild(list_item_view);
      //console.log("added: " + i);

      fields_count++;
      setTimeout(() => {
        (document.getElementById(`name-${i}`)).value = name;
        (document.getElementById(`hint-${i}`)).value = hint;
        (document.getElementById(`selector-${i}`)).value = type;

        is_updating = false;
      }, 500);
    }

    const updateField = (oldId, newId) => {
      if (oldId == 1) return;
      const _div = document.getElementById(`field-${oldId}`);
      if (_div === null) return;
      const _remove = document.getElementById(`delete-${oldId}`);
      const _label = document.getElementById(`label-${oldId}`);
      const _input1 = document.getElementById(`name-${oldId}`);
      const _input2 = document.getElementById(`hint-${oldId}`);
      const _selector = document.getElementById(`selector-${oldId}`);

      _div.id = `field-${newId}`;
      _remove.id = `delete-${newId}`;
      _label.id = `label-${newId}`;
      _label.innerText = `Field ${newId}`;
      _input1.id = `name-${newId}`;
      _input2.id = `hint-${newId}`;
      _selector.id = `selector-${newId}`;
    }

    document.addEventListener("click", function(evnt) {
      //console.log("clicked: ", evnt.target.id);
      if (evnt.target.id.includes("delete-")) {
        const id = evnt.target.id.split("-")[1];
        if (is_updating) return;
        removeField(parseInt(id));
      }
    });

    const removeField = (id) => {
      is_updating = true;
      fields_count--;
      if (fields_count <= 1) {
          fields_count = 1;
      }
      if (fields_count <= 6) {
          add_btn.style.display = "flex";
      } else {
          add_btn.style.display = "none";
      }
      const _div = document.getElementById(`field-${id}`);
      //_div.style.visibility = "hidden";
      _div.className = _div.className + " remove-anim";
      setTimeout(() => {
        fields_container.removeChild(_div);
        console.log("removed: " + id);
        setTimeout(() => {
          for (var i = 0; i < fields_container.childElementCount; i++) {
            const element = fields_container.children[i];
            const id_number = element.id.split("-")[1];
            console.log("element id: ", id_number);
            //if (id > parseInt(id_number)) {
            updateField(element.id.split("-")[1], i + 1);
          }
          setTimeout(() => {
            is_updating = false;
          }, 500);
        }, 500);
      }, 500);
    }

    const fieldList = [];

    var event_id = 0;

    function loadFields(id, list) {
      fieldList.length = 0;
      if (id === 0) {
        id = new Date().getTime();
      }
      event_id = id;
      if (list.length > 0) {
        for (var i = 0; i < list.length; i++) {
          const field = list[i];
          fieldList.push({
            name: field.name,
            hint: field.hint,
            type: field.type
          });
          addField(i + 1, field.name, field.hint, field.type);
        }
      } else {
        addField(1, "", "", "text");
      }
    }

    ok_btn.onclick = () => {
      fieldList.length = 0;
      for (var i = 0; i < fields_container.childElementCount; i++) {
        const element = fields_container.children[i];
        const id_number = element.id.split("-")[1];
        //console.log("element id: ", id_number);
        const _remove = document.getElementById(`delete-${id_number}`);
        const _label = document.getElementById(`label-${id_number}`);
        const _input1 = document.getElementById(`name-${id_number}`);
        const _input2 = document.getElementById(`hint-${id_number}`);
        const _selector = document.getElementById(`selector-${id_number}`);

        const name = _input1.value;
        const hint = _input2.value;

        if (name === "" || hint === "") {
          swal({
            title: "Please fill all fields",
            icon: "error",
            button: "OK",
          });
          break;
        } else {
          var field_type = "text";
          const field = {
            name: name,
            hint: hint,
            type: _selector.value
          };
          fieldList.push(field);
        }
      }
      if (fieldList.length > 0) {
        console.log("fieldList: ", fieldList);
        // post data to server
        const payload = JSON.stringify(fieldList); // [{},{}]
        console.log("payload: " + typeof payload, payload);

        $.ajax({
          type: "POST",
          url: "event-form.php",
          data: {
            event_id:  event_id, // "96f8d078e3",
            fields: payload
          },
          success: function(result) {
            // convert json to object
            try {
              console.log("result: ", result);
              const data = JSON.parse(result);
              console.log("result: ", data);
              if (data.success) {
                swal({
                  title: "Form successfully created / updated",
                  icon: "success",
                  button: "OK",
                });
              } else {
                swal({
                  title: "Failed to Create or Update Form",
                  icon: "error",
                  button: "OK",
                });
              }
            } catch (e) {
              console.log("error: ", e);
              swal({
                title: "Failed to Create or Update Form",
                icon: "error",
                button: "OK",
              });
            }
          },
          error: function(err) {
            console.log("error: ", err);
            swal({
              title: "Something Went Wrong While Creating or Updating Form",
              icon: "error",
              button: "OK",
            });
          }
        });
      }
    }
  </script>
</body>
</html>