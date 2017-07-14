<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php get_title(); ?></title>

  <!-- Bootstrap -->
  <link href="../../css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="../banner/banner.css">

  <link rel="stylesheet" type="text/css" href="<?php get_css(); ?>">

  <link rel="stylesheet" type="text/css" href="../footer/footer_design.css">

  <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">

</head>

<body>

  <?php require_once('banner/banner.php') ?>

  <?php echo display_content(); ?>


  <?php require_once('footer/footer.php'); ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>

</body>
</html>