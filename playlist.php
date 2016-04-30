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

        $query = "SELECT * FROM comments JOIN users ON comments.user_id=users.id WHERE playlist_id = '$playlist_id'";
        $comments = mysqli_query($conx, $query);
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
            <section id="playlist-comments" class="col-sm-4 no-padder bg">
                <section class="vbox">
                    <section class="scrollable hover">
                        <ul class="list-group list-group-lg no-bg auto m-b-none m-t-n-xxs">

                            <?php if(mysqli_num_rows($comments)): ?>
                                <?php while($comment = mysqli_fetch_assoc($comments)): ?>
                                    <li class="list-group-item clearfix">
                                        <a href="#" class="pull-left thumb-sm m-r">
                                            <img src="assets/images/m0.jpg" alt="...">
                                        </a>
                                        <a class="clear" href="#">
                                            <span class="block text-ellipsis"><?php echo $comment['comment'] ?></span>
                                            <small class="text-muted">by <?php echo $comment['username'] ?></small>
                                        </a>
                                    </li>
                                <?php endwhile ?>
                            <?php endif ?>
                        </ul>
                    </section>
                </section>
            </section>
            <section class="col-sm-3 lt">
                <section class="vbox">
                    <form id="playlist-comment">
                        <div class="form-group">
                            <textarea class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </section>
            </section>
        </section>
    </section>
    <?php include_once 'partials/player.php'; ?>
</div>

<?php include_once 'partials/footer.php'; ?>