<?php include 'header.php';
$run_news=$conn->prepare("SELECT * FROM news WHERE news_id=:news_id");
$run_news->execute(array('news_id'=>@$_GET['news_id']));
$row_news=$run_news->fetch(PDO::FETCH_ASSOC);
?>

    <div role="main" class="main">
        <div class="container">
            <div class="row pt-xl">

                <div class="col-md-9">

                    <ht1 class="mt-xl mb-none"><?php echo $row_news['news_name']; ?></ht1>
                    <div class="divider divider-primary divider-small mb-xl">
                        <hr>
                    </div>

                    <div class="row">


                                <div class="col-md-12">

									<span class="thumb-info thumb-info-side-image thumb-info-no-zoom mt-xl">
									<!-- ----hidden-xs mobilde divi gizler----	<span class="thumb-info-side-image-wrapper p-none hidden-xs">
										</span> -->

									<div class="col-md-12">
												<h2 class="mb-md mt-xs" style="text-align: center"><a title="" class="text-dark" ><?php echo $row_news['news_name']; ?></a></h2>
                                        <hr>
												<!--<span class="post-meta">
													<span>January 10, 2016 | <a href="#">John Doe</a></span>
												</span>-->
												<p class="font-size-md"><img src="admin/production/<?php echo $row_news['news_image']; ?>" class="img-responsive" alt="" style=" float:left; width: 350px; height: 200px; padding: 10px; margin-right: 10px;">
                                                    <?php echo $row_news['news_content']; ?></p>
                                                <hr>
												<p class="font-size-md"> <b>Keywords: </b>

                                                    <?php $keyword=explode(',',$row_news['news_keyword']);

                                                    foreach($keyword as $run_keyword){ ?>
                                                       <a href="search.php?search=<?php echo $run_keyword; ?>"><?php echo $run_keyword.","; ?></a>

                                                   <?php }
                                                    ?></p>

                                    </div>
									</span>

                        </div>

                    </div>
                </div>

                <!-- Sidebar -->

              <?php include'right_bar.php';?>

            </div>

        </div>
    </div>

<?php include 'footer.php'; ?>