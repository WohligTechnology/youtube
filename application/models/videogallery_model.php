<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class videogallery_model extends CI_Model
{
public function create($videogallerycategory,$status,$order,$url,$timestamp)
{
$data=array("videogallerycategory" => $videogallerycategory,"status" => $status,"order" => $order,"url" => $url);
$query=$this->db->insert( "youtube_videogallery", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("youtube_videogallery")->row();
return $query;
}
function getsinglevideogallery($id){
$this->db->where("id",$id);
$query=$this->db->get("youtube_videogallery")->row();
return $query;
}
public function edit($id,$videogallerycategory,$status,$order,$url,$timestamp)
{
$data=array("videogallerycategory" => $videogallerycategory,"status" => $status,"order" => $order,"url" => $url,"timestamp" => $timestamp);
$this->db->where( "id", $id );
$query=$this->db->update( "youtube_videogallery", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `youtube_videogallery` WHERE `id`='$id'");
return $query;
}
}
?>
