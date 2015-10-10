<div class="row">
<div class="col s12">
<div class="row">
<div class="col s12 drawchintantable">
<?php $this->chintantable->createsearch(" List of Events");?>
<table class="highlight responsive-table">
<thead>
<tr>
<th data-field="id">ID</th>
<!-- <th data-field="status">Status</th> -->
<th data-field="name">Name</th>
<th data-field="venue">Venue</th>
<th data-field="image">Image</th>
<th data-field="url">Url</th>
<th data-field="action">Action</th>
<!-- <th data-field="starttime">Start Time</th>
<th data-field="timestamp">Timestamp</th>
<th data-field="content">Content</th> -->
</tr>
</thead>
<tbody>
</tbody>
</table>
</div>
</div>
<?php $this->chintantable->createpagination();?>
<div class="createbuttonplacement"><a class="btn-floating btn-large waves-effect waves-light blue darken-4 tooltipped" href="<?php echo site_url("site/createevents"); ?>"data-position="top" data-delay="50" data-tooltip="Create"><i class="material-icons">add</i></a></div>
</div>
</div>
<script>
function drawtable(resultrow) {
	 var image = "<a href='<?php echo base_url('uploads').'/'; ?>" + resultrow.image + "' class='img-center' ><img src='<?php echo base_url('uploads').'/'; ?>" + resultrow.image + "'></a>";
        if (resultrow.image == "") {
            image = "No Receipt Available";
        }

return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.name + "</td><td>" + resultrow.venue + "</td><td>" + image + "</td><td>" + resultrow.url + "</td><td><a class='btn btn-primary btn-xs waves-effect waves-light blue darken-4 z-depth-0 less-pad' href='<?php echo site_url('site/editevents?id=');?>"+resultrow.id+"'><i class='fa fa-pencil propericon'></i></a><a class='btn btn-danger btn-xs waves-effect waves-light red pad10 z-depth-0 less-pad' onclick=return confirm(\"Are you sure you want to delete?\") href='<?php echo site_url('site/deleteevents?id='); ?>"+resultrow.id+"'><i class='material-icons propericon'>delete</i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
