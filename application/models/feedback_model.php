<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class feedback_model extends CI_Model
{
public function create($name,$email,$timestamp,$content)
{
$data=array("name" => $name,"email" => $email,"content" => $content);
$query=$this->db->insert( "youtube_feedback", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("youtube_feedback")->row();
return $query;
}
function getsinglefeedback($id){
$this->db->where("id",$id);
$query=$this->db->get("youtube_feedback")->row();
return $query;
}
public function edit($id,$name,$email,$timestamp,$content)
{
$data=array("name" => $name,"email" => $email,"timestamp" => $timestamp,"content" => $content);
$this->db->where( "id", $id );
$query=$this->db->update( "youtube_feedback", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `youtube_feedback` WHERE `id`='$id'");
return $query;
}
}
?>
