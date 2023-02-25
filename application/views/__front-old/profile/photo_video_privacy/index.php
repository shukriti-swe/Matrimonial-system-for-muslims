<div class="row">
    <div class="col-lg-12">
     <div class="card-title" style="text-align: center; background-color: #E91E63;" xmlns="http://www.w3.org/1999/html">
    <h3 class="heading heading-6 strong-500" style="padding: 0.4em; font-size: 22px !important;">
    <b>PHOTO(S) PRIVACY</b></h3>
</div>
<form class="form-default col-12" method="post" role="form">
    <div class="row">

        <div class="col-md-7 mr-auto" style="padding-left: 16px; font-size: 12px">
            <div class="row">
                <div class="stats-entry col-md-5" style="width: 100%;">
                <label for="profile_photo" class="control-label styling" style="padding-top: 40px;">Profile Photo:</label>
                </div>
                <div class="stats-entry col-md-7" style="width: 100%; padding-top: 27px;">
            <select class="profilePhoto form-control" id="profilePhoto">
                <option value="">Select One</option>
                <option value="1">Only Me</option>
                <option value="2">All Members</option>
                <option value="3">Premium Members</option>
            </select>
                </div>
        </div>
        </div>

        <div class="col-md-7 mr-auto" style="padding-left: 16px; font-size: 12px">
            <div class="row">
            <div class="stats-entry col-md-5" style="width: 100%;">
                <label for="gallery_photo" class="control-label styling">Gallery Photo:</label>
            </div>
        <div class="stats-entry col-md-7" style="width: 100%">
            <div id="galleryPhoto"> </div>
        </div>
            </div>
        </div>

 <div class="col-md-7 mr-auto" style="padding-left: 16px; font-size: 12px">
            <div class="row">
                <div class="stats-entry col-md-5" style="width: 100%;">
                    <label for="delete_photo" class="control-label styling" style="color: black;">Delete Photo:</label>
                </div>
                <div class="stats-entry col-md-7" style="width: 100%">
                    <select class="deletePhoto form-control" id="deletePhoto">
                        <option value="">Select One</option>
                        <option value="1">Profile Picture</option>
                        <option value="2">Gallery Picture(s)</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col"></div>
    <div class="col" style="margin-left: 70%; margin-bottom: 3%;">
        <button type="button" class="btn btn-sm btn-base-1 btn-shadow mt-2" id="btn_pass" style="width: 15%;
    font-size: 14px;
    margin: 10px;"><?php echo translate('save')?></button>
    </div>
</form>
    </div>

<div class="col-lg-12">
<div class="card-title" style="text-align: center; background-color: #E91E63;" xmlns="http://www.w3.org/1999/html">
    <h3 class="heading heading-6 strong-500" style="padding: 0.3em; font-size: 22px !important;">
        <b>VIDEO PRIVACY</b></h3>
</div>
<form class="form-default col-12" method="post" role="form">
    <div class="row">

        <div class="col-md-7 mr-auto" style="padding-left: 16px; font-size: 12px">
            <div class="row">
                <div class="stats-entry col-md-5" style="width: 100%;">
                    <label for="profile_video" class="control-label styling" style="padding-top: 40px;">Profile Video:</label>
                </div>
                <div class="stats-entry col-md-7" style="width: 100%; padding-top: 27px;">
                    <select class="profileVideo form-control" id="profileVideo">
                        <option value="">Select One</option>
                        <option value="1">Only Me</option>
                        <option value="2">All Members</option>
                        <option value="3">Premium Members</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-7 mr-auto" style="padding-left: 16px; font-size: 12px">
            <div class="row">
                <div class="stats-entry col-md-5" style="width: 100%;">
                    <label for="gallery_video" class="control-label styling">Gallery Video:</label>
                </div>
                <div class="stats-entry col-md-7" style="width: 100%">
                    <div id="galleryVideo"> </div>
                </div>
            </div>
        </div>

        <div class="col-md-7 mr-auto" style="padding-left: 16px; font-size: 12px">
            <div class="row">
                <div class="stats-entry col-md-5" style="width: 100%;">
                    <label for="delete_video" class="control-label styling" style="color: black;">Delete Video:</label>
                </div>
                <div class="stats-entry col-md-7" style="width: 100%">
                    <select class="deleteVideo form-control" id="deleteVideo">
                        <option value="">Select One</option>
                        <option value="1">Profile Video</option>
                        <option value="2">Gallery Video</option>
                    </select>
                </div>
            </div>
        </div>
<br />
        <div class="col"></div>
        <div class="col" style="margin-left: 70%; margin-bottom: 3%;">
            <button type="button" class="btn btn-sm btn-base-1 btn-shadow mt-2" id="btn_pass" style="width: 50%;
    font-size: 14px;
    margin: 10px;"><?php echo translate('save')?></button>
        </div>
    </div>
</form>

<style>
    .styling{
        color: black;
        text-align: center;
        font-size: 16px;
        padding: 15px;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        padding: 12px 16px;
        z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>

<script>
    $( ".profilePhoto" ).clone().appendTo( "#galleryPhoto" );
    $( ".editPhoto" ).clone().appendTo( "#deletePhoto" );

    $( ".profileVideo" ).clone().appendTo( "#galleryVideo" );
    $( ".editVideo" ).clone().appendTo( "#deleteVideo" );
</script>