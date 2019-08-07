<?php  include'header.php';


if(isset($_POST['slider_save'])){
  $image_name = $_FILES['slider_path']['name'];
  $image_tmp = $_FILES['slider_path']['tmp_name'];
  $image_size = $_FILES ['slider_path']['size'];
  $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
  $slider_path = 'images/slider/'.$image_name.'';
  $slider_db_path = 'images/slider/'.$image_name.'';
  move_uploaded_file($image_tmp,$slider_path);

  $run_general=$conn->prepare("INSERT INTO slider SET slider_name=:slider_name, slider_url=:url, slider_no=:slider_no, slider_role =:role, slider_path=:path");
  $run_general->execute(array('slider_name'=>$_POST['slider_name'],
  'url'=>$_POST['slider_url'],
  'slider_no'=>$_POST['slider_no'],
  'role'=>$_POST['slider_role'],
  'path'=>$slider_db_path));

  if($run_general){
     header("Location:new_slider.php?case=ok");
     die();
      }else{
        header("Location:new_slider.php?case=no");
        die();
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
                    <h2>New Slider Area<small>

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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="new_slider.php" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pick İmage:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="image" name="slider_path" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Slider Name:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="url" name="slider_name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Slider URL: </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="title" name="slider_url"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Slider Number:<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="description" class="form-control col-md-7 col-xs-12" type="text" name="slider_no" required="required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Slider Role:<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="slider_role">
                            <option value="1">Show</option>
                            <option value="0"">Don't Show</option>
                          </select>
                        </div>
                      </div>


                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="slider_save">Submit</button>
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