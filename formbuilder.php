<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Create Form</title>
	<link href="https://fonts.googleapis.com.css?family=Raleway:300,500,700" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.css">
	<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
	<style>
		.row {
			top: 0;
			margin: 0;
			padding: 0;
		}
		.header {
			text-align: center;
		}
		.fa-minus-circle {
			color: #e1251b;
		}
		.fa-plus-circle {
			color: #287bff;
		}
		.submit_btn {
			min-width: 150px;
			max-width: 250px;
			font-size: 1.2rem;
			height: 60px;
			margin-top: 20px;
			padding: 20px;
		}
		.submit_btn {
			padding-right: 10px;
		}
		.form-control {
			display: inline-block;
			width: calc(100% - 45px);
			border: 1px solid #f5f5f5;
		}
		.fas {
			cursor: pointer;
		}
		@media (min-width: 768px) {
			.invoice-save-bottom {
				min-width: 400px;
			}
			.right-ads {
				float: left;
			}
			.left-ads {
				float: right;
			}
		}
	</style>
</head>
<body>
	<div id="app">
	  <div class="row">
	  	<div class="col-md-6 offset-md-3">
	  		<h1 class="header">Create Form</h1>
	  		<div class="form-group" v-for="(input,k) in inputs" :key="k">
	  			<input type="text" class="form-control" v-model="input.name">
	  			<span>
	  				<i class="fas fa-minus-circle" @click="remove(k)" v-show="k || (!k && inputs.length > 1)"></i>
	  				<i class="fas fa-plus-circle" @click="add(k)" v-show="k == inputs.length-1"></i>
	  			</span>
	  		</div>
	  		<button class="btn btn-primary" type="submit">Save Form</button>
	  	</div>
	  </div>
	</div>
	<script>
		var app = new Vue({
		  el: '#app',
		  data: {
		    inputs: [
			    {
			    	name: ''
			    }
		    ]
		  },
		  methods: {
		  	add(index) {
		  		this.inputs.push({name: ''});
		  	},
		  	remove(index) {
		  		this.inputs.splice(index, 1);
		  	}
		  }
		});
	</script>
</body>
</html>