<div class="profile clearfix">
    <div class="profile_pic">
        <img height="75px" src="<?php echo $row_users['user_icon']; ?>" alt="User Icon" class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2><?php echo $row_users['user_name']; ?></h2>

    </div>
    <div class="clearfix"></div>
</div>
<br>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3><?php
            if($row_users['user_role']=="1"){
                echo "Role: Admin";
            }
            ?></h3>
        <ul class="nav side-menu">
            <li><a href="index.php"><i class="fa fa-home"></i> Home </a></li>
            <li><a href="menu.php"><i class="fa fa-list"></i> Menu Setting </a></li>
            <li><a href="slider.php"><i class="fa fa-picture-o"></i> Slider Setting</a></li>
            <li><a href="news.php"><i class="fa fa-file-text"></i> News Setting</a></li>
            <li><a href="about_us.php"><i class="fa fa-home"></i> About Us </a></li>
            <li><a href="contact.php"><i class="fa fa-book"></i> Contact Setting </a></li>
            <li><a><i class="fa fa-cog"></i> Settings <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="settings.php">General Setting</a></li>
                    <li><a href="c_settings.php">Communication Settings</a></li>
                    <li><a href="a_settings.php">API Setting</a></li>
                    <li><a href="s_settings.php">SMTP Setting</a></li>
                </ul>
            </li>


        </ul>
    </div>
</div>