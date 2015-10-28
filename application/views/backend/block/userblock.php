<section class="panel">
    <div class="panel-body">
        <ul id="nav-mobile">
            <li><a class="waves-effect waves-light <?php if($this->uri->segment(2)=="viewuserimages" || $this->uri->segment(2)=="createuserimages" || $this->uri->segment(2)=="edituserimages" ) { echo "active"; } ?>" href="<?php echo site_url('site/viewuserimages?id=').1; ?>">Images</a></li>
        </ul>
    </div>
</section>