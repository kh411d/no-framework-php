<?php 
global $items;
load::c('home'); //Load controller
?>

<?php load::v('header'); //Begin HTML ?>

<h1><?php echo $items->text1;?> <?php echo $items->text2;?></h1>
<?php load::v('footer');//End HTML ?>
