<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if($_SESSION['authenticated'] != null && $_SESSION['authenticated'] == true){
	header('Location: /index.php');
}
?>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		.selected{
			border-top: 0.5px solid white;
			color: white;
		}
	</style>
	
</head>
<body style="background: rgb(2, 2, 2);">
<nav class="navbar navbar-dark" style="background: #272525">
        <a class="navbar-brand" href="/">The Blood Bank Application</a>
</nav>
<form action="/src/Authenticate.php" method="POST" enctype="multipart/form-data">
	<input type="number" hidden value="0" id="authentication_type" name="authentication_type">
	<div class = "container mt-5">
		<div style="width: fit-content; display: flex; flex-direction: row;">
			<div class="p-2" style="cursor:pointer" id="receiver-btn"><h3 class="display-4 p-2" onclick="currentUser='receiver'; currentOperation='login'; changeState();">Receiver</h3></div>
			<div class="p-2" style="cursor:pointer" id="hospital-btn"><h3 class="display-4 p-2" onclick="currentUser='hospital'; currentOperation='login'; changeState();">Hospital</h3></div>
		</div>
		<div class="container p-4" style="margin-top:0 ;border: 0.5px solid white; background: black;">
			<div id="receiver">
				<div id="receiver-login" style="display:none">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Username</span>
						</div>
						<input type="text" class="form-control" id="receiver-login-username" name="receiver-login-username"  aria-label="Username" aria-describedby="basic-addon1">
					</div>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Password</span>
						</div>
						<input type="password" class="form-control"  id="receiver-login-password" name="receiver-login-password" aria-label="Password" aria-describedby="basic-addon1">
					</div>
					<button class="btn btn-success" type="button" onclick="formSubmit(1)">Submit</button>
					<button class="btn btn-info" type="button" onclick=" currentOperation='register'; changeState();">Register</button>
					</div>
					
					
					<div id="receiver-register" style="display:none">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">First Name</span>
							</div>
							<input type="text" class="form-control" id="receiver-register-firstname" name="receiver-register-firstname" aria-label="FirstName" aria-describedby="basic-addon1">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">Last Name</span>
							</div>
							<input type="text" class="form-control"  id="receiver-register-lastname" name="receiver-register-lastname" aria-label="LastName" aria-describedby="basic-addon1">
						</div>
						
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">Blood Group</span>
							</div>
							<select class="custom-select" id="receiver-register-blood-group" name="receiver-register-blood-group">
								<option selected value="">Select</option>
								<option value="O+">O+</option>
								<option value="O-">O-</option>
								<option value="AB+">AB+</option>
								<option value="AB-">AB-</option>
								<option value="A+">A+</option>
								<option value="A-">A-</option>
								<option value="B+">B+</option>
								<option value="B-">B-</option>
							</select>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">Email Address</span>
							</div>
							<input type="text" class="form-control"  id="receiver-register-email" name="receiver-register-email" aria-label="Email" aria-describedby="basic-addon1">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">Username</span>
							</div>
							<input type="text" class="form-control" id="receiver-register-username"  name="receiver-register-username" aria-label="Username" aria-describedby="basic-addon1">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">Password</span>
							</div>
							<input type="password" class="form-control"  id="receiver-register-password" name="receiver-register-password" aria-label="Password" aria-describedby="basic-addon1">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">Re-enter Password</span>
							</div>
							<input type="password" class="form-control"  id="receiver-register-reenter-password" aria-label="Renter-Password" aria-describedby="basic-addon1">
						</div>
						<button class="btn btn-success" type="button" onclick="formSubmit(3)">Submit</button>
						<button class="btn btn-info" type="button" onclick="currentOperation='login'; changeState();">Login</button>
						</div>
						
						
						<div id="hospital">
							<div id="hospital-login" style="display:none">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">User Id</span>
									</div>
									<input type="text" id="hospital-login-userid" name="hospital-login-userid" class="form-control"  aria-label="UserId" aria-describedby="basic-addon1">
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">Password</span>
									</div>
									<input type="password" class="form-control"  id="hospital-login-password" name="hospital-login-password" aria-label="Password" aria-describedby="basic-addon1">
								</div>
								<button class="btn btn-success" type="button" onclick="formSubmit(2)">Submit</button>
								<button class="btn btn-info" type="button" onclick=" currentOperation='register'; changeState();">Register</button>
							</div>
							
							<div id="hospital-register" style="display:none">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">Hospital Name</span>
									</div>
									<input type="text" name = "hospital-register-name" id = "hospital-register-name" class="form-control"  aria-label="HospitalName" aria-describedby="basic-addon1">
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">Full Address</span>
									</div>
									<input type="text" name="hospital-register-address" id = "hospital-register-address" class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">User Id</span>
									</div>
									<input type="text" name = "hospital-register-userid" id = "hospital-register-userid" class="form-control"  aria-label="Userid" aria-describedby="basic-addon1">
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">Password</span>
									</div>
									<input type="password" class="form-control"  id="hospital-register-password" name="hospital-register-password" aria-label="Password" aria-describedby="basic-addon1">
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">Re-enter Password</span>
									</div>
									<input type="password" class="form-control"  id="hospital-register-reenter-password" name="hospital-register-reenter-password" aria-label="ReenterPassword" aria-describedby="basic-addon1">
								</div>
								<button class="btn btn-success" type="button" onclick="formSubmit(4)">Submit</button>
								<button class="btn btn-info" type="button" onclick="currentOperation='login'; changeState();">Login</button>
							</div>
						</div>
						<span style="font-weight: 100; color: red; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
							<?php
									echo $_SESSION['message'];
							?>
						</span>
					</div>
				</div>
			</div>
			</form>
		</body>
		<script defer>
			var currentOperation = "login";
			var currentUser = "receiver";
			function formSubmit(type){
				if((type == 3 && $('#receiver-register-password').val() != $('#receiver-register-reenter-password').val())
					|| (type == 4 && $('#hospital-register-password').val() != $('#hospital-register-reenter-password').val())){
						alert('Passwords do not match');
						return;
					}
				if(!validate(type))
					return;
				$('#authentication_type').val(type);
				$('form').submit();
			}
			function validateEmail(email) {
    			const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    			return re.test(String(email).toLowerCase());
			}			
			function validate(type){
				final = true;
				msg = "";
				if(type == 1 || type == 2){
					username = type == 1 ? $("#receiver-login-username").val() : $("#hospital-login-userid").val();
					password = type == 1 ? $("#receiver-login-password").val() : $("#hospital-login-password").val();
					if(!username.length || !password.length)
						final = false;
						msg = "\nPlease fill all the fields";
				}

				else if(type == 3){
					username = $("#receiver-register-username").val()
					password = $("#receiver-register-password").val()
					if(!username.length || !password.length)
						final = false;
						msg += "\nPlease fill all the fields";
					if(username.length > 50){
						final = false;
						msg += "\nUsername cannot exceed 50 characters";
					}
					if($("#receiver-register-blood-group").val().length == 0){
						final = false;
						msg += "\nPlease Enter a blood type.";
					}
					if(!validateEmail($("#receiver-register-email").val())){
						final = false;
						msg += "\nInvalid Email Address";
					}
					if($("#receiver-register-firstname").val().length == 0){
						final = false;
						msg += "\nFirstname required";
					}
					if($("#receiver-register-lastname").val().length == 0){
						final = false;
						msg += "\nLastname required";
					}
				}else {
					username = $("#hospital-register-userid").val();
					password = $("#hospital-register-password").val();
					if(!username.length || !password.length)
						final = false;
						msg += "\nPlease fill all the fields";
					if(username.length > 50){
						final = false;
						msg += "\nUsername cannot exceed 50 characters";
					}
					if($("#hospital-register-address").val().length == 0){
						final = false;
						msg += "\nPlease enter the address.";
					}
					if($("#hospital-register-name").val().length == 0){
						final = false;
						msg += "\nPlease enter the hospital's name";
					}
	
				}
				if(!final)
					alert(msg);
				return final;
			}

			function hideall(){
				$("#receiver-login").hide();
				$("#receiver-register").hide();
				$("#hospital-register").hide();
				$("#hospital-login").hide();
				$('#hospital-btn').removeClass('selected');
				$('#receiver-btn').removeClass('selected');
			}
			
			function changeState(){
				hideall();
				if(currentUser == "receiver"){
					if(currentOperation == "login")
					$("#receiver-login").show();
					else
					$("#receiver-register").show();
					$('#receiver-btn').addClass("selected");
				}else{
					if(currentOperation == "login")
					$("#hospital-login").show()
					else
					$("#hospital-register").show();
					$('#hospital-btn').addClass("selected");
				}
			}
			changeState();
			<?php
				$_SESSION['message'] = "";
			?>

		</script>
		</html>