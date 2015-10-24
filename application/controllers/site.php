<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller 
{
	public function __construct( )
	{
		parent::__construct();
		
		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
	public function index()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'page' ] = 'dashboard';
		$data[ 'usercount' ] = $this->user_model->usercount();
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );	
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'activemenu' ] = 'users';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );	
	}
	function createusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data[ 'page' ] = 'createuser';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );	
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $contact=$this->input->post('contact');
            $logintype=$this->input->post('logintype');
            $address=$this->input->post('address');
            $dob=$this->input->post('dob');
            $website=$this->input->post('website');
            $about=$this->input->post('about');
            $hobbies=$this->input->post('hobbies');
            $profession=$this->input->post('profession');
       
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			} $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}


            // COVERIMAGE

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'coverimage';
            $coverimage = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $coverimage = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
                $config_r['maintain_ratio'] = true;
                $config_t['create_thumb'] = false; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;

                // end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                    // return false;
                } else {

                    // print_r($this->image_lib->dest_image);
                    // dest_image

                    $coverimage = $this->image_lib->dest_image;

                    // return false;
                }
            }
            
			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$address,$contact,$dob,$website,$about,$hobbies,$profession,$coverimage)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			$data['redirect']="site/viewusers";
			$this->load->view("redirect",$data);
		}
	}
    function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewusers';
        $data['base_url'] = site_url("site/viewusersjson");
        
		$data['title']='View Users';
		$this->load->view('template',$data);
	} 
    function viewusersjson()
	{
		$access = array("1");
		$this->checkaccess($access);
        
        
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        
        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`socialid`";
        $elements[3]->sort="1";
        $elements[3]->header="SocialId";
        $elements[3]->alias="socialid";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`logintype`.`name`";
        $elements[4]->sort="1";
        $elements[4]->header="Logintype";
        $elements[4]->alias="logintype";
       
        $elements[5]=new stdClass();
        $elements[5]->field="`accesslevel`.`name`";
        $elements[5]->sort="1";
        $elements[5]->header="Accesslevel";
        $elements[5]->alias="accesslevelname";
       
        $elements[6]=new stdClass();
        $elements[6]->field="`statuses`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Status";
        $elements[6]->alias="status";
       
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`");
        
		$this->load->view("json",$data);
	} 
    
    
	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['before1']=$this->input->get('id');
		$data['before2']=$this->input->get('id');
		$data['page']='edituser';
		$data[ 'activemenu' ] = 'users';
		 $data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('templatewith2',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
//			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $contact=$this->input->post('contact');
            $logintype=$this->input->post('logintype');
            $address=$this->input->post('address');
            $dob=$this->input->post('dob');
            $website=$this->input->post('website');
            $about=$this->input->post('about');
            $hobbies=$this->input->post('hobbies');
            $profession=$this->input->post('profession');
//            $category=$this->input->get_post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }

              // COVERIMAGE

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            $filename = 'coverimage';
            $coverimage = '';
            if ($this->upload->do_upload($filename)) {
                $uploaddata = $this->upload->data();
                $coverimage = $uploaddata['file_name'];
                $config_r['source_image'] = './uploads/'.$uploaddata['file_name'];
                $config_r['maintain_ratio'] = true;
                $config_t['create_thumb'] = false; ///add this
                $config_r['width'] = 800;
                $config_r['height'] = 800;
                $config_r['quality'] = 100;

                // end of configs

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                if (!$this->image_lib->resize()) {
                    $data['alerterror'] = 'Failed.'.$this->image_lib->display_errors();

                    // return false;
                } else {

                    // print_r($this->image_lib->dest_image);
                    // dest_image

                    $coverimage = $this->image_lib->dest_image;

                    // return false;
                }
            }

            if ($coverimage == '') {
                $coverimage = $this->user_model->getCoverImageById($id);

                // print_r($coverimage);

                $coverimage = $coverimage->coverimage;
            }
            
			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$address,$contact,$dob,$website,$about,$hobbies,$profession,$coverimage)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
	}
    
    
    
    public function viewlatestvideos()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewlatestvideos";
$data["base_url"]=site_url("site/viewlatestvideosjson");
$data["title"]="View latestvideos";
$this->load->view("template",$data);
}
function viewlatestvideosjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`youtube_latestvideos`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`youtube_latestvideos`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";
$elements[2]=new stdClass();
$elements[2]->field="`youtube_latestvideos`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`youtube_latestvideos`.`url`";
$elements[3]->sort="1";
$elements[3]->header="Url";
$elements[3]->alias="url";
$elements[4]=new stdClass();
$elements[4]->field="`youtube_latestvideos`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";
$elements[5]=new stdClass();
$elements[5]->field="DATE_FORMAT(`youtube_latestvideos`.`timestamp`,'%a, %b %d %Y %h:%i %p')";
$elements[5]->sort="1";
$elements[5]->header="Timestamp";
$elements[5]->alias="timestamp";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `youtube_latestvideos`");
$this->load->view("json",$data);
}

public function createlatestvideos()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createlatestvideos";
$data[ 'activemenu' ] = 'latest videos';
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create latestvideos";
$this->load->view("template",$data);
}
public function createlatestvideossubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createlatestvideos";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create latestvideos";
$this->load->view("template",$data);
}
else
{
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$url=$this->input->get_post("url");
$image=$this->input->get_post("image");
$timestamp=$this->input->get_post("timestamp");
 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
if($this->latestvideos_model->create($order,$status,$url,$image,$timestamp)==0)
$data["alerterror"]="New latestvideos could not be created.";
else
$data["alertsuccess"]="latestvideos created Successfully.";
$data["redirect"]="site/viewlatestvideos";
$this->load->view("redirect",$data);
}
}
public function editlatestvideos()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editlatestvideos";
$data[ 'activemenu' ] = 'latest videos';
$data["title"]="Edit latestvideos";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->latestvideos_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editlatestvideossubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editlatestvideos";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit latestvideos";
$data["before"]=$this->latestvideos_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$url=$this->input->get_post("url");
$image=$this->input->get_post("image");
$timestamp=$this->input->get_post("timestamp");
 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->latestvideos_model->getimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }

if($this->latestvideos_model->edit($id,$order,$status,$url,$image,$timestamp)==0)
$data["alerterror"]="New latestvideos could not be Updated.";
else
$data["alertsuccess"]="latestvideos Updated Successfully.";
$data["redirect"]="site/viewlatestvideos";
$this->load->view("redirect",$data);
}
}
public function deletelatestvideos()
{
$access=array("1");
$this->checkaccess($access);
$this->latestvideos_model->delete($this->input->get("id"));
$data["redirect"]="site/viewlatestvideos";
$this->load->view("redirect",$data);
}
public function viewpickedvideos()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewpickedvideos";
$data["base_url"]=site_url("site/viewpickedvideosjson");
$data["title"]="View pickedvideos";
$this->load->view("template",$data);
}
function viewpickedvideosjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`youtube_pickedvideos`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`youtube_pickedvideos`.`status`";
$elements[1]->sort="1";
$elements[1]->header="Status";
$elements[1]->alias="status";
$elements[2]=new stdClass();
$elements[2]->field="`youtube_pickedvideos`.`url`";
$elements[2]->sort="1";
$elements[2]->header="Url";
$elements[2]->alias="url";
$elements[3]=new stdClass();
$elements[3]->field="`youtube_pickedvideos`.`image`";
$elements[3]->sort="1";
$elements[3]->header="Image";
$elements[3]->alias="image";
$elements[4]=new stdClass();
$elements[4]->field="DATE_FORMAT(`youtube_pickedvideos`.`timestamp`,'%a, %b %d %Y %h:%i %p')";
$elements[4]->sort="1";
$elements[4]->header="Timestamp";
$elements[4]->alias="timestamp";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `youtube_pickedvideos`");
$this->load->view("json",$data);
}

public function createpickedvideos()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createpickedvideos";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'activemenu' ] = 'picked videos';
$data["title"]="Create pickedvideos";
$this->load->view("template",$data);
}
public function createpickedvideossubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createpickedvideos";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create pickedvideos";
$this->load->view("template",$data);
}
else
{
$status=$this->input->get_post("status");
$url=$this->input->get_post("url");
$image=$this->input->get_post("image");
$timestamp=$this->input->get_post("timestamp");
 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
if($this->pickedvideos_model->create($status,$url,$image,$timestamp)==0)
$data["alerterror"]="New pickedvideos could not be created.";
else
$data["alertsuccess"]="pickedvideos created Successfully.";
$data["redirect"]="site/viewpickedvideos";
$this->load->view("redirect",$data);
}
}
public function editpickedvideos()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editpickedvideos";
$data[ 'activemenu' ] = 'picked videos';
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit pickedvideos";
$data["before"]=$this->pickedvideos_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editpickedvideossubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editpickedvideos";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit pickedvideos";
$data["before"]=$this->pickedvideos_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$status=$this->input->get_post("status");
$url=$this->input->get_post("url");
$image=$this->input->get_post("image");
$timestamp=$this->input->get_post("timestamp");
 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->pickedvideos_model->getimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }

if($this->pickedvideos_model->edit($id,$status,$url,$image,$timestamp)==0)
$data["alerterror"]="New pickedvideos could not be Updated.";
else
$data["alertsuccess"]="pickedvideos Updated Successfully.";
$data["redirect"]="site/viewpickedvideos";
$this->load->view("redirect",$data);
}
}
public function deletepickedvideos()
{
$access=array("1");
$this->checkaccess($access);
$this->pickedvideos_model->delete($this->input->get("id"));
$data["redirect"]="site/viewpickedvideos";
$this->load->view("redirect",$data);
}
public function viewevents()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewevents";
$data["base_url"]=site_url("site/vieweventsjson");
$data["title"]="View events";
$this->load->view("template",$data);
}
function vieweventsjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`youtube_events`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`youtube_events`.`status`";
$elements[1]->sort="1";
$elements[1]->header="Status";
$elements[1]->alias="status";
$elements[2]=new stdClass();
$elements[2]->field="`youtube_events`.`name`";
$elements[2]->sort="1";
$elements[2]->header="Name";
$elements[2]->alias="name";
$elements[3]=new stdClass();
$elements[3]->field="`youtube_events`.`venue`";
$elements[3]->sort="1";
$elements[3]->header="Venue";
$elements[3]->alias="venue";
$elements[4]=new stdClass();
$elements[4]->field="`youtube_events`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";
$elements[5]=new stdClass();
$elements[5]->field="`youtube_events`.`url`";
$elements[5]->sort="1";
$elements[5]->header="Url";
$elements[5]->alias="url";
$elements[6]=new stdClass();
$elements[6]->field="`youtube_events`.`starttime`";
$elements[6]->sort="1";
$elements[6]->header="Start Time";
$elements[6]->alias="starttime";
$elements[7]=new stdClass();
$elements[7]->field="`youtube_events`.`timestamp`";
$elements[7]->sort="1";
$elements[7]->header="Timestamp";
$elements[7]->alias="timestamp";
$elements[8]=new stdClass();
$elements[8]->field="`youtube_events`.`content`";
$elements[8]->sort="1";
$elements[8]->header="Content";
$elements[8]->alias="content";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `youtube_events`");
$this->load->view("json",$data);
}

public function createevents()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createevents";
$data[ 'activemenu' ] = 'events';
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create events";
$this->load->view("template",$data);
}
public function createeventssubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("venue","Venue","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("starttime","Start Time","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createevents";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create events";
$this->load->view("template",$data);
}
else
{
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$venue=$this->input->get_post("venue");
$image=$this->input->get_post("image");
$url=$this->input->get_post("url");
$starttime=$this->input->get_post("starttime");
$timestamp=$this->input->get_post("timestamp");
$content=$this->input->get_post("content");
$startdate=$this->input->get_post("startdate");
 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
if($this->events_model->create($status,$name,$venue,$image,$url,$starttime,$timestamp,$content,$startdate)==0)
$data["alerterror"]="New events could not be created.";
else
$data["alertsuccess"]="events created Successfully.";
$data["redirect"]="site/viewevents";
$this->load->view("redirect",$data);
}
}
public function editevents()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editevents";
$data[ 'activemenu' ] = 'events';
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit events";
$data["before"]=$this->events_model->beforeedit($this->input->get("id"));
$data['exp'] = explode(':', $data['before']->starttime);
$this->load->view("template",$data);
}
public function editeventssubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("venue","Venue","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("starttime","Start Time","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editevents";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit events";
$data["before"]=$this->events_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$venue=$this->input->get_post("venue");
$image=$this->input->get_post("image");
$url=$this->input->get_post("url");
$starttime=$this->input->get_post("starttime");
$timestamp=$this->input->get_post("timestamp");
$content=$this->input->get_post("content");
$startdate=$this->input->get_post("startdate");
 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->events_model->getimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }

if($this->events_model->edit($id,$status,$name,$venue,$image,$url,$starttime,$timestamp,$content,$startdate)==0)
$data["alerterror"]="New events could not be Updated.";
else
$data["alertsuccess"]="events Updated Successfully.";
$data["redirect"]="site/viewevents";
$this->load->view("redirect",$data);
}
}
public function deleteevents()
{
$access=array("1");
$this->checkaccess($access);
$this->events_model->delete($this->input->get("id"));
$data["redirect"]="site/viewevents";
$this->load->view("redirect",$data);
}
public function viewblogs()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewblogs";
$data["base_url"]=site_url("site/viewblogsjson");
$data["title"]="View blogs";
$this->load->view("template",$data);
}
function viewblogsjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`youtube_blogs`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`youtube_blogs`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";
$elements[2]=new stdClass();
$elements[2]->field="`youtube_blogs`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`youtube_blogs`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Name";
$elements[3]->alias="name";
$elements[4]=new stdClass();
$elements[4]->field="`youtube_blogs`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";
$elements[5]=new stdClass();
$elements[5]->field="`youtube_blogs`.`url`";
$elements[5]->sort="1";
$elements[5]->header="Url";
$elements[5]->alias="url";
$elements[6]=new stdClass();
$elements[6]->field="`youtube_blogs`.`timestamp`";
$elements[6]->sort="1";
$elements[6]->header="Timestamp";
$elements[6]->alias="timestamp";
$elements[7]=new stdClass();
$elements[7]->field="`youtube_blogs`.`content`";
$elements[7]->sort="1";
$elements[7]->header="Content";
$elements[7]->alias="content";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `youtube_blogs`");
$this->load->view("json",$data);
}

public function createblogs()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createblogs";
$data[ 'activemenu' ] = 'events';
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create blogs";
$this->load->view("template",$data);
}
public function createblogssubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createblogs";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create blogs";
$this->load->view("template",$data);
}
else
{
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$image=$this->input->get_post("image");
$url=$this->input->get_post("url");
$timestamp=$this->input->get_post("timestamp");
$content=$this->input->get_post("content");
 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
if($this->blogs_model->create($order,$status,$name,$image,$url,$timestamp,$content)==0)
$data["alerterror"]="New blogs could not be created.";
else
$data["alertsuccess"]="blogs created Successfully.";
$data["redirect"]="site/viewblogs";
$this->load->view("redirect",$data);
}
}
public function editblogs()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editblogs";
$data[ 'activemenu' ] = 'events';
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit blogs";
$data["before"]=$this->blogs_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editblogssubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editblogs";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit blogs";
$data["before"]=$this->blogs_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$image=$this->input->get_post("image");
$url=$this->input->get_post("url");
$timestamp=$this->input->get_post("timestamp");
$content=$this->input->get_post("content");
 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->blogs_model->getimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }

if($this->blogs_model->edit($id,$order,$status,$name,$image,$url,$timestamp,$content)==0)
$data["alerterror"]="New blogs could not be Updated.";
else
$data["alertsuccess"]="blogs Updated Successfully.";
$data["redirect"]="site/viewblogs";
$this->load->view("redirect",$data);
}
}
public function deleteblogs()
{
$access=array("1");
$this->checkaccess($access);
$this->blogs_model->delete($this->input->get("id"));
$data["redirect"]="site/viewblogs";
$this->load->view("redirect",$data);
}
public function viewphotogallerycategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewphotogallerycategory";
$data["base_url"]=site_url("site/viewphotogallerycategoryjson");
$data["title"]="View photogallerycategory";
$this->load->view("template",$data);
}
function viewphotogallerycategoryjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`youtube_photogallerycategory`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`youtube_photogallerycategory`.`order`";
$elements[1]->sort="1";
$elements[1]->header="Order";
$elements[1]->alias="order";
$elements[2]=new stdClass();
$elements[2]->field="`youtube_photogallerycategory`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`youtube_photogallerycategory`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Name";
$elements[3]->alias="name";
$elements[4]=new stdClass();
$elements[4]->field="`youtube_photogallerycategory`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";
$elements[5]=new stdClass();
$elements[5]->field="DATE_FORMAT(`youtube_photogallerycategory`.`timestamp`,'%a, %b %d %Y %h:%i %p')";
$elements[5]->sort="1";
$elements[5]->header="Timestamp";
$elements[5]->alias="timestamp";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `youtube_photogallerycategory`");
$this->load->view("json",$data);
}

public function createphotogallerycategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createphotogallerycategory";
$data[ 'activemenu' ] = 'photo gallery category';
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create photogallerycategory";
$this->load->view("template",$data);
}
public function createphotogallerycategorysubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createphotogallerycategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create photogallerycategory";
$this->load->view("template",$data);
}
else
{
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$image=$this->input->get_post("image");
$timestamp=$this->input->get_post("timestamp");
 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
if($this->photogallerycategory_model->create($order,$status,$name,$image,$timestamp)==0)
$data["alerterror"]="New photogallerycategory could not be created.";
else
$data["alertsuccess"]="photogallerycategory created Successfully.";
$data["redirect"]="site/viewphotogallerycategory";
$this->load->view("redirect",$data);
}
}
public function editphotogallerycategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editphotogallerycategory";
$data[ 'activemenu' ] = 'photo gallery category';
$data["page2"]="block/photoblock";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit photogallerycategory";
$data["before"]=$this->photogallerycategory_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editphotogallerycategorysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editphotogallerycategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit photogallerycategory";
$data["before"]=$this->photogallerycategory_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$name=$this->input->get_post("name");
$image=$this->input->get_post("image");
$timestamp=$this->input->get_post("timestamp");
 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->photogallerycategory_model->getimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }

if($this->photogallerycategory_model->edit($id,$order,$status,$name,$image,$timestamp)==0)
$data["alerterror"]="New photogallerycategory could not be Updated.";
else
$data["alertsuccess"]="photogallerycategory Updated Successfully.";
$data["redirect"]="site/viewphotogallerycategory";
$this->load->view("redirect",$data);
}
}
public function deletephotogallerycategory()
{
$access=array("1");
$this->checkaccess($access);
$this->photogallerycategory_model->delete($this->input->get("id"));
$data["redirect"]="site/viewphotogallerycategory";
$this->load->view("redirect",$data);
}
public function viewphotogallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewphotogallery";
$data["page2"]="block/photoblock";
$data[ 'activemenu' ] = 'photo gallery category';
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewphotogalleryjson");
$data["title"]="View photogallery";
$this->load->view("templatewith2",$data);
}
function viewphotogalleryjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`youtube_photogallery`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`youtube_photogallery`.`photogallerycategory`";
$elements[1]->sort="1";
$elements[1]->header="Photo Gallery Category";
$elements[1]->alias="photogallerycategory";
$elements[2]=new stdClass();
$elements[2]->field="`youtube_photogallery`.`order`";
$elements[2]->sort="1";
$elements[2]->header="Order";
$elements[2]->alias="order";
$elements[3]=new stdClass();
$elements[3]->field="`youtube_photogallery`.`status`";
$elements[3]->sort="1";
$elements[3]->header="Status";
$elements[3]->alias="status";
$elements[4]=new stdClass();
$elements[4]->field="`youtube_photogallery`.`image`";
$elements[4]->sort="1";
$elements[4]->header="Image";
$elements[4]->alias="image";
$elements[5]=new stdClass();
$elements[5]->field="DATE_FORMAT(`youtube_photogallery`.`timestamp`,'%a, %b %d %Y %h:%i %p')";
$elements[5]->sort="1";
$elements[5]->header="Timestamp";
$elements[5]->alias="timestamp";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `youtube_photogallery`");
$this->load->view("json",$data);
}

public function createphotogallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createphotogallery";
$data["page2"]="block/photoblock";
$data[ 'activemenu' ] = 'photo gallery category';
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["photogallerycategory"]=$this->photogallerycategory_model->getphotogallerycategorydropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create photogallery";
$this->load->view("templatewith2",$data);
}
public function createphotogallerysubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("photogallerycategory","Photo Gallery Category","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createphotogallery";
$data["photogallerycategory"]=$this->photogallerycategory_model->getphotogallerycategorydropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create photogallery";
$this->load->view("template",$data);
}
else
{
$photogallerycategory=$this->input->get_post("photogallerycategory");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$image=$this->input->get_post("image");
$timestamp=$this->input->get_post("timestamp");
 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
if($this->photogallery_model->create($photogallerycategory,$order,$status,$image,$timestamp)==0)
$data["alerterror"]="New photogallery could not be created.";
else
$data["alertsuccess"]="photogallery created Successfully.";
$data["redirect"]="site/viewphotogallery?id=".$photogallerycategory;
$this->load->view("redirect2",$data);
}
}
public function editphotogallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editphotogallery";
$data["page2"]="block/photoblock";
$data["before1"]=$this->input->get('photogallerycategoryid');
$data["before2"]=$this->input->get('photogallerycategoryid');
$data[ 'activemenu' ] = 'photo gallery category';
$data["photogallerycategory"]=$this->photogallerycategory_model->getphotogallerycategorydropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit photogallery";
$data["before"]=$this->photogallery_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editphotogallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("photogallerycategory","Photo Gallery Category","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("image","Image","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editphotogallery";
$data["photogallerycategory"]=$this->photogallerycategory_model->getphotogallerycategorydropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit photogallery";
$data["before"]=$this->photogallery_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$photogallerycategory=$this->input->get_post("photogallerycategory");
$order=$this->input->get_post("order");
$status=$this->input->get_post("status");
$image=$this->input->get_post("image");
$timestamp=$this->input->get_post("timestamp");
 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->photogallery_model->getimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }

if($this->photogallery_model->edit($id,$photogallerycategory,$order,$status,$image,$timestamp)==0)
$data["alerterror"]="New photogallery could not be Updated.";
else
$data["alertsuccess"]="photogallery Updated Successfully.";
$data["redirect"]="site/viewphotogallery?id=".$photogallerycategory;
$this->load->view("redirect2",$data);
}
}
public function deletephotogallery()
{
$access=array("1");
$this->checkaccess($access);
$this->photogallery_model->delete($this->input->get("id"));
$photogallerycategory=$this->input->get("photogallerycategoryid");
$data["redirect"]="site/viewphotogallery?id=".$photogallerycategory;
$this->load->view("redirect2",$data);
}
public function viewvideogallerycategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewvideogallerycategory";
$data["base_url"]=site_url("site/viewvideogallerycategoryjson");
$data["title"]="View videogallerycategory";
$this->load->view("template",$data);
}
function viewvideogallerycategoryjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`youtube_videogallerycategory`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`youtube_videogallerycategory`.`status`";
$elements[1]->sort="1";
$elements[1]->header="Status";
$elements[1]->alias="status";
$elements[2]=new stdClass();
$elements[2]->field="`youtube_videogallerycategory`.`order`";
$elements[2]->sort="1";
$elements[2]->header="Order";
$elements[2]->alias="order";
$elements[3]=new stdClass();
$elements[3]->field="`youtube_videogallerycategory`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Name";
$elements[3]->alias="name";
$elements[4]=new stdClass();
$elements[4]->field="`youtube_videogallerycategory`.`subtitle`";
$elements[4]->sort="1";
$elements[4]->header="Sub Title";
$elements[4]->alias="subtitle";
$elements[5]=new stdClass();
$elements[5]->field="`youtube_videogallerycategory`.`url`";
$elements[5]->sort="1";
$elements[5]->header="Url";
$elements[5]->alias="url";
$elements[6]=new stdClass();
$elements[6]->field="`youtube_videogallerycategory`.`timestamp`";
$elements[6]->sort="1";
$elements[6]->header="Timestamp";
$elements[6]->alias="timestamp";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `youtube_videogallerycategory`");
$this->load->view("json",$data);
}

public function createvideogallerycategory()
{
$access=array("1");
$this->checkaccess($access);
$data[ 'activemenu' ] = 'video gallery category';
$data["page"]="createvideogallerycategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create videogallerycategory";
$this->load->view("template",$data);
}
public function createvideogallerycategorysubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("subtitle","Sub Title","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createvideogallerycategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create videogallerycategory";
$this->load->view("template",$data);
}
else
{
$status=$this->input->get_post("status");
$order=$this->input->get_post("order");
$name=$this->input->get_post("name");
$subtitle=$this->input->get_post("subtitle");
$url=$this->input->get_post("url");
$timestamp=$this->input->get_post("timestamp");
if($this->videogallerycategory_model->create($status,$order,$name,$subtitle,$url,$timestamp)==0)
$data["alerterror"]="New videogallerycategory could not be created.";
else
$data["alertsuccess"]="videogallerycategory created Successfully.";
$data["redirect"]="site/viewvideogallerycategory";
$this->load->view("redirect",$data);
}
}
public function editvideogallerycategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editvideogallerycategory";
$data["page2"]="block/videoblock";
$data[ 'activemenu' ] = 'video gallery category';
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'before1' ] =$this->input->get('id');
$data[ 'before2' ] =$this->input->get('id');
$data["title"]="Edit videogallerycategory";
$data["before"]=$this->videogallerycategory_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editvideogallerycategorysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("subtitle","Sub Title","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editvideogallerycategory";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit videogallerycategory";
$data["before"]=$this->videogallerycategory_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$status=$this->input->get_post("status");
$order=$this->input->get_post("order");
$name=$this->input->get_post("name");
$subtitle=$this->input->get_post("subtitle");
$url=$this->input->get_post("url");
$timestamp=$this->input->get_post("timestamp");
if($this->videogallerycategory_model->edit($id,$status,$order,$name,$subtitle,$url,$timestamp)==0)
$data["alerterror"]="New videogallerycategory could not be Updated.";
else
$data["alertsuccess"]="videogallerycategory Updated Successfully.";
$data["redirect"]="site/viewvideogallerycategory";
$this->load->view("redirect",$data);
}
}
public function deletevideogallerycategory()
{
$access=array("1");
$this->checkaccess($access);
$this->videogallerycategory_model->delete($this->input->get("id"));
$data["redirect"]="site/viewvideogallerycategory";
$this->load->view("redirect",$data);
}
public function viewvideogallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewvideogallery";
$data["page2"]="block/videoblock";
$data[ 'activemenu' ] = 'video gallery category';
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewvideogalleryjson?id=".$this->input->get('id'));
$data["title"]="View videogallery";
$this->load->view("templatewith2",$data);
}
function viewvideogalleryjson()
{
$id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`youtube_videogallery`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`youtube_videogallery`.`videogallerycategory`";
$elements[1]->sort="1";
$elements[1]->header="Video Gallery Category";
$elements[1]->alias="videogallerycategory";
$elements[2]=new stdClass();
$elements[2]->field="`youtube_videogallery`.`status`";
$elements[2]->sort="1";
$elements[2]->header="Status";
$elements[2]->alias="status";
$elements[3]=new stdClass();
$elements[3]->field="`youtube_videogallery`.`order`";
$elements[3]->sort="1";
$elements[3]->header="Order";
$elements[3]->alias="order";
$elements[4]=new stdClass();
$elements[4]->field="`youtube_videogallery`.`url`";
$elements[4]->sort="1";
$elements[4]->header="Url";
$elements[4]->alias="url";
$elements[5]=new stdClass();
$elements[5]->field="DATE_FORMAT(`youtube_videogallery`.`timestamp`,'%a, %b %d %Y %h:%i %p')";
$elements[5]->sort="1";
$elements[5]->header="Timestamp";
$elements[5]->alias="timestamp";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `youtube_videogallery`","WHERE `youtube_videogallery`.`videogallerycategory`=$id");
$this->load->view("json",$data);
}

public function createvideogallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page2"]="block/videoblock";
$data[ 'activemenu' ] = 'video gallery category';
$data["page"]="createvideogallery";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["videogallerycategory"]=$this->videogallerycategory_model->getvideogallerycategorydropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create videogallery";
$this->load->view("templatewith2",$data);
}
public function createvideogallerysubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("videogallerycategory","Video Gallery Category","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createvideogallery";
$data["videogallerycategory"]=$this->videogallerycategory_model->getvideogallerycategorydropdown();
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create videogallery";
$this->load->view("template",$data);
}
else
{
$videogallerycategory=$this->input->get_post("videogallerycategory");
$status=$this->input->get_post("status");
$order=$this->input->get_post("order");
$url=$this->input->get_post("url");
$timestamp=$this->input->get_post("timestamp");
if($this->videogallery_model->create($videogallerycategory,$status,$order,$url,$timestamp)==0)
$data["alerterror"]="New videogallery could not be created.";
else
$data["alertsuccess"]="videogallery created Successfully.";
$data["redirect"]="site/viewvideogallery?id=".$videogallerycategory;
$this->load->view("redirect2",$data);
}
}
public function editvideogallery()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editvideogallery";
$data["page2"]="block/videoblock";
$data[ 'activemenu' ] = 'video gallery category';
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["videogallerycategory"]=$this->videogallerycategory_model->getvideogallerycategorydropdown();
$data["title"]="Edit videogallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["before"]=$this->videogallery_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editvideogallerysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("videogallerycategory","Video Gallery Category","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("url","Url","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["videogallerycategory"]=$this->videogallerycategory_model->getvideogallerycategorydropdown();
$data["page"]="editvideogallery";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit videogallery";
$data["before"]=$this->videogallery_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$videogallerycategory=$this->input->get_post("videogallerycategory");
$status=$this->input->get_post("status");
$order=$this->input->get_post("order");
$url=$this->input->get_post("url");
$timestamp=$this->input->get_post("timestamp");
if($this->videogallery_model->edit($id,$videogallerycategory,$status,$order,$url,$timestamp)==0)
$data["alerterror"]="New videogallery could not be Updated.";
else
$data["alertsuccess"]="videogallery Updated Successfully.";
$data["redirect"]="site/viewvideogallery?id=".$videogallerycategory;
$this->load->view("redirect2",$data);
}
}
public function deletevideogallery()
{
$access=array("1");
$this->checkaccess($access);
$this->videogallery_model->delete($this->input->get("id"));
$videogallerycategory=$this->input->get("videogallerycategory");
$data["redirect"]="site/viewvideogallery?id=".$videogallerycategory;
$this->load->view("redirect2",$data);
}
public function viewnotification()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewnotification";
$data["base_url"]=site_url("site/viewnotificationjson");
$data["title"]="View notification";
$this->load->view("template",$data);
}
function viewnotificationjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`youtube_notification`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`youtube_notification`.`status`";
$elements[1]->sort="1";
$elements[1]->header="Status";
$elements[1]->alias="status";
$elements[2]=new stdClass();
$elements[2]->field="`youtube_notification`.`order`";
$elements[2]->sort="1";
$elements[2]->header="Order";
$elements[2]->alias="order";
$elements[3]=new stdClass();
$elements[3]->field="`youtube_notification`.`name`";
$elements[3]->sort="1";
$elements[3]->header="Name";
$elements[3]->alias="name";
$elements[4]=new stdClass();
$elements[4]->field="`youtube_notification`.`link`";
$elements[4]->sort="1";
$elements[4]->header="Link";
$elements[4]->alias="link";
$elements[5]=new stdClass();
$elements[5]->field="DATE_FORMAT(`youtube_notification`.`timestamp`,'%a, %b %d %Y %h:%i %p')";
$elements[5]->sort="1";
$elements[5]->header="Timestamp";
$elements[5]->alias="timestamp";
$elements[6]=new stdClass();
$elements[6]->field="`youtube_notification`.`content`";
$elements[6]->sort="1";
$elements[6]->header="Content";
$elements[6]->alias="content";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `youtube_notification`");
$this->load->view("json",$data);
}

public function createnotification()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createnotification";
$data[ 'activemenu' ] = 'notification';
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create notification";
$this->load->view("template",$data);
}
public function createnotificationsubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("link","Link","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createnotification";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Create notification";
$this->load->view("template",$data);
}
else
{
$status=$this->input->get_post("status");
$order=$this->input->get_post("order");
$name=$this->input->get_post("name");
$link=$this->input->get_post("link");
$timestamp=$this->input->get_post("timestamp");
$content=$this->input->get_post("content");
if($this->notification_model->create($status,$order,$name,$link,$timestamp,$content)==0)
$data["alerterror"]="New notification could not be created.";
else
$data["alertsuccess"]="notification created Successfully.";
$data["redirect"]="site/viewnotification";
$this->load->view("redirect",$data);
}
}
public function editnotification()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editnotification";
$data[ 'activemenu' ] = 'notification';
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit notification";
$data["before"]=$this->notification_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editnotificationsubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("link","Link","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editnotification";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data["title"]="Edit notification";
$data["before"]=$this->notification_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$status=$this->input->get_post("status");
$order=$this->input->get_post("order");
$name=$this->input->get_post("name");
$link=$this->input->get_post("link");
$timestamp=$this->input->get_post("timestamp");
$content=$this->input->get_post("content");
if($this->notification_model->edit($id,$status,$order,$name,$link,$timestamp,$content)==0)
$data["alerterror"]="New notification could not be Updated.";
else
$data["alertsuccess"]="notification Updated Successfully.";
$data["redirect"]="site/viewnotification";
$this->load->view("redirect",$data);
}
}
public function deletenotification()
{
$access=array("1");
$this->checkaccess($access);
$this->notification_model->delete($this->input->get("id"));
$data["redirect"]="site/viewnotification";
$this->load->view("redirect",$data);
}
public function viewfeedback()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewfeedback";
$data["base_url"]=site_url("site/viewfeedbackjson");
$data["title"]="View feedback";
$this->load->view("template",$data);
}
function viewfeedbackjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`youtube_feedback`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`youtube_feedback`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";
$elements[2]=new stdClass();
$elements[2]->field="`youtube_feedback`.`email`";
$elements[2]->sort="1";
$elements[2]->header="Email";
$elements[2]->alias="email";
$elements[3]=new stdClass();
$elements[3]->field="`youtube_feedback`.`timestamp`";
$elements[3]->sort="1";
$elements[3]->header="Timestamp";
$elements[3]->alias="timestamp";
$elements[4]=new stdClass();
$elements[4]->field="`youtube_feedback`.`content`";
$elements[4]->sort="1";
$elements[4]->header="Content";
$elements[4]->alias="content";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `youtube_feedback`");
$this->load->view("json",$data);
}

public function createfeedback()
{
$access=array("1");
$this->checkaccess($access);
$data[ 'activemenu' ] = 'feedback';
$data["page"]="createfeedback";
$data["title"]="Create feedback";
$this->load->view("template",$data);
}
public function createfeedbacksubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createfeedback";
$data["title"]="Create feedback";
$this->load->view("template",$data);
}
else
{
$name=$this->input->get_post("name");
$email=$this->input->get_post("email");
$timestamp=$this->input->get_post("timestamp");
$content=$this->input->get_post("content");
if($this->feedback_model->create($name,$email,$timestamp,$content)==0)
$data["alerterror"]="New feedback could not be created.";
else
$data["alertsuccess"]="feedback created Successfully.";
$data["redirect"]="site/viewfeedback";
$this->load->view("redirect",$data);
}
}
public function editfeedback()
{
$access=array("1");
$this->checkaccess($access);
$data[ 'activemenu' ] = 'feedback';
$data["page"]="editfeedback";
$data["title"]="Edit feedback";
$data["before"]=$this->feedback_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editfeedbacksubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editfeedback";
$data["title"]="Edit feedback";
$data["before"]=$this->feedback_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
$email=$this->input->get_post("email");
$timestamp=$this->input->get_post("timestamp");
$content=$this->input->get_post("content");
if($this->feedback_model->edit($id,$name,$email,$timestamp,$content)==0)
$data["alerterror"]="New feedback could not be Updated.";
else
$data["alertsuccess"]="feedback Updated Successfully.";
$data["redirect"]="site/viewfeedback";
$this->load->view("redirect",$data);
}
}
public function deletefeedback()
{
$access=array("1");
$this->checkaccess($access);
$this->feedback_model->delete($this->input->get("id"));
$data["redirect"]="site/viewfeedback";
$this->load->view("redirect",$data);
}
public function viewenquiry()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewenquiry";
$data["base_url"]=site_url("site/viewenquiryjson");
$data["title"]="View enquiry";
$this->load->view("template",$data);
}
function viewenquiryjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`youtube_enquiry`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`user`.`name`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";
$elements[2]=new stdClass();
$elements[2]->field="`youtube_enquiry`.`name`";
$elements[2]->sort="1";
$elements[2]->header="Name";
$elements[2]->alias="name";
$elements[3]=new stdClass();
$elements[3]->field="`youtube_enquiry`.`email`";
$elements[3]->sort="1";
$elements[3]->header="Email";
$elements[3]->alias="email";
$elements[4]=new stdClass();
$elements[4]->field="`youtube_enquiry`.`timestamp`";
$elements[4]->sort="1";
$elements[4]->header="Timestamp";
$elements[4]->alias="timestamp";
$elements[5]=new stdClass();
$elements[5]->field="`youtube_enquiry`.`content`";
$elements[5]->sort="1";
$elements[5]->header="Content";
$elements[5]->alias="content";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `youtube_enquiry` LEFT OUTER JOIN `user` ON `user`.`id`=`youtube_enquiry`.`user`");
$this->load->view("json",$data);
}

public function createenquiry()
{
$access=array("1");
$this->checkaccess($access);
$data[ 'activemenu' ] = 'enquiry';
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["page"]="createenquiry";
$data["title"]="Create enquiry";
$this->load->view("template",$data);
}
public function createenquirysubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createenquiry";
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Create enquiry";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
$name=$this->input->get_post("name");
$email=$this->input->get_post("email");
$timestamp=$this->input->get_post("timestamp");
$content=$this->input->get_post("content");
if($this->enquiry_model->create($user,$name,$email,$timestamp,$content)==0)
$data["alerterror"]="New enquiry could not be created.";
else
$data["alertsuccess"]="enquiry created Successfully.";
$data["redirect"]="site/viewenquiry";
$this->load->view("redirect",$data);
}
}
public function editenquiry()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editenquiry";
$data[ 'activemenu' ] = 'enquiry';
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Edit enquiry";
$data["before"]=$this->enquiry_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editenquirysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","User","trim");
$this->form_validation->set_rules("name","Name","trim");
$this->form_validation->set_rules("email","Email","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
$this->form_validation->set_rules("content","Content","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editenquiry";
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Edit enquiry";
$data["before"]=$this->enquiry_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
$name=$this->input->get_post("name");
$email=$this->input->get_post("email");
$timestamp=$this->input->get_post("timestamp");
$content=$this->input->get_post("content");
if($this->enquiry_model->edit($id,$user,$name,$email,$timestamp,$content)==0)
$data["alerterror"]="New enquiry could not be Updated.";
else
$data["alertsuccess"]="enquiry Updated Successfully.";
$data["redirect"]="site/viewenquiry";
$this->load->view("redirect",$data);
}
}
public function deleteenquiry()
{
$access=array("1");
$this->checkaccess($access);
$this->enquiry_model->delete($this->input->get("id"));
$data["redirect"]="site/viewenquiry";
$this->load->view("redirect",$data);
}


// user multiple images

public function viewuserimages()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewuserimages";
$data["page2"]="block/userblock";
$data["activemenu"]="users";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data["base_url"]=site_url("site/viewuserimagesjson?id=".$this->input->get('id'));
$data["title"]="View userimages";
$this->load->view("templatewith2",$data);
}
function viewuserimagesjson()
{
$id=$this->input->get('id');
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`userimages`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`userimages`.`user`";
$elements[1]->sort="1";
$elements[1]->header="user";
$elements[1]->alias="user";
    
$elements[2]=new stdClass();
$elements[2]->field="`userimages`.`image`";
$elements[2]->sort="1";
$elements[2]->header="Image";
$elements[2]->alias="image";
    
$elements[3]=new stdClass();
$elements[3]->field="`userimages`.`user`";
$elements[3]->sort="1";
$elements[3]->header="userid";
$elements[3]->alias="userid";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `userimages`","WHERE `userimages`.`user`=$id");
$this->load->view("json",$data);
}

public function createuserimages()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createuserimages";
$data["page2"]="block/userblock";
$data["activemenu"]="users";
$data["before1"]=$this->input->get('id');
$data["before2"]=$this->input->get('id');
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Create userimages";
$this->load->view("templatewith2",$data);
}
public function createuserimagessubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createuserimages";
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Create userimages";
$this->load->view("template",$data);
}
else
{
$user=$this->input->get_post("user");
 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
if($this->userimages_model->create($user,$image)==0)
$data["alerterror"]="New userimages could not be created.";
else
$data["alertsuccess"]="userimages created Successfully.";
$data["redirect"]="site/viewuserimages?id=".$user;
$this->load->view("redirect2",$data);
}
}
public function edituserimages()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="edituserimages";
$data["page2"]="block/userblock";
$data["activemenu"]="users";
$data["before1"]=$this->input->get('userid');
$data["before2"]=$this->input->get('userid');
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Edit userimages";
$data["before"]=$this->userimages_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function edituserimagessubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("user","user","trim");
$this->form_validation->set_rules("image","Image","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="edituserimages";
$data[ 'user' ] =$this->user_model->getuserdropdown();
$data["title"]="Edit userimages";
$data["before"]=$this->userimages_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$user=$this->input->get_post("user");
 $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->user_model->getCoverImageById($id);
               // print_r($image);
                $image=$image->image;
            }

if($this->userimages_model->edit($id,$user,$image)==0)
$data["alerterror"]="New userimages could not be Updated.";
else
$data["alertsuccess"]="userimages Updated Successfully.";
$data["redirect"]="site/viewuserimages?id=".$user;
$this->load->view("redirect2",$data);
}
}
public function deleteuserimages()
{
$access=array("1");
$this->checkaccess($access);
$this->userimages_model->delete($this->input->get("id"));
$userid=$this->input->get("userid");
$data["redirect"]="site/viewuserimages?id=".$userid;
$this->load->view("redirect2",$data);
}
}
?>
