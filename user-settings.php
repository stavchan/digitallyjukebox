<?php
session_start();
require_once 'scripts/functions.php';
require_once 'scripts/db_conx.php';

$user_id = $_SESSION['user']['id'];

$query = "SELECT * FROM users WHERE id='$user_id' LIMIT 1";
$result = mysqli_query($conx, $query);

$user = mysqli_fetch_assoc($result);
?>

<?php include_once 'partials/header.php'; ?>
  <section class="vbox">
    <section class="scrollable wrapper">
        <div class="panel panel-default">
          <div class="panel-heading font-bold">Settings</div>
          <div class="panel-body">
            <form id="user-settings" action="scripts/save_settings.php" method="POST" class="form-horizontal ajax-form">
                <div class="form-group">
                  <label class='col-lg-2 control-label'>Username</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" name="username" value="<?php echo $user['username']?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class='col-lg-2 control-label'>Password</label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" name="password">
                  </div>
                </div>
                <div class="form-group">
                  <label class='col-lg-2 control-label'>Email</label>
                  <div class="col-lg-10">
                    <input type="email" class="form-control" name="email" value="<?php echo $user['email']?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class='col-lg-2 control-label'>Birthdate</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control datepicker" name="birthdate" value="<?php echo $user['birthdate']?>">
                  </div>
                </div>

                <div class="line line-dashed b-b line0-lg pull-in"></div>

                <div class="form-group">
                  <label class='col-lg-2 control-label'>Facebook</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" name="facebook" value="<?php echo $user['facebook']?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class='col-lg-2 control-label'>Twitter</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" name="twitter" value="<?php echo $user['twitter']?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class='col-lg-2 control-label'>Google+</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" name="googleplus" value="<?php echo $user['googleplus']?>">
                  </div>
                </div>

                <div class="line line-dashed b-b line0-lg pull-in"></div>

                <div class="form-group">
                  <label class='col-lg-2 control-label'>About me</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" name="about_me" value="<?php echo $user['about_me']?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class='col-lg-2 control-label'>Info</label>
                  <div class="col-lg-10">
                      <textarea class="form-control" name="info"><?php echo $user['info']?></textarea>
                  </div>
                </div>

              <div class="line line-dashed b-b line0-lg pull-in"></div>

                <div class="form-group">
                    <label class='col-lg-2 control-label'>Country</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="country" value="<?php echo $user['country']?>">
                    </div>
                </div>

                <div class="form-group">
                  <label class='col-lg-2 control-label'>City</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" name="city" value="<?php echo $user['city']?>">
                  </div>
                </div>

              <div class="line line-dashed b-b line0-lg pull-in"></div>

              <div class="col-sm-4 col-sm-offset-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="index.php" class="btn btn-default">Cancel</a>
              </div>
            </form>
          </div>
        </div>
    </section>
  </section>
  <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
<?php include_once 'partials/footer.php'; ?>