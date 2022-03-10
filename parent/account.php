<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
  <div class="header">
    <div class="row">
      <div class="col-md-4 col-md-offset-2">
        <?php
        if (!(isset($_SESSION['email']))) {
          header("location:index.php");
        } else {
          $name = $_SESSION['name'];
          $email = $_SESSION['email'];  
        } ?>
      </div>
    </div>
  </div>
    <!--navigation menu closed-->
    <div class="container">
      <!--container start-->
      <div class="row">
        <div class="col-md-12">
        <table class="table table-responsive-md m-5">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Email</th>
              <th>Score</th>
            </tr>
          </thead>
          <tbody class="bg-white">
          <?php
            $id = $_SESSION['id'] - 1;
            $cheack1 = mysqli_query($db_conn, "SELECT * FROM accounts WHERE id='$id'");;
            while ($row1 = mysqli_fetch_object($cheack1)) {
            $ans = $row1->email;
            $q = mysqli_query($db_conn, "SELECT * FROM rank WHERE `email`='$ans' ORDER BY score DESC ") or die('Error223');
            $c = 1;
            while ($row = mysqli_fetch_array($q)) {
              $s = $row['score'];
              $e = $row['email']; ?>
                <tr>
                  <td><?= $c ?></td>
                  <td><?= $row1->name ?></td>
                  <td><?= $e ?></td>
                  <td><?= $s ?></td>
                </tr>
               <?php }
              $c++;
            } 
            ?>
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>

  <?php include('footer.php'); ?>