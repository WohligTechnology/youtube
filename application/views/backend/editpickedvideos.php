<div class="row">
<div class="col s12">
<h4 class="pad-left-15">Edit Picked Videos</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editpickedvideossubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("status",$status,set_value('status',$before->status));?>
<label for="Status">Status</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Url">Url</label>
<input type="text" id="Url" name="url" value='<?php echo set_value('url',$before->url);?>'>
</div>
</div>
 <div class="row">
            <div class="file-field input-field col s12 m6">
               <span class="img-center big">
                <?php if($before->image != "") { ?>
                <img src="<?php echo base_url('uploads').'/'.$before->image; ?>" > <?php } ?></span>
                <div class="btn blue darken-4">
                    <span>Image</span>
                    <input name="image" type="file" multiple>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload one or more files" value="<?php echo set_value('image',$before->image);?>">
                    <?php if($before->image == "") { } else {
                    ?>
                    <?php } ?>
                </div>
            </div>
        </div>
<div class="row">
<div class="input-field col s6">
<label for="Timestamp">Timestamp</label>
<input type="text" id="Timestamp" name="timestamp" value='<?php echo set_value('timestamp',$before->timestamp);?>'>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewpickedvideos"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
