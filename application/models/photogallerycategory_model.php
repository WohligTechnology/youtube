<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class photogallerycategory_model extends CI_Model
{
public function create($order,$status,$name,$image,$timestamp)
{
$data=array("order" => $order,"status" => $status,"name" => $name,"image" => $image);
$query=$this->db->insert( "youtube_photogallerycategory", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("youtube_photogallerycategory")->row();
return $query;
}
function getsinglephotogallerycategory($id){
$query=$this->db->query("SELECT * FROM `youtube_photogallerycategory` WHERE `id`='$id'")->row();
		return $query;
return $query;
}
public function edit($id,$order,$status,$name,$image,$timestamp)
{
$data=array("order" => $order,"status" => $status,"name" => $name,"image" => $image,"timestamp" => $timestamp);
$this->db->where( "id", $id );
$query=$this->db->update( "youtube_photogallerycategory", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `youtube_photogallerycategory` WHERE `id`='$id'");
return $query;
}
public function getimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `youtube_photogallerycategory` WHERE `id`='$id'")->row();
		return $query;
	}
	public function getphotogallerycategorydropdown()
	{
		$query=$this->db->query("SELECT * FROM `youtube_photogallerycategory`  ORDER BY `id` ASC")->result();

		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
}
?>
