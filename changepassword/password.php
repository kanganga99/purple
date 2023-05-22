<?php
include '../includes/header.php';
?>
<?php
if (isset($_POST['submit'])) :
  extract($_POST);
  if ($old_password != "" && $password != "" && $confirm_pwd != "") :
    if (isset($_GET['id']) && $_GET['id'] != "") {
      $user_id  = $_GET['id'];
    } else {
      $user_id  = $_SESSION['id'];
    }
    // $user_id = '1';
    $old_pwd = md5(mysqli_real_escape_string($conn, $_POST['old_password']));
    $pwd = md5(mysqli_real_escape_string($conn, $_POST['password']));
    $c_pwd = md5(mysqli_real_escape_string($conn, $_POST['confirm_pwd']));
    if ($pwd == $c_pwd) :
      if ($pwd != $old_pwd) :
        $sql = "SELECT * FROM `admins` WHERE `id`='$user_id' AND `password` ='$old_pwd'";
        $db_check = $conn->query($sql);
        $count = mysqli_num_rows($db_check);
        if ($count == 1) :
          $fetch = $conn->query("UPDATE `admins` SET `password` = '$pwd' WHERE `id`='$user_id'");
          $old_password = '';
          $password = '';
          $confirm_pwd = '';
          $msg_sucess = "Your new password was updated successfully.";
        else :
          $error = "The password you gave is incorrect.";
        endif;
      else :
        $error = "Old password new password cannot be similar Please try again.";
      endif;
    else :
      $error = "New password and confirm password do not match";
    endif;
  else :
    $error = "Please fill in all the required fields";
  endif;
endif;
?>

?>
<!DOCTYPE html>
<html lang="en">
<style type="text/css">
  .error {
    margin-top: 6px;
    margin-bottom: 0;
    color: #fff;
    background-color: #D65C4F;
    display: table;
    padding: 5px 8px;
    font-size: 11px;
    font-weight: 600;
    line-height: 14px;
  }

  .green {
    margin-top: 6px;
    margin-bottom: 0;
    color: #fff;
    background-color: green;
    display: table;
    padding: 5px 8px;
    font-size: 11px;
    font-weight: 600;
    line-height: 14px;
  }
</style>

<body class="sb-nav-fixed">

  </div>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4">
        <h4 class="mt-4">Update password</h4>

        <div class="row">

          <div class="card mb-4">

            <div class="card-body">
              <div class="container">

                <div class="<?= (@$msg_sucess == "") ? 'error' : 'green'; ?>" id="logerror">
                  <?php echo @$error; ?><?php echo @$msg_sucess; ?>
                </div><br>
                <form method="post" autocomplete="off" id="password_form">
                  <p>Enter your old password<br />
                    <input type="password" name="old_password" placeholder="old password" />
                  </p>
                  <p>Enter your new password<br />
                    <input type="password" name="password" id="password" placeholder="new password" class="ser" />
                  </p>
                  <p>Confirm your new password<br />
                    <input type="password" name="confirm_pwd" id="confirm_pwd" placeholder="confirm password" class="ser" />
                  </p>
                    <button name="submit" type="submit" value="Save Password" class="btn btn-success">Save</button>
                </form>
              </div>
            </div>
          </div>
    </main>
  </div>
  </div>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/chart.min.js"></script>
  <script src="../assets/js/datatables.js"></script>
</body>
</html>