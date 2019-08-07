<?php  include'header.php';

if(@$_GET['delete']=='ok'){
    $delete_menu = $conn->prepare("DELETE FROM menu WHERE menu_id=:menu_id");
    $delete_menu->execute(array(
    'menu_id' =>$_GET['menu_id']));
    if($delete_menu){
        header("Location:menu.php?case=ok");

    }else{
        header("Location:menu.php?case=no");
    }
}
if(isset($_POST['search'])){
    $vocable=$_POST['vocable'];
    $run_menu=$conn->prepare("SELECT * FROM menu WHERE menu_name LIKE '%$vocable%' ORDER BY menu_id DESC LIMIT 10");
    $run_menu->execute();
    $count=$run_menu->rowCount();
}else{
    $run_menu=$conn->prepare("SELECT * FROM menu WHERE menu_submenu=:submenu ORDER BY menu_no ASC LIMIT 20");
    $run_menu->execute(array('submenu'=> '0'));
    $count=$run_menu->rowCount();
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

                    <h2>MENU SETTING<small><?php
                            echo $count." menu founded.";
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
                                  <th class="column-title tex-center">Menu No</th>
                                  <th class="column-title">Menu Name</th>
                                  <th class="column-title">Menu Role</th>
                                  <th class="column-title">Menu State</th>
                                  <th class="column-title" style="width: 80px;"></th>
                                  <th class="column-title" style="width: 80px;"></th>

                                  </th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php

                             while($row_menu=$run_menu->fetch(PDO::FETCH_ASSOC)){
                                 $menu_id=$row_menu['menu_id'];
                                 ?>

                              <tr>
                                  <td class=" "><?php echo $row_menu['menu_no'];?></td>
                                  <td class=" "><?php echo $row_menu['menu_name'];?></td>
                                  <td class=" ">
                                      <?php
                                        if($row_menu['menu_role']== 1){
                                            echo "Show";
                                        }else{
                                            echo "Don't Show";
                                        }
                                      ?>
                                  </td>
                                  <td class=" "><?php echo $row_menu['menu_submenu'];?>
                                  </td>

                                  <td class=" "><a href="edit_menu.php?menu_id=<?php echo $row_menu['menu_id'];?>"><button class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-pencil fa-1x"></i> Edit</button></a></td>
                                  <td class=" "><a href="menu.php?delete=ok&menu_id=<?php echo $row_menu['menu_id'];?>"><button class="btn btn-danger btn-sm"><i aria-hidden="true" class="fa fa-trash-o fa-1x"></i> Delete</button></a></td>
                                  </td>
                              </tr>
                                 <!-- FIRST WHİLE -->

                            <?php $run_submenu=$conn->prepare("SELECT * FROM menu WHERE menu_submenu=:menu_id ORDER BY menu_no ASC");
                                 $run_submenu->execute(array('menu_id'=>$menu_id));

                                 while($row_submenu=$run_submenu->fetch(PDO::FETCH_ASSOC)){ ?>
                                     <tr>
                                         <td class=" ">&nbsp;&nbsp;&nbsp;- <?php echo $row_submenu['menu_no'];?></td>
                                         <td class=" "><?php echo $row_submenu['menu_name'];?></td>
                                         <td class=" ">
                                             <?php
                                             if($row_submenu['menu_role']== 1){
                                                 echo "Show";
                                             }else{
                                                 echo "Don't Show";
                                             }
                                             ?>
                                         </td>
                                         <td class=" "><?php echo $row_submenu['menu_submenu'];?></td>

                                         <td class=" "><a href="edit_menu.php?menu_id=<?php echo $row_submenu['menu_id'];?>"><button class="btn btn-warning btn-sm"><i aria-hidden="true" class="fa fa-pencil fa-1x"></i> Edit</button></a></td>
                                         <td class=" "><a href="menu.php?delete=ok&menu_id=<?php echo $row_submenu['menu_id'];?>"><button class="btn btn-danger btn-sm"><i aria-hidden="true" class="fa fa-trash-o fa-1x"></i> Delete</button></a></td>
                                         </td>
                                     </tr>
                                     <?php } }?>
                              </tbody>
                          </table>
                      </div>
                      <div class="col-md-12" align="right"><a href="new_menu.php"><button class="btn btn-success btn-sm">Submit</button></a></div>

                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->


        <?php include'footer.php';?>