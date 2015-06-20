<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginModel extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     //get the username & password from tbl_usrs
     function get_user($name, $password, $table)
     {
          if($table =='teams'){
               $sql = "select * from " . $table . " where teamName = '" . $name . "' and teamPassword = '" . $password . "'";
          }else if($table =='admins'){
               $sql = "select * from " . $table . " where adminName = '" . $name . "' and adminPassword = '" . $password . "'";
          }


          
          $query = $this->db->query($sql);
          return $query->num_rows();
     }
}?>