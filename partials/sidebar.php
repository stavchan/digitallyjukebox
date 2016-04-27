<!-- .aside -->
<aside class="bg-black dk nav-xs aside hidden-print" id="nav">
    <section class="vbox">
        <section class="w-f-md scrollable">
            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                    <ul class="nav bg clearfix">
                        <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
                            Discover
                        </li>
                        <li>
                            <a href="index.php">
                                <i class="icon-disc icon text-success"></i>
                                <span class="font-bold">What's new</span>
                            </a>
                        </li>
                        <li>
                            <a href="tracks.php">
                                <i class="icon-music-tone-alt icon text-info"></i>
                                <span class="font-bold">Tracks</span>
                            </a>
                        </li>
                        <li>
                            <a href="playlists.php">
                                <i class="icon-list icon  text-info-dker"></i>
                                <span class="font-bold">Playlist</span>
                            </a>
                        </li>
                        <li class="m-b hidden-nav-xs"></li>
                    </ul>
                    <ul class="nav" data-ride="collapse">
                        <li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
                            User
                        </li>
                        <li >
                            <a href="user.php?username=<?php echo $_SESSION['user']['username'] ?>" class="auto">
                            <span class="pull-right text-muted">
                              <i class="fa fa-angle-left text"></i>
                              <i class="fa fa-angle-down text-active"></i>
                            </span>
                                <i class="icon-user icon">
                                </i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li >
                            <a href="user-settings.php" class="auto">
                            <span class="pull-right text-muted">
                              <i class="fa fa-angle-left text"></i>
                              <i class="fa fa-angle-down text-active"></i>
                            </span>
                                <i class="icon-settings icon">
                                </i>
                                <span>Settings</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- / nav -->
            </div>
        </section>

        <footer class="footer hidden-xs no-padder text-center-nav-xs">
            <div class="bg hidden-xs ">
                <div class="dropdown dropup wrapper-sm clearfix">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="thumb-sm avatar pull-left m-l-xs">                        
                        <img src="assets/images/a3.png" class="dker" alt="...">
                        <i class="on b-black"></i>
                      </span>
                      <span class="hidden-nav-xs clear">
                        <span class="block m-l">
                          <strong class="font-bold text-lt">John.Smith</strong> 
                          <b class="caret"></b>
                        </span>
                        <span class="text-muted text-xs block m-l">Art Director</span>
                      </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight aside text-left">
                        <li>
                            <span class="arrow bottom hidden-nav-xs"></span>
                            <a href="#">Settings</a>
                        </li>
                        <li>
                            <a href="profile.html">Profile</a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="badge bg-danger pull-right">3</span>
                                Notifications
                            </a>
                        </li>
                        <li>
                            <a href="docs.html">Help</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="modal.lockme.html" data-toggle="ajaxModal" >Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </section>
</aside>
<!-- /.aside -->