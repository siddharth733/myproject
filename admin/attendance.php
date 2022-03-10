<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
if(isset($_POST['search'])){
    $class_name = $_POST['class'] ;
    $section_name = $_POST['section'];
}
if (isset($_POST['submit'])) {
    $sections = $_POST['section'];
    // $sections = implode(' ', $_POST['section']);
    $data_add = date('Y-m-d');
    foreach ($_POST['section'] as $val) {
    $querry = mysqli_query($db_conn,"SELECT * FROM accounts WHERE `id`='$val'");
    while($result=mysqli_fetch_object($querry)){
        $name = $result->name;
        $class = $_GET['class'];
        $sec = $_GET['section'];
        mysqli_query($db_conn, "INSERT INTO attendance (`name`,`class`,`section`,`user_meta`,`date`) VALUES ('$name','$class','$sec','$val','$data_add')");
        // echo'<pre>';
        // print_r($result);
        // echo'</pre>';
    }
    }
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Student Attendance</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Attendance</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
       <?php if(isset($_GET['search']) && $_GET['search'] == ''){ ?>
        <div class="card bg-white">
            <div class="card-header">
                <h3 class="card-title">Students</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Present</th>
                                    <th>Student Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $ans = $_GET['class'];
                                $ans1 = $_GET['section'];
                                $querry = mysqli_query($db_conn,"SELECT * FROM accounts as a INNER JOIN usermeta as u ON (u.user_id = a.id+1) INNER JOIN usermeta as us ON (us.user_id = a.id+1) WHERE a.type = 'student' AND u.meta_key='class' AND u.meta_value = $ans AND us.meta_key='section' AND us.meta_value = $ans1");
                                // $querry = mysqli_query($db_conn,"SELECT * FROM accounts as a INNER JOIN usermeta as u ON (u.user_id = a.id) INNER JOIN usermeta as su ON (su.user_id = a.id) WHERE a.type = 'student' AND u.meta_key = 'class' AND u.meta_value = $ans AND u.meta_key = 'section' AND u.meta_value = $ans1");
                                while ($result = mysqli_fetch_object($querry)) { ?>
                                    <tr>
                                    <td><input type="checkbox" id="<?= $count++ ?>" name="section[]" value="<?= $result->user_id - 1;?>"></td>
                                    <td>
                                    <?= $result->name; ?>
                                    <input type="hidden" name="name" value="<?= $result->name;?>">
                                    </td>
                                    <input type="hidden" name="id" value="<?= $result->user_id - 1; ?>">
                                    </tr>
                                <?php  }
                                ?>
                            </tbody>
                        </table>
                        <button name="submit" class="btn btn-success">submit</button>
                    </div>
                </form>
            </div>
        </div> <?php } else { ?>
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
       <?php } ?>
        <!--/. container-fluid -->
</section>
<!-- /.content -->
<?php include('footer.php'); ?>