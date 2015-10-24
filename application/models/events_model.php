<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class events_model extends CI_Model
{
public function create($status,$name,$venue,$image,$url,$starttime,$timestamp,$content,$startdate)
{
$data=array("status" => $status,"name" => $name,"venue" => $venue,"image" => $image,"url" => $url,"starttime" => $starttime,"content" => $content,"startdate" => $startdate);
$query=$this->db->insert( "youtube_events", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("youtube_events")->row();
return $query;
}
function getsingleevents($id){
$this->db->where("id",$id);
$query=$this->db->get("youtube_events")->row();
return $query;
}
public function edit($id,$status,$name,$venue,$image,$url,$starttime,$timestamp,$content,$startdate)
{
$data=array("status" => $status,"name" => $name,"venue" => $venue,"image" => $image,"url" => $url,"starttime" => $starttime,"timestamp" => $timestamp,"content" => $content,"startdate" => $startdate);
$this->db->where( "id", $id );
$query=$this->db->update( "youtube_events", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `youtube_events` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `youtube_events` WHERE `id`='$id'")->row();
		return $query;
	}

}
?>
