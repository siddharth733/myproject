<?php include('header.php'); ?>
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