<div class="row">
<div class="col s12">
<h4 class="pad-left-15">Edit Events</h4>
</div>
</div>
<div class="row">
<form class='col s12' method='post' action='<?php echo site_url("site/editeventssubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class=" row">
<div class=" input-field col s12 m6">
<?php echo form_dropdown("status",$status,set_value('status',$before->status));?>
<label for="Status">Status</label>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Name">Name</label>
<input type="text" id="Name" name="name" value='<?php echo set_value('name',$before->name);?>'>
</div>
</div>
<div class="row">
<div class="input-field col s6">
<label for="Venue">Venue</label>
<input type="text" id="Venue" name="venue" value='<?php echo set_value('venue',$before->venue);?>'>
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
<label for="Url">Url</label>
<input type="text" id="Url" name="url" value='<?php echo set_value('url',$before->url);?>'>
</div>
</div>
   <div class="row">
                <div class="input-field col s12 m8">
                     <input type="date" class="datepicker" name="startdate" value="<?php echo set_value('startdate', $before->startdate);?>">
                <label >Start Date</label>
                </div>
            </div>
                   <div class="row">
                <div class="input-field col s6 m4">
               <span class="combodate"><select class="hour " style="width: auto;"><option value=" <?php echo $exp[0]; ?>" selected="selected"><?php echo $exp[0];?></option><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option></select>
                   <label>Hour</label></span>
                   </div>
               <div class="input-field col s6 m4">
               <span class="combodate"><select class="minute " style="width: auto;"><option value=" <?php echo $exp[1]; ?>" selected="selected"><?php echo $exp[1];?><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select><label>Minute</label></span></div> </div>
           <div class="row" style="display:none">
            <div class="input-field col s12 m8">
                <label for="starttime">Starttime</label>
                <input type="text" id="starttime" name="starttime" value="<?php echo set_value('starttime', $before->starttime);?>">
            </div>
        </div>
<div class="row">
<div class="input-field col s6">
<label for="Timestamp">Timestamp</label>
<input type="text" id="Timestamp" name="timestamp" value='<?php echo set_value('timestamp',$before->timestamp);?>'>
</div>
</div>
<div class="row">
<div class="col s12 m6">
<label>Content</label>
<textarea name="content" placeholder="Enter text ..."><?php echo set_value( 'content',$before->content);?></textarea>
</div>
</div>
<div class="row">
<div class="col s6">
<button type="submit" class="btn btn-primary waves-effect waves-light  blue darken-4">Save</button>
<a href='<?php echo site_url("site/viewevents"); ?>' class='btn btn-secondary waves-effect waves-light red'>Cancel</a>
</div>
</div>
</form>
</div>
