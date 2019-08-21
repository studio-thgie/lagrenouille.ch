<?php

for($l = 1; $l <= 2; $l++){
    if(rand(1, 100) > 75){
        echo '<span class="g-shape--left"><img data-effect="parallax" src="'.get_theme_file_uri( 'assets/img/shapes/l_0'.rand(1, 2).'.svg' ).'"></span>';
    }
}

for($r = 1; $r <= 2; $r++){
    if(rand(1, 100) > 75){
        echo '<span class="g-shape--right"><img data-effect="parallax" src="'.get_theme_file_uri( 'assets/img/shapes/r_0'.rand(1,4).'.svg' ).'"></span>';
    }
}

?>