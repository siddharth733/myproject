<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Classes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Student</a></li>
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
            <!-- Info boxes -->
            <div class="card bg-white">
                <div class="card-header">
                    <h3 class="card-title">Classes</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive bg-white">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Section</th>
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
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->
<?php include('footer.php'); ?>