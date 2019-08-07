<?php $about_us=$conn->prepare("SELECT * FROM about_us WHERE about_id=?");
$about_us->execute(array(0));
$row_about=$about_us->fetch(PDO::FETCH_ASSOC); ?>

<div class="col-md-3 col-md-offset-0">

    <h4 class="mt-xl mb-none">Our Commitment</h4>
    <div class="divider divider-primary divider-small mb-xl">
        <hr>
    </div>

    <div class="embed-responsive embed-responsive-16by9 mb-xl">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $row_about['about_video'];?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
    </div>
    <h4 class="mt-xlg">Our Vision</h4>

    <div class="divider divider-primary divider-small mb-xl">
        <hr>
    </div>
    <blockquote class="blockquote-secondary">
        <p class="font-size-lg">"<?php echo $row_about['about_vision'];?>"</p>
        <footer>Our Vission</footer>
    </blockquote>
    <h4 class="mt-xlg">Our Mission</h4>

    <div class="divider divider-primary divider-small mb-xl">
        <hr>
    </div>
    <blockquote class="blockquote-secondary">
        <p class="font-size-lg">"<?php echo $row_about['about_mission'];?>"</p>
        <footer>Our Mission</footer>
    </blockquote>

    <h4 class="mt-xlg">Our History</h4>

    <div class="divider divider-primary divider-small mb-xl">
        <hr>
    </div>

    <ul class="list list-unstyled list-primary list-borders">
        <li class="pt-sm pb-sm"><strong class="text-color-primary font-size-xl">2016 - </strong> Moves its headquarters to a new building</li>
        <li class="pt-sm pb-sm"><strong class="text-color-primary font-size-xl">2014 - </strong> Porto creates its new brand</li>
        <li class="pt-sm pb-sm"><strong class="text-color-primary font-size-xl">2006 - </strong> Porto Office opens it doors in London</li>
        <li class="pt-sm pb-sm"><strong class="text-color-primary font-size-xl">2003 - </strong> Inauguration of the new office</li>
        <li class="pt-sm pb-sm"><strong class="text-color-primary font-size-xl">2001 - </strong> Porto goes into business</li>
    </ul>

</div>