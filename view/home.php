<?php extract(load::c('home',$args)->get()); //Load and extract controller results ?>

<?php load::v('header'); //Begin HTML ?>
<h1><?php echo $hello;?> </h1>
<?php load::v('footer');//End HTML ?>
