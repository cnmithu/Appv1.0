
<div class="well">
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="<?php echo $movieDetails->posterUrl ?>">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><?php echo $movieDetails->title ?></h4>
            <p ><b>Director:</b> <?php echo $movieDetails->director ?></p>
            <em ><b>Genres:</b> <?php echo implode(",", $movieDetails->genres) ?></em> 
            &nbsp;&nbsp; <em ><b>Runtime:</b> <?php echo $movieDetails->runtime ?></em> 
            <br>
            <p><?php echo $movieDetails->plot ?></p>
            <ul class="list-inline list-unstyled">
                <li><span><i class="glyphicon glyphicon-calendar"></i> <?php echo $movieDetails->year ?> </span></li>
                <li>|</li>
                <span><i class="glyphicon glyphicon-user"></i> <?php echo $movieDetails->actors ?></span>
                
            </ul>
        </div>
    </div>
</div>