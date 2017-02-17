<?php

$config = [

		'cust_reg_rules'=> [

								[
									'field' => 'fname',
									'label' => 'First Name',
									'rules' => 'required|alpha|trim'
								],
								
								[
									'field' => 'mname',
									'label' => 'Middle Name',
									'rules' => 'required|alpha|trim'
								],

								[
									'field' => 'lname',
									'label' => 'Last Name',
									'rules' => 'required|alpha|trim'
								],

								[
									'field' => 'email',
									'label' => 'Email',
									'rules' => 'required|valid_email|is_unique[customers.mobilenumber]'
								],

								[
									'field' => 'emailotp',
									'label' => 'Email OTP',
									'rules' => 'required'
								],

								[
									'field' => 'mobileno',
									'label' => 'Mobile Number',
									'rules' => 'trim|required|exact_length[10]|regex_match[/[7-9]{1}[0-9]{9}/]|is_unique[customers.mobilenumber]'	
								],

								[
									'field' => 'mobileotp',
									'label' => 'Mobile OTP',
									'rules' => 'required'
								],

								[
									'field' => 'altmobileno',
									'label' => 'Alternative Mobile Number',
									'rules' => 'trim|required|exact_length[10]|regex_match[/[7-9]{1}[0-9]{9}/]|is_unique[customers.alt_m_number]'	
								],

								[
									'field' => 'password',
									'label' => 'Password',
									'rules' => 'required|min_length[6]'
								],

								[
									'field' => 'cpassword',
									'label' => 'Confirm Password',
									'rules' => 'required|min_length[6]|matches[password]'
								],

								[
									'field' => 'address',
									'label' => 'Address',
									'rules' => 'required'
								]
							]

];