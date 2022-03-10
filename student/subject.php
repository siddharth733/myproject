<?php include('header.php'); ?>
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
                    <li class="breadcrumb-item"><a href="#">Student</a></li>
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
            <!-- Info boxes -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card bg-white">
                    <div class="card-header">
                        <h1 class="card-title">Courses</h1>
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
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->
<?php include('footer.php'); ?>