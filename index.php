<?php include('header.php'); ?>
<?php include('includes/config.php'); ?>
<?php 
if(isset($_POST['feedback_btn'])){
    $feedback = $_POST['feedback'];
    $meta_value = $_SESSION['id'];
    $query = mysqli_query($db_conn,"SELECT * FROM accounts WHERE `id`='$meta_value'");
    $result = mysqli_fetch_object($query);
    $name = $result->name;
    $type = $result->type;
    mysqli_query($db_conn,"INSERT INTO feedback (`name`,`meta_value`,`feedback`,`type`) VALUES ('$name','$meta_value','$feedback','$type')");
}
?>
    <!--Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark default-color">
        <a class="navbar-brand" href="#"> <b>SMS</b> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
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
                   <?php } else{ ?>
                    <a href="login.php" class="nav-link"><i class="fa fa-user mr-2"></i>Login</a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </nav>
    <!--/.Navbar -->

    <!-- Banner -->
    <div class="d-flex bg-light" style="height: 500px ;background:linear-gradient(110deg,#c6c3ba 60%,#c5dff6 60%)">
        <div class="container-fluid my-auto">
            <div class="row">
                <div class="col-lg-6 my-auto">
                    <h1 class="display-3 font-weight-bold">School Managment System</h1>
                </div>
                <div class="col-lg-6">
                    <!-- <div class="w-50 mx-auto card shadow-lg">
                        <div class="card-body">
                            <h3>Inquiry Form</h3>
                            <form action="" method="POST">
                                <div class="md-form">
                                    <input type="text" id="name" class="form-control">
                                    <label for="form1">Your Name</label>
                                </div>
                                <div class="md-form">
                                    <input type="email" id="email" class="form-control">
                                    <label for="email">Your Email</label>
                                </div>
                                <div class="md-form">
                                    <input type="text" id="mobile" class="form-control">
                                    <label for="form1">Your Mobile</label>
                                </div>
                                <div class="md-form">
                                    <input type="text" id="class" class="form-control">
                                    <label for="form1">Your Class</label>
                                </div>

                                <button class="btn btn-dark btn-block">Submit Form</button>
                            </form>
                        </div> 
                    </div> -->
                </div>
            </div>
        </div>
    </div>

    <!-- About Us -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 py-5">
                    <h2 class="font-weight-bold">About School Managment System</h2>
                    <div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ducimus adipisci eum quibusdam assumenda repudiandae possimus? Recusandae corporis eum reprehenderit laborum reiciendis dolore quam iusto officia voluptatem culpa laboriosam ipsam necessitatibus sint, labore dicta in veritatis, architecto id voluptatibus! Voluptatum ad nisi, at, blanditiis quidem magni ea dignissimos, beatae molestias aperiam quos!</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique nesciunt officia harum fugiat in maiores nemo! Consectetur adipisci neque explicabo, obcaecati aperiam exercitationem ut ullam a magni laudantium illum! Velit, doloremque assumenda? Vero, omnis perferendis.</p>
                    </div>
                </div>
                <div class="col-lg-6" style="background: url(./assets/images/about.jpeg);">
                </div>
            </div>
        </div>
    </section>

    <!-- Courses -->
    <section class="py-5 bg-light">
        <div>
            <div class="text-center mb-4">
                <h2 class="font-weight-bold">Course Details</h2>
                <p class="text-muted">Here We Showing Our Course Details</p>
            </div>
        </div>
        <div class="container bg-light">
        <div id="carouselId" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                <li data-target="#carouselId" data-slide-to="1"></li>
                <li data-target="#carouselId" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item slide active">
                            <div class="card bg-light">
                                <div class="card-body">
                                <img src="uploads/Untitled.png" width="100%" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>HTML</h3>
                                    <p>In this HTML tutorial, you will find more than 200 examples. With our online "Try it Yourself" editor, you can edit and test each example yourself!</p>
                                </div>
                                </div>
                    </div>
                </div>
                <div class="carousel-item">
                            <div class="card slide bg-light">
                                <div class="card-body">
                                <img src="uploads/Untitled.png" width="100%" class="img-fluid" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>CSS</h3>
                                    <p>Cascading Style Sheets, fondly referred to as CSS, is a simple design language intended to simplify the process of making web pages presentable. CSSis a MUST for students and working professionals to become a great Software Engineer specially when they are working in Web Development Domain.</p>
                                </div>
                                </div>
                        </div>
                </div>
                <div class="carousel-item">
                            <div class="card slide bg-light">
                                <div class="card-body">
                                <img src="uploads/Untitled.png" width="100%" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>Bootstrap</h3>
                                    <p>Bootstrap is the most popular HTML, CSS, and JavaScript framework for developing responsive, mobile-first websites.</p>
                                </div>
                                </div>
                            </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        </div>
    </section>

    <!-- Teachers -->
<?php if (isset($_SESSION['login'])) {?>
    <section class="py-5">
        <div class="text-center mb-4">
            <h2 class="font-weight-bold">Teachers Details</h2>
            <p class="text-muted">Here We Showing Our Teacher Details</p>
        </div>
        <div class="container">
            <div class="row">
                <?php $query1 = mysqli_query($db_conn,"SELECT * FROM accounts WHERE type='teacher' LIMIT 4");
                while($result1 = mysqli_fetch_object($query1)){ ?>
                    <div class="col-lg-3 my-5">
                        <div class="card">
                            <div class="col-6 bg-d position-absolute" style="top:-50px; ">
                                <img src="./assets/images/teach_avatar.webp"  alt="" class="mw-100 bg-dark border rounded-circle">
                            </div>
                            <div class="card-body pt-5 mt-2">
                                <p class="card-title"><b><?= $result1->name ?></b></p>
                                <p class="card-text">
                                    <b>Contact:</b> <?= $result1->mobile ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </section>
<?php } ?>

    <!-- Achivement  -->
    <section class="py-5 <?php if(isset($_SESSION['login'])){ ?> bg-light <?php } ?>">
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2>Achivments</h2>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi dolorem quo est quos animi alias dolore quasi debitis fuga facere, error tempore expedita ipsam fugiat neque ea voluptate commodi reprehenderit inventore nemo!</p>
                        <img src="./assets/images/about.jpeg" alt="" class="img-fluid rounded">
                    </div>
                    <div class="col-lg-6 my-auto">
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <div class="card border rounded shadow text-center">
                                    <div class="card-body">
                                        <span><i class="fa fa-users fa-2x"></i></span>
                                        <h2 class="my-2 font-weight-bold h1"><?php 
                  $querry = mysqli_query($db_conn,"SELECT * FROM accounts WHERE type='teacher'");
                  $ans = mysqli_num_rows($querry);
                  echo "$ans";
                  ?></h2>
                                        <hr>
                                        <h4>Total Teacher</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="card border rounded shadow text-center">
                                    <div class="card-body">
                                        <span><i class="fa fa-graduation-cap fa-2x"></i></span>
                                        <h2 class="my-2 font-weight-bold h1">
                                        <?php 
                  $querry = mysqli_query($db_conn,"SELECT * FROM courses");
                  $ans = mysqli_num_rows($querry);
                  echo "$ans";
                  ?>
                                        </h2>
                                        <hr>
                                        <h4>Total Courses</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="card border rounded shadow text-center">
                                    <div class="card-body">
                                        <span><i class="fa fa-graduation-cap fa-2x"></i></span>
                                        <h2 class="my-2 font-weight-bold h1">
                                        <?php 
                  $querry = mysqli_query($db_conn,"SELECT * FROM accounts WHERE type='student'");
                  $ans = mysqli_num_rows($querry);
                  echo "$ans";
                  ?>
                                        </h2>
                                        <hr>
                                        <h4>Total Students</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="card border rounded shadow text-center">
                                    <div class="card-body">
                                        <span><i class="fa fa-graduation-cap fa-2x"></i></span>
                                        <h2 class="my-2 font-weight-bold h1"><?php 
                  $querry = mysqli_query($db_conn,"SELECT * FROM feedback");
                  $ans = mysqli_num_rows($querry);
                  echo "$ans";
                  ?></h2>
                                        <hr>
                                        <h4>Total Feedback</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial  -->
    <section class="py-5 <?php if(!isset($_SESSION['login'])){ ?> bg-light <?php } ?>">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="font-weight-bold">What Pepole See</h2>
                <p class="text-muted">Students & Parrent Feedback</p>
            </div>
            <div class="container">
                <div class="row">
                    <?php $query1 = mysqli_query($db_conn,"SELECT * FROM feedback LIMIT 4");
                    while($result1 = mysqli_fetch_object($query1)){ ?>
                    <div class="col-6 mb-4">
                        <div class="border bg-white shadow rounded p-3" style="background-color: #0005;">
                            <img src="./assets/images/avatar_te.jpg" alt="" class="rounded-circle position-relative mt-2" width="100" height="100">
                            <h6 class="mt-2"><b><?= $result1->name ?></b></h6>
                            <h6><?= $result1->type ?></h6>
                            <div class="p-4 text-center"><?= $result1->feedback ?></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

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