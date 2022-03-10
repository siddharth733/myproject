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
    foreach ($_POST['section'] as $val) {
        mysqli_query($db_conn, "INSERT INTO attendance (`name`,`class`,`section`) VALUES ('$user_id','section','$val')");
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
                    <li class="breadcrumb-item"><a href="#">Parent</a></li>
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
                                    <th>Present Date</th>
                                    <th>Student Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $id = $_SESSION['id'] - 1; 
                            $querry = mysqli_query($db_conn,"SELECT * FROM attendance WHERE `user_meta`='$id'");
                            while($result = mysqli_fetch_object($querry)){
                                $my_date = $result->date;
                                $querry1 = mysqli_query($db_conn,"SELECT * FROM busattendance WHERE `meta_value`='$id' AND `date`= '$my_date' ");
                                while($result1 = mysqli_fetch_object($querry1)){  ?>
                               <tr>
                               <td><?= $result->date ?></td>
                                <td><?= $result->name ?></td>
                                <td>"Present in Both"</td>
                               </tr>
                            <?php } }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <!--/. container-fluid -->
</section>
<!-- /.content -->
<?php include('footer.php'); ?>