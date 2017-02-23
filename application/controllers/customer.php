<?php 

class Customer extends MY_Controller {

	public function __construct()
	{
  		parent::__construct();
  		$this->load->library('session');
  		$this->load->helper('url');
  		$this->load->helper('form');
  		$this->load->library('form_validation');
  		$this->load->helper('string');
  		$this->load->driver('session');
  	}

	public function creg()
	{
		$this->load->view('Registration/Customer_reg');
	}

	public function registration()
	{
		if ( $this->form_validation->run('cust_reg_rules') )
		{
			$fname = $this->input->post('fname');
			$mname = $this->input->post('mname');
			$lname = $this->input->post('lname');
			$email = $this->input->post('email');
			$email_otp = $this->input->post('emailotp');
			$mobileno = $this->input->post('mobileno');
			$mobile_otp = $this->input->post('mobileotp');
			$alt_mobile_no = $this->input->post('altmobileno');
			$password = $this->input->post('password');
			$address = $this->input->post('address');
			$stepv = $this->input->post('2stepv');
			$dates = date('d-m-Y');
			
			if ( $stepv )
			{
				$vcode = random_string('alnum', 8); 
				$this->session->set_userdata('vcode',$vcode);
			} 
			else
			{
				$vcode="";
			}

			$data=['firstname'=>$fname,'middlename'=>$mname,'lastname'=>$lname,'email'=>$email,'emailotp'=>$email_otp,'mobilenumber'=>$mobileno,'alt_m_number'=>$alt_mobile_no,'password'=>md5($password),'address'=>$address,'createdon'=>$dates,'2stepv'=>$stepv,'vcode'=>md5($vcode)];

			$this->load->model('registrationmodel','regmodel');

			if (  $this->session->userdata('email')==$email && $this->session->userdata('eotp')==$email_otp && $this->session->userdata('mobileno') && $this->session->userdata('motp')==$mobile_otp )
			{
				if ( $this->regmodel->add_customer($data) )
				{
					if( $vcode )
					{
						$this->session->set_flashdata("fb","IMPORTANT MSG: Please note down this alternative verification code for 2 step verification : " . "$vcode");
					}
					else
					{

					}
					$udata = array('email'=>$email,'eotp'=>$email_otp,'mobileno'=>$mobileno,'motp'=>$mobile_otp);
					$this->session->unset_userdata($udata);	
				}
				else
				{
					$this->session->set_flashdata("fb","Database error please try again");
				}
			}
			else
			{
				$this->session->set_flashdata("fb","Email Address / Mobile Number Does not match with Registered one <b>or</b> Invalid OTP Entered");
			}
			redirect("customer/creg");
		}
		else
		{
			$this->load->view('Registration/Customer_reg');
		}
	}

	public function val_send_email()
	{
		$email=$this->input->post('email');
		$resend=$this->input->post('resend');
		$val_e=$this->input->post('val_e');

		if ( $email )
		{
			if(  $this->form_validation->run('custreg_email_rules') )
			{
				$this->load->model('registrationmodel','regmodel');
				if( $this->regmodel->get_email($email) )
				{
					echo "<script>document.getElementById('eiemail').style.background = '#EE6960';</script>";
					echo "Email Address already exists";
					echo "<script>$('#email').prop('disabled',true);</script>";
				}
				else 
				{
					echo "<script>document.getElementById('eiemail').style.background = '#E9EE60';</script>";
					if( !$val_e )
					{
						$this->generate_email($email,$resend);
					}
				}
			}
			else 
			{
				echo "<script>document.getElementById('eiemail').style.background = '#EE6960';</script>";
				echo "Invalid Email Address"; 
			}
		}
		else 
		{
			echo "<script>document.getElementById('eiemail').style.background = '#FFFFFF';</script>";
			echo "Enter Email Address"; 
		}
	}

	public function generate_email($email,$resend)
	{
		$this->session->set_userdata('email_state','1');
		$config = Array(
							'protocol' => 'smtp',
							'smtp_host' => 'ssl://smtp.googlemail.com',
							'smtp_port' => 465,
							'smtp_user' => 'custemails@gmail.com',
							'smtp_pass' => 'build123'
						);

		$eotp=random_string('alnum', 6);

		$this->session->set_userdata('email',$email);
		$this->session->set_userdata('eotp',$eotp);

		$this->load->library('email',$config);
		$this->email->set_newline("\r\n");

		$this->email->from('custemails@gmail.com','Buildo');
		$this->email->to($email);
		$this->email->subject('OTP From Buildoholic');
		$this->email->message($eotp);

		if( $resend=='1' && $this->email->send() )
		{
			echo "<script>document.getElementById('eiemail').style.background = '#89F17B';</script>";
			echo "New OTP sent on your Email Address";
		}
		else if ( $resend!='1' && $this->email->send() )     
		{
			echo "<script>document.getElementById('eiemail').style.background = '#89F17B';</script>";
			echo "OTP sent on your Email Address";
		}
		else
		{
			echo "<script>document.getElementById('eiemail').style.background = '#EE6960';</script>";
			// show_error($this->email->print_debugger());
			echo "Enter Email Address one more time";
		}
		$this->session->unset_userdata('email_state');
	}

	public function val_email_otp()
	{
		$email=$this->input->post('email');
		$eotp=$this->input->post('eotp');

		if( !$email )
		{
			echo "<script>document.getElementById('eiemail').style.background = '#FFFFFF';</script>";
			echo "Enter Email Address";
		}
		else if( !$eotp )
		{
			echo "<script>document.getElementById('eieotp').style.background = '#FFFFFF';</script>";
			echo "Enter OTP";
		}
		else if( $email && $eotp )
		{
			if ( $this->session->userdata('email')==$email && $this->session->userdata('eotp')==$eotp )
			{
				echo "<script>document.getElementById('eiemail').style.background = '#89F17B'; document.getElementById('eieotp').style.background = '#89F17B';</script>";
				echo "";
			}
			else
			{
				echo "<script>document.getElementById('eieotp').style.background = '#EE6960';</script>";
				echo "Invalid OTP";
			}
		}
	}

	public function val_send_mobileno()
	{
		$mobileno=$this->input->post('mobileno');
		$resend=$this->input->post('resend');
		$val_e=$this->input->post('val_e');

		if ( $mobileno )
		{
			if(  $this->form_validation->run('custreg_mobileno_rules') )
			{
				$this->load->model('registrationmodel','regmodel');
				if( $this->regmodel->get_mobileno($mobileno) )
				{
					echo "<script>document.getElementById('eimobileno').style.background = '#EE6960';</script>";
					echo "Mobile Number already exists";
					echo "<script>$('#mobileno').prop('disabled',true);</script>";
				}
				else 
				{
					echo "<script>document.getElementById('eimobileno').style.background = '#E9EE60';</script>";
					if( !$val_e )
					{
						$this->generate_motp($mobileno,$resend);
					}
				}
			}
			else 
			{
				echo "<script>document.getElementById('eimobileno').style.background = '#EE6960';</script>";
				echo "Invalid Mobile Number"; 
			}
		}
		else 
		{
			echo "<script>document.getElementById('eimobileno').style.background = '#FFFFFF';</script>";
			echo "Enter Mobile Number"; 
		}
	}

	public function generate_motp($mobileno,$resend)
	{
		$this->session->set_userdata('motp_state','1');

		$motp=random_string('alnum', 6);
		$this->session->set_userdata('mobileno','8234567891');
		$this->session->set_userdata('motp','12345');
		//send mobile otp

		// $authKey = "FChQJlbDctQsXRKQFGPpd1MFeExU5L1wnyPhsmVt1OoOO9aDlUlSeR4i7W5o1zjZo0GMhA6np5JNaka4jVYip0fO4audjH5MZodwWiqdJK4UMCFrQlPH_QQ-0PpRDzy4T70pjopliwaCiN8L2KAuGw==";
		// $mobileNumbers = $mobileno;
		// $senderId = "default";
		// $message = urlencode($motp);
		// $route="4";
		// $postData = array('authkey' => $authKey,'mobiles' => $mobileNumbers,'message' => $message,'sender' => $senderId,'route' =>$route);
		// $url="http://api.msg91.com/api/sendhttp.php";
		// $ch = curl_init();
		// curl_setopt_array($ch, array(CURLOPT_URL => $url,CURLOPT_RETURNTRANSFER => true,CURLOPT_POST => true,CURLOPT_POSTFIELDS => $postData));
		// $output = curl_exec($ch);
		// if(curl_errno($ch)){
		// echo 'error:' . curl_error($ch);
		// }
		// curl_close($ch);
		// echo $output;

		//send mobile otp

		if( $resend=='1' /*&& validate mobile otp send*/ )
		{
			echo "<script>document.getElementById('eimobileno').style.background = '#89F17B';</script>";
			echo "New OTP sent on your Mobile Number";
		}
		else if ( $resend!='1' /*&& validate mobile otp send*/ )     
		{
			echo "<script>document.getElementById('eimobileno').style.background = '#89F17B';</script>";
			echo "OTP sent on your Mobile Number";
		}
		else
		{
			echo "<script>document.getElementById('eimobileno').style.background = '#EE6960';</script>";
			echo "Enter Mobile Number one more time";
		}
		$this->session->unset_userdata('motp_state');
	}

	public function val_mobile_otp()
	{
		$mobileno=$this->input->post('mobileno');
		$motp=$this->input->post('motp');

		if( !$mobileno )
		{
			echo "<script>document.getElementById('eimobileno').style.background = '#FFFFFF';</script>";
			echo "Enter Mobile Number";
		}
		else if( !$motp )
		{
			echo "<script>document.getElementById('eimotp').style.background = '#FFFFFF';</script>";
			echo "Enter OTP";
		}
		else if( $mobileno && $motp )
		{
			if ( $this->session->userdata('mobileno')==$mobileno && $this->session->userdata('motp')==$motp )
			{
				echo "<script>document.getElementById('eimobileno').style.background = '#89F17B'; document.getElementById('eimotp').style.background = '#89F17B';</script>";
				echo "";
			}
			else
			{
				echo "<script>document.getElementById('eimotp').style.background = '#EE6960';</script>";
				echo "Invalid OTP";
			}
		}
	}
}