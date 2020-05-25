<?php

class m_site extends CI_model{

public function m_login($username,$password)
{
  return $this->db->query("SELECT * from admin where username='$username' AND password='$password' limit 1");
} 

public function m_login_guru($username,$password)
{
  return $this->db->query("SELECT * from guru where username='$username' AND password='$password' limit 1");
} 

}