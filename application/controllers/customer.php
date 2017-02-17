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
						echo "<br/><br/><br/><br/><span style=\"color:#000000; font-size:20px; padding:200px; margin-top: 80px;\"><b>IMPORTANT MSG:</b> Please note down this alternative verification code for 2 step verification. <b>$vcode<b> </span>";
					}
					else
					{

					}
					$udata = array('email'=>$email,'eotp'=>$email_otp,'mobileno'=>$mobileno,'motp'=>$mobile_otp);
					$this->session->unset_userdata($udata);	
				}
				else
				{
					echo "<br/><br/><br/><br/><span style=\"color:#ff0000; font-size:20px; padding:200px; margin-top: 80px;\">Database error please try again</span>";
				}
			}
			else
			{
				echo "<br/><br/><br/><br/><span style=\"color:#ff0000; font-size:20px; padding:200px; margin-top: 80px;\">Email Address / Mobile Number Does not match with Registered one <b>or</b> Invalid OTP Entered.</span>";
			}
		}
		else
		{
			$this->load->view('Registration/Customer_reg');
		}
	}

	public function email_otp($email,$otpp)
	{
		$this->load->model('registrationmodel','regmodel');

		if ( $this->regmodel->get_email($email) )
		{
		    echo "<br/><br/><br/><br/><span style=\"color:#0000ff; font-size:20px; padding:200px; margin-top: 80px;\">Email Adrress is already exists please go back and enter another Email Address</span>";
		}
		else
		{
				if ($email!='1' && $otpp=='0')
				{
					$config = Array(
						'protocol' => 'smtp',
						'smtp_host' => 'ssl://smtp.googlemail.com',
						'smtp_port' => 465,
						'smtp_user' => 'custemails@gmail.com',
						'smtp_pass' => 'build123'
					);

					$otp=random_string('alnum', 6);

					$this->session->set_userdata('email',$email);
					$this->session->set_userdata('eotp',$otp);

					$this->session->set_userdata('mobileno','8234567890');
					$this->session->set_userdata('motp','12345');

					$this->load->library('email',$config);
					$this->email->set_newline("\r\n");

					$this->email->from('custemails@gmail.com','Buildo');
					$this->email->to($email);
					$this->email->subject('OTP From Buildoholic');
					$this->email->message($otp);

					if( $this->email->send() )
					{
						echo "<br/><br/><br/><br/><span style=\"color:#0000ff; font-size:20px; padding:200px; margin-top: 80px;\">OTP is sent successfully on your Email Address please go back and enter the OTP to proceed further</span>";
					}
					else     
					{
						// show_error($this->email->print_debugger());
						echo "<br/><br/><br/><br/><span style=\"color:#ff0000; font-size:20px; padding:200px; margin-top: 80px;\">You have entered invalid Email Address please go back and enter valid Email Address</span>";
					}
				} 
				else if( $email=='2' || $email!='2' && $otpp!='0')
				{
					if( $email!='2' )
					{
						if( $this->session->userdata('email')==$email && $this->session->userdata('eotp')==$otpp )
						{
							echo "<br/><br/><br/><br/><span style=\"color:#0000ff; font-size:20px; padding:200px; margin-top: 80px;\">You have entered valid OTP, Email has been registered succefully go back and proceed further</span>";
						}
						else
						{
							echo "<br/><br/><br/><br/><span style=\"color:#ff0000; font-size:20px; padding:200px; margin-top: 80px;\">Invalid OTP go back and try again and make sure Email Address is entered</span>";
						}	
					}
					else
					{
						echo "<br/><br/><br/><br/><span style=\"color:#ff0000; font-size:20px; padding:200px; margin-top: 80px;\">Please go back and enter valid OTP</span>";
					}
				}
				else
				{
					echo "<br/><br/><br/><br/><span style=\"color:#ff0000; font-size:20px; padding:200px; margin-top: 80px;\">Please go back and enter Valid Email Address</span>";
				}
		}
		
	}

	public function mobile_otp($mobileno,$otpp)
	{
		$this->load->library('clickatel');

		$otp=random_string('alnum', 6);

		if ($mobileno!='1' && $otpp=='0')
		{
			$params = array('user' => 'sourabh1', 'password' => 'smssourabh', 'api_id' => 'zpJI3r-kTmOm7CQgWce0Fg==');  
	        $this->load->library('clickatel', $params);

	        $this->clickatel->send_sms($mobileno, $top);

	        $this->session->set_userdata('mobileno','8234567890');
			$this->session->set_userdata('motp','12345');

	        // if(  )
	        // {
	        // 	echo "<br/><br/><br/><br/><span style=\"color:#0000ff; font-size:20px; padding:200px; margin-top: 80px;\">OTP is sent successfully on your Mobile Number please go back and enter the OTP to proceed further</span>";
	        // }
	        // else
	        // {
	        // 	echo "<br/><br/><br/><br/><span style=\"color:#ff0000; font-size:20px; padding:200px; margin-top: 80px;\">You have entered invalid Mobile Number please go back and enter valid Mobile Number</span>";
	        // }

		}
	}

}