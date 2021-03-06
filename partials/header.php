<?php

if (!isset($_SESSION)) session_start();

if(isset($_SESSION['notice'])){
    $notice = $_SESSION['notice'];
    unset($_SESSION['notice']);
}else if(isset($_SESSION['alert'])){
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
}

?>

<!DOCTYPE html>
<html lang="en" class="app">
<head>
    <meta charset="utf-8" />
    <title>Digitally Jukebox</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <script src="https://connect.soundcloud.com/sdk/sdk-3.0.0.js"></script>
    <link rel="stylesheet" href="assets/js/jPlayer/jplayer.flat.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/font.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/datepicker.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/app.css" type="text/css" />
    <script src="assets/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- App -->
    <script src="assets/js/bootstrap-datepicker.js"></script>
    <script src="assets/js/functions.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/app.plugin.js"></script>
    <script type="text/javascript" src="assets/js/jPlayer/jquery.jplayer.min.js"></script>
    <script type="text/javascript" src="assets/js/jPlayer/add-on/jplayer.playlist.min.js"></script>
    <script type="text/javascript" src="assets/js/jPlayer/demo.js"></script>
</head>
<body class="">
<section class="vbox">
    <header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
        <div class="navbar-header aside bg-info nav-xs">
            <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
                <i class="icon-list"></i>
            </a>
            <a href="index.php" class="navbar-brand text-lt">
                <i class="icon-music-tone-alt"></i>
                <img src="assets/images/logo.jpg" alt="." class="hide">
                <span class="hidden-nav-xs m-l-sm">Di Jukebox</span>
            </a>
            <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
                <i class="icon-settings"></i>
            </a>
        </div>
        <ul class="nav navbar-nav hidden-xs">
            <li>
                <a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">
                    <i class="fa fa-indent text"></i>
                    <i class="fa fa-dedent text-active"></i>
                </a>
            </li>
        </ul>
        <form class="navbar-form navbar-left input-s-lg m-t m-l-n-xs hidden-xs" role="search">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-search"></i></button>
                    </span>
                    <input type="text" class="form-control input-sm no-border rounded" placeholder="Search songs, albums...">
                </div>
            </div>
        </form>
        <div class="navbar-right ">
            <?php if(isset($_SESSION['user'])): ?>
                <ul class="nav navbar-nav m-n hidden-xs nav-user user">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">
                      <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                        <img src="assets/images/a0.png" alt="...">
                      </span>
                            <?php echo $_SESSION['user']['username'] ?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight">
                            <li>
                                <span class="arrow top"></span>
                                <a href="user.php?username=<?php echo $_SESSION['user']['username']; ?>">Profile</a>
                            </li>
                            <li><a href="user-settings.php">Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="scripts/logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            <?php else: ?>
                <ul class="nav navbar-nav m-n hidden-xs nav-user user">
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                </ul>
            <?php endif ?>
        </div>
    </header>
    <section>
        <section class="hbox stretch">
            <?php include_once 'partials/sidebar.php'; ?>
                <section id="content">

                    <?php if(isset($notice)): ?>
                        <div class="alert alert-success">
                            <?php echo $notice; ?>
                        </div>
                    <?php elseif(isset($alert)): ?>
                        <div class="alert alert-warning">
                            <?php echo $alert; ?>
                        </div>
                    <?php endif ?>