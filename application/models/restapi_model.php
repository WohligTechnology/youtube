<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class restapi_model extends CI_Model
{
   
    public function signUp($name, $email, $password,$contact)
    {
        $password = md5($password);
         $query1=$this->db->query("SELECT `id` FROM `user` WHERE `email`='$email'");
				$num=$query1->num_rows();
        if($num == 0)
        {
            $query = $this->db->query('INSERT INTO `user`( `name`, `email`, `password`,`contact`,`logintype`,`accesslevel`,`status`) VALUES ('.$this->db->escape($name).','.$this->db->escape($email).','.$this->db->escape($password).','.$this->db->escape($contact).",'1','3','1')");
            $id = $this->db->insert_id();

          

            $newdata = $this->db->query('SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `address`, `contact`, `dob`, `street`, `city`, `state`, `country`, `pincode`, `facebook`, `google`, `twitter`, `website` FROM `user` WHERE `id`=('.$this->db->escape($id).')')->row();
            if (!$query) {
                return false;
            } else {
                return $newdata;
            }
       
    }
    }
    public function signIn($email, $password)
    {
        $password = md5($password);
        $query = $this->db->query('SELECT `id` FROM `user` WHERE `email`=('.$this->db->escape($email).') AND `password`= ('.$this->db->escape($password).')');
        if ($query->num_rows > 0) {
            $user = $query->row();
            $user = $user->id;
            $query1 = $this->db->query("UPDATE `user` SET `forgotpassword`='' WHERE `email`=(".$this->db->escape($email).')');
            $newdata = $this->db->query('SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `email`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `pincode`, `facebook`, `twitter`, `google`, `country`, `instagram`, `contact`, `eventnotification`, `photonotification`, `videonotification`, `blognotification`, `coverimage`, `forgotpassword` FROM `user` WHERE `id`=('.$this->db->escape($user).')')->row();
            $this->session->set_userdata($newdata);
            //print_r($newdata);
            return $newdata;
        } elseif ($query->num_rows == 0) {
            $query3 = $this->db->query('SELECT `id` FROM `user` WHERE `email`=('.$this->db->escape($email).') AND `forgotpassword`= ('.$this->db->escape($password).')');
            if ($query3->num_rows > 0) {
                $user = $query3->row();
                $user = $user->id;
                $query1 = $this->db->query("UPDATE `user` SET `forgotpassword`='',`password`=(".$this->db->escape($password).') WHERE `email`=('.$this->db->escape($email).')');
                $newdata = $this->db->query('SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `pincode`, `facebook`, `twitter`, `google`, `country`, `instagram`, `contact`, `eventnotification`, `photonotification`, `videonotification`, `blognotification`, `coverimage`, `forgotpassword` FROM `user` WHERE `id`=('.$this->db->escape($user).')')->row();

                $this->session->set_userdata($newdata);
                    //print_r($newdata);
                    return $newdata;
            } else {
                return false;
            }
        }
    }

   

    public function profileSubmit($id, $name, $email, $password, $dob, $contact)
    {
        $password = md5($password);
        $query = $this->db->query('UPDATE `user`
 SET `name` = '.$this->db->escape($name).', `email` = '.$this->db->escape($email).',`password` = '.$this->db->escape($password).',`dob` = '.$this->db->escape($dob).',`contact` = '.$this->db->escape($contact).'
 WHERE id = ('.$this->db->escape($id).')');
        if (!$query) {
            return  0;
        } else {
            return  1;
        }
    }
    public function editProfile($id, $name, $email,$oldpassword,$newpassword,$contact,$address, $website,  $dob)
    {
         $query = $this->db->query('UPDATE `user`
 SET `name` = '.$this->db->escape($name).', `email` = '.$this->db->escape($email).',`dob` = '.$this->db->escape($dob).',`contact` = '.$this->db->escape($contact).',`address` = '.$this->db->escape($address).',`website` = '.$this->db->escape($website).'
 WHERE id = ('.$this->db->escape($id).')');

        $query1 = $this->db->query('SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `pincode`, `facebook`, `twitter`, `google`, `country`, `instagram`, `contact` FROM `user` WHERE `id`=('.$this->db->escape($id).')')->row();
        if ($query) {
            return  $query1;
        } else {
            return  0;
        }
    }
  
}
