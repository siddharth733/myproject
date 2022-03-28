<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
if (isset($_POST['done'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $start_holiday = $_POST['start_holiday'];
    $end_holiday = $_POST['end_holiday'];
    mysqli_query($db_conn, "UPDATE holiday set id='$id',name='$name',start_holiday='$start_holiday',end_holiday='$end_holiday' where id=$id");
}

?>
    <div class="col-lg-6 m-auto">

        <form method="post">

            <br><br>
            <div class="card">

               <div class="card-body">
                   <?php
                    $id = $_GET['id'];
                   $querry = mysqli_query($db_conn,"SELECT * FROM holiday WHERE id='$id' ");
                   while($ans = mysqli_fetch_object($querry)){ ?>
               <div class="card-header bg-dark">
                    <h1 class="text-white text-center"> Update Holiday </h1>
            <input type="button" class="btn btn-light mb-2 form-control mt-2" value="View Holiday" onClick="myFunction()" />
                </div><br>

                <label> Name: </label>
                <input type="text" name="name" value="<?= $ans->name ?>" class="form-control"> <br>

                <label>Start Holiday</label>
                <input type="date" name="start_holiday" value="<?= $ans->start_holiday ?>" class="form-control"><br>

                <label>End Holiday</label>
                <input type="date" name="end_holiday" value="<?= $ans->end_holiday ?>" class="form-control"><br>

                <button class="btn btn-success" type="submit" name="done"> Submit </button><br>
               </div>

               <?php }
                   ?>

            </div>
        </form>
    </div>
    <script>
                function myFunction() {
                    window.location.href = "http://localhost:7882/school/admin/display.php";
                }
            </script>
<?php include('footer.php'); ?>