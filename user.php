<?php
session_start();
require_once 'scripts/functions.php';
require_once 'scripts/db_conx.php';

if(!empty($_GET['username'])){
  $username = $_GET['username'];
  $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
  $result = mysqli_query($conx, $query);

  if(mysqli_num_rows($result)){
    $user = mysqli_fetch_assoc($result);
    $user_id = $user['id'];

    // Favorite Tracks
    $query = "SELECT * FROM favorite_tracks WHERE user_id='$user_id'";
    $favorite_tracks = mysqli_query($conx, $query);
  }else{
    $_SESSION['alert'] = 'There is no user with this username';
    header('location: index.php');
  }
}
?>

<?php include_once 'partials/header.php'; ?>
        <?php include_once 'partials/sidebar.php'; ?>

        <section id="content">
          <section class="vbox">
            <section class="scrollable">
              <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <div class="text-center m-b m-t">
                          <a href="#" class="thumb-lg">
                            <img src="assets/images/a0.png" class="img-circle">
                          </a>
                          <div>
                            <div class="h3 m-t-xs m-b-xs"><?php echo $user['username']; ?></div>
                            <small class="text-muted"><i class="fa fa-map-marker"></i> <?php echo $user['country']; ?>, <?php echo $user['city']; ?></small>
                          </div>                
                        </div>
                        <div class="panel wrapper">
                          <div class="row text-center">
                            <div class="col-xs-6">
                              <a href="#">
                                <span class="m-b-xs h4 block">245</span>
                                <small class="text-muted">Followers</small>
                              </a>
                            </div>
                            <div class="col-xs-6">
                              <a href="#">
                                <span class="m-b-xs h4 block">55</span>
                                <small class="text-muted">Following</small>
                              </a>
                            </div>
                          </div>
                        </div>

                        <?php if(isset($_SESSION['user'])): ?>
                          <div class="btn-group btn-group-justified m-b">
                            <a class="btn btn-success btn-rounded" data-toggle="button">
                              <span class="text">
                                <i class="fa fa-eye"></i> Follow
                              </span>
                              <span class="text-active">
                                <i class="fa fa-eye"></i> Following
                              </span>
                            </a>
                            <a class="btn btn-dark btn-rounded">
                              <i class="fa fa-comment-o"></i> Chat
                            </a>
                          </div>
                        <?php endif ?>
                        <div>
                          <small class="text-uc text-xs text-muted">About me</small>
                          <p><?php echo $user['about_me']; ?></p>
                          <small class="text-uc text-xs text-muted">Info</small>
                          <p><?php echo $user['info']; ?></p>
                          <div class="line"></div>
                          <small class="text-uc text-xs text-muted">Connection</small>
                          <p class="m-t-sm">
                            <a href="<?php echo $user['facebook'] ?>" target="_blank" class="btn btn-rounded btn-twitter btn-icon"><i class="fa fa-twitter"></i></a>
                            <a href="<?php echo $user['twitter']; ?>" target="_blank" class="btn btn-rounded btn-facebook btn-icon"><i class="fa fa-facebook"></i></a>
                            <a href="<?php echo $user['googleplus']; ?>" target="_blank" class="btn btn-rounded btn-gplus btn-icon"><i class="fa fa-google-plus"></i></a>
                          </p>
                        </div>
                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light lt">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                        <li><a href="#playlists" data-toggle="tab">Playlists</a></li>
                        <li><a href="#favorite-playlists" data-toggle="tab">Favorite Playlists</a></li>
                        <li><a href="#favorite-tracks" data-toggle="tab">Favorite Tracks</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                            <li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="assets/images/a0.png" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">3 minuts ago</small>
                                <strong class="block">Drew Wllon</strong>
                                <small>Wellcome and play this web application template ... </small>
                              </a>
                            </li>
                            <li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="assets/images/a1.png" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">1 hour ago</small>
                                <strong class="block">Jonathan George</strong>
                                <small>Morbi nec nunc condimentum...</small>
                              </a>
                            </li>
                            <li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="assets/images/a2.png" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">2 hours ago</small>
                                <strong class="block">Josh Long</strong>
                                <small>Vestibulum ullamcorper sodales nisi nec...</small>
                              </a>
                            </li>
                            <li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="assets/images/a3.png" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">1 day ago</small>
                                <strong class="block">Jack Dorsty</strong>
                                <small>Morbi nec nunc condimentum...</small>
                              </a>
                            </li>
                            <li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="assets/images/a4.png" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">3 days ago</small>
                                <strong class="block">Morgen Kntooh</strong>
                                <small>Mobile first web app for startup...</small>
                              </a>
                            </li>
                            <li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="assets/images/a5.png" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">Jun 21</small>
                                <strong class="block">Yoha Omish</strong>
                                <small>Morbi nec nunc condimentum...</small>
                              </a>
                            </li>
                            <li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="assets/images/a6.png" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">May 10</small>
                                <strong class="block">Gole Lido</strong>
                                <small>Vestibulum ullamcorper sodales nisi nec...</small>
                              </a>
                            </li>
                            <li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="assets/images/a7.png" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">Jan 2</small>
                                <strong class="block">Jonthan Snow</strong>
                                <small>Morbi nec nunc condimentum...</small>
                              </a>
                            </li>
                            <li class="list-group-item" href="#email-content" data-toggle="class:show">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="assets/images/a8.png" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">3 minuts ago</small>
                                <strong class="block">Drew Wllon</strong>
                                <small>Vestibulum ullamcorper sodales nisi nec sodales nisi nec sodales nisi nec...</small>
                              </a>
                            </li>
                            <li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="assets/images/a9.png" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">1 hour ago</small>
                                <strong class="block">Jonathan George</strong>
                                <small>Morbi nec nunc condimentum...</small>
                              </a>
                            </li>
                          </ul>
                        </div>

                        <div class="tab-pane" id="playlists"></div>
                        <div class="tab-pane" id="favorite-playlists"></div>
                        <div class="tab-pane" id="favorite-tracks">
                          <?php if(mysqli_num_rows($favorite_tracks)): ?>
                            <?php while($track = mysqli_fetch_assoc($favorite_tracks)): ?>
                                <?php echo preview_track($track); ?>
                            <?php endwhile  ?>
                          <?php else:  ?>

                          <?php endif ?>
                        </div>

                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="col-lg-3 b-l">
                  <section class="vbox">
                    <section class="scrollable padder-v">
                      <div class="panel">
                        <h4 class="font-thin padder">Latest Tweets</h4>
                        <ul class="list-group">
                          <li class="list-group-item">
                              <p>Wellcome <a href="#" class="text-info">@Drew Wllon</a> and play this web application template, have fun1 </p>
                              <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                          </li>
                          <li class="list-group-item">
                              <p>Morbi nec <a href="#" class="text-info">@Jonathan George</a> nunc condimentum ipsum dolor sit amet, consectetur</p>
                              <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 hour ago</small>
                          </li>
                          <li class="list-group-item">                     
                              <p><a href="#" class="text-info">@Josh Long</a> Vestibulum ullamcorper sodales nisi nec adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis</p>
                              <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 hours ago</small>
                          </li>
                        </ul>
                      </div>
                    </section>
                  </section>              
                </aside>
              </section>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
        </section>
<?php include_once 'partials/footer.php'; ?>