<div class="row">
<div class="col s12">
<h4 class="pad-left-15">Create Notification</h4>
</div>
<form class='col s12' method='post' action='<?php echo site_url("site/createnotificationsubmit");?>' enctype= 'multipart/form-data'>
<div class=" row">
<div class=" input-field col s6">
<?php echo form_dropdown("status",$status,set_value('status'));?>
<label>Status</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Order">Order</label>
<input type="text" id="Order" name="order" value='<?php echo set_value('order');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Link">Link</label>
<input type="text" id="Link" name="link" value='<?php echo set_value('link');?>'>
</div>
</div>
<div class="row">
<div class="input-field col s12">
<textarea name="content" class="materialize-textarea" length="400"><?php echo set_value( 'content');?></textarea>
<label>Content</label>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<button type="submit" class="btn btn-primary waves-effect waves-light blue darken-4">Save</button>
<a href="<?php echo site_url("site/viewnotification"); ?>" class="btn btn-secondary waves-effect waves-light red">Cancel</a>
</div>
</div>
</form>
</div>
