<?php  include'header.php';


if(isset($_POST['save_profile'])) {

  $user_password= md5($_POST['user_password']);
  if($_FILES['user_icon']["size"] > 0){

    $image_name = $_FILES['user_icon']['name'];
    $image_tmp = $_FILES['user_icon']['tmp_name'];
    $image_size = $_FILES ['user_icon']['size'];
    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $profile_path = 'images/users/'.$image_name.'';
    $profile_db_path = 'images/users/'.$image_name.'';
    move_uploaded_file($image_tmp,$profile_path);


    $run_users = $conn->prepare("UPDATE users SET user_name=:user_name, user_password=:user_password, user_role=:role, user_icon=:icon WHERE user_id=:id");
    $run_users->execute(array('user_name' => $_POST['user_name'],
        'user_password' => $user_password,
        'role' => $_POST['user_role'],
        'id' => $_POST['user_id'],
        'icon'=>$profile_db_path));

    if($run_users){
      $delete_image = $_POST['delete_image'];
      unlink("$delete_image");
      header("Location:profile.php?case=ok");
      die();
    }else{
      header("Location:profile.php?case=no");
      die();
    }

  } else {


    $run_users = $conn->prepare("UPDATE users SET user_name=:user_name, user_password=:user_password, user_role=:role WHERE user_id=:id");
    $run_users->execute(array('user_name' => $_POST['user_name'],
        'user_password' =>$user_password,
        'role' => $_POST['user_role'],
        'id' => $_POST['user_id']));

    if ($run_users) {
      header("Location:profile.php?case=ok");
      die();
    } else {
      header("Location:profile.php?case=no");
    }
  }

}
?>

        <!-- /top navigation -->

        <!-- page content -->
  <div class="right_col" role="main" xmlns="http://www.w3.org/1999/html">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>PROFILE PANEL</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Your Profile Settings<small>

                      <?php
                        if(@$_GET['case']== 'ok'){?>
                              <a style="color:green;">The changes were saved.</a>

                      <?php }elseif(@$_GET['case']=='no'){ ?>
                              <a style="color:red;">The changes could not be saved.</a>

                    <?php }?></small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!-- Form Start -->

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="profile.php" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="delete_image" value="<?php echo $row_users['user_icon'];?>">
                      <input type="hidden" name="user_id" value="<?php echo $row_users['user_id'];?>">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pick Your Icon:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php if(strlen($row_users['user_icon'])>0){?>
                            <img width="150px" src="<?php echo $row_users['user_icon'];?>">
                          <?php } else { ?>
                            <img width="150px" src="images/no_icon.jpg">
                          <?php }?>
                          <br>
                          <input type="file" id="image" name="user_icon" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Name & Surname:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="url" name="user_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row_users['user_name'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Username:<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="title" name="user_username" disabled="" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row_users['user_username'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Username:<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="title" name="user_password" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row_users['user_password'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">User Role:<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="description" class="form-control col-md-7 col-xs-12" type="text" name="user_role" value="<?php echo $row_users['user_role'];?>" required="required">
                        </div>
                      </div>

                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="save_profile">Submit</button>
                        </div>
                      </div>


                    </form>
<!-- Form End -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


        <?php include'footer.php';?>