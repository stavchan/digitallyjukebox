<?php
session_start();
include_once 'scripts/functions.php';

$tracks = rest_request('/tracks',[
    'original_format'=> 'mp3',
    'sharing'=> 'public',
    'streamable'=> true,
    'downloadable'=> true,
    'state'=> 'finished',
    'track_type'=> 'original'
]);
?>

<?php include_once 'partials/header.php'; ?>

    <section class="hbox stretch">
        <section>
            <section class="vbox">
                <section class="scrollable padder-lg w-f-md" id="bjax-target">
                    <a href="#" class="pull-right text-muted m-t-lg" id="refresh-btn">
                        <i class="icon-refresh i-lg inline"></i>
                    </a>
                    <h2 class="font-thin m-b">Discover <span class="musicbar animate inline m-l-sm"
                                                             style="width:20px;height:20px">
                    <span class="bar1 a1 bg-primary lter"></span>
                    <span class="bar2 a2 bg-info lt"></span>
                    <span class="bar3 a3 bg-success"></span>
                    <span class="bar4 a4 bg-warning dk"></span>
                    <span class="bar5 a5 bg-danger dker"></span>
                  </span></h2>
                    <div id="tracks-wrapper" class="row row-sm">
                    	<?php foreach($tracks as $track): ?>
                    		<?php echo preview_track($track) ?>
                		<?php endforeach; ?>
                    </div>
                </section>
                <?php include_once 'partials/player.php';?>
            </section>
        </section>
        <!-- / side content -->
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>

<?php include_once 'partials/footer.php'; ?>