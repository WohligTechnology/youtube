<section class="panel">
    <div class="panel-body">
        <ul id="nav-mobile">
            <li><a class="waves-effect waves-light <?php if($this->uri->segment(2)=="edituser") { echo "active"; } ?>" href="<?php echo site_url('site/edituser?id=').$before1; ?>">User Details</a></li>
            <li><a class="waves-effect waves-light <?php if($this->uri->segment(2)=="viewuserimages" || $this->uri->segment(2)=="editvideogallery" || $this->uri->segment(2)=="createuserimages" || $this->uri->segment(2)=="edituserimages" ) { echo "active"; } ?>" href="<?php echo site_url('site/viewuserimages?id=').$before2; ?>">User Images Details</a></li>
        </ul>
    </div>
</section>