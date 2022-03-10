<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    // echo'<pre>';
    // print_r($_POST);
    // echo'</pre>';
    $sections = $_POST['section'];
    // $sections = implode(' ', $_POST['section']);
    $data_add = date('Y-m-d');
    $querry = mysqli_query($db_conn, "INSERT INTO posts (`author`,`title`,`description`,`type`,`publish_date`,`status`) VALUES ('1','$title','$title Descrpiption','class','$data_add','publish')");

    if ($querry) {
        $user_id = mysqli_insert_id($db_conn);
    }
        foreach($_POST['section'] as $val){
            mysqli_query($db_conn,"INSERT INTO metadata (`item_id`,`meta_key`,`meta_value`) VALUES ('$user_id','section','$val')");
        }
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Classes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Teacher</a></li>
                    <li class="breadcrumb-item active">Classes</li>
                </ol>
            </div><!-- /.col -->
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
                    <h3 class="card-title">Add New Classes</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" name="title" placeholder="Enter Class Name" class="form-control bg-white" required><br>
                            <label for="name">Sections</label>
                            <?php
                            $count = 1;
                            $args = array(
                                'type' => 'section',
                                'status' => 'publish',
                            );
                            $sections = get_posts($args);
                            foreach($sections as $section){ ?>
                                <div>
                                    <label for="<?= $count++ ?>">
                                        <input type="checkbox" id="<?= $count++ ?>" name="section[]" value="<?= $section->id ?>">
                                        <?= $section->title ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                        <button class="btn btn-success" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <!-- Info boxes -->
            <div class="card bg-white">
                <div class="card-header">
                    <h3 class="card-title">Classes</h3>
                    <div class="card-tools">
                        <a href="?action=add-new" class="btn btn-success"><i class="fa fa-plus mr-2"></i> Add Class</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive bg-white">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Section</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $args = array(
                                    'type' => 'class',
                                    'status' => 'publish',
                                );
                                $classes = get_posts($args);
                               foreach($classes as $class) { ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= $class->title ?></td>
                                        <td>
                                        <?php
                                            $class_meta = get_metadata($class->id,'section');
                                                foreach($class_meta as $meta){
                                                    // print_r(get_post(array('id'=>$meta->meta_value)));
                                                    $show = get_post(array('id'=>$meta->meta_value));
                                                    echo $show->title."<br>";
                                                }
                                        ?>
                                        </td>
                                        <td><button class="btn btn-danger">Delete</button></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
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