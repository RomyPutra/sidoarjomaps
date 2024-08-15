<style type="text/css">
    /* Cubic Bezier Transition */
    /***
    New Profile Page
    ***/
    .profile-sidebar {
      float: left;
      width: 300px;
      margin-right: 20px; }

    .profile-content {
      overflow: hidden; }

    /* PROFILE SIDEBAR */
    .profile-sidebar-portlet {
      padding: 30px 0 0 0 !important; }

    .profile-userpic img {
      float: none;
      margin: 0 auto;
      width: 50%;
      height: 50%;
      -webkit-border-radius: 50% !important;
      -moz-border-radius: 50% !important;
      border-radius: 50% !important; }

    .profile-usertitle {
      text-align: center;
      margin-top: 20px; }

    .profile-usertitle-name {
      color: #5a7391;
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 7px; }

    .profile-usertitle-job {
      text-transform: uppercase;
      color: #5b9bd1;
      font-size: 13px;
      font-weight: 800;
      margin-bottom: 7px; }

    .profile-userbuttons {
      text-align: center;
      margin-top: 10px; }

    .profile-userbuttons .btn {
      margin-right: 5px; }
      .profile-userbuttons .btn:last-child {
        margin-right: 0; }

    .profile-userbuttons button {
      text-transform: uppercase;
      font-size: 11px;
      font-weight: 600;
      padding: 6px 15px; }

    .profile-usermenu {
      margin-top: 30px;
      padding-bottom: 20px; }

    .profile-usermenu ul li {
      border-bottom: 1px solid #f0f4f7; }

    .profile-usermenu ul li:last-child {
      border-bottom: none; }

    .profile-usermenu ul li a {
      color: #93a3b5;
      font-size: 16px;
      font-weight: 400; }

    .profile-usermenu ul li a i {
      margin-right: 8px;
      font-size: 16px; }

    .profile-usermenu ul li a:hover {
      background-color: #fafcfd;
      color: #5b9bd1; }

    .profile-usermenu ul li.active a {
      color: #5b9bd1;
      background-color: #f6f9fb;
      border-left: 2px solid #5b9bd1;
      margin-left: -2px; }

    .profile-stat {
      padding-bottom: 20px;
      border-bottom: 1px solid #f0f4f7; }

    .profile-stat-title {
      color: #7f90a4;
      font-size: 25px;
      text-align: center; }

    .profile-stat-text {
      color: #5b9bd1;
      font-size: 11px;
      font-weight: 800;
      text-align: center; }

    .profile-desc-title {
      color: #7f90a4;
      font-size: 17px;
      font-weight: 600; }

    .profile-desc-text {
      color: #7e8c9e;
      font-size: 14px; }

    .profile-desc-link i {
      width: 22px;
      font-size: 19px;
      color: #abb6c4;
      margin-right: 5px; }

    .profile-desc-link a {
      font-size: 14px;
      font-weight: 600;
      color: #5b9bd1; }

    /* END PROFILE SIDEBAR */
    /* RESPONSIVE MODE */
    @media (max-width: 991px) {
      /* 991px */
      /* 991px */
      .profile-sidebar {
        float: none;
        width: 100% !important;
        margin: 0; }
      .profile-sidebar > .portlet {
        margin-bottom: 20px; }
      .profile-content {
        overflow: visible; } }
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0 text-dark">User Profile</h1> -->
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            User Profile
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-sidebar-portlet ">
                                        <!-- SIDEBAR USERPIC -->
                                        <img style="border: 2px solid;border-radius: 25px;width: 250px;height: 250px;" src="<?= $profil->picture !== null ? base_url('uploads/profile/').$profil->picture : base_url('uploads/profile/no-image.png')?>" class="img-responsive" alt=""> 
                                        <!-- END SIDEBAR USERPIC -->
                                        <!-- SIDEBAR USER TITLE -->
                                        <div class="profile-usertitle">
                                            <div class="profile-usertitle-name"> <?php echo $profil->username?> </div>
                                            <div class="profile-usertitle-job"> <?php echo $profil->level?> </div>
                                        </div>
                                        <!-- END MENU -->
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="portlet-title tabbable-line">
                                        <ul class="nav nav-pills">
                                          <li class="nav-item"><a class="tabs nav-link active" href="#datapersonal" data-source="personal" data-toggle="tab">Personal Info</a></li>
                                          <li class="nav-item"><a class="tabs nav-link" href="#dataavatar" data-source="avatar" data-toggle="tab">Change Avatar</a></li>
                                          <li class="nav-item"><a class="tabs nav-link" href="#datapassword" data-source="password" data-toggle="tab">Change Password</a></li>
                                          <li class="nav-item"><a class="tabs nav-link" href="#datasign" data-source="signature" data-toggle="tab">Signature</a></li>
                                        </ul>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="datapersonal">
                                                <!-- PERSONAL INFO TAB -->
                                                <form action="<?php echo base_url('changename');?>" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" id="csrf_faukes" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
                                                    <div class="form-group">
                                                        <label class="control-label">User Name Login</label>
                                                        <input type="text" value="<?php echo $profil == null ? old('user_name') : $profil->username; ?>" class="form-control" name="user_name" readonly/> 
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Profile Name</label>
                                                        <input type="text" value="<?php echo $profil == null ? old('profile_name') : $profil->name; ?>" name="profile_name" class="form-control" /> 
                                                    </div>
                                                  
                                                    <div class="form_action">
                                                        <div class="margiv-top-10">
                                                            <button type="submit" class="btn green"> Save Changes </button>
                                                            <button type="cancel" class="btn default"> Cancel </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="dataavatar">
                                                <form action="<?php echo base_url('changepic');?>" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" id="csrf_faukes" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
                                                    <div class="form-group">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                              <?php if ($profil->picture == null) { ?>
                                                                <img src="<?php echo base_url('uploads');?>/no-image.png" alt="" /> </div>
                                                              <?php } else { ?>
                                                                <img src="<?php echo base_url('uploads').'/profile/'.$profil->picture;?>" alt="" /> </div>
                                                              <?php } ?>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
                                                            </div>
                                                            <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> Select image </span>
                                                                    <span class="fileinput-exists"> Change </span>
                                                                    <input type="file" name="filefoto" accept=".jpg,.jpeg,.png"> </span>
                                                                <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="margin-top-10">
                                                        <button type="submit" class="btn green" > Submit </button>
                                                        <button type="cancel" class="btn default"> Cancel </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="datapassword">
                                                <form action="<?php echo base_url('changepass');?>" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" id="csrf_faukes" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
                                                    <div class="form-group">
                                                        <label class="control-label">New Password</label>
                                                        <input type="password" name="pass" id="pass" matches="conf_pass" value="<?=old('pass')?>" class="form-control" /> 
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Re-type New Password</label>
                                                        <input type="password" name="conf_pass" required-matches="pass" id="conf_pass" class="form-control" onkeyup="checkPass(); return false;" /> 
                                                    </div>
                                                    <div class="form_action">
                                                        <div class="margin-top-10">
                                                            <button type="submit" class="btn green" id="btn" onkeyup="checkPass(); return false; "> Change Password </button>
                                                            <button type="cancel" class="btn default"> Cancel </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="datasign">
                                                <form action="<?php echo base_url('changesign');?>" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" id="csrf_faukes" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
                                                    <div class="form-group">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                              <?php if ($profil->signature == null) { ?>
                                                                <img src="<?php echo base_url('uploads');?>/no-image.png" alt="" /> </div>
                                                              <?php } else { ?>
                                                                <img src="<?php echo base_url('uploads').'/signature/'.$profil->signature;?>" alt="" /> </div>
                                                              <?php } ?>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
                                                            </div>
                                                            <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> Select image </span>
                                                                    <span class="fileinput-exists"> Change </span>
                                                                    <input type="file" name="filesign" accept=".jpg,.jpeg,.png"> </span>
                                                                <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="margin-top-10">
                                                        <button type="submit" class="btn green" > Submit </button>
                                                        <button type="cancel" class="btn default"> Cancel </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>                              
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
