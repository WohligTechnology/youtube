<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class videogallerycategory_model extends CI_Model
{
public function create($status,$order,$name,$subtitle,$url,$timestamp)
{
$data=array("status" => $status,"order" => $order,"name" => $name,"subtitle" => $subtitle,"url" => $url);
$query=$this->db->insert( "youtube_videogallerycategory", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("youtube_videogallerycategory")->row();
return $query;
}
function getsinglevideogallerycategory($id){
$this->db->where("id",$id);
$query=$this->db->get("youtube_videogallerycategory")->row();
return $query;
}
public function edit($id,$status,$order,$name,$subtitle,$url,$timestamp)
{
$data=array("status" => $status,"order" => $order,"name" => $name,"subtitle" => $subtitle,"url" => $url,"timestamp" => $timestamp);
$this->db->where( "id", $id );
$query=$this->db->update( "youtube_videogallerycategory", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `youtube_videogallerycategory` WHERE `id`='$id'");
return $query;
}
public function getvideogallerycategorydropdown()
	{
		$query=$this->db->query("SELECT * FROM `youtube_videogallerycategory`  ORDER BY `id` ASC")->result();

		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
}
?>
