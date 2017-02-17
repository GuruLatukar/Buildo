<?php

class Registrationmodel extends CI_Model {

	public function add_customer($data)
	{
		return $this->db->insert('customers',$data);
	}

	public function get_email($email)
	{
		$q = $this->db->where('email',$email)
					  ->get('customers');

		if( $q->num_rows() )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}