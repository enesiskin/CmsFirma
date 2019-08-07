<?php  include'header.php';

$run_news=$conn->prepare("SELECT * FROM news WHERE news_id=:news_id");
$run_news->execute(array('news_id'=>@$_GET['news_id']));
$row_news=$run_news->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['edit_news'])){

  if($_FILES['news_image']["size"] > 0){

    $image_name = $_FILES['news_image']['name'];
    $image_tmp = $_FILES['news_image']['tmp_name'];
    $image_size = $_FILES ['news_image']['size'];
    $image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
    $news_path = 'images/news/'.$image_name.'';
    $news_db_path = 'images/news/'.$image_name.'';
    move_uploaded_file($image_tmp,$news_path);

    $run_general=$conn->prepare("UPDATE news SET news_name=:news_name,  news_content=:content,  news_keyword=:keyword,  news_role =:role,  news_image=:path WHERE news_id=:news_id");
    $run_general->execute(array('news_name'=>$_POST['news_name'],
        'keyword'=>$_POST['news_keyword'],
        'content'=>$_POST['news_content'],
        'role'=>$_POST['news_role'],
        'news_id'=>$news_id=$_POST['news_id'],
        'path'=>$news_db_path));

    if($run_general){
      $delete_image = $_POST['delete_image'];
      unlink("$delete_image");
      header("Location:edit_news.php?case=ok&news_id=$news_id");
      die();
    }else{
      header("Location:edit_news.php?case=no");
      die();
    }

  }else{
    $run_general=$conn->prepare("UPDATE news SET news_name=:news_name,  news_content=:content,  news_keyword=:keyword,  news_role =:role WHERE news_id=:news_id");
    $run_general->execute(array('news_name'=>$_POST['news_name'],
        'keyword'=>$_POST['news_keyword'],
        'content'=>$_POST['news_content'],
        'role'=>$_POST['news_role'],
        'news_id'=>$news_id=$_POST['news_id']));

    if($run_general){
      header("Location:edit_news.php?case=ok&news_id=$news_id");
      die();
    }else{
      header("Location:edit_news.php?case=no");
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
                <h3>NEWS PANEL</h3>
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
                    <h2>Edit News Settings<small>

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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="edit_news.php" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="news_id" value="<?php echo $row_news['news_id'];?>">
                      <input type="hidden" name="delete_image" value="<?php echo $row_news['news_image'];?>">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pick İmage:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img width="200px" height="100px" src="<?php echo $row_news['news_image'];?>">
                          <input type="file" id="image" name="news_image" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">News Name:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="url" name="news_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row_news['news_name'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Content:<span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <textarea name="news_content" class="ckeditor" id="editor1" ><?php echo $row_news['news_content']?> </textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">News Keyword: </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="title" name="news_keyword"  class="form-control col-md-7 col-xs-12" value="<?php echo $row_news['news_keyword'];?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">News Role:<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="news_role">
                            <?php
                            if($row_news['news_role']== 1){ ?>
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
                          <button type="submit" class="btn btn-success" name="edit_news">Edit</button>
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