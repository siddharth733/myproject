<?php include('header.php'); ?>
<?php
if (isset($_POST['submit'])) {
    // echo'<pre>';
    // print_r($_POST);
    // echo'</pre>';
    $class = $_POST['class'];
    $section = $_POST['section'];
    $subject = $_POST['subject'];
    $data_add = date('Y-m-d');

    $querry = mysqli_query($db_conn, "INSERT INTO posts (`author`,`title`,`description`,`type`,`publish_date`,`status`) VALUES ('1','$subject','Descrpiption','subject','$data_add','publish')");

    if ($querry) {
        $user_id = mysqli_insert_id($db_conn);
    }

    mysqli_query($db_conn,"INSERT INTO metadata (`item_id`,`meta_key`,`meta_value`) VALUES ('$user_id','class_id','$class')");
    mysqli_query($db_conn,"INSERT INTO metadata (`item_id`,`meta_key`,`meta_value`) VALUES ('$user_id','section_id','$section')");
}
?>
<?php include('sidebar.php'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Subjects</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Subjects</li>
                </ol>
            </div><!-- /.col -->
            <?php
            if (isset($_SESSION['success_msg'])) { ?>
                <div class="col-12">
                    <small class="text-success"><?= $_SESSION['success_msg'] ?></small>
                </div>
            <?php
                unset($_SESSION['success_msg']);
            }
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
                            <input type="file" name="thumbnail" id="thumbnail" required>
                        </div>
                        <button class="btn btn-success" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <!-- Info boxes -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Add New Sunjects
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="class">Select Class</label>
                                <select name="class" id="class" class="form-control">
                                    <option value="Select Class">Select Class</option>
                                    <?php 
                                    $args = array(
                                        'type' => 'class',
                                        'status' => 'publish',
                                    );
                                    $classes = get_posts($args);
                                            foreach($classes as $class){ ?>
                                                <option value="<?php echo $class->id ?>"><?php echo $class->title; ?></option>
                                           <?php } ?>
                                </select>
                            </div>
                            <div class="form-group" id="section-container">
                                <label for="section">Select Section</label>
                                <select name="section" id="section" class="form-control">
                                    <option value="Select Class">Select Section</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject Name</label>
                                <input type="text" name="subject" class="form-control" placeholder="Subject Name" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-light" value="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card bg-white">
                    <div class="card-header">
                        <h3 class="card-title">Courses</h3>
                        <div class="card-tools">
                            <a href="?action=add-new" class="btn btn-success"><i class="fa fa-plus mr-2"></i> Add Course</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive bg-white">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Class</th>
                                        <th>Section</th>
                                        <th>Subject</th>
                                        <th>Publish Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    $args = array(
                                        'type' => 'subject',
                                        'status' => 'publish',
                                    );
                                    $subjects = get_posts($args);
                                    foreach($subjects as $subject) { ?>
                                        <tr>
                                        <td><?= $count++ ?></td>
                                            <td>
                                                <?php
                                                    $class_meta = get_metadata($subject->id,'class_id');
                                                        foreach($class_meta as $meta){
                                                            // print_r(get_post(array('id'=>$meta->meta_value)));
                                                            $show = get_post(array('id'=>$meta->meta_value));
                                                            echo $show->title."<br>";
                                                        }
                                                ?>
                                            </td>
                                            <td>
                                            <?php
                                                    $section_meta = get_metadata($subject->id,'section_id');
                                                        foreach($section_meta as $meta){
                                                            // print_r(get_post(array('id'=>$meta->meta_value)));
                                                            $show = get_post(array('id'=>$meta->meta_value));
                                                            echo $show->title."<br>";
                                                        }
                                                ?>
                                            </td>
                                            <td><?= $subject->title ?></td>
                                            <td><?= $subject->publish_date ?></td>
                                        </tr>

                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
            <!-- /.row -->
        <?php } ?>
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->
<?php include('footer.php'); ?>