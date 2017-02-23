$(document).ready(function(){
			
			$('#email').on('keyup',function() {
				$('#eotp').val('');
				var email = $('#email').val();
				$.ajax({
					type:'POST',
					data:{email:email},
					url:'<?= base_url('index.php/customer/val_send_email'); ?>',
					success: function(result){
						$('#result1').html(result);
					}
				});
			});

			$('#eresend').click(function() {
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
				$.ajax({
					type:'POST',
					data:{mobileno:mobileno},
					url:'<?= base_url('index.php/customer/val_send_mobileno'); ?>',
					success: function(result){
						$('#result2').html(result);
					}
				});
			});

			$('#mresend').click(function() {
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

			$('#cpassword').on('keyup',function() {
				var password = $("#password").val();
			    var confirmPassword = $("#cpassword").val();

			    if (password != confirmPassword)
			        $(".cpass").html("password doesn't match");
			    else
			        $(".cpass").html("");
			});

			$(document).on('keypress', '#fname,#mname,#lname', function (event) {
			    var regex = new RegExp("^[a-zA-Z ]+$");
			    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			    if (!regex.test(key)) {
			        event.preventDefault();
			        return false;
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
			        		$(".altmobileno").html("Invalid Mobile Number");
			        	} else {
			        		$(".altmobileno").html("");
			        	}
			        } else if( firstNo!="7" || firstNo!="8" || firstNo!="9" ) {
			        	$(".altmobileno").html("Invalid Mobile Number");
			        }	
		        } else {
		        	$(".altmobileno").html("Enter Mobile Number");	
		        }
		     });

			$(document).on('keypress', '#mobileno,#altmobileno', function (event) {
			    var regex = new RegExp("^[0-9]$");
			    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			    if (!regex.test(key)) {
			        event.preventDefault();
			        return false;
			    }
			});
		});