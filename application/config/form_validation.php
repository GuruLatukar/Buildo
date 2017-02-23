<?php

$config = [

		'custreg_email_rules'=> [
									[
										'field' => 'email',
										'label' => 'Email',
										'rules' => 'required|valid_email'
									],
								],

	'custreg_mobileno_rules'=> [
									[
										'field' => 'mobileno',
										'label' => 'Mobile Number',
										'rules' => 'trim|regex_match[/[7-9]{1}[0-9]{9}/]'
									],
								]							

];