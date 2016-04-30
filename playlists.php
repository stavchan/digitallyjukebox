<?php

session_start();
require_once 'scripts/db_conx.php';

$query = "SELECT playlists.id, playlists.title, users.username FROM playlists JOIN users ON playlists.user_id = users.id ORDER BY playlists.created_at DESC";
$result = mysqli_query($conx, $query);

?>

<?php include_once 'partials/header.php'; ?>

<section class="vbox">
    <section class="scrollable padder-lg">
        <h2 class="font-thin m-b">Playlists by Users</h2>
        <div class="row row-sm">

            <?php if(mysqli_num_rows($result)): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                        <div class="item">
                            <div class="pos-rlt">
                                <div class="item-overlay opacity r r-2x bg-black">
                                    <div class="center text-center m-t-n">
                                        <a href="playlist.php?id=<?php echo $row['id'] ?>"><i class="fa fa-play-circle i-2x"></i></a>
                                    </div>
                                </div>
                                <a href="playlist.php?id=<?php echo $row['id'] ?>"><img src="assets/images/logo.jpg" alt="" class="r r-2x img-full"></a>
                            </div>
                            <div class="padder-v">
                                <a href="playlist.php?id=<?php echo $row['id'] ?>" data-bjax="" data-target="#bjax-target" data-el="#bjax-el" data-replace="true" class="text-ellipsis"><?php echo $row['title'] ?></a>
                                <a href="user.php?username=<?php echo $row['username'] ?>" data-bjax="" data-target="#bjax-target" data-el="#bjax-el" data-replace="true" class="text-ellipsis text-xs text-muted"><?php echo $row['username'] ?></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile ?>
            <?php endif ?>

        </div>

    </section>
    <?php include_once 'partials/player.php';?>
</section>

<?php include_once 'partials/footer.php'; ?>