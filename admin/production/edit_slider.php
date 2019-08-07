<?php  include'header.php';

$edit_slider = $conn->prepare("SELECT * FROM slider WHERE slider_id=:slider_id");
$edit_slider->execute(array('slider_id' =>@$_GET['slider_id']));
$row_slider= $edit_slider->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['slider_edit'])){

  if($_FILES['slider_path']["size"] > 0){

    $image_name = $_FILES['slider_path']['name'];
    $image_tmp = $_FILES['slider_path']['tmp_name'];
    $image_size = $_FILES ['slider_path']['size'];
    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $slider_path = 'images/slider/'.$image_name.'';
    $slider_db_path = 'images/slider/'.$image_name.'';
    move_uploaded_file($image_tmp,$slider_path);

    $run_general=$conn->prepare("UPDATE slider SET slider_name=:slider_name, slider_url=:url, slider_no=:slider_no, slider_role =:role, slider_path=:path WHERE slider_id=:slider_id");
    $run_general->execute(array('slider_name'=>$_POST['slider_name'],
        'url'=>$_POST['slider_url'],
        'slider_no'=>$_POST['slider_no'],
        'role'=>$_POST['slider_role'],
        'slider_id'=>$slider_id=$_POST['slider_id'],
        'path'=>$slider_db_path));

    if($run_general){
      $delete_image = $_POST['delete_image'];
      unlink("$delete_image");
      header("Location:edit_slider.php?case=ok&slider_id=$slider_id");
      die();
    }else{
      header("Location:edit_slider.php?case=no");
      die();
    }

  }else{


    $run_general=$conn->prepare("UPDATE slider SET slider_name=:slider_name, slider_url=:url, slider_no=:slider_no, slider_role =:role WHERE slider_id=:slider_id");
    $run_general->execute(array('slider_name'=>$_POST['slider_name'],
        'url'=>$_POST['slider_url'],
        'slider_no'=>$_POST['slider_no'],
        'role'=>$_POST['slider_role'],
        'slider_id'=>$slider_id=$_POST['slider_id']));

    if($run_general){
      header("Location:edit_slider.php?case=ok&slider_id=$slider_id");
      die();
    }else{
      header("Location:edit_slider.php?case=no");
      die();
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
                <h3>SLIDER PANEL</h3>
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
                  <div align="left" class="x_title">
                    <h2>Edit Slider Settings<small>

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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="edit_slider.php" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="slider_id" value="<?php echo $row_slider['slider_id'];?>">
                      <input type="hidden" name="delete_image" value="<?php echo $row_slider['slider_path'];?>">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pick İmage:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img width="200px" height="100px" src="<?php echo $row_slider['slider_path'];?>">
                          <input type="file" id="image" name="slider_path" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Slider Name:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="url" name="slider_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row_slider['slider_name'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Slider URL: </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="title" name="slider_url"  class="form-control col-md-7 col-xs-12" value="<?php echo $row_slider['slider_url'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Slider Number:<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="description" class="form-control col-md-7 col-xs-12" type="text" name="slider_no" required="required" value="<?php echo $row_slider['slider_no'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Slider Role:<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="slider_role">
                            <?php
                            if($row_slider['slider_role']== 1){ ?>
                              <option value="1">Show</option>
                            <option value="0"">Don't Show</option>
                            <?php }else{ ?>
                              <option value="0"">Don't Show</option>
                              <option value="1">Show</option>
                              <?php } ?>


                          </select>
                        </div>
                      </div>


                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="slider_edit">Edit Slider</button>
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