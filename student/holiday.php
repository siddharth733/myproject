<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<div class="container">
    <div class="col-lg-12"><br><br>
        <div class="card">
                <div class="card-body">
                <h1 class="text-warning text-center">Display</h1>
            <table class="table table-striped table-light text-dark table-boardered">
                <tr class="text-center">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Start Holiday</th>
                    <th>End Holiday</th>
                </tr>
                <?php
                $query = mysqli_query($db_conn, "select * from holiday");
                while ($res = mysqli_fetch_array($query)) {
                ?>
                    <tr class="text-center">
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['name'] ?></td>
                        <td><?php echo date("d-m-Y", strtotime($res['start_holiday'])) ?></td>
                        <td><?php echo date("d-m-Y", strtotime($res['end_holiday'])) ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
                </div>
            </div>

        </div>
    </div>
    <?php include('footer.php'); ?>

