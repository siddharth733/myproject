<?php include('header.php'); ?>
<?php include('includes/config.php'); ?>
<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color">
    <a class="navbar-brand" href="#"> <b>SMS</b> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="teachers.php">Teachers
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="courses.php">Courses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="feedBack.php">Feedback</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto nav-flex-icons">
            <li class="nav-item dropdown">
                <?php if (isset($_SESSION['login'])) { ?>
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user mr-2"></i>Account
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                        <a class="dropdown-item" href="/school/admin/dashboard.php">Dashboard</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                <?php } else { ?>
                    <a href="login.php" class="nav-link"><i class="fa fa-user mr-2"></i>Login</a>
                <?php } ?>
            </li>
        </ul>
    </div>
</nav>
<!--/.Navbar -->

<div class="container">
    <div class="row mt-5">
        <?php
        $querry = mysqli_query($db_conn, "SELECT * FROM accounts WHERE type='teacher'");
        while ($result = mysqli_fetch_object($querry)) { ?>
            <div class="col-12 mb-5 mt-2 rounded">
                <div class="card bg-dark text-white">
                    <div class="col-6 position-absolute" style="top:-50px; ">
                        <img src="./assets/images/teach_avatar.webp" width="100px" alt="" class="mw-100 bg-dark border rounded-circle">
                    </div>
                    <div class="card-body pt-5 mt-2">
                        <p class="card-title"><b><?= $result->name ?></b></p>
                        <p class="card-text">
                            <b>Contact:</b> <?= $result->mobile ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Footer  -->
<footer class="py-5 bg-dark text-white mt-auto">
    <div>
        <div class="container-fluid">
            <div class="row">
                <!-- <div class="col-lg-4">
                        <h4>UseFull Links</h4>
                        <ul class="fa-ul ml-4">
                            <li><a href="" class="text-light"><i class="fa-li fa fa-angle-right"></i>List icons</a></li>
                            <li><a href="" class="text-light"><i class="fa-li fa fa-angle-right"></i>can be used</a></li>
                            <li><a href="" class="text-light"><i class="fa-li fa fa-angle-right"></i>as bullets</a></li>
                            <li><a href="" class="text-light"><i class="fa-li fa fa-angle-right"></i>in lists</a></li>
                        </ul>
                    </div> -->
                <div class="col-lg-6">
                    <h4>Social Presence</h4>
                    <div>
                        <span class="fa-stack">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fab fa-facebook-f fa-stack-1x fa-inverse text-dark"></i>
                        </span>
                        <span class="fa-stack">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fab fa-instagram fa-stack-1x fa-inverse text-dark"></i>
                        </span>
                        <span class="fa-stack">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fab fa-twitter fa-stack-1x fa-inverse text-dark"></i>
                        </span>
                        <span class="fa-stack">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fab fa-linkedin fa-stack-1x fa-inverse text-dark"></i>
                        </span>
                        <span class="fa-stack">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fab fa-youtube fa-stack-1x fa-inverse text-dark"></i>
                        </span>
                    </div>
                </div>
    <?php if (isset($_SESSION['login']) && ($_SESSION['user_type'] == 'student' || $_SESSION['user_type'] == 'parent')) { ?>
                    <div class="col-lg-5">
                        <h4>Feedback</h4>
                        <form action="" method="POST">
                                <!-- <div class="form-group">
                                    <input type="email" id="email" class="form-control mt-2" placeholder="Your Email">
                                    <!-- <label for="email">Email</label> -->
                                <!-- </div> -->
                                <div class="form-group">
                                    <input type="text" name="feedback" class="form-control mb-4" placeholder="Your Feedback">
                                    <!-- <label for="resopnse">Feedback</label> -->
                                </div>
                                <button name="feedback_btn" class="bt btn-secondary rounded p-1 btn-block">Submit</button>
                        </form>
                    </div>
                    <?php } ?>  
                </div>
            </div>
        </div>
    </footer>

    <section class="py-2 bg-dark text-white text-center">
        <div class="container-fluid">
            Copyright 2022-2024 All Right Reserved. <br> <a href="" class="text-light"> School Managment System</a>
        </div>
    </section>
                <?php include('footer.php'); ?>