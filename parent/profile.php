<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Parent</a></li>
                    <li class="breadcrumb-item active">Profile</li>
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
                    <h3 class="card-title">Information</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <!-- <th></th>
                                <th></th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $id = $_SESSION['id'];
                            $query = mysqli_query($db_conn,"SELECT * FROM `usermeta` WHERE `user_id` = '$id'");
                            while($result = mysqli_fetch_object($query)){ ?>
                                <tr>
                                    <td><?= $result->meta_key ?></td>
                                    <td><?= $result->meta_value ?></td>
                                </tr>
                                <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->
    </div>
    <!--/. container-fluid -->
</section>
<!-- /.content -->
<?php include('footer.php'); ?>