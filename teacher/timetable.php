<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
if(isset($_POST['search'])){
    $class_name = $_POST['class'] ;
    $section_name = $_POST['section'];
}
if (isset($_POST['submit'])) {
    $class_id = isset($_POST['class_id']) ? $_POST['class_id'] : '';
    $section_id = isset($_POST['section_id']) ? $_POST['section_id'] : '';
    $teacher_id = isset($_POST['teacher_id']) ? $_POST['teacher_id'] : '';
    $period_id = isset($_POST['period_id']) ? $_POST['period_id'] : '';
    $day_name = isset($_POST['day_name']) ? $_POST['day_name'] : '';
    $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
    $data_add = date('Y-m-d g:i:s');
    $status = 'publish';
    $author = 1;
    $type = 'timetable';
    $querry = mysqli_query($db_conn, "INSERT INTO posts (`type`,`author`,`status`,`publish_date`) VALUES ('$type','$author','$status','$data_add')");
    if ($querry) {
        $item_id = mysqli_insert_id($db_conn);
    }
    $metadata = array(
        'class_id' => $class_id,
        'section_id' => $section_id,
        'teacher_id' => $teacher_id,
        'period_id' => $period_id,
        'day_name' => $day_name,
        'subject_id' => $subject_id,
    );
    foreach ($metadata as $key => $value) {
        mysqli_query($db_conn, "INSERT INTO metadata (`item_id`,`meta_key`,`meta_value`) VALUES ('$item_id','$key','$value')");
    }
}
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manage Time Table
                    <a href="?action=add" class="btn btn-dark btn-sm">Add New</a>
                </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Teacher</a></li>
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
        <?php if (isset($_GET['action']) && $_GET['action'] == 'add') { ?>
            <div class="card shadow">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-lg">
                                <div class="form-group">
                                    <label for="class_id">Select Class</label>
                                    <select name="class_id" id="class_id" class="form-control">
                                        <option value="Select Class">Select Class</option>
                                        <?php
                                        $args = array(
                                            'type' => 'class',
                                            'status' => 'publish',
                                        );
                                        $classes = get_posts($args);
                                        foreach ($classes as $class) { ?>
                                            <option name="class_value" value="<?php echo $class->id ?>"><?php echo $class->title; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group" id="Section-Container"">
                                <label for=" section_id">Select Section</label>
                                    <select name="section_id" id="section_id" class="form-control">
                                        <option value="Select Section">Select Section</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group" id="Section-Container"">
                                <label for=" teacher_id">Select Teacher</label>
                                    <select name="teacher_id" id="teacher_id" class="form-control">
                                        <option value="Select teacher">Select Teacher</option>
                                        <?php 
                                            $querry = mysqli_query($db_conn,"SELECT * FROM accounts WHERE type = 'teacher' ");
                                            while($result = mysqli_fetch_object($querry)){?>
                                            <option value="<?= $result->id ?>"><?=$result->name?></option>
                                            <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group" id="Section-Container"">
                                <label for=" period_id">Select Period</label>
                                    <select name="period_id" id="period_id" class="form-control">
                                        <option value="Select Period">Select Period</option>
                                        <?php
                                        $args = array(
                                            'type' => 'period',
                                            'status' => 'publish',
                                        );
                                        $periods = get_posts($args);
                                        foreach ($periods as $key => $period) {
                                        ?>
                                            <option value="<?php echo $period->id ?>"><?php echo $period->title ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group" id="Section-Container"">
                                <label for=" day_name">Select Day</label>
                                    <select name="day_name" id="day_name" class="form-control">
                                        <option value="Select Day">Select Day</option>
                                        <?php
                                        $days = ['monday', 'tuesday', 'wedensday', 'thursday', 'friday', 'saturday', 'sunday'];
                                        foreach ($days as $key => $day) { ?>
                                            <option value="<?php echo $day ?>"><?php echo ucwords($day) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="form-group" id="Section-Container"">
                                <label for=" subject_id">Select Subject</label>
                                    <select name="subject_id" id="subject_id" class="form-control">
                                        <option value="Select Subject">Select Subject</option>
                                        <?php
                                        $count = 1;
                                        $args = array(
                                            'type' => 'subject',
                                            'status' => 'publish',
                                        );
                                        $subjects = get_posts($args);
                                        foreach($subjects as $subject) { ?>
                                                    <option value="<?= $subject->id ?>"><?= $subject->title ?></option>
                                            <?php }    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>
                            <input type="submit" name="submit" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        <?php } else if(isset($_GET['search']) && $_GET['search'] == '') { ?>
            <div class="card">
                <div class="card-body  bg-white">
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
                                        $answer = $_GET['class'];
                                        $answer1 = $_GET['section'];
                                        $querry = mysqli_query($db_conn, "SELECT * FROM posts as p INNER JOIN metadata as mc ON (mc.item_id = p.id) INNER JOIN metadata as mk ON (mk.item_id = p.id) INNER JOIN metadata as md ON (md.item_id = p.id) INNER JOIN metadata as mp ON (mp.item_id = p.id) WHERE p.type = 'timetable' AND p.status = 'publish' AND md.meta_key = 'day_name' AND md.meta_value='$day' AND mp.meta_key = 'period_id' AND mp.meta_value=$period->id AND mc.meta_key = 'class_id' AND mc.meta_value = $answer AND mk.meta_key = 'section_id' AND mk.meta_value = $answer1");
                                        if (mysqli_num_rows($querry) > 0) {
                                            while ($timetable = mysqli_fetch_object($querry)) { ?>
                                                <td>
                                                    <p>
                                                        <b>Teacher : </b><?php $teacher_id = get_metadata($timetable->item_id, 'teacher_id',)[0]->meta_value;
                                                                        print_r(get_user_data($teacher_id)[0]->name);
                                                                        ?><br>

                                                        <b>Class : </b><?php $class_id = get_metadata($timetable->item_id, 'class_id',)[0]->meta_value;
                                                                        echo get_post(array('id'=>$class_id))->title;
                                                                        ?><br>
                                                        <b>Section : </b><?php $class_id = get_metadata($timetable->item_id, 'section_id',)[0]->meta_value;
                                                                        echo get_post(array('id'=>$class_id))->title;
                                                                        ?><br>
                                                        <b>Subject : </b><?php $class_id = get_metadata($timetable->item_id, 'subject_id',)[0]->meta_value;
                                                                        echo get_post(array('id'=>$class_id))->title;
                                                                        ?><br>
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
            <?php } else { ?>
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-lg-6">
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
                                        foreach ($classes as $class) { ?>
                                            <option value="<?php echo $class->id ?>"><?php echo $class->title; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group" id="Section-Container"">
                                <label for=" class">Select Section</label>
                                    <select name="section" id="section" class="form-control">
                                        <option value="Select Class">Select Section</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button name="search" class="btn btn-success">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
<?php } ?>
<!--/. container-fluid -->
</section>
<!-- /.content -->
<script>
    jQuery(document).ready(function() {
        jQuery('#class_id').change(function() {
            jQuery.ajax({
                'url': 'ajax.php',
                'type': 'POST',
                'data': {
                    'class_id': jQuery(this).val()
                },
                success: function(response) {
                    jQuery('#section_id').html(response);
                    // console.log(response);
                }
            });
        })
    })
</script>
<?php include('footer.php'); ?>