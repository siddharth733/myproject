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
        <div class="col-md-12 mt-5">
          <?php
          $id = $_SESSION['id'] - 1;
          $ans = mysqli_query($db_conn,"SELECT * FROM accounts WHERE id='$id'");
          $ans1 = mysqli_fetch_object($ans);
          $chec = $ans1->email;
           $q = mysqli_query($db_conn, "SELECT * FROM history WHERE email='$chec' ORDER BY date DESC ") or die('Error197');
           echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:white"><td><b>S.N.</b></td><td><b>Exams</b></td><td><b>Question Solved</b></td><td><b>Right</b></td><td><b>Wrong<b></td><td><b>Score</b></td>';
           $c = 0;
           while ($row = mysqli_fetch_array($q)) {
             $eid = $row['eid'];
             $s = $row['score'];
             $w = $row['wrong'];
             $r = $row['sahi'];
             $qa = $row['level'];
             $q23 = mysqli_query($db_conn, "SELECT title FROM quiz WHERE  eid='$eid' ") or die('Error208');
             while ($row = mysqli_fetch_array($q23)) {
               $title = $row['title'];
             }
             $c++;
             echo '<tr style="color:#2db44a"><td>' . $c . '</td><td>' . $title . '</td><td>' . $qa . '</td><td>' . $r . '</td><td>' . $w . '</td><td>' . $s . '</td></tr>';
           }
           echo '</table></div>'; ?>
        </div>
      </div>
    </div>
  </div>
  <?php include('footer.php'); ?>