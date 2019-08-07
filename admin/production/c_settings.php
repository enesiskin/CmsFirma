<?php  include'header.php';
$run_setting= $conn->prepare("SELECT * FROM settings");
$run_setting->execute(array(0));
$row_setting=$run_setting->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['communicat_setting'])){
  $run_general=$conn->prepare("UPDATE settings SET setting_phone=:phone, setting_gsm=:gsm, setting_fax=:fax, setting_mail =:mail,setting_address=:address, setting_province=:province, setting_district=:district, setting_face=:face, setting_twitter=:twit, setting_linkedin=:linke, setting_google=:google WHERE setting_id=0");
  $run_general->execute(array('district'=> $_POST['setting_district'],
  'phone'=> $_POST['setting_phone'],
  'gsm'=> $_POST['setting_gsm'],
  'fax'=> $_POST['setting_fax'],
  'mail'=> $_POST['setting_mail'],
  'address'=> $_POST['setting_address'],
  'province'=> $_POST['setting_province'],
  'face'=> $_POST['setting_face'],
  'twit'=> $_POST['setting_twitter'],
  'linke'=> $_POST['setting_linkedin'],
  'google'=> $_POST['setting_google'] ));

  if($run_general){
     header("Location:c_settings.php?case=ok");
     die();
      }else{
        header("Location:c_settings.php?case=no");
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
                    <h2>Communication Settings<small>

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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="c_settings.php" method="post">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number:<span>*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="phone" name="setting_phone" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row_setting['setting_phone'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">GSM Number:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="gsm" name="setting_gsm"  class="form-control col-md-7 col-xs-12" value="<?php echo $row_setting['setting_gsm'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fax:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="fax" class="form-control col-md-7 col-xs-12" type="text" name="setting_fax" value="<?php echo $row_setting['setting_fax'];?>" >
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">E-Mail:<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="mail" class="form-control col-md-7 col-xs-12" type="text" name="setting_mail" value="<?php echo $row_setting['setting_mail'];?>" required="required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Address:<span>*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="address" class=" form-control col-md-7 col-xs-12" type="text" name="setting_address" value="<?php echo $row_setting['setting_address'];?>" required="required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Province:<span>*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="province" class=" form-control col-md-7 col-xs-12" type="text" name="setting_province" value="<?php echo $row_setting['setting_province'];?>" required="required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">District:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="district" class=" form-control col-md-7 col-xs-12" type="text" name="setting_district" value="<?php echo $row_setting['setting_district'];?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Facebook:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="face" class=" form-control col-md-7 col-xs-12" type="text" name="setting_face" value="<?php echo $row_setting['setting_face'];?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Twitter:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="twitter" class=" form-control col-md-7 col-xs-12" type="text" name="setting_twitter" value="<?php echo $row_setting['setting_twitter'];?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Linkedin:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="linkedin" class=" form-control col-md-7 col-xs-12" type="text" name="setting_linkedin" value="<?php echo $row_setting['setting_linkedin'];?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gmail:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="gmail" class=" form-control col-md-7 col-xs-12" type="text" name="setting_google" value="<?php echo $row_setting['setting_google'];?>">
                        </div>
                      </div>

                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="communicat_setting">Submit</button>
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