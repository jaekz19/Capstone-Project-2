<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php get_title(); ?></title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="index/login_design.css">

  <link rel="stylesheet" type="text/css" href="partials/footer/footer_design.css">

  <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">

</head>

<body>

  <!-- <audio autoplay="autoplay" loop="loop">
    <source src="final.mp3" type="audio/mpeg">
  </audio> -->

  <?php echo display_banner(); ?>
  <?php echo display_content(); ?>
  <?php require_once('partials/footer/footer.php'); ?>
    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

</body>
</html>