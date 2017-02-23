<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Customer Registration</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css')?>">
	<script type="text/javascript" src="<?= base_url('assets/js/jQuery v3.1.1')?>"></script>
	<script>
		$(document).ready(function(){	
			$('#email').on('keyup',function() {
				$('#eotp').val('');
				var email = $('#email').val();
				var val_e = "1";
				$.ajax({
						type:'POST',
						data:{email:email,val_e:val_e},
						url:'<?= base_url('index.php/customer/val_send_email'); ?>',
						success: function(result){
							$('#result1').html(result);
						}
					});	
			});

			$('#email').on('focusout',function() {
				var email = $('#email').val();
				var val_e = "0";
				if ( email )
				{
					$('#email').prop('disabled',true);
					$.ajax({
						type:'POST',
						data:{email:email,val_e:val_e},
						url:'<?= base_url('index.php/customer/val_send_email'); ?>',
						success: function(result){
							$('#result1').html(result);
						}
					});
				}	
			});

			$('#emailcb').click(function() {
				if( !'<?php $this->session->has_userdata('email_state'); ?>' )
	            {
	            	$('#eotp').val('');
		        	$('#email').val('');
					$('#result1').html("");
					$("#email").prop('disabled',false);
					$('#email').focus();
					document.getElementById("eiemail").style.background = "#FFFFFF";
					document.getElementById("eieotp").style.background = "#FFFFFF";
	            }
	        });

			$('#eresend').click(function() {
				$('#eotp').val('');
				var email = $('#email').val();
				var resend="1";
				$.ajax({
					type:'POST',
					data:{email:email,resend:resend},
					url:'<?= base_url('index.php/customer/val_send_email'); ?>',
					success: function(result){
						$('#result1').html(result);
					}
				});
			});

			$('#eotp').on('keyup',function() {
				var email = $('#email').val();
				var eotp = $('#eotp').val();
				$.ajax({
					type:'POST',
					data:{email:email,eotp:eotp},
					url:'<?= base_url('index.php/customer/val_email_otp') ?>',
					success:function(result){
						$('#result1').html(result);
					}
				});
			});

			$('#mobileno').on('keyup',function() {
			$('#motp').val('');
				var mobileno = $('#mobileno').val();
				var val_e = "1";
				$.ajax({
						type:'POST',
						data:{mobileno:mobileno,val_e:val_e},
						url:'<?= base_url('index.php/customer/val_send_mobileno'); ?>',
						success: function(result){
							$('#result2').html(result);
						}
					});	
			});

			$('#mobileno').on('focusout',function() {
			var mobileno = $('#mobileno').val();
			var val_e = "0";
				if ( mobileno )
				{
					$('#mobileno').prop('disabled',true);
					$.ajax({
						type:'POST',
						data:{mobileno:mobileno,val_e:val_e},
						url:'<?= base_url('index.php/customer/val_send_mobileno'); ?>',
						success: function(result){
							$('#result2').html(result);
						}
					});
				}	
			});

			$('#mobilenocb').click(function() {
				if( !'<?php $this->session->has_userdata('motp_state'); ?>' )
	            {
	            	$('#motp').val('');
		        	$('#mobileno').val('');
					$('#result2').html("");
					$("#mobileno").prop('disabled',false);
					$('#mobileno').focus();
					document.getElementById("eimobileno").style.background = "#FFFFFF";
					document.getElementById("eimotp").style.background = "#FFFFFF";
	            }
	        });


			$('#mresend').click(function() {
				$('#motp').val('');
				var mobileno = $('#mobileno').val();
				var resend="1";
				$.ajax({
					type:'POST',
					data:{mobileno:mobileno,resend:resend},
					url:'<?= base_url('index.php/customer/val_send_mobileno'); ?>',
					success: function(result){
						$('#result2').html(result);
					}
				});
			});

			$('#motp').on('keyup',function() {
				var mobileno = $('#mobileno').val();
				var motp = $('#motp').val();
				$.ajax({
					type:'POST',
					data:{mobileno:mobileno,motp:motp},
					url:'<?= base_url('index.php/customer/val_mobile_otp') ?>',
					success:function(result){
						$('#result2').html(result);
					}
				});
			});

			$('#password').on('keyup',function() {
				var password = $("#password").val();
			    if ( !password ){
			    	document.getElementById("eipassword").style.background = "#FFFFFF";
			        $("#pass").html("Enter Password");
			    } else {
			    	document.getElementById("eipassword").style.background = "#89F17B";
			        $("#pass").html("");
			    }
			});

			$('#cpassword').on('keyup',function() {
				var password = $("#password").val();
			    var confirmPassword = $("#cpassword").val();
				if ( !confirmPassword ){
			    	document.getElementById("eicpassword").style.background = "#FFFFFF";
			        $(".cpass").html("Enter Confirm Password");
			    } else if( password != confirmPassword ){
			    	document.getElementById("eicpassword").style.background = "#EE6960";
			        $(".cpass").html("Password doesn't match");
			    } else {
			    	document.getElementById("eicpassword").style.background = "#89F17B";
			        $(".cpass").html("");
			    }
			});

			$('#altmobileno').on('keyup',function() {
				var altmobileno = $('#altmobileno').val();
		        var firstNo = $('#altmobileno').val().substr(0, 1);
		        if ( firstNo )
		        {
		        	if( firstNo=="7" || firstNo=="8" || firstNo=="9"  )
			        {
			        	if ( $(this).val().length!="10")
			        	{
			        		document.getElementById("eialtmobileno").style.background = "#EE6960";
			        		$(".altmobileno").html("Invalid Mobile Number");
			        	} else {
			        		document.getElementById("eialtmobileno").style.background = "#89F17B";
			        		$(".altmobileno").html("");
			        	}
			        } else if( firstNo!="7" || firstNo!="8" || firstNo!="9" ) {
			        	document.getElementById("eialtmobileno").style.background = "#EE6960";
			        	$(".altmobileno").html("Invalid Mobile Number");
			        }	
		        } else {
		        	document.getElementById("eialtmobileno").style.background = "#FFFFFF";
		        	$(".altmobileno").html("Enter Alternative Mobile Number");	
		        }
		     });

			$('#address').on('keyup',function() {
				var address = $('#address').val();
		        if ( !address )
		        {
		        	document.getElementById("eiaddress").style.background = "#FFFFFF";
		        	$(".eadd").html("Enter Address");	
		        } else {
		        	document.getElementById("eiaddress").style.background = "#89F17B";
		        	$(".eadd").html("");	
		        }
		     });

			$(document).on('keypress', '#mobileno,#altmobileno', function (event) {
			    var regex = new RegExp("^[0-9]+$");
				var charCode =(typeof event.which == "number") ?event.which:event.keyCode
				var key = String.fromCharCode(charCode);
				
				if (!(charCode == 8 || charCode == 0)) {
			        if (!regex.test(key)) {
				            event.preventDefault();
				            return false;
				    }
				}
			});

			$('#fname').on('keyup',function() {
				var fname=$('#fname').val();
				if( fname && fname.length>="3" )
				{	
					if( !(/^[a-zA-Z ]*$/.test(fname)) ) {
						document.getElementById("eifname").style.background = "#EE6960";
						$('.name').html("Numbers or Special Characters are not allowed");
					} else {
						document.getElementById("eifname").style.background = "#89F17B";
						$('.name').html("");
					}
				} else if( !fname ){
					document.getElementById("eifname").style.background = "#FFFFFF";
					$('.name').html("Enter First Name");
				} else {
					document.getElementById("eifname").style.background = "#EE6960";
					$('.name').html("First name must contain at least 3 characters");
				}
			});

			$('#mname').on('keyup',function() {
				var mname=$('#mname').val();
				if( mname && mname.length>="3" )
				{	
					if( !(/^[a-zA-Z ]*$/.test(mname)) ) {
						document.getElementById("eimname").style.background = "#EE6960";
						$('.name').html("Numbers or Special Characters are not allowed");
					} else {
						document.getElementById("eimname").style.background = "#89F17B";
						$('.name').html("");
					}
				} else if( !mname ){
					document.getElementById("eimname").style.background = "#FFFFFF";
					$('.name').html("Enter Middle Name");
				} else {
					document.getElementById("eimname").style.background = "#EE6960";
					$('.name').html("Middle name must contain at least 3 characters");
				}
			});

			$('#lname').on('keyup',function() {
				var lname=$('#lname').val();
				if( lname && lname.length>="3" )
				{	
					if( !(/^[a-zA-Z ]*$/.test(lname)) ) {
						document.getElementById("eilname").style.background = "#EE6960";
						$('.name').html("Numbers or Special Characters are not allowed");
					} else {
						document.getElementById("eilname").style.background = "#89F17B";
						$('.name').html("");
					}
				} else if( !lname ){
					document.getElementById("eilname").style.background = "#FFFFFF";
					$('.name').html("Enter Last Name");
				} else {
					document.getElementById("eilname").style.background = "#EE6960";
					$('.name').html("Last name must contain at least 3 characters");
				}
			});
			
		});	
	</script>
</head>
<body>
	<br/><br/>
	<div class="container">
		<?php echo form_open('customer/registration', ['method'=>'post','class'=>'form-horizontal']); ?>
	   		
	   		<legend>Customer Registration Form</legend>
	   		
	   		 <div class="form-group">
		    	<div class="col-lg-5 col-lg-offset-2 errorc">
		    		<?= $this->session->flashdata("fb"); ?>
		    	</div>
		    </div>

	   		<div class="form-group">
		      <label class="col-lg-2 control-label">Full Name</label>
		      <div class="col-lg-2">
		      	<div class="input-group">
		      		<span class="input-group-btn">
				        <a href="#" id="eifname" class="btn btn-default" title="Error Indicator">&nbsp</a>
				    </span>
		      		<?php echo form_input(['maxlength'=>'20','name'=>'fname','class'=>'form-control','placeholder'=>'Enter First Name','title'=>'Enter Your First Name','required'=>'required','id'=>'fname','value'=>set_value('fname')]); ?>
		      	</div>
		      </div> 

		     <div class="col-lg-2">
			    <div class="input-group">
			    	<span class="input-group-btn">
				        <a href="#" id="eimname" class="btn btn-default" title="Error Indicator">&nbsp</a>
				    </span>
			        <?php echo form_input(['maxlength'=>'20','name'=>'mname','class'=>'form-control','placeholder'=>'Middle Name','title'=>'Enter Your Middle Name','required'=>'required','id'=>'mname','value'=>set_value('mname')]); ?>
			    </div>	
		      </div>

		      <div class="col-lg-2">
		      	<div class="input-group">
		      		<span class="input-group-btn">
				        	<a href="#" id="eilname" class="btn btn-default" title="Error Indicator">&nbsp</a>
				    </span>
		      		<?php echo form_input(['maxlength'=>'20','name'=>'lname','class'=>'form-control','placeholder'=>'Last Name','title'=>'Enter Your Last Name','required'=>'required','id'=>'lname','value'=>set_value('lname')]); ?>
		      	</div>
		      </div>
		    </div>
			<!-- Errors -->
		    <div class="form-group">
		    	<div class="col-lg-5 col-lg-offset-2 errorc">
		    		<span class="name"></span>
		    	</div>
		    </div>
			
			<div class="form-group">
		      <label class="col-lg-2 control-label">Email</label>
				<div class="col-lg-4">
					<div class="input-group">
						<span class="input-group-btn">
							<a href="#" id="eiemail" class="btn btn-default" title="Error Indicator">&nbsp</a>
						</span>	
				    	<?php echo form_input(['name'=>'email','class'=>'form-control','placeholder'=>'Enter Email ID','title'=>'Enter Your Email Address','id'=>'email','required'=>'required','value'=>set_value('email')]); ?>
					    <span class="input-group-btn">
						  	<a href="#" id="emailcb" class="btn btn-primary" title="Cilck Change Button To Change Email Address">Change</a>
					    </span>
				    </div>
				</div>

			  <div class="col-lg-3">
				    <div class="input-group">
				     <span class="input-group-btn">
				      	 <a href="#" id="eieotp" class="btn btn-default" title="Error Indicator">&nbsp</a>
				        <a href="#" id="eresend" class="btn btn-primary" title="Cilck Resend Button To Get New OTP">Resend</a>
				     </span>
				      <?php echo form_input(['name'=>'emailotp','class'=>'form-control','placeholder'=>'Enter Email OTP','title'=>'Enter The OTP Sent On Your Email ID','required'=>'required','id'=>'eotp','value'=>set_value('emailotp')]); ?>
				    </div>
			  </div>
			</div>

			<!-- Errors -->
		    <div class="form-group">
		    	<div class="col-lg-5 col-lg-offset-2 errorc">
		    		<?php echo form_error('email');?>
		    		<span id="result1"></span>
		    	</div>
		    </div>

			<div class="form-group">
		      <label class="col-lg-2 control-label">Mobile No.</label>
				<div class="col-lg-4">
				    <div class="input-group">
				    	<span class="input-group-btn">
				        	<a href="#" id="eimobileno" class="btn btn-default" title="Error Indicator">&nbsp</a>
				    	</span>
				    <span class="input-group-addon" id="basic-addon1">+91</span>
				     <?php echo form_input(['maxlength'=>'10','name'=>'mobileno','class'=>'form-control','placeholder'=>'Enter Mobile No.','title'=>'Enter Your Mobile Number','required'=>'required','id'=>'mobileno','value'=>set_value('mobileno')]); ?>
				      <span class="input-group-btn">
						  	<a href="#" id="mobilenocb" class="btn btn-primary" title="Cilck Change Button To Change Mobile No.">Change</a>
					  </span>
				    </div>
				 </div>

			  <div class="col-lg-3">
				    <div class="input-group">
				    <span class="input-group-btn">
				     	<a href="#" id="eimotp" class="btn btn-default" title="Error Indicator">&nbsp</a>
				        <a href="#" id="mresend" class="btn btn-primary" title="Cilck Resend Button To Get New OTP">Resend</a>
				    </span>
				      <?php echo form_input(['name'=>'mobileotp','class'=>'form-control','placeholder'=>'Enter Mobile OTP','title'=>'Enter The OTP Sent On Your Mobile Number','required'=>'required','id'=>'motp','value'=>set_value('mobileotp')]); ?>
				    </div>
			  </div>
			</div>

			<!-- Errors -->
		    <div class="form-group">
		    	<div class="col-lg-5 col-lg-offset-2 errorc">
		    		<?php echo form_error('mobileno'); ?>
		    		<span id="result2"></span>
		    	</div>
		    </div>
					
			<div class="form-group">
		      <label class="col-lg-2 control-label">Alternative Mobile No.</label>
				<div class="col-lg-3">
					<div class="input-group">
						<span class="input-group-btn">
				        	<a href="#" id="eialtmobileno" class="btn btn-default" title="Error Indicator">&nbsp</a>
				    	</span>
						<span class="input-group-addon" id="basic-addon1">+91</span>
						<?php echo form_input(['maxlength'=>'10','name'=>'altmobileno','class'=>'form-control','placeholder'=>'Enter Alternative No.','title'=>'Enter Alternative Mobile Number','required'=>'required','id'=>'altmobileno','value'=>set_value('altmobileno')]); ?>
					</div> 
				</div>
			</div>

			<!-- Errors -->
		    <div class="form-group">
		    	<div class="col-lg-5 col-lg-offset-2 errorc">
		    		<span class="altmobileno"></span>
		    	</div>
		    </div>	 		

		    <div class="form-group">
		      <label class="col-lg-2 control-label">Password</label>
		      <div class="col-lg-2">
		      	<div class="input-group">
		      		<span class="input-group-btn">
				        <a href="#" id="eipassword" class="btn btn-default" title="Error Indicator">&nbsp</a>
					</span>
		      		<?php echo form_password(['name'=>'password','class'=>'form-control','placeholder'=>'Enter Password','title'=>'Enter Your Password','required'=>'required','id'=>'password']); ?>
		        </div>
		      </div>
		    </div>

		    <!-- Errors -->
		    <div class="form-group">
		    	<div class="col-lg-5 col-lg-offset-2 errorc">
		    		<span id="pass"></span>
		    	</div>
		    </div>

		    <div class="form-group">
		      <label class="col-lg-2 control-label">Confirm Password</label>
		      <div class="col-lg-2">
		      <div class="input-group">
		      		<span class="input-group-btn">
				        <a href="#" id="eicpassword" class="btn btn-default" title="Error Indicator">&nbsp</a>
					</span>
		      		 <?php echo form_password(['name'=>'cpassword','class'=>'form-control','placeholder'=>'Confirm Password','title'=>'Enter Your Password One More Time To Cofirm','required'=>'required','id'=>'cpassword']); ?>
		      </div>
		      </div>
		    </div>

		    <!-- Errors -->
		    <div class="form-group">
		    	<div class="col-lg-5 col-lg-offset-2 errorc">
		    		<span class="cpass"></span>
		    	</div>
		    </div>

		    <div class="form-group">
		      <label class="col-lg-2 control-label">Address</label>
		      <div class="col-lg-7">
		      	<div class="input-group">
		      		<span class="input-group-btn">
				  	  <a href="#" id="eiaddress" class="btn btn-default" title="Error Indicator">&nbsp</a></span>
		      		<?php echo form_textarea(['name'=>'address','class'=>'form-control','rows'=>'1','placeholder'=>'Enter Address','title'=>'Enter Your Address','required'=>'required','value'=>set_value('address'),'id'=>'address']);?>
		      	</div>
		      </div>
		   </div>
			
		   <!-- Errors -->
		    <div class="form-group">
		    	<div class="col-lg-5 col-lg-offset-2 errorc">
		    		<span class="eadd"></span>
		    	</div>
		    </div>

			<div class="form-group">
				<div class="checkbox"><br/>
				 	<div class="col-lg-2 control-label"></div>
				 	<?php echo form_checkbox(['name'=>'2stepv','style'=>'width:25px; height:25px;','title'=>'Will Ask To Enter Verification Code Every Time You Log-In And Your Mobile No.','value'=>'1']); ?>
				 	<h4 style="padding-left: 205px;">
				 	<lable title="Will Ask To Enter Verification Code Every Time You Log-In And Your Mobile No.">Enable Stronger Security For Your Account With 2-Step Verification</lable></h4>
				</div>
		    </div> 

		    <div class="form-group">
		      <div class="col-lg-5 col-lg-offset-2">
		        <?php echo form_submit(['name'=>'submit','value'=>'Submit','class'=>'btn btn-primary']),
		        form_reset(['name'=>'reset','value'=>'Reset','class'=>'btn btn-default']); ?>
		      </div>
		    </div> 
		<?= form_close(); ?>
	</div>
</body>
</html>