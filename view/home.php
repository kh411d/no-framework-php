<?php load::c('home'); //Load controller ?>
<?php load::v('header'); //Begin HTML ?>
<h1><?php echo load::c('home')->items['hello'];?> </h1>
<?php load::v('footer');//End HTML ?>
