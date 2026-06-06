<?php
session_start();
$uid = $_SESSION['uid'];
include 'database.php';

if (isset($_POST["s"])) {

    $uname = $_POST['uname'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['e'];
    $pass  = $_POST['pass'];

    // Get current images so we don't lose them if no new file uploaded
    $current = mysqli_fetch_array(mysqli_query($conn, "SELECT upimg, ucimg FROM users WHERE uid='$uid'"));

    // Handle Profile Image
    if (!empty($_FILES['i']['name'])) {
        $in = basename($_FILES['i']['name']);
        $it = $_FILES['i']['tmp_name'];
        $profileDir = 'users/profile/'; // lowercase - consistent!
        if (!is_dir($profileDir)) mkdir($profileDir, 0755, true);
        move_uploaded_file($it, $profileDir . $in);
    } else {
        $in = $current['upimg']; // keep existing
    }

    // Handle Cover Image
    if (!empty($_FILES['c']['name'])) {
        $cn = basename($_FILES['c']['name']);
        $ct = $_FILES['c']['tmp_name'];
        $coverDir = 'users/cover/'; // lowercase - consistent!
        if (!is_dir($coverDir)) mkdir($coverDir, 0755, true);
        move_uploaded_file($ct, $coverDir . $cn);
    } else {
        $cn = $current['ucimg']; // keep existing
    }

    $sql    = "UPDATE `users` SET `Username`='$uname', `First_Name`='$fname', `Last_Name`='$lname', `Email`='$email', `Pass`='$pass', `upimg`='$in', `ucimg`='$cn' WHERE `uid`='$uid'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Use JavaScript redirect ONLY - no header() after output
        echo "<script>alert('Profile Updated Successfully'); window.location.href='profile.php';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to Update Profile. Error: " . mysqli_error($conn) . "'); window.history.back();</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>Edit Profile - Trek Track</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
</head>
<body class="">

<?php include 'headers.php'; ?>

<main class="main-content mt-0">
  <section>
    <div class="page-header min-vh-100">
      <div class="container">
        <div class="row" style="padding-top: 10rem;">
          <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
            <div class="card card-plain">
              <div class="card-header pb-0 text-start">
                <h4 class="font-weight-bolder">Edit Profile</h4>
                <p class="mb-0">Update your account information</p>
              </div>

              <?php
              $sql    = "SELECT * FROM users WHERE uid='$uid'";
              $result = mysqli_query($conn, $sql);
              $row    = mysqli_fetch_array($result);
              ?>

              <div class="card-body">
                <form role="form" action="" method="POST" enctype="multipart/form-data">

                  <div class="mb-3">
                    <input type="text" value="<?php echo htmlspecialchars($row['Username']); ?>"
                      name="uname" required class="form-control form-control-lg" placeholder="Username">
                  </div>
                  <div class="mb-3">
                    <input type="text" name="fname" value="<?php echo htmlspecialchars($row['First_Name']); ?>"
                      required class="form-control form-control-lg" placeholder="First Name">
                  </div>
                  <div class="mb-3">
                    <input type="text" name="lname" value="<?php echo htmlspecialchars($row['Last_Name']); ?>"
                      required class="form-control form-control-lg" placeholder="Last Name">
                  </div>
                  <div class="mb-3">
                    <input type="email" name="e" value="<?php echo htmlspecialchars($row['Email']); ?>"
                      required class="form-control form-control-lg" placeholder="Email">
                  </div>
                  <div class="mb-3">
                    <input type="password" name="pass" value="<?php echo htmlspecialchars($row['Pass']); ?>"
                      required class="form-control form-control-lg" placeholder="Password">
                  </div>

                  <!-- Current Profile Image Preview -->
                  <?php if (!empty($row['upimg'])): ?>
                  <div class="mb-2 text-center">
                    <p class="mb-1 text-sm text-muted">Current Profile Image:</p>
                    <img src="users/profile/<?php echo htmlspecialchars($row['upimg']); ?>"
                         width="80" height="80"
                         style="border-radius:50%; object-fit:cover; border:2px solid #ddd;"
                         onerror="this.style.display='none'">
                  </div>
                  <?php endif; ?>

                  <div class="mb-3">
                    <label class="form-label text-sm">Profile Image <span class="text-muted">(leave empty to keep current)</span>:</label>
                    <input type="file" name="i" accept="image/*" class="form-control form-control-lg">
                  </div>

                  <!-- Current Cover Image Preview -->
                  <?php if (!empty($row['ucimg'])): ?>
                  <div class="mb-2 text-center">
                    <p class="mb-1 text-sm text-muted">Current Cover Image:</p>
                    <img src="users/cover/<?php echo htmlspecialchars($row['ucimg']); ?>"
                         width="150" height="60"
                         style="object-fit:cover; border-radius:8px; border:2px solid #ddd;"
                         onerror="this.style.display='none'">
                  </div>
                  <?php endif; ?>

                  <div class="mb-3">
                    <label class="form-label text-sm">Cover Image <span class="text-muted">(leave empty to keep current)</span>:</label>
                    <input type="file" name="c" accept="image/*" class="form-control form-control-lg">
                  </div>

                  <div class="text-center">
                    <button type="submit" name="s" class="btn btn-lg btn-primary w-100 mt-4 mb-0">
                      Update Profile
                    </button>
                  </div>
                </form>
              </div>

              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                  <a href="profile.php" class="text-primary text-gradient font-weight-bold">← Back to Profile</a>
                </p>
              </div>
            </div>
          </div>

          <!-- Right side decorative panel -->
          <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
            <div class="position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                 style="background-image: url('https://img.freepik.com/free-photo/aesthetic-wallpaper-made-abstract-geometric-shapes_23-2150300231.jpg?w=360'); background-size: cover;">
              <span class="mask bg-gradient-primary opacity-6"></span>
              <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new currency"</h4>
              <p class="text-white position-relative">The more effortless the writing looks, the more effort the writer actually put into the process.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), { damping: '0.5' });
  }
</script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>
</html>
