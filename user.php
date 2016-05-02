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
    $guest = $_SESSION['user']['id'];

    // COUNT follows
    $query = "SELECT COUNT(CASE WHEN follower='$user_id' THEN 1 ELSE NULL END) as following, COUNT(CASE WHEN following='$user_id' THEN 1 ELSE NULL END) as followers FROM followers";
    $follows = mysqli_fetch_assoc(mysqli_query($conx, $query));

    // GET following users
    $query = "SELECT users.username, users.username, users.country, users.city FROM followers
              JOIN users ON users.id=followers.following WHERE followers.follower='$user_id'";
    $followings = mysqli_query($conx, $query);

    // GET followers users
    $query = "SELECT users.username, users.username, users.country, users.city FROM followers
              JOIN users ON users.id=followers.follower WHERE followers.following='$user_id'";
    $followers = mysqli_query($conx, $query);

    $query = "SELECT * FROM followers WHERE follower='$guest' AND following='$user_id' LIMIT 1";
    $follow_btn = mysqli_query($conx, $query);

    // GET playlist
    $query = "SELECT playlists.id, playlists.title, COUNT(tracks.id) as tracks FROM playlists
              JOIN tracks ON playlists.id=tracks.playlist_id
              WHERE playlists.user_id='$user_id'
              GROUP BY playlists.id";
    $playlists = mysqli_query($conx, $query);

    // GET latest 5 comments of user
    $query = "SELECT comments.comment, comments.created_at, playlists.title, playlists.id FROM comments
              JOIN playlists ON comments.playlist_id=playlists.id WHERE comments.user_id = '$user_id' LIMIT 5";
    $comments = mysqli_query($conx, $query);

  }else{
    $_SESSION['alert'] = 'There is no user with this username';
    header('location: index.php');
  }
}
?>

<?php include_once 'partials/header.php'; ?>

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
                          <span class="m-b-xs h4 block"><?php echo $follows['followers'] ?></span>
                          <small class="text-muted">Followers</small>
                        </a>
                      </div>
                      <div class="col-xs-6">
                        <a href="#">
                          <span class="m-b-xs h4 block"><?php echo $follows['following'] ?></span>
                          <small class="text-muted">Following</small>
                        </a>
                      </div>
                    </div>
                  </div>

                  <?php if(isset($_SESSION['user']) && ($_SESSION['user']['id'] != $user['id'])): ?>
                    <div class="btn-group btn-group-justified m-b">
                      <a data-user="<?php echo $user_id ?>" class="follow-btn btn btn-success btn-rounded <?php if(mysqli_num_rows($follow_btn)) echo 'active' ?>">
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
                      <a href="http://www.facebook.com/<?php echo $user['facebook'] ?>" target="_blank" class="btn btn-rounded btn-twitter btn-icon"><i class="fa fa-twitter"></i></a>
                      <a href="http://www.twitter.com/<?php echo $user['twitter']; ?>" target="_blank" class="btn btn-rounded btn-facebook btn-icon"><i class="fa fa-facebook"></i></a>
                      <a href="http://www.plus.google.com/<?php echo $user['googleplus']; ?>" target="_blank" class="btn btn-rounded btn-gplus btn-icon"><i class="fa fa-google-plus"></i></a>
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
                  <li class="active"><a href="#playlists" data-toggle="tab">Playlists</a></li>
                  <li><a href="#followers" data-toggle="tab">Followers</a></li>
                  <li><a href="#following" data-toggle="tab">Following</a></li>
                </ul>
              </header>
              <section class="scrollable">
                <div class="tab-content">
                  <div class="tab-pane active" id="playlists">
                    <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                      <?php if(mysqli_num_rows($playlists)): ?>
                        <?php while($p = mysqli_fetch_assoc($playlists)): ?>
                          <li class="list-group-item">
                            <a href="#" class="thumb-sm pull-left m-r-sm">
                              <img src="assets/images/logo.jpg" class="img-circle">
                            </a>
                            <a href="playlist.php?id=<?php echo $p['id'] ?>" class="clear">
                              <strong class="block"><?php echo $p['title'] ?></strong>
                              <small><i class="fa fa-headphones"></i> <?php echo $p['tracks'] ?></small>
                            </a>
                          </li>
                        <?php endwhile ?>
                      <?php endif ?>
                    </ul>
                  </div>
                  <div class="tab-pane" id="followers">
                    <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                      <?php if(mysqli_num_rows($followers)): ?>
                        <?php while($f = mysqli_fetch_assoc($followers)): ?>
                          <li class="list-group-item">
                            <a href="#" class="thumb-sm pull-left m-r-sm">
                              <img src="assets/images/a2.png" class="img-circle">
                            </a>
                            <a href="user.php?username=<?php echo $f['username'] ?>" class="clear">
                              <strong class="block"><?php echo $f['username'] ?></strong>
                              <small><i class="fa fa-map-marker"></i> <?php echo $f['country'] ?> <?php echo $f['city'] ?></small>
                            </a>
                          </li>
                        <?php endwhile ?>
                      <?php endif ?>
                    </ul>
                  </div>
                  <div class="tab-pane" id="following">
                    <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                      <?php if(mysqli_num_rows($followings)): ?>
                        <?php while($f = mysqli_fetch_assoc($followings)): ?>
                          <li class="list-group-item">
                            <a href="#" class="thumb-sm pull-left m-r-sm">
                              <img src="assets/images/a2.png" class="img-circle">
                            </a>
                            <a href="user.php?username=<?php echo $f['username'] ?>" class="clear">
                              <strong class="block"><?php echo $f['username'] ?></strong>
                              <small><i class="fa fa-map-marker"></i><?php echo $f['country'] ?> <?php echo $f['city'] ?></small>
                            </a>
                          </li>
                        <?php endwhile ?>
                      <?php endif ?>
                    </ul>
                  </div>
                </div>
              </section>
            </section>
          </aside>
          <aside class="col-lg-3 b-l">
            <section class="vbox">
              <section class="scrollable padder-v">
                <div class="panel">
                  <h4 class="font-thin padder">Latest Comments</h4>
                  <?php if(mysqli_num_rows($comments)): ?>
                    <ul class="list-group">
                      <?php while($comment = mysqli_fetch_assoc($comments)): ?>
                          <li class="list-group-item">
                              <p><a href="playlist.php?id=<?php echo $comment['id'] ?>" class="text-info">@<?php echo $comment['title'] ?></a> <?php echo $comment['comment'] ?></p>
                              <small class="block text-muted"><i class="fa fa-clock-o"></i> <?php echo $comment['created_at'] ?></small>
                          </li>
                      <?php endwhile ?>
                    </ul>
                  <?php endif ?>
                </div>
              </section>
            </section>
          </aside>
        </section>
      </section>
      <?php include_once 'partials/player.php';?>
    </section>
  <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
<?php include_once 'partials/footer.php'; ?>