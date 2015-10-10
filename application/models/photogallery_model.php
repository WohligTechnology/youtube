<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class photogallery_model extends CI_Model
{
public function create($photogallerycategory,$order,$status,$image,$timestamp)
{
$data=array("photogallerycategory" => $photogallerycategory,"order" => $order,"status" => $status,"image" => $image);
$query=$this->db->insert( "youtube_photogallery", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("youtube_photogallery")->row();
return $query;
}
function getsinglephotogallery($id){
$this->db->where("id",$id);
$query=$this->db->get("youtube_photogallery")->row();
return $query;
}
public function edit($id,$photogallerycategory,$order,$status,$image,$timestamp)
{
$data=array("photogallerycategory" => $photogallerycategory,"order" => $order,"status" => $status,"image" => $image,"timestamp" => $timestamp);
$this->db->where( "id", $id );
$query=$this->db->update( "youtube_photogallery", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `youtube_photogallery` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `youtube_photogallery` WHERE `id`='$id'")->row();
		return $query;
	}
}
?>
