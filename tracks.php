<?php
session_start();
include_once 'scripts/functions.php';
include_once 'scripts/db_conx.php';

$query = "SELECT soundcloud_track_id FROM tracks ORDER BY created_at DESC";
$tracks = mysqli_query($conx, $query);

?>

<?php include_once 'partials/header.php'; ?>

    <section class="hbox stretch">
        <section>
            <section class="vbox">
                <section class="scrollable padder-lg w-f-md" id="bjax-target">
                    <h2 class="font-thin m-b">Tracks <span class="musicbar animate inline m-l-sm"
                                                             style="width:20px;height:20px">
                    <span class="bar1 a1 bg-primary lter"></span>
                    <span class="bar2 a2 bg-info lt"></span>
                    <span class="bar3 a3 bg-success"></span>
                    <span class="bar4 a4 bg-warning dk"></span>
                    <span class="bar5 a5 bg-danger dker"></span>
                  </span></h2>
                    <div id="tracks-wrapper" class="row row-sm">
                        <?php if(mysqli_num_rows($tracks)): ?>
                            <?php while($track = mysqli_fetch_assoc($tracks)): ?>
                                <?php echo preview_track($track['soundcloud_track_id'], true) ?>
                            <?php endwhile ?>
                        <?php endif ?>
                    </div>
                </section>
                <?php include_once 'partials/player.php';?>
            </section>
        </section>
        <!-- / side content -->
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>

<?php include_once 'partials/footer.php'; ?>