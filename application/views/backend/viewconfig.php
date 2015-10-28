<div class="row">
    <div class="col s12">
        <h4 class="pad-left-15">Edit Config</h4>
    </div>
</div>
<div class="row">
    <form class='col s12' method='post' action='<?php echo site_url("site/editconfigsubmit");?>' enctype='multipart/form-data'>
        <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
        <div class="row">
            <div class="input-field col s6">
                <label for="Name">Name</label>
                <input type="text" id="Name" name="name" value='<?php echo set_value(' name ',$before->name);?>'>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
                <textarea name="about" class="materialize-textarea" length="120"><?php echo set_value( 'about',$before->about);?></textarea>
                <label>About</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col m6 s12">
        <textarea name="hobbies" class="materialize-textarea" length="120"><?php echo set_value( 'hobbies',$before->hobbies);?></textarea>
                <label>Hobbies</label>
            </div>
        </div>
        <div class="row">
            <div class="file-field input-field col s12 m6">
               <span class="img-center big">
                <?php if($before->coverimage != "") { ?>
                <img src="<?php echo base_url('uploads').'/'.$before->coverimage; ?>" > <?php } ?></span>
                <div class="btn blue darken-4">
                    <span>Cover Image</span>
                    <input name="coverimage" type="file" multiple>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('coverimage',$before->coverimage);?>">
                    <?php if($before->coverimage == "") { } else {
                    ?>
                    <?php } ?>
                </div>
            </div>
        </div>
      
        <div class="row">
            <div class="input-field col s6">
                <label for="fbusername">Facebook Username</label>
                <input type="text" id="fbusername" name="fbusername" value='<?php echo set_value(' fbusername ',$before->fbusername);?>'>
            </div>
        </div>
           <div class="row">
            <div class="input-field col s6">
                <label for="instausername">Instagram Username</label>
                <input type="text" id="instausername" name="instausername" value='<?php echo set_value(' instausername ',$before->instausername);?>'>
            </div>
        </div>
        <div class=" row">
            <div class=" input-field col s12 m6">
                <?php echo form_dropdown( "channelid",$channelid,set_value( 'channelid',$before->channelid));?>
                <label for="channelid">Channel Id</label>
            </div>
        </div>

        <div class="row">
            <div class="col s6">
                <button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
                <a href='<?php echo site_url("site/viewconfig"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
            </div>
        </div>
    </form>
</div>