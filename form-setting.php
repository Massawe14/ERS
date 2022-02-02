<?php  
  session_start();

  error_reporting(0);

  include "eventdb.php";

  include('includes/header.php');
  include('includes/sidemenu.php');
  include('includes/topbar.php');
  include('includes/message.php');

  if (!isset($_SESSION['username'])) {
  	// code...
  	header("Location: authentication");
  	exit(0);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Event</title>
	<style>
		/*body {
			font-family: Arial, Helvetica, sans-serif;
		    display: flex;
		    flex-direction: column;
		    justify-content: center;
		    align-items: center;
		    overflow: auto;
		}*/

		/* Full-width input fields */
		input[type=text], input[type=password], input[type=file], input[type=email], 
		input[type=tel] {
	    width: 100%;
	    padding: 12px 20px;
	    margin: 8px 0;
	    display: inline-block;
	    border: 1px solid #ccc;
	    box-sizing: border-box;
		}

		/* Set a style for all buttons */
		input[type=submit]{
	    background-color: #e1251b;
	    color: white;
	    padding: 14px 20px;
	    margin: 8px 0;
	    border: none;
	    cursor: pointer;
	    width: 100%;
	    text-align: center;
	    text-decoration: none;
		}

		input[type=submit]:hover {
		    opacity: 0.8;
		}

		.wrapper {
			background-color: #fff;
			width: 1000px;
			padding: 25px;
			/* margin: 25px auto 0; */
			margin: 80px 25px 25px 25px;
			/* box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5); */
			border-radius: 20px;
			position: relative;
		}

		.event {
		    padding: 80px;
		}

		input[type='button'] {
			background-color: #e1251b;
			color: white;
			padding: 14px 20px;
			border: none;
			cursor: pointer;
			width: 100%;
		}

		input[type='button']:hover {
			opacity: 0.8;
		}

		/*.cancel {
			width: 100%;
			background-color: #e1251b;
		}*/

		/*img.avatar {
		  width: 40%;
		  border-radius: 50%;
		}*/

		.eventcontainer {
			padding: 15px;
		}

		.input-group {
			display: none;
		}

		.modal {
			display: none;
			position: fixed;
			z-index: 1;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgb(0, 0, 0);
			background-color: rgba(0, 0, 0, 0.4);
			padding-top: 60px;
		}

		.modal-content {
			background-color: #fefefe;
			margin: 5% auto 15% auto;
			border: 1px solid #888;
			width: 80%;
		}

		.close {
			position: absolute;
			right: 25px;
			top: 0;
	    color: #000;
	    font-size: 35px;
	    font-weight: bold;
		}

		.close:hover,
		.close:focus {
		  color: red;
		  cursor: pointer;
		}

		/* add animation */
		.animate {
		  -webkit-animation: animatezoom 0.6s;
		  animation: animatezoom 0.6s;
		}

		@-webkit-keyframes animatezoom {
	    from {-webkit-transform: scale(0)} 
	    to {-webkit-transform: scale(1)}
		}
		    
		@keyframes animatezoom {
	    from {transform: scale(0)} 
	    to {transform: scale(1)}
		}

		/*@media screen and (max-width: 300px) {
	    .cancel {
	      width: 100%;
	    }
		}*/

		.controls {
			width: 294px;
			margin: 15px auto;

		}

		#remove_fields {
			float: right;
		}

		.controls a ion-icon {
			margin-right: 5px;
		}

		a {
			color: black;
			text-decoration: none;
		}

		.wrapper {
            /* width: 60%; */
            /* height: 70%; */
            display: flex;
            flex-direction: column;
            align-items: center;
            /* border-radius: 32px; */
            /* border-color: transparent; */
            /* border-style: solid; */
            /* box-shadow: 1px 0px 20px 0px rgba(22, 22, 22, 0.5); */
            /* padding: 20px; */
            /* background-color: #ffffff; */
            overflow: hidden;
        }
        
        .fields-container {
            width: 60%;
            height: auto;
            display: flex;
            flex-direction: column;
            /* border-radius: 8px;
            border-color: black;
            border-style: solid; */
            padding: 8px;
        }
        
        .field {
            width: 100%;
            height: 190px;
            position: relative;
            display: flex;
            flex-direction: column;
            background-color: #3c87ba;
            border-radius: 8px;
            border-color: rgb(36, 36, 36);
            border-style: solid;
            border-width: 1px;
            padding: 8px;
            margin: 8px;
			animation-name: add-field-anim;
            animation-duration: 1s;
        }
        
        .close-field-btn {
            width: auto;
            height: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: absolute;
            right: 0;
            top: 0;
            text-align: center;
            color: white;
            font-style: bold;
            font-size: 16px;
            background-color: #da2929;
            border-color: transparent;
            border-style: solid;
            border-width: 1px;
            border-radius: 8px;
            padding: 4px 8px 4px 8px;
            margin: 8px 12px 8px 8px;
            cursor: pointer;
        }
        
        .close-field-btn:hover {
            background-color: #b12020;
        }
        
        label {
            color: rgb(255, 255, 255);
            font-style: bold;
            font-size: 20px;
            margin: 0 0 0 10px;
        }
        
        input,
        select {
            width: calc(100% - 24px);
            height: 30px;
            border-radius: 8px;
            border-color: transparent;
            border-style: solid;
            border-width: 1px;
            padding: 4px;
            margin: 8px;
        }
        
        select {
            width: calc(100% - 16px);
            height: 40px !important;
            cursor: pointer;
        }
        
        .btn-container {
            width: 80%;
            height: auto;
            display: flex;
            position: relative;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }
        
        .action-btn {
            width: auto;
            height: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            color: white;
            font-style: bold;
            background-color: #3c87ba;
            border-color: transparent;
            border-style: solid;
            border-width: 1px;
            border-radius: 8px;
            padding: 4px;
            margin: 8px;
            cursor: pointer;
        }
        
        #add-btn {
            background-color: #3c87ba;
        }
        
        #ok-btn {
            background-color: #34bb97;
        }
        
        #add-btn:hover {
            background-color: #285e82;
        }
        
        #ok-btn:hover {
            background-color: #26876d;
        }
        
        .remove-anim {
            animation-name: remove-field-anim;
            animation-duration: 1s;
        }

		@keyframes add-field-anim {
            0% {
                opacity: 0;
                height: 0px;
            }
            100% { 
				opacity: 1;
                height: 190px;
            }
        }
        
        @keyframes remove-field-anim {
            0% {
                opacity: 1;
                height: 190px;
            }
            100% {
                opacity: 0;
                height: 0px;
            }
        }

	</style>
</head>
<body>

	<div class="wrapper">
		<div class="fields-container" id="fields-container">
        </div>
        <div class="btn-container">
            <div id="ok-btn" class="action-btn">Create</div>
            <div id="add-btn" class="action-btn">Add Field</div>
        </div>
        <!-- <form id="the-form" action="form-setting" method="post" style="display: none">
            <input id="the-event-id" type="hidden" name="event_id" value="" />
            <input id="the-fields" type="hidden" name="fields" value="" />
        </form> -->
	</div>

	<?php include('includes/script.php'); ?>
	<!-- how to make close when click on any point of the browser -->
	<!-- <script>
		var valueList = document.getElementById('valueList');
		var text = '<span> you have selected : </span>'
		var listArray = [];
		var checkboxes = document.querySelectorAll('.checkme');

		for (var checkbox of checkboxes) {
			checkbox.addEventListener('click',function(){
				if (this.checked == true) {
					$(this).parents(".checkbox-card").find('.input-group').show();
					console.log(this.value);
					listArray.push(this.value);
					valueList.innerHTML = text + listArray.join(' / ');
				}
				else {
					$(this).parents(".checkbox-card").find('.input-group').hide();
					console.log('You unchecked the checkbox');
					listArray = listArray.filter(e => e !== this.value);
					valueList.innerHTML = text + listArray.join(' / ');
				}
			});
		} 
	 </script> 
	<script>
		var modal = document.getElementById('eventmodal');
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
	</script>-->
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

        // const the_form = document.getElementById("the-form");
        // const the_event_id = document.getElementById("the-event-id");
        // const the_fields = document.getElementById("the-fields");

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
            //console.log("updated old: " + oldId + "   new: " + newId);
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
                //if (id >= 7) return;
                setTimeout(() => {
                    for (var i = 0; i < fields_container.childElementCount; i++) {
                        const element = fields_container.children[i];
                        const id_number = element.id.split("-")[1];
                        console.log("element id: ", id_number);
                        //if (id > parseInt(id_number)) {
                        updateField(element.id.split("-")[1], i + 1);
                        //}
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