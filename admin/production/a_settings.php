<?php  include'header.php';
$run_setting= $conn->prepare("SELECT * FROM settings");
$run_setting->execute(array(0));
$row_setting=$run_setting->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['api_setting'])){
  $run_general=$conn->prepare("UPDATE settings SET setting_recapctha=:recapctha, setting_map=:map, setting_analystic=:analystic WHERE setting_id=0");
  $run_general->execute(array('recapctha'=> $_POST['setting_recapctha'],
  'map'=> $_POST['setting_map'],
  'analystic'=> $_POST['setting_analystic'],));

  if($run_general){
     header("Location:a_settings.php?case=ok");
     die();
      }else{
        header("Location:a_settings.php?case=no");
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
                    <h2>API Settings<small>

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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="a_settings.php" method="post">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Recapctha:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="setting_recapctha" placeholder="Google Recapctha API" class="form-control col-md-7 col-xs-12" value="<?php echo $row_setting['setting_recapctha'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Google Map Setting:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="map" name="setting_map" placeholder="Google Map API" class="form-control col-md-7 col-xs-12" value="<?php echo $row_setting['setting_map'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Analystic:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="analystic" class="form-control col-md-7 col-xs-12" placeholder="Google Analystic UA ID" type="text" name="setting_analystic" value="<?php echo $row_setting['setting_analystic'];?>">
                        </div>
                      </div>

                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="api_setting">Submit</button>
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