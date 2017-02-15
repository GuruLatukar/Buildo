<?php 

class Customer extends MY_Controller {

	public function __construct()
	{
  		parent::__construct();
  		$this->load->library('session');
  		$this->load->helper('url');
  		$this->load->helper('form');
  		$this->load->library('form_validation');
  	}

	public function creg()
	{
		$this->load->view('Registration/Customer_reg');
	}

	public function registration()
	{
		if ( $this->form_validation->run('cust_reg_rules') )
		{
			//success

			//
			// Destroy all sessions
			//
		}
		else
		{
			$this->load->view('Registration/Customer_reg');
			//
			// Destroy all sessions
			//
		}
	}

	public function email_otp($email,$otpp)
	{
		$this->load->driver('session');
		$this->load->helper('string');

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
			$this->session->set_userdata('otp',$otp);

			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");

			$this->email->from('phsourabh.patil@gmail.com','Sourabh');
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
				if( $this->session->userdata('email')==$email && $this->session->userdata('otp')==$otpp )
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

	public function mobile_otp($mobileno,$otpp)
	{
		$this->load->driver('session');
		$this->load->helper('string');
		$this->load->library('clickatel');

		$otp=random_string('alnum', 6);

		if ($mobileno!='1' && $otpp=='0')
		{
			$params = array('user' => 'sourabh1', 'password' => 'smssourabh', 'api_id' => 'zpJI3r-kTmOm7CQgWce0Fg==');  
	        $this->load->library('clickatel', $params);

	        $this->clickatel->send_sms($mobileno, $top);

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