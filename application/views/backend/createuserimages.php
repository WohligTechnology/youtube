<div class="row">
<div class="col s12">
<h4 class="pad-left-15">Create User Images</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createuserimagessubmit");?>' enctype= 'multipart/form-data'>
<!--
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("user",$user,set_value('user',$this->input->get('id')));?>
<label>User</label>
</div>
</div>
-->
  <div class="row">
                <div class="file-field input-field col s12 m6">
                    <div class="btn blue darken-4">
                        <span>Image</span>
                        <input name="image" type="file" multiple>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image');?>">
                    </div>
                </div>
            </div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewuserimages?id=1");?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
