<?php  include'header.php';

if(@$_GET['delete']=='ok'){
    $delete_news = $conn->prepare("DELETE FROM news WHERE news_id=:news_id");
    $delete_news->execute(array(
    'news_id' =>$_GET['news_id']));
    if($delete_news){
        $delete_image = $_GET['delete_image'];
        unlink("$delete_image");
        header("Location:news.php?case=ok");

    }else{
        header("Location:news.php?case=no");
    }
}
if(isset($_POST['search'])){
    $vocable=$_POST['vocable'];
    $run_news=$conn->prepare("SELECT * FROM news WHERE news_name LIKE '%$vocable%' ORDER BY news_id DESC LIMIT 10");
    $run_news->execute();
    $count=$run_news->rowCount();
}else{
    $run_news=$conn->prepare("SELECT * FROM news ORDER BY news_id DESC LIMIT 10");
    $run_news->execute();
    $count=$run_news->rowCount();
}


?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
              <div class="title_right">
                  <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                      <form action="" method="post">
                      <div class="input-group">
                          <input type="text" class="form-control" name="vocable" placeholder="Search for...">
                                    <span class="input-group-btn">
                                     <button class="btn btn-default" name="search" type="submit">Go!</button>
                                    </span>
                      </div></form>
                  </div>
              </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">

                    <h2>NEWS SETTING<small><?php
                            echo $count." news founded.";
                        if(@$_GET['case']== 'ok'){?>
                            <a style="color:green;">The changes were saved.</a>

                        <?php }elseif(@$_GET['case']=='no'){ ?>
                        <a style="color:red;">The changes could not be saved.</a>

                        <?php }?></small></h2>


                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="table-responsive">
                          <table class="table table-striped jambo_table bulk_action">
                              <thead>
                              <tr class="headings">
                                  <th class="column-title tex-center"></th>
                                  <th class="column-title text-center">İmage Path </th>
                                  <th class="column-title">News Name</th>
                                  <th class="column-title">News Role</th>
                                  <th class="column-title" style="width: 80px;"></th>
                                  <th class="column-title" style="width: 80px;"></th>

                                  </th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php

                             while($row_news=$run_news->fetch(PDO::FETCH_ASSOC)){?>

                              <tr>
                                  <td class=" "><?php echo $row_news['news_time'];?></td>
                                  <td class="text-center"><img style="height:100px; width: 200px;" src="<?php echo $row_news['news_image'];?>"> </td>
                                  <td class=" "><?php echo $row_news['news_name'];?></td>
                                  <td class=" ">
                                      <?php
                                        if($row_news['news_role']== 1){
                                            echo "Show";
                                        }else{
                                            echo "Don't Show";
                                        }
                                      ?>
                                  </td>

                                  <td class=" "><a href="edit_news.php?news_id=<?php echo $row_news['news_id'];?>"><button class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-pencil fa-1x"></i> Edit</button></a></td>
                                  <td class=" "><a href="news.php?delete=ok&news_id=<?php echo $row_news['news_id'];?>&delete_image=<?php echo $row_news['news_image']?>"><button class="btn btn-danger btn-sm"><i aria-hidden="true" class="fa fa-trash-o fa-1x"></i> Delete</button></a></td>
                                  </td>
                              </tr>
                            <?php } ?>
                              </tbody>
                          </table>
                      </div>
                      <div class="col-md-12" align="right"><a href="new_news.php"><button class="btn btn-success btn-sm">Submit</button></a></div>

                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


        <?php include'footer.php';?>