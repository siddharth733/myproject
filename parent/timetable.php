<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Time Table</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Parent</a></li>
                    <li class="breadcrumb-item active">Time Table</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
            <div class="card">
                <div class="card-body bg-white">
                    <table class="table table-bordered">
                    <thead class=" text-center">
                        <tr>
                            <th>Timing</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wedensday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                            <th>Sunday</th>
                        </tr>
                        </thead>
                        <tbody style="font-size: small">
                            <?php
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
                                    <td><?php echo date('h:i A', strtotime($from)) ?> - <?php echo date('h:i A', strtotime($to)) ?></td>
                                    <?php
                                    $days = ['monday', 'tuesday', 'wedensday', 'thursday', 'friday', 'saturday', 'sunday'];
                                    foreach ($days as $day) {
                                        $id = $_SESSION['id'];
                                        $query1 = mysqli_query($db_conn,"SELECT * FROM `usermeta` WHERE `user_id` = '$id' AND `meta_key` = 'class'");
                                        $result1 = mysqli_fetch_object($query1);
                                        $query2 = mysqli_query($db_conn,"SELECT * FROM `usermeta` WHERE `user_id` = '$id' AND `meta_key` = 'section'");
                                        $result2 = mysqli_fetch_object($query2);
                                        $ans =  $result1->meta_value;
                                        $ans1 =  $result2->meta_value;
                                        $querry = mysqli_query($db_conn, "SELECT * FROM posts as p INNER JOIN metadata as mc ON (mc.item_id = p.id) INNER JOIN metadata as mk ON (mk.item_id = p.id) INNER JOIN metadata as md ON (md.item_id = p.id) INNER JOIN metadata as mp ON (mp.item_id = p.id) WHERE p.type = 'timetable' AND p.status = 'publish' AND md.meta_key = 'day_name' AND md.meta_value='$day' AND mp.meta_key = 'period_id' AND mp.meta_value=$period->id AND mc.meta_key = 'class_id' AND mc.meta_value = $ans AND mk.meta_key = 'section_id' AND mk.meta_value = $ans1");
                                        if (mysqli_num_rows($querry) > 0) {
                                            while ($timetable = mysqli_fetch_object($querry)) { ?>
                                                <td>
                                                    <p>
                                                        <b>Teacher : </b><?php $teacher_id = get_metadata($timetable->item_id, 'teacher_id',)[0]->meta_value;
                                                                        print_r(get_user_data($teacher_id)[0]->name);
                                                                        ?><br>
                                                        <b>Subject : </b><?php $class_id = get_metadata($timetable->item_id, 'subject_id',)[0]->meta_value;
                                                                        echo get_post(array('id'=>$class_id))->title;
                                                                        ?>
                                                        <br>
                                                    </p>
                                                </td>
                                            <?php }
                                        } else { ?>
                                            <td>Unscheduled</td>
                                    <?php }
                                    } ?>
                                </tr>
                            <?php  }  ?>
                        </tbody>

                    </table>
                </div>
            </div>
    </div>
<!--/. container-fluid -->
</section>
<?php include('footer.php'); ?>