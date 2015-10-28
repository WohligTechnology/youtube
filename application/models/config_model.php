<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class config_model extends CI_Model
{
public function checkplaylist()
{
$query=$this->db->query("SELECT COUNT(*) as `playlistcount` FROM `playlist`")->row();
$playlistcount=$query->playlistcount;
return $playlistcount;
}
    public function getplaylistdropdown()
	{
		$query=$this->db->query("SELECT * FROM `playlist`  ORDER BY `id` ASC")->result();

		foreach($query as $row)
		{
			$return[$row->id]=$row->playlist;
		}
		
		return $return;
	}
    
    public function beforeedit()
{
$this->db->where("id",1);
$query=$this->db->get("config")->row();
return $query;
}
 public function getCoverImageById($id)
    {
        $query = $this->db->query('SELECT `coverimage` FROM `config` WHERE `id`=('.$this->db->escape($id).')')->row();

        return $query;
    } 
    public function edit($id,$name,$about,$hobbies,$coverimage,$fbusername,$instausername,$channelid)
    {
        $query=$this->db->query("UPDATE `config` SET `about`='$about',`hobbies`='$hobbies',`coverimage`='$coverimage',`fbusername`='$fbusername',`instausername`='$instausername',`channelid`='$channelid',`name`='$name' WHERE `id`=1");
        return 1;

    }

}
?>
