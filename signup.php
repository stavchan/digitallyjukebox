<?php

session_start();

if(isset($_SESSION['errors'])){
  $errors = $_SESSION['errors'];
  unset($_SESSION['errors']);
}

?>

<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Digitally Jukebox</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/animate.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/font.css" type="text/css" />
  <link rel="stylesheet" href="assets/css/app.css" type="text/css" />
</head>
<body class="bg-info dker">
<section id="content" class="m-t-lg wrapper-md animated fadeInDown">
  <div class="container aside-xl">
    <a class="navbar-brand block" href="index.php"><span class="h1 font-bold">Digitally Jukebox</span></a>
    <section class="m-b-lg">
      <header class="wrapper text-center">
        <strong>Sign up to find interesting thing</strong>
      </header>
      <form action="scripts/signup.php" method="POST">
        <div class="form-group">
          <input type="text" placeholder="Username" name="username" class="form-control rounded input-lg text-center no-border" required>
        </div>
        <div class="form-group">
          <input type="email" placeholder="Email" name="email" class="form-control rounded input-lg text-center no-border" required>
        </div>
        <div class="form-group">
          <input type="password" placeholder="Password" name="password" class="form-control rounded input-lg text-center no-border" required>
        </div>
        <div class="checkbox i-checks m-b">
          <label class="m-l">
            <input type="checkbox" checked name="terms"><i></i> Agree the <a href="#">terms and policy</a>
          </label>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded"><i class="icon-arrow-right pull-right"></i><span class="m-r-n-lg">Sign up</span></button>
        </div>

        <?php if(isset($errors)): ?>
          <div class="alert alert-danger">
            You have current errors:
            <ul>
              <?php foreach($errors as $error): ?>
                <li><?php echo $error; ?></li>
              <?php endforeach ?>
            </ul>
          </div>
        <?php endif ?>

        <div class="line line-dashed"></div>
        <p class="text-muted text-center"><small>Already have an account?</small></p>
        <a href="login.php" class="btn btn-lg btn-info btn-block btn-rounded">Sign in</a>
      </form>
    </section>
  </div>
</section>
<!-- footer -->
<footer id="footer">
  <div class="text-center padder clearfix">
    <p>
      <small>Digitally Jukebox<br>&copy; <?php echo date('Y'); ?></small>
    </p>
  </div>
</footer>
<!-- / footer -->
<script src="assets/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="assets/js/bootstrap.js"></script>
<!-- App -->
<script src="assets/js/app.js"></script>
<script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/js/app.plugin.js"></script>
<script type="text/javascript" src="assets/js/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="assets/js/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript" src="assets/js/jPlayer/demo.js"></script>
</body>
</html>