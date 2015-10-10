<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class notification_model extends CI_Model
{
public function create($status,$order,$name,$link,$timestamp,$content)
{
$data=array("status" => $status,"order" => $order,"name" => $name,"link" => $link,"content" => $content);
$query=$this->db->insert( "youtube_notification", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("youtube_notification")->row();
return $query;
}
function getsinglenotification($id){
$this->db->where("id",$id);
$query=$this->db->get("youtube_notification")->row();
return $query;
}
public function edit($id,$status,$order,$name,$link,$timestamp,$content)
{
$data=array("status" => $status,"order" => $order,"name" => $name,"link" => $link,"timestamp" => $timestamp,"content" => $content);
$this->db->where( "id", $id );
$query=$this->db->update( "youtube_notification", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `youtube_notification` WHERE `id`='$id'");
return $query;
}
}
?>
