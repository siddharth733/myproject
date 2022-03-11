<?php include('header.php'); ?>
<nav class="navbar navbar-expand-lg navbar-dark default-color">
        <a class="navbar-brand" href="#"> <b>SMS</b> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home
                    </a>
                </li>
                <?php if (isset($_SESSION['login'])) {?>
                <li class="nav-item">
                    <a class="nav-link" href="teachers.php">Teachers</a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="courses.php">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="feedBack.php">Feedback</a>
                </li>
            </ul>
        </div>
    </nav>
<section class="lg-bg vh-100 d-flex">
    <div class="col-4 m-auto">
        <div class="card rounded shadow">
            <div class="card-body rounded bg-light">
                <div class="text-center mb-3">
                    <span class="fa-stack fa-3x">
                        <i class="fa text-dark fa-circle fa-stack-2x"></i>
                        <i class="fa fa-user fa-stack-1x text-white"></i>
                    </span>
                </div>
                <form action="./action/login.php" method="POST">
                    <div class="form-group">
                        <label class="lg-txt font-weight-bold" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter Your Email" required>
                    </div>
                    <div class="form-group"></div>
                        <label class="lg-txt font-weight-bold" for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter Your Password" required>
                    </div>
                    <button class="lg-btn btn w-50 rounded mt-3 mb-3 btn-grey" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include('footer.php'); ?>