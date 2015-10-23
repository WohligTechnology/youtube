<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class userimages_model extends CI_Model
{
public function create($user,$image)
{
$data=array("image" => $image,"user" => $user);
$query=$this->db->insert( "userimages", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("userimages")->row();
return $query;
}
public function edit($id,$user,$image)
{
$data=array("image" => $image,"user" => $user);
$this->db->where( "id", $id );
$query=$this->db->update( "userimages", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `userimages` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `userimages` WHERE `id`='$id'")->row();
		return $query;
	}
}
?>
