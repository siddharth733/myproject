<?php include('header.php'); ?>
<?php
if (isset($_POST['submit'])) {
    // echo'<pre>';
    // print_r($_POST);
    // echo'</pre>';

    $name = $_POST['name'];
    $category = $_POST['category'];
    $duration = $_POST['duration'];
    $detail = $_POST['detail'];
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
            mysqli_query($db_conn,"INSERT INTO courses (`name`,`category`,`duration`,`date`,`image`,`detail`) VALUES ('$name','$category','$duration','$today','$image','$detail')")
            or die(mysqli_error($db_conn));
            $_SESSION['success_msg'] = 'Course Uploaded Successfully';
            header('Location: courses.php');
            exit;
        } else {
        echo "Sorry, there was an error uploading your file.";
        }
    }
}

if (isset($_POST['delete'])){
    $did = $_POST['id'];
  mysqli_query($db_conn,"DELETE FROM courses WHERE `id` = '$did' ");
}
?>
<?php include('sidebar.php'); ?> 
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Courses</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Courses</li>
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
        <?php
        if (isset($_REQUEST['action'])) { ?>
            <div class="card bg-white">
                <div class="card-header">
                    <h3 class="card-title">Add New Course</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Course Name</label>
                            <input type="text" name="name" placeholder="Course Title" class="form-control bg-white" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Course Category</label>
                            <select name="category" id="category" class="form-control" required>
                                <option value="">Select Category</option>
                                <option value="web-design-and-devlopment">Web Design & Devlopment</option>
                                <option value="app-devlopment">Android Devlopment</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="duration">Course Duration</label>
                            <input type="text" name="duration" id="duration" class="form-control bg-white" placeholder="Duration" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Course Details</label>
                            <textarea name="detail" cols="30" rows="5" class="form-control bg-white" placeholder="Enter Course Details" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="thumbnail" id="thumbnail" required>
                        </div>
                        <button class="btn btn-success" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <!-- Info boxes -->
            <div class="card bg-white">
                <div class="card-header">
                    <h3 class="card-title">Courses</h3>
                    <div class="card-tools">
                        <a href="?action=add-new" class="btn btn-success"><i class="fa fa-plus mr-2"></i> Add Course</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                    <div class="table-responsive bg-white">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Duration</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $course_query = mysqli_query($db_conn, "SELECT * FROM courses");
                                while ($course = mysqli_fetch_object($course_query)) { ?>

                                    <tr>
                                        <td><?=$count++?></td>
                                        <td><img src="../uploads/<?= $course->image ?>" height="100" alt=""></td>
                                        <td><?= $course->name?></td>
                                        <td><?= $course->category?></td>
                                        <td><?= $course->duration?></td>
                                        <td><?= $course->date?></td>
                                        <td><input type=hidden name=id value="<?= $course->id ?>"><button  value="Delete" name="delete" value="submit" class="btn btn-danger">Delete</button></td>
                                    </tr>

                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        <?php } ?>
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->
<?php include('footer.php'); ?>