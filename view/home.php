<?php extract(load::c('home')->getVars()); //Load and extract controller variables ?>

<?php load::v('header'); //Begin HTML ?>
<h1><?php echo $hello;?> </h1>
<?php load::v('footer');//End HTML ?>
