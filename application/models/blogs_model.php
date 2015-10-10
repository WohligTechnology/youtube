<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class blogs_model extends CI_Model
{
public function create($order,$status,$name,$image,$url,$timestamp,$content)
{
$data=array("order" => $order,"status" => $status,"name" => $name,"image" => $image,"url" => $url,"content" => $content);
$query=$this->db->insert( "youtube_blogs", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("youtube_blogs")->row();
return $query;
}
function getsingleblogs($id){
$this->db->where("id",$id);
$query=$this->db->get("youtube_blogs")->row();
return $query;
}
public function edit($id,$order,$status,$name,$image,$url,$timestamp,$content)
{
$data=array("order" => $order,"status" => $status,"name" => $name,"image" => $image,"url" => $url,"timestamp" => $timestamp,"content" => $content);
$this->db->where( "id", $id );
$query=$this->db->update( "youtube_blogs", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `youtube_blogs` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `youtube_blogs` WHERE `id`='$id'")->row();
		return $query;
	}

}
?>
