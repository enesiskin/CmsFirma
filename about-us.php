<?php include 'header.php';
$about_us=$conn->prepare("SELECT * FROM about_us WHERE about_id=?");
$about_us->execute(array(0));
$row_about=$about_us->fetch(PDO::FETCH_ASSOC);
?>

			<div role="main" class="main">
				<div class="container">
					<div class="row pt-xl">
						<div class="col-md-7">
							<h1 class="mt-xl mb-none"><?php echo $row_about['about_heading']; ?></h1>
							<div class="divider divider-primary divider-small mb-xl">
								<hr>
							</div>
							<p><?php echo $row_about['about_content'];?></p>

						</div>

					<?php include'right_bar.php';?>

					</div>
				</div>
			</div>

<?php include 'footer.php';?>