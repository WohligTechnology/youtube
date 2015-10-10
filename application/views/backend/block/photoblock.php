<section class="panel">
    <div class="panel-body">
        <ul id="nav-mobile">
            <li><a class="waves-effect waves-light <?php if($this->uri->segment(2)=="editphotogallerycategory") { echo "active"; } ?>" href="<?php echo site_url('site/editphotogallerycategory?id=').$before1; ?>">Photo Gallery Category Details</a></li>
            <li><a class="waves-effect waves-light <?php if($this->uri->segment(2)=="viewvphotogallery" || $this->uri->segment(2)=="editphotogallery" || $this->uri->segment(2)=="createphotogallerycategory" ) { echo "active"; } ?>" href="<?php echo site_url('site/viewphotogallery?id=').$before2; ?>">Photo Gallery Details</a></li>
        </ul>
    </div>
</section>