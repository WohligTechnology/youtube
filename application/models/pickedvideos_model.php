<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class pickedvideos_model extends CI_Model
{
public function create($status,$url,$image,$timestamp)
{
$data=array("status" => $status,"url" => $url,"image" => $image);
$query=$this->db->insert( "youtube_pickedvideos", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("youtube_pickedvideos")->row();
return $query;
}
function getsinglepickedvideos($id){
$this->db->where("id",$id);
$query=$this->db->get("youtube_pickedvideos")->row();
return $query;
}
public function edit($id,$status,$url,$image,$timestamp)
{
$data=array("status" => $status,"url" => $url,"image" => $image,"timestamp" => $timestamp);
$this->db->where( "id", $id );
$query=$this->db->update( "youtube_pickedvideos", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `youtube_pickedvideos` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `youtube_pickedvideos` WHERE `id`='$id'")->row();
		return $query;
	}

}
?>
