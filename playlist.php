<?php

require_once 'scripts/db_conx.php';
require_once 'scripts/functions.php';

if(!empty($_GET['id'])){
    $playlist_id = mysqli_real_escape_string($conx, $_GET['id']);

    $query = "SELECT * FROM playlists WHERE id = '$playlist_id' LIMIT 1";
    $result = mysqli_query($conx, $query);

    if(mysqli_num_rows($result)){
        $playlist = mysqli_fetch_assoc($result);

        $query = "SELECT * FROM tracks WHERE playlist_id = '$playlist_id'";
        $tracks = mysqli_query($conx, $query);
    }else{
        header('location: '.$_SERVER["HTTP_REFERER"]);
    }
}else{
    header('location: '.$_SERVER["HTTP_REFERER"]);
}

?>


<?php include_once 'partials/header.php'; ?>
<div class="vbox">
    <section class="w-f-md">
        <section class="hbox stretch bg-black dker">
            <!-- side content -->
            <aside class="col-sm-5 no-padder" id="sidebar">
                <section class="vbox animated fadeInUp">
                    <section class="scrollable">
                        <div class="m-t-n-xxs item pos-rlt">
                            <div class="top text-right">
                        <span class="musicbar animate bg-success bg-empty inline m-r-lg m-t" style="width:25px;height:30px">
                          <span class="bar1 a3 lter"></span>
                          <span class="bar2 a5 lt"></span>
                          <span class="bar3 a1 bg"></span>
                          <span class="bar4 a4 dk"></span>
                          <span class="bar5 a2 dker"></span>
                        </span>
                            </div>
                            <div class="bottom gd bg-info wrapper-lg">
                                <span class="h2 font-thin"><?php echo $playlist['title'] ?></span>
                            </div>
                            <img class="img-full" src="assets/images/logo.jpg" alt="...">
                        </div>
                        <ul class="list-group list-group-lg no-radius no-border no-bg m-t-n-xxs m-b-none auto">

                            <?php if(mysqli_num_rows($tracks)): ?>
                                <?php while($row = mysqli_fetch_assoc($tracks)): ?>
                                    <?php $track = rest_request('/tracks/'.$row['soundcloud_track_id']); ?>

                                    <li class="list-group-item item" data-track-id="<?php echo $track->id ?>">
                                        <div class="pull-right m-l">
                                            <a href="#" class="m-r-sm"><i class="icon-cloud-download"></i></a>
                                            <?php if(isset($_SESSION['user'])): ?>
                                                <a href="#" class="m-r-sm"><i class="icon-plus"></i></a>
                                                <a href="#"><i class="icon-close"></i></a>
                                            <?php endif ?>
                                        </div>
                                        <a href="#" class="play-track m-r-sm pull-left">
                                            <i class="icon-control-play text"></i>
                                            <i class="icon-control-pause text-active"></i>
                                        </a>
                                        <div class="clear text-ellipsis">
                                            <span><?php echo $track->title ?></span>
                                            <span class="text-muted"> -- <?php echo time_format($track->duration) ?></span>
                                        </div>
                                    </li>
                                <?php endwhile ?>
                            <?php endif ?>

                        </ul>
                    </section>
                </section>
            </aside>
            <!-- / side content -->
            <section class="col-sm-4 no-padder bg">
                <section class="vbox">
                    <section class="scrollable hover">
                        <ul class="list-group list-group-lg no-bg auto m-b-none m-t-n-xxs">
                            <li class="list-group-item clearfix">
                                <a href="#" class="jp-play-me pull-right m-t-sm m-l text-md">
                                    <i class="icon-control-play text"></i>
                                    <i class="icon-control-pause text-active"></i>
                                </a>
                                <a href="#" class="pull-left thumb-sm m-r">
                                    <img src="images/m0.jpg" alt="...">
                                </a>
                                <a class="clear" href="#">
                                    <span class="block text-ellipsis">Little Town</span>
                                    <small class="text-muted">by Soph Ashe</small>
                                </a>
                            </li>
                            <li class="list-group-item clearfix">
                                <a href="#" class="jp-play-me pull-right m-t-sm m-l text-md">
                                    <i class="icon-control-play text"></i>
                                    <i class="icon-control-pause text-active"></i>
                                </a>
                                <a href="#" class="pull-left thumb-sm m-r">
                                    <img src="images/a1.png" alt="...">
                                </a>
                                <a class="clear" href="#">
                                    <span class="block text-ellipsis">Get lacinia odio sem nec elit</span>
                                    <small class="text-muted">by Filex</small>
                                </a>
                            </li>
                            <li class="list-group-item clearfix">
                                <a href="#" class="jp-play-me pull-right m-t-sm m-l text-md">
                                    <i class="icon-control-play text"></i>
                                    <i class="icon-control-pause text-active"></i>
                                </a>
                                <a href="#" class="pull-left thumb-sm m-r">
                                    <img src="images/a2.png" alt="...">
                                </a>
                                <a class="clear" href="#">
                                    <span class="block text-ellipsis">Donec sed odio du</span>
                                    <small class="text-muted">by Dan Doorack</small>
                                </a>
                            </li>
                            <li class="list-group-item clearfix">
                                <a href="#" class="jp-play-me pull-right m-t-sm m-l text-md">
                                    <i class="icon-control-play text"></i>
                                    <i class="icon-control-pause text-active"></i>
                                </a>
                                <a href="#" class="pull-left thumb-sm m-r">
                                    <img src="images/a3.png" alt="...">
                                </a>
                                <a class="clear" href="#">
                                    <span class="block text-ellipsis">Curabitur blandit tempu</span>
                                    <small class="text-muted">by Foxes</small>
                                </a>
                            </li>
                            <li class="list-group-item clearfix">
                                <a href="#" class="jp-play-me pull-right m-t-sm m-l text-md">
                                    <i class="icon-control-play text"></i>
                                    <i class="icon-control-pause text-active"></i>
                                </a>
                                <a href="#" class="pull-left thumb-sm m-r">
                                    <img src="images/a4.png" alt="...">
                                </a>
                                <a class="clear" href="#">
                                    <span class="block text-ellipsis">Urna mollis ornare vel eu leo</span>
                                    <small class="text-muted">by Chris Fox</small>
                                </a>
                            </li>
                            <li class="list-group-item clearfix">
                                <a href="#" class="jp-play-me pull-right m-t-sm m-l text-md">
                                    <i class="icon-control-play text"></i>
                                    <i class="icon-control-pause text-active"></i>
                                </a>
                                <a href="#" class="pull-left thumb-sm m-r">
                                    <img src="images/a5.png" alt="...">
                                </a>
                                <a class="clear" href="#">
                                    <span class="block text-ellipsis">Faucibus dolor auctor</span>
                                    <small class="text-muted">by Lauren Taylor</small>
                                </a>
                            </li>
                            <li class="list-group-item clearfix">
                                <a href="#" class="jp-play-me pull-right m-t-sm m-l text-md">
                                    <i class="icon-control-play text"></i>
                                    <i class="icon-control-pause text-active"></i>
                                </a>
                                <a href="#" class="pull-left thumb-sm m-r">
                                    <img src="images/a6.png" alt="...">
                                </a>
                                <a class="clear" href="#">
                                    <span class="block text-ellipsis">Praesent commodo cursus magn</span>
                                    <small class="text-muted">by Chris Fox</small>
                                </a>
                            </li>
                            <li class="list-group-item clearfix">
                                <a href="#" class="jp-play-me pull-right m-t-sm m-l text-md">
                                    <i class="icon-control-play text"></i>
                                    <i class="icon-control-pause text-active"></i>
                                </a>
                                <a href="#" class="pull-left thumb-sm m-r">
                                    <img src="images/a7.png" alt="...">
                                </a>
                                <a class="clear" href="#">
                                    <span class="block text-ellipsis">Vestibulum id</span>
                                    <small class="text-muted">by Milian</small>
                                </a>
                            </li>
                            <li class="list-group-item clearfix">
                                <a href="#" class="jp-play-me pull-right m-t-sm m-l text-md">
                                    <i class="icon-control-play text"></i>
                                    <i class="icon-control-pause text-active"></i>
                                </a>
                                <a href="#" class="pull-left thumb-sm m-r">
                                    <img src="images/a8.png" alt="...">
                                </a>
                                <a class="clear" href="#">
                                    <span class="block text-ellipsis">Blandit tempu</span>
                                    <small class="text-muted">by Amanda Conlan</small>
                                </a>
                            </li>
                            <li class="list-group-item clearfix">
                                <a href="#" class="jp-play-me pull-right m-t-sm m-l text-md">
                                    <i class="icon-control-play text"></i>
                                    <i class="icon-control-pause text-active"></i>
                                </a>
                                <a href="#" class="pull-left thumb-sm m-r">
                                    <img src="images/a9.png" alt="...">
                                </a>
                                <a class="clear" href="#">
                                    <span class="block text-ellipsis">Vestibulum ullamcorpe quis malesuada augue mco rpe</span>
                                    <small class="text-muted">by Dan Doorack</small>
                                </a>
                            </li>
                            <li class="list-group-item clearfix">
                                <a href="#" class="jp-play-me pull-right m-t-sm m-l text-md">
                                    <i class="icon-control-play text"></i>
                                    <i class="icon-control-pause text-active"></i>
                                </a>
                                <a href="#" class="pull-left thumb-sm m-r">
                                    <img src="images/a10.png" alt="...">
                                </a>
                                <a class="clear" href="#">
                                    <span class="block text-ellipsis">Natis ipsum ac feugiat</span>
                                    <small class="text-muted">by Hamburg</small>
                                </a>
                            </li>
                            <li class="list-group-item clearfix">
                                <a href="#" class="jp-play-me pull-right m-t-sm m-l text-md">
                                    <i class="icon-control-play text"></i>
                                    <i class="icon-control-pause text-active"></i>
                                </a>
                                <a href="#" class="pull-left thumb-sm m-r">
                                    <img src="images/a0.png" alt="...">
                                </a>
                                <a class="clear" href="#">
                                    <span class="block text-ellipsis">Sec condimentum au</span>
                                    <small class="text-muted">by Amanda Conlan</small>
                                </a>
                            </li>
                        </ul>
                    </section>
                </section>
            </section>
            <section class="col-sm-3 no-padder lt">
                <section class="vbox">
                    <section class="scrollable hover">
                        <div class="m-t-n-xxs">
                            <div class="item pos-rlt">
                                <a href="#" class="item-overlay active opacity wrapper-md font-xs">
                                    <span class="block h3 font-bold text-info">Find</span>
                                    <span class="text-muted">Search the music you like</span>
                                    <span class="bottom wrapper-md block">- <i class="icon-arrow-right i-lg pull-right"></i></span>
                                </a>
                                <a href="#">
                                    <img class="img-full" src="images/m40.jpg" alt="...">
                                </a>
                            </div>
                            <div class="item pos-rlt">
                                <a href="#" class="item-overlay active opacity wrapper-md font-xs text-right">
                                    <span class="block h3 font-bold text-warning text-u-c">Listen</span>
                                    <span class="text-muted">Find the peace in your heart</span>
                                    <span class="bottom wrapper-md block"><i class="icon-arrow-right i-lg pull-left"></i> -</span>
                                </a>
                                <a href="#">
                                    <img class="img-full" src="images/m41.jpg" alt="...">
                                </a>
                            </div>
                            <div class="item pos-rlt">
                                <a href="#" class="item-overlay active opacity wrapper-md font-xs">
                                    <span class="block h3 font-bold text-success text-u-c">Share</span>
                                    <span class="text-muted">Share the good songs with your loves</span>
                                    <span class="bottom wrapper-md block">- <i class="icon-arrow-right i-lg pull-right"></i></span>
                                </a>
                                <a href="#">
                                    <img class="img-full" src="images/m42.jpg" alt="...">
                                </a>
                            </div>
                            <div class="item pos-rlt">
                                <a href="#" class="item-overlay active opacity wrapper-md font-xs text-right">
                                    <span class="block h3 font-bold text-white text-u-c">2014</span>
                                    <span class="text-muted">Find, Listen &amp; Share</span>
                                    <span class="bottom wrapper-md block"><i class="icon-arrow-right i-lg pull-left"></i> -</span>
                                </a>
                                <a href="#">
                                    <img class="img-full" src="images/m44.jpg" alt="...">
                                </a>
                            </div>
                            <div class="item pos-rlt">
                                <a href="#" class="item-overlay active opacity wrapper-md font-xs">
                                    <span class="block h3 font-bold text-danger-lter text-u-c">Top10</span>
                                    <span class="text-muted">Selected songs</span>
                                    <span class="bottom wrapper-md block">- <i class="icon-arrow-right i-lg pull-right"></i></span>
                                </a>
                                <a href="#">
                                    <img class="img-full" src="images/m45.jpg" alt="...">
                                </a>
                            </div>
                        </div>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <?php include_once 'partials/player.php'; ?>
</div>

<?php include_once 'partials/footer.php'; ?>