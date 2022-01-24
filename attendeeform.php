<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Attendee Form</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container w-50 mt-5 bg-light p-5 rounded" style="box-shadow: 1px 1px 10px 2px #eeeddd;">
		<p id="msg"></p>
		<form method="POST" name="form1" id="form1">
			<table class="table">
				<thead class="thead">
					<tr>
						<th>Firstname
							<a class="btn float-right text-info" id="add"><i class="fas fa-plus-square"></i></a>
						</th>
					</tr>
				</thead>
				<tbody id="tbody"></tbody>
			</table>
			<button type="submit" class="btn btn-success btn-block btn-sm" name="submit" disabled>Insert Data</button>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function(){
			var num = 1;
			$("add").click(function(){
				$("#tbody").append('<tr><td><div class="btn-group w-100"><input type="text" name="firstname[]" value="" id="firstname'+num+'" class="firstname form-control form-control-sm mr-4"><a href="javascript:void(0)" class="rem text-danger" title="Delete" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a></div></td></tr>');
				num++;
				$("submit").removeAttr('disabled');
			});
			$("#tbody").on('click', '.rem', function(){
				$(this).closest('tr').remove();
				num--;
				var tr = $("#tbody").find('tr').length;
				if (tr <= 0) {
					$("#msg").html("");
					$("#submit").attr('disabled', 'disabled');
				}
			});
			$("#form1").on('submit', function(event){
				event.preventDefault();
				var error = "";
				$(".firstname").each(function(){
					if ($(this).val() == "") {
						error += "<div class='alert alert-danger'>Firstname is Required</div>";
						$("#msg").html(error);
						$(this).focus();
						return false;
					}
				});
				var data = $(this).serialize();
				if (error == '') {
					$.ajax({
						url : "code.php",
						type: "POST",
						data: data,
						success: function(data){
							console.log(data);
							$("#msg").html("<div class='alert alert-success'>Data Inserted Successfully</div>");
							$("form")[0].reset();
						}
					});
				}
			});
		});
	</script>
</body>
</html>