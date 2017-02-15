<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Customer Registration</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css')?>">
	<script>
		function prepare_link1() {
		  var email = document.getElementById('email');
		  var target_link1 = document.getElementById('target_link1');
		  if ( ! email.value ) {
		       target_link1.href = target_link1.href + '/' + '1';
		  }
		target_link1.href = target_link1.href + '/' + escape(email.value) + '/' + '0';
		}

		function prepare_link2() {
		  var email = document.getElementById('email');
		  var target_link2 = document.getElementById('target_link2');
		  if ( ! email.value ) {
		       target_link2.href = target_link2.href + '/' + '1';
		  }
		target_link2.href = target_link2.href + '/' + escape(email.value) + '/' + '0';
		}

		function prepare_link3() {
		  var email = document.getElementById('email');
		  var target_link3 = document.getElementById('target_link3');
		  if (  !email.value && eotp.value )
		  {
		  	target_link3.href = target_link3.href + '/' + '1';
		  } 
		  else if (  email.value && !eotp.value )
		  {
		  	target_link3.href = target_link3.href + '/' + '2';
		  } 
		  else if ( ! email.value && !eotp.value ) {
		       target_link3.href = target_link3.href + '/' + '1' + '/' + '2';
		  }
		target_link3.href = target_link3.href + '/' + escape(email.value) + '/' + escape(eotp.value);
		}

		function prepare_link4() {
		  var mobileno = document.getElementById('mobileno');
		  var target_link4 = document.getElementById('target_link4');
		  if ( ! mobileno.value ) {
		       target_link4.href = target_link4.href + '/' + '1';
		  }
		target_link4.href = target_link4.href + '/' + escape(mobileno.value) + '/' + '0';
		}
	</script>
</head>
<body>
	<br/><br/>
	<div class="container">
		<?php echo form_open('customer/registration', ['method'=>'post','class'=>'form-horizontal']); ?>
	   		
	   		<legend>Customer Registration Form</legend>
	   		
			<div class="form-group">
		      <label class="col-lg-2 control-label">Full Name</label>
		      <div class="col-lg-2">
		      <?php echo form_input(['name'=>'fname','class'=>'form-control','placeholder'=>'Enter First Name','title'=>'Enter Your First Name','required'=>'required','id'=>'fname']); ?>
		      </div> 

		     <div class="col-lg-2">
		        <?php echo form_input(['name'=>'mname','class'=>'form-control','placeholder'=>'Enter Middle Name','title'=>'Enter Your Middle Name','required'=>'required','id'=>'mname']); ?>
		      </div>

		      <div class="col-lg-2">
		        <?php echo form_input(['name'=>'lname','class'=>'form-control','placeholder'=>'Enter Last Name','title'=>'Enter Your Last Name','required'=>'required','id'=>'lname']); ?>
		      </div>
		    </div>
			<!-- Errors -->
		    <div class="form-group">
		    	<div class="col-lg-5 col-lg-offset-2 errorc">
		    		<?php echo form_error('fname'); ?>
		    		<?php echo form_error('mname'); ?>
		    		<?php echo form_error('lname'); ?>
		    	</div>
		    </div>
			
			<div class="form-group">
		      <label class="col-lg-2 control-label">Email</label>
				<div class="col-lg-3">
				    <div class="input-group">
				      <?php echo form_input(['name'=>'email','class'=>'form-control','placeholder'=>'Enter Email And Validate','title'=>'Enter Your Email ID','id'=>'email','required'=>'required']); ?>
				      <span class="input-group-btn">
				        <a href="<?= base_url('index.php/customer/email_otp'); ?>" id="target_link1" class="btn btn-primary" onclick="prepare_link1();" title="Click Validate Button To Get OTP On Your email">Validate</a>
				      </span>
				    </div>
				</div>

			  <div class="col-lg-4">
				    <div class="input-group">
				      <span class="input-group-btn">
				        <a href="<?= base_url('index.php/customer/email_otp'); ?>" id="target_link2" class="btn btn-primary" onclick="prepare_link2();" title="Cilck Resend Button To Get New OTP">Resend</a>
				      </span>
				      <?php echo form_input(['name'=>'emailotp','class'=>'form-control','placeholder'=>'Enter Email OTP','title'=>'Enter The OTP Sent On Your Email ID','required'=>'required','id'=>'eotp']); ?>
				      <span class="input-group-btn">
				         <a href="<?= base_url('index.php/customer/email_otp'); ?>" id="target_link3" class="btn btn-primary" onclick="prepare_link3();" title="Click Confirm Button To Proceed">Confirm</a>
				      </span>
				    </div>
			  </div>
			</div>

			<!-- Errors -->
		    <div class="form-group">
		    	<div class="col-lg-5 col-lg-offset-2 errorc">
		    		<?php echo form_error('email'); ?>
		    		<?php echo form_error('emailotp'); ?>
		    	</div>
		    </div>

			<div class="form-group">
		      <label class="col-lg-2 control-label">Mobile No.</label>
				<div class="col-lg-3">
				    <div class="input-group">
				      <?php echo form_input(['type'=>'number','name'=>'mobileno','class'=>'form-control','placeholder'=>'Enter Mobile No.','title'=>'Enter Your Mobile Number','required'=>'required','id'=>'mobileno']); ?>
				      <span class="input-group-btn">
				         <a href="<?= base_url('index.php/Customer/mobile_otp'); ?>" id="target_link4" class="btn btn-primary" onclick="prepare_link4();" title="Click Validate Button To Get OTP On Your Mobile">Validate</a>
				      </span>
				    </div>
				 </div>

			  <div class="col-lg-4">
				    <div class="input-group">
				    <span class="input-group-btn">
				         <?= anchor('customer/m_otp_resend','Resend',['class'=>'btn btn-primary','title'=>'Click Resend Button To Get New OTP']) ?>	
				    </span>
				      <?php echo form_input(['name'=>'mobileotp','class'=>'form-control','placeholder'=>'Enter Mobile OTP','title'=>'Enter The OTP Sent On Your Mobile Number','required'=>'required']); ?>
				      <span class="input-group-btn">
				        <?= anchor('customer/m_otp_val','Confirm',['class'=>'btn btn-primary','title'=>'Click Confirm Button To Proceed']) ?>	
				      </span>
				    </div>
			  </div>
			</div>

			<!-- Errors -->
		    <div class="form-group">
		    	<div class="col-lg-5 col-lg-offset-2 errorc">
		    		<?php echo form_error('mobileno'); ?>
		    		<?php echo form_error('mobileotp'); ?>
		    	</div>
		    </div>
					
			<div class="form-group">
		      <label class="col-lg-2 control-label">Alternative Mobile No.</label>
				<div class="col-lg-3">
					<?php echo form_input(['maxlength'=>'10','type'=>'number','name'=>'altmobileno','class'=>'form-control','placeholder'=>'Enter Alternative Mobile No.','title'=>'Enter Alternative Mobile Number','required'=>'required']); ?>
				</div>
			</div>

			<!-- Errors -->
		    <div class="form-group">
		    	<div class="col-lg-5 col-lg-offset-2 errorc">
		    		<?php echo form_error('altmobileno'); ?>
		    	</div>
		    </div>	 		

		    <div class="form-group">
		      <label class="col-lg-2 control-label">Password</label>
		      <div class="col-lg-2">
		        <?php echo form_password(['name'=>'password','class'=>'form-control','placeholder'=>'Enter Password','title'=>'Enter Your Password','required'=>'required']); ?>
		      </div>
		    </div>

		    <!-- Errors -->
		    <div class="form-group">
		    	<div class="col-lg-5 col-lg-offset-2 errorc">
		    		<?php echo form_error('password'); ?>
		    	</div>
		    </div>

		    <div class="form-group">
		      <label class="col-lg-2 control-label">Confirm Password</label>
		      <div class="col-lg-2">
		        <?php echo form_password(['name'=>'cpassword','class'=>'form-control','placeholder'=>'Confirm Password','title'=>'Enter Your Password One More Time To Cofirm','required'=>'required']); ?>
		      </div>
		    </div>

		    <!-- Errors -->
		    <div class="form-group">
		    	<div class="col-lg-5 col-lg-offset-2 errorc">
		    		<?php echo form_error('cpassword'); ?>
		    	</div>
		    </div>

		    <div class="form-group">
		      <label class="col-lg-2 control-label">Address</label>
		      <div class="col-lg-5">
		        <?php echo form_textarea(['name'=>'address','class'=>'form-control','rows'=>'3','placeholder'=>'Enter Address','title'=>'Enter Your Address','required'=>'required']);?>
		      </div>
		   </div>

		   <!-- Errors -->
		    <div class="form-group">
		    	<div class="col-lg-5 col-lg-offset-2 errorc">
		    		<?php echo form_error('address'); ?>
		    	</div>
		    </div>

			<div class="form-group">
				<div class="checkbox">
				 	<div class="col-lg-2 control-label"></div>
				 	<?php echo form_checkbox(['name'=>'2stepv','style'=>'width:25px; height:25px;','title'=>'Will Ask To Enter Verification Code Every Time You Log-In And Your Mobile No. And Email ID Will Be Encrypted']); ?>
				 	<h4 style="padding-left: 205px;">
				 	<lable title="Will Ask To Enter Verification Code Every Time You Log-In And Your Mobile No. And Email ID Will Be Encrypted">Enable Stronger Security For Your Account With 2-Step Verification</lable></h4>
				</div>
		    </div> 

		    <div class="form-group">
		      <div class="col-lg-5 col-lg-offset-2">
		        <?php echo form_submit(['name'=>'submit','value'=>'Submit','class'=>'btn btn-primary']),
		        form_reset(['name'=>'reset','value'=>'Reset','class'=>'btn btn-default']); ?>
		      </div>
		    </div> 
		</form>
	</div>
</body>
</html>