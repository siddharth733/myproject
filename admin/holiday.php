<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
if (isset($_POST['done'])) {
    $name = $_POST['name'];
    $start_holiday = $_POST['start_holiday'];
    $end_holiday = $_POST['end_holiday'];
    mysqli_query($db_conn, "INSERT INTO holiday (`name`,`start_holiday`,`end_holiday`) VALUES ('$name','$start_holiday','$end_holiday')");
}
?>
    <div class="col-lg-6 m-auto">

        <form action="" method="post">

            <br><br>
            <div class="card p-5">

                <div class="card-header bg-dark">
                    <h1 class="text-white text-center"> Insert Holiday </h1>
                </div>
            <input type="button" class="btn btn-light m-2" value="View Holiday" onClick="myFunction()" />
                <br>

                <label> Name: </label>
                <input type="text" name="name" class="form-control" required> <br>

                <label>Start Holiday</label>
                <input type="date" name="start_holiday" class="form-control" required><br>

                <label>End Holiday</label>
                <input type="date" name="end_holiday" class="form-control" required><br>

                <button class="btn btn-success" type="submit" name="done"> Submit </button><br>
            </div>
        </form>
    </div>
    <script>
                function myFunction() {
                    window.location.href = "http://localhost:7882/school/admin/display.php";
                }
            </script>
    <?php include('footer.php'); ?>