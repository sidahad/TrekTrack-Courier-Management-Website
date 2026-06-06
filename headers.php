<?php
if(!session_id()){
    session_start();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Logistica - Shipping Company Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/styl.css" rel="stylesheet">

    <style>
        /* Desktop Styling (Unchanged) */
        .profile-dropdown {
            width: 100%; /* Keeping the desktop dropdown width intact */
        }
    
        .profile-content {
            background-color: white;
            text-align: center;
            
            
           
        }
    
        .profile-img {
            border-radius: 50%;
            width: 150px; /* Keeping the profile image size intact */
            height: 150px;
            margin-top: 30px;
        }
    
        /* Mobile View Adjustments */
        @media (max-width: 576px) {
            /* Ensure the dropdown takes full width in mobile view */
            .profile-dropdown {
                width: 100% !important;       
            }
    
            /* Resize the profile image for mobile */
            .profile-img {
                width: 80px;
                height: 80px;
                margin-top: 15px;
            }
    
            /* Adjust text sizes for mobile */
            .profile-content h4 {
                font-size: 16px;
            }
    
            /* Full width dropdown for mobile */
            .dropdown-menu {
                width: 100% !important;
                padding: 0 !important;
            }
    
            /* Center align the text and links on mobile */
            .profile-content a {
                font-size: 14px;
                
            }
    
            /* .navbar-nav .nav-item {
                
            } */
        }
    </style>
</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow border-top border-5 border-primary sticky-top p-0">
        <a href="index.html" class="navbar-brand bg-primary d-flex align-items-center px-4 px-lg-5">
            <h2 class="mb-2 text-white">TREK TRACK</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link active">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link">Services</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="price.php" class="dropdown-item">Pricing Plan</a>
                        <a href="feature.php" class="dropdown-item">Features</a>
                        <a href="quote.php" class="dropdown-item">Free Quote</a>
                        <a href="blog.php" class="dropdown-item">Blog</a>
                        <a href="team.php" class="dropdown-item">Our Team</a>
                        <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                        <a href="404.php" class="dropdown-item">404 Page</a>
                    </div>
                </div>

                <a href="contact.php" class="nav-item nav-link">Contact</a>

                <?php
                    if (isset($_SESSION['uid'])) {
                        $uid = $_SESSION['uid']; // Get the user ID from the session
                        include('database.php');

                        // SQL query to get the current logged-in user's details
                        $selectquery = "SELECT `uid`, `Username`, `First_Name`, `Last_Name`, `Email`, `Pass`, `upimg`, `ucimg` 
                                        FROM `users` 
                                        WHERE `uid` = '$uid'"; 

                        $query = mysqli_query($conn, $selectquery);

                        if ($row = mysqli_fetch_array($query)) {
                            ?>
                            <!-- Profile Dropdown -->
                             <div style="width: 260px;">
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fa fa-user opacity-6 text-dark me-1"></i>Profile
                                </a>
                                <div class="dropdown-menu bg-light rounded-0 m-0 profile-dropdown">
                                    <div class="profile-content">
                                        <?php
$imgPath = 'users/profile/' . $row['upimg'];
$imgPathAlt = 'users/Profile/' . $row['upimg'];
$imgSrc = file_exists($imgPath) ? $imgPath : (file_exists($imgPathAlt) ? $imgPathAlt : 'assets/img/placeholder.png');
?>
<img src="<?php echo $imgSrc; ?>" alt="" class="profile-img"><br><br>
                                        <h4 class="text-center">Hi <?php echo $row['Username']; ?></h4>
                                        <div style="display: flex; justify-content:center;">
                                            <a href="logout.php" style="margin-left: 10px;" class="nav-item nav-link">Logout</a>
                                            <a class="nav-link" style="margin-left: 5px;" href="reg_updt.php">EDIT Profile</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <?php
                        } else {
                            echo "<p class='text-center'>User not found</p>";
                        }
                    } else {
                        // If user is not logged in, display login and register links
                        ?>
                        <a href="login.php" class="nav-item nav-link"><i class="fas fa-user-circle opacity-6 text-dark me-1"></i>Login</a>
                        <a href="register.php" class="nav-item nav-link"><i class="fas fa-key opacity-6 text-dark me-1"></i>Register</a>
                        <?php
                    }
                    ?>


                
            </div>
            <h4 class="m-0 pe-lg-5 d-none d-lg-block"><i class="fa fa-headphones text-primary me-3"></i>+92 3456175</h4>
        </div>
    </nav>
    <!-- Navbar End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/mains.js"></script>
</body>

</html>