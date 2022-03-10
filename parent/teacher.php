<?php
if (isset($_POST['submit'])) {
    // echo'<pre>';
    // print_r($_POST);
    // echo'</pre>';

    $name = $_POST['name'];
    $category = $_POST['category'];
    $duration = $_POST['duration'];
    $image = $_FILES["thumbnail"]["name"];
    $today = date('Y-m-d');

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["thumbnail"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["thumbnail"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
            mysqli_query($db_conn,"INSERT INTO courses (`name`,`category`,`duration`,`date`,`image`) VALUES ('$name','$category','$duration','$today','$image')")
            or die(mysqli_error($db_conn));
            $_SESSION['success_msg'] = 'Course Uploaded Successfully';
            header('Location: courses.php');
            exit;
        } else {
        echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
<?php include('header.php'); ?>
<?php include('sidebar.php'); ?> 
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Teacher Information</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Parent</a></li>
                    <li class="breadcrumb-item active">Teacher</li>
                </ol>
            </div><!-- /.col -->
            <?php
                if(isset($_SESSION['success_msg'])){ ?>
                    <div class="col-12">
                    <small class="text-success"><?= $_SESSION['success_msg']?></small>
                    </div>
              <?php
              unset($_SESSION['success_msg']);  }
            ?>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <div class="card bg-white">
                <div class="card-body">
                    <div class="table-responsive bg-white">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $user_query = 'SELECT * FROM accounts WHERE `type` = "teacher" ';
                            $user_result = mysqli_query($db_conn, $user_query);
                            while ($users = mysqli_fetch_object($user_result)) { ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?php echo $users->name ?></td>
                                <td><?php echo $users->email ?></td>
                                <td><?php echo $users->mobile ?></td>
                            </tr>
                            <?php  }
                            ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->
<?php include('footer.php'); ?>