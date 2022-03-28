<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
if (isset($_POST['delete'])){
    $did = $_POST['id'];
    mysqli_query($db_conn,"DELETE FROM holiday WHERE `id` = '$did' ");
}
?>
<div class="container">
    <div class="col-lg-12"><br><br>
        <div class="card">
                <div class="card-body">
                <h1 class="text-warning text-center">Display</h1>
            <input type="button" class="btn btn-light mb-2" value="Insert Holiday" onClick="myFunction()" />
            <table class="table table-striped table-light text-dark table-boardered">
                <tr class="text-center">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Start Holiday</th>
                    <th>End Holiday</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $query = mysqli_query($db_conn, "select * from holiday");
                while ($res = mysqli_fetch_array($query)) {
                ?>
                <form action="" method="post">
                    <tr class="text-center">
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['name'] ?></td>
                        <td><?php echo date("d-m-Y", strtotime($res['start_holiday'])) ?></td>
                        <td><?php echo date("d-m-Y", strtotime($res['end_holiday'])) ?></td>
                        <td> <button class="btn-primary btn"> <a href="edit.php?id=<?php echo $res['id']; ?>" class="text-white"> Edit </a> </button> </td>
                        <td><input type=hidden name=id value="<?= $res['id'] ?>"><button value="Delete" name="delete" class="btn btn-danger">Delete</button></td>
                    </tr>
                    </form>
                <?php
                }
                ?>
            </table>
                </div>
            </div>
            <script>
                function myFunction() {
                    window.location.href = "http://localhost:7882/school/admin/holiday.php";
                }
            </script>

        </div>
    </div>
    <?php include('footer.php'); ?>

