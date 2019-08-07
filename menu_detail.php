<?php include 'header.php';
$run_menu=$conn->prepare("SELECT * FROM menu WHERE menu_id=:menu_id");
$run_menu->execute(array('menu_id'=>@$_GET['menu_id']));
$row_menu=$run_menu->fetch(PDO::FETCH_ASSOC);
?>

    <div role="main" class="main">
        <div class="container">
            <div class="row pt-xl">

                <div class="col-md-9">

                    <h1 class="mt-xl mb-none"><?php echo $row_menu['menu_name']; ?></h1>
                    <div class="divider divider-primary divider-small mb-xl">
                        <hr>
                    </div>

                    <div class="row">


                                <div class="col-md-12">

									<span class="thumb-info thumb-info-side-image thumb-info-no-zoom mt-xl">
										<span class="thumb-info-side-image-wrapper p-none hidden-xs">


										</span>
										<span class="thumb-info-caption">
											<span class="thumb-info-caption-text">
												<h2 class="mb-md mt-xs"><a title="" class="text-dark" href="demo-law-firm-menu-detail.html"><?php echo $row_menu['menu_name']; ?></a></h2>
												<!--<span class="post-meta">
													<span>January 10, 2016 | <a href="#">John Doe</a></span>
												</span>-->
												<p class="font-size-md"><?php echo $row_menu['menu_detail']; ?></p>

											</span>
										</span>
									</span>

                        </div>

                    </div>
                </div>

                <!-- Sidebar -->
              <?php include 'right_bar.php';?>
            </div>

        </div>
    </div>

<?php include 'footer.php'; ?>