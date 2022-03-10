<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<?php
if (isset($_POST['submit'])) {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $from = isset($_POST['from']) ? $_POST['from'] : '';
    $to = isset($_POST['to']) ? $_POST['to'] : '';
    $status = 'publish';
    $type = 'period';
    $data_add = date('Y-m-d g:i:s');

    $querry = mysqli_query($db_conn, "INSERT INTO `posts` (`title`,`status`,`publish_date`,`type`) VALUES ('$title','$status','$data_add','$type')");
    if ($querry) {
        $item_id = mysqli_insert_id($db_conn);
    }
    mysqli_query($db_conn, "INSERT INTO `metadata` (`meta_key`,`meta_value`,`item_id`) VALUES ('from','$from','$item_id')");
    mysqli_query($db_conn, "INSERT INTO `metadata` (`meta_key`,`meta_value`,`item_id`) VALUES ('to','$from','$item_id')");
}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Periods</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Teacher</a></li>
                    <li class="breadcrumb-item active">Periods</li>
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
                        <h3 class="card-title">Periods</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive bg-white">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>From</th>
                                        <th>To</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    $args = array(
                                        'type' => 'period',
                                        'status' => 'publish',
                                    );
                                    $periods = get_posts($args);
                                    foreach ($periods as $period) {
                                        $from = get_metadata($period->id, 'from')[0]->meta_value;
                                        $to = get_metadata($period->id, 'to')[0]->meta_value;
                                    ?>

                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= $period->title ?></td>
                                            <td><?php echo date('h:i A',strtotime($from)) ?></td>
                                            <td><?php echo date('h:i A',strtotime($to)) ?></td>
                                        </tr>

                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-white">
                    <div class="card-header">
                        <h3 class="card-title">Add New Period</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" placeholder="Enter Class Name" class="form-control bg-white" required>
                            </div>
                            <div class="form-group">
                                <label for="name">From</label>
                                <input type="time" name="from" class="form-control bg-white" required>
                            </div>
                            <div class="form-group">
                                <label for="name">To</label>
                                <input type="time" name="to" class="form-control bg-white" required>
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