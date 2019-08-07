<?php  include'header.php';
$run_about= $conn->prepare("SELECT * FROM about_us WHERE about_id=?");
$run_about->execute(array(0));
$row_about=$run_about->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['about_setting'])){
  $run_general=$conn->prepare("UPDATE about_us SET about_heading=:heading, about_content=:content, about_video=:video, about_vision =:vision,about_mission=:mission WHERE about_id=0");
  $run_general->execute(array('heading'=>$_POST['about_heading'],
      'content'=>$_POST['about_content'],
      'video'=>$_POST['about_video'],
      'vision'=>$_POST['about_vision'],
      'mission'=>$_POST['about_mission']));

  if($run_general){
    header("Location:about_us.php?case=ok");
    die();
  }else{
    header("Location:about_us.php?case=no");
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
                    <h2>About Us Settings<small>

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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="about_us.php" method="post">

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Heading:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="about_heading" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row_about['about_heading'];?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Content:<span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                         <textarea name="about_content" class="ckeditor" id="editor1" ><?php echo $row_about['about_content']?></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Video:<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control col-md-7 col-xs-12" type="text" name="about_video" value="<?php echo $row_about['about_video'];?>" required="required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Vision:<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control col-md-7 col-xs-12" type="text" name="about_vision" value="<?php echo $row_about['about_vision'];?>" required="required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Mission:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control col-md-7 col-xs-12" type="text" name="about_mission" value="<?php echo $row_about['about_mission'];?>">
                        </div>
                      </div>

                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="about_setting">Submit</button>
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