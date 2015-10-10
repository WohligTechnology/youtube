<section class="panel">
    <div class="panel-body">
        <ul id="nav-mobile">
            <li><a class="waves-effect waves-light <?php if($this->uri->segment(2)=="editvideogallerycategory") { echo "active"; } ?>" href="<?php echo site_url('site/editvideogallerycategory?id=').$before1; ?>">Video Gallery Category Details</a></li>
            <li><a class="waves-effect waves-light <?php if($this->uri->segment(2)=="viewvideogallery" || $this->uri->segment(2)=="editvideogallery" || $this->uri->segment(2)=="createvideogallerycategory" || $this->uri->segment(2)=="createvideogallery" ) { echo "active"; } ?>" href="<?php echo site_url('site/viewvideogallery?id=').$before2; ?>">Video Gallery Details</a></li>
        </ul>
    </div>
</section>