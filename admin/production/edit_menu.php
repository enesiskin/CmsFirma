<?php  include'header.php';
$edit_menu = $conn->prepare("SELECT * FROM menu WHERE menu_id=:menu_id");
$edit_menu->execute(array('menu_id' =>@$_GET['menu_id']));
$row_menu= $edit_menu->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['edit_menu'])){
  $menu_id=$_POST['menu_id'];
  $run_menu=$conn->prepare("UPDATE menu SET menu_name=:menu_name, menu_detail=:detail, menu_no=:menu_no, menu_role =:role, menu_url=:url, menu_submenu=:submenu, category_id=:id WHERE menu_id=:menu_id");
  $run_menu->execute(array('menu_name'=>$_POST['menu_name'],
  'detail'=>$_POST['menu_detail'],
  'submenu'=>$_POST['menu_submenu'],
  'menu_no'=>$_POST['menu_no'],
  'url'=>$_POST['menu_url'],
  'menu_id'=>$menu_id,
  'id'=>'0',
  'role'=>$_POST['menu_role']));

  if($run_menu){
     header("Location:edit_menu.php?case=ok&menu_id=$menu_id");
     die();
      }else{
        header("Location:edit_menu.php?case=no&menu_id=$menu_id");
        die();
      }
}

?>
<head>

  <!-- Select2 -->
  <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">

</head>
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
                    <h2>Menu Area<small>

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
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="edit_menu.php" method="post">

                      <input type="hidden" name="menu_id" value="<?php echo $row_menu['menu_id'];?>">
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Select Top Menu</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_single form-control" required="required" name="menu_submenu" tabindex="-1">
                            <?php

                            // ÜST MENÜSÜ OLAN MENÜYÜ YAZIDRMA

                            ?>
                            <option value="0">Top Menu</option>
                            <?php

                            $run_menu=$conn->prepare("SELECT * FROM menu WHERE menu_submenu=:submenu");
                            $run_menu->execute(array('submenu'=> 0));
                            while($row_submenu=$run_menu->fetch(PDO::FETCH_ASSOC)){
                              ?>
                              <option value="<?php echo $row_submenu['menu_id'];?>"><?php echo $row_submenu['menu_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Menu Name:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="menu_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row_menu['menu_name'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Menu Link:</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="menu_url"  class="form-control col-md-7 col-xs-12" value="<?php echo $row_menu['menu_url'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Menu Detail:<span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                          <textarea name="menu_detail" class="ckeditor" id="editor1" ><?php echo $row_menu['menu_detail'];?></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Menu No:<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="description" class="form-control col-md-7 col-xs-12" required="required" type="text" name="menu_no" value="<?php echo $row_menu['menu_no'];?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Menu Role:<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="menu_role">
                            <?php
                            if($row_menu['menu_role']== 1){ ?>
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
                          <button type="submit" class="btn btn-success" name="edit_menu">Submit</button>
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
  <script>
    $(document).ready(function() {
      $(".select2_single").select2({
        placeholder: "Select a state",
        allowClear: true
      });
      $(".select2_group").select2({});
      $(".select2_multiple").select2({
        maximumSelectionLength: 4,
        placeholder: "With Max Selection limit 4",
        allowClear: true
      });
    });
  </script>
  <script src="../vendors/select2/dist/js/select2.full.min.js"></script>

        <?php include'footer.php';?>