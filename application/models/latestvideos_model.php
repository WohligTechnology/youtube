<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class latestvideos_model extends CI_Model
{
public function create($order,$status,$url,$image,$timestamp)
{
$data=array("order" => $order,"status" => $status,"url" => $url,"image" => $image);
$query=$this->db->insert( "youtube_latestvideos", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("youtube_latestvideos")->row();
return $query;
}
function getsinglelatestvideos($id){
$this->db->where("id",$id);
$query=$this->db->get("youtube_latestvideos")->row();
return $query;
}
public function edit($id,$order,$status,$url,$image,$timestamp)
{
$data=array("order" => $order,"status" => $status,"url" => $url,"image" => $image,"timestamp" => $timestamp);
$this->db->where( "id", $id );
$query=$this->db->update( "youtube_latestvideos", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `youtube_latestvideos` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `youtube_latestvideos` WHERE `id`='$id'")->row();
		return $query;
	}
}
?>
