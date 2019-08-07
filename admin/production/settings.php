<?php  include'header.php';
$run_setting= $conn->prepare("SELECT * FROM settings WHERE setting_id=?");
$run_setting->execute(array(0));
$row_setting=$run_setting->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['general_setting'])) {

  if($_FILES['setting_logo']["size"] > 0){

    $image_name = $_FILES['setting_logo']['name'];
    $image_tmp = $_FILES['setting_logo']['tmp_name'];
    $image_size = $_FILES ['setting_logo']['size'];
    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $setting_path = 'images/'.$image_name.'';
    $setting_db_path = 'images/'.$image_name.'';
    move_uploaded_file($image_tmp,$setting_path);


    $run_general = $conn->prepare("UPDATE settings SET setting_url=:url, setting_title=:title, setting_desc=:description, setting_key =:keywords,setting_author=:author, setting_logo=:path WHERE setting_id=0");
    $run_general->execute(array('url' => $_POST['setting_url'],
        'title' => $_POST['setting_title'],
        'description' => $_POST['setting_desc'],
        'keywords' => $_POST['setting_key'],
        'author' => $_POST['setting_author'],
        'path'=>$setting_db_path));

    if($run_general){
      $delete_image = $_POST['delete_image'];
      unlink("$delete_image");
      header("Location:settings.php?case=ok");
      die();
    }else{
      header("Location:settings.php?case=no");
      die();
    }

  } else {


    $run_general = $conn->prepare("UPDATE settings SET setting_url=:url, setting_title=:title, setting_desc=:description, setting_key =:keywords,setting_author=:author WHERE setting_id=0");
    $run_general->execute(array('url' => $_POST['setting_url'],
        'title' => $_POST['setting_title'],
        'description' => $_POST['setting_desc'],
        'keywords' => $_POST['setting_key'],
        'author' => $_POST['setting_author']));

    if ($run_general) {
      header("Location:settings.php?case=ok");
      die();
    } else {
      header("Location:settings.php?case=no");
    }
  }

}



  ?>

        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>SETTINGS PANEL</h3>
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
                    <h2>General Settings<small>

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

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="settings.php" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="delete_image" value="<?php echo $row_setting['setting_logo'];?>">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pick Logo:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php if(strlen($row_setting['setting_logo'])>0){?>
                            <img width="200px" src="<?php echo $row_setting['setting_logo'];?>">
                          <?php } else { ?>
                            <img width="200px" src="images/no_image.jpeg">
                          <?php }?>
                          <input type="file" id="image" name="setting_logo" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Website Link:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="url" name="setting_url" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row_setting['setting_url'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Title:<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="title" name="setting_title" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row_setting['setting_title'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Description:<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="description" class="form-control col-md-7 col-xs-12" type="text" name="setting_desc" value="<?php echo $row_setting['setting_desc'];?>" required="required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Keywords:<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="keywords" class="form-control col-md-7 col-xs-12" type="text" name="setting_key" value="<?php echo $row_setting['setting_key'];?>" required="required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Author:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="author" class="form-control col-md-7 col-xs-12" type="text" name="setting_author" value="<?php echo $row_setting['setting_author'];?>">
                        </div>
                      </div>

                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="general_setting">Submit</button>
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