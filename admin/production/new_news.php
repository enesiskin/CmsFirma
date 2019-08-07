<?php  include'header.php';


if(isset($_POST['news_save'])){
  $image_name = $_FILES['news_image']['name'];
  $image_tmp = $_FILES['news_image']['tmp_name'];
  $image_size = $_FILES ['news_image']['size'];
  $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
  $news_path = 'images/news/'.$image_name.'';
  $news_db_path = 'images/news/'.$image_name.'';
  move_uploaded_file($image_tmp,$news_path);

  $date=$_POST['news_date'];
  $time=$_POST['news_hour'];
  $news_time=$date." ".$time;

  $run_news=$conn->prepare("INSERT INTO news SET news_name=:news_name, news_content=:content, news_keyword=:keyword, news_role =:role, news_image=:image, news_time=:news_time");
  $run_news->execute(array('news_name'=>$_POST['news_name'],
  'content'=>$_POST['news_content'],
  'keyword'=>$_POST['news_keyword'],
  'role'=>$_POST['news_role'],
  'news_time'=>$news_time,
  'image'=>$news_db_path));

  if($run_news){
     header("Location:new_news.php?case=ok");
     die();
      }else{
        header("Location:new_news.php?case=no");
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
                    <h2>News Area<small>

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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="new_news.php" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Pick İmage:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="image" name="news_image" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">News Time:</label>
                        <div class="col-md-3">
                          <input type="date" name="news_date" class="form-control col-md-7 col-xs-12" value="<?php echo date('Y-m-d');?>">
                        </div>
                        <div class="col-md-3">
                          <input type="time" name="news_hour" class="form-control col-md-7 col-xs-12" value="<?php echo date('H:m:s');?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">News Name:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="url" name="news_name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Content:<span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <textarea name="news_content" class="ckeditor" id="editor1" ></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">News Keyword:<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="description" class="form-control col-md-7 col-xs-12" type="text" name="news_keyword" required="required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">News Role:<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="news_role">
                            <option value="1">Show</option>
                            <option value="0"">Don't Show</option>
                          </select>
                        </div>
                      </div>


                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="news_save">Submit</button>
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