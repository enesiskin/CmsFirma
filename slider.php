
<div role="main" class="main">
    <div class="slider-container rev_slider_wrapper" style="height: 650px;">
        <div id="revolutionSlider" class="slider rev_slider manual">
            <ul>

                <?php
                $run_slider=$conn->prepare("SELECT * FROM slider WHERE slider_role=1 ORDER BY slider_no ASC LIMIT 5");
                $run_slider->execute();
                while($row_slider=$run_slider->fetch(PDO::FETCH_ASSOC)){?>
                <li data-transition="fade" data-title="Advocate Team" data-thumb="admin/production/<?php echo $row_slider['slider_path'];?>">
                    <img src="admin/production/<?php echo $row_slider['slider_path'];?>"
                         alt="<?php echo $row_slider['slider_name'];?>"
                         data-bgposition="center center"
                         data-bgfit="cover"
                         data-bgrepeat="no-repeat"
                         class="rev-slidebg">
                    </li>
                <?php } ?>

            </ul>
        </div>
    </div>