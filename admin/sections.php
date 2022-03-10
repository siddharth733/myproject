<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $data_add = date('Y-m-d g:i:s');
    mysqli_query($db_conn, "INSERT INTO posts (`author`,`title`,`description`,`type`,`publish_date`,`status`) VALUES ('1','$title','$title Descrpiption','section','$data_add','publish')");
}
if (isset($_POST['delete'])){
    $did = $_POST['id'];
    mysqli_query($db_conn,"DELETE FROM posts WHERE `type` = 'section' AND `id` = '$did' ");
}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Sections</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Sections</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card bg-white">
                    <div class="card-header">
                        <h3 class="card-title">Sections</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                        <div class="table-responsive bg-white">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    $args = array(
                                        'type' => 'section',
                                        'status' => 'publish',
                                    );
                                    $sections = get_posts($args);
                                    foreach($sections as $section){ ?>

                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= $section->title ?></td>
                                            <td><input type=hidden name=id value="<?= $section->id ?>"><button  value="Delete" name="delete" value="submit" class="btn btn-danger">Delete</button></td>
                                        </tr>

                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-white">
                    <div class="card-header">
                        <h3 class="card-title">Add New Sections</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" name="title" placeholder="Enter Class Name" class="form-control bg-white" required>
                            </div>
                            <button name="submit" class="btn btn-success float-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Info boxes -->

        <!-- /.row -->
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->
<?php include('footer.php'); ?>