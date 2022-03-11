<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<!-- Content Header (Page header) -->
  <div class="header">
    <div class="row">
      <?php
      $email = $_SESSION['email'];
      if (!(isset($_SESSION['email']))) {
        header("location:index.php");
      } else {
        $name = $_SESSION['name'];
      } ?>

    </div>
  </div>
  <!-- admin start-->

  <!--navigation menu-->
  <nav class="nav navbar justify-content-center">
  <li <?php if (@$_GET['q'] == 0) echo 'class="active"'; ?>><a href="dash.php?q=0" class="text-success"><h4>Home </h4><span class="sr-only">(current)</span></a></li>
          <li <?php if (@$_GET['q'] == 2) echo 'class="active"'; ?>><a href="dash.php?q=2" class="nav-link text-success"><h4>User Score</h4></a></li>
          <li <?php if (@$_GET['q'] == 1) echo 'class="active"'; ?>><a href="dash.php?q=1" class="nav-link text-success"><h4>Users</h4></a></li>
          <li <?php if (@$_GET['q'] == 4) echo 'class="active"'; ?>><a href="dash.php?q=4" class="nav-link text-success"><h4>Add Exams</h4></a></li>
  </nav>
  <!--navigation menu closed-->
  <div class="container mt-5">
    <!--container start-->
    <div class="row">
      <div class="col-md-12">
        <!--home start-->

        <?php if (@$_GET['q'] == 0) {

          $result = mysqli_query($db_conn, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
          echo  '<div class="panel"><table class="table bg-dark table-striped title1">
  <tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
            $c = 1;
            while ($row = mysqli_fetch_array($result)) {
              $title = $row['title'];
              $total = $row['total'];
              $sahi = $row['sahi'];
              $time = $row['time'];
              $eid = $row['eid'];
              echo '<tr style="color:#2db44a"><td>' . $c++ . '</td><td>' . $title . '</td><td>' . $total . '</td><td>' . $sahi * $total . '</td><td>' . $time . '&nbsp;min</td>
    <td><b><a href="update.php?q=rmquiz&eid=' . $eid . '" class="pull-right btn btn-danger" style="margin:0px; border-radius:0%;"><span class="glyphicon glyphicon-trash"  aria-hidden="true"></span>&nbsp;<span class="title1"><b>Remove</b></span></a></b></td></tr>';
            }
            $c = 0;
            echo '</table></div>';
          }

          //ranking start
          if (@$_GET['q'] == 2) {
             echo  '<div class="panel title">
  <table class="table bg-dark table-striped title1" >
  <tr style="color:white"><td><b>S.N.</b></td><td><b>Name</b></td><td><b>Email</b></td><td><b>Exams</b></td><td><b>Question Solved</b></td><td><b>Right</b></td><td><b>Wrong<b></td><td><b>Score</b></td>';
  $ans = mysqli_query($db_conn,"SELECT * FROM accounts WHERE type='student'");
            while($ans1 = mysqli_fetch_object($ans)){
            $chec = $ans1->email;
             $q = mysqli_query($db_conn, "SELECT * FROM history WHERE email='$chec' ORDER BY date DESC ") or die('Error197');
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
               echo '<tr style="color:#2db44a"><td>' . $c . '</td><td>' . $ans1->name . '</td><td>' . $ans1->email . '</td><td>' . $title . '</td><td>' . $qa . '</td><td>' . $r . '</td><td>' . $w . '</td><td>' . $s . '</td></tr>';
             }
            }
             echo '</table></div>';
          }
          ?>



          <!--home closed-->
          <!--users start-->
          <?php if (@$_GET['q'] == 1) {

            $result = mysqli_query($db_conn, "SELECT * FROM accounts WHERE type='student'") or die('Error');
            echo  '<div class="panel"><table class="table bg-dark table-striped title1">
  <tr><td><b>S.N.</b></td><td><b>Name</b></td><td><b>Email</b></td><td><b>Mobile</b></td><td></td></tr>';
            $c = 1;
            while ($row = mysqli_fetch_array($result)) {
              $name = $row['name'];
              $mob = $row['mobile'];
              $email = $row['email'];

              echo '<tr style="color:#2db44a"><td>' . $c++ . '</td><td>' . $name . '</td><td>' . $email . '</td><td>' . $mob . '</td>
    <td><a title="Delete User" href="update.php?demail=' . $email . '"><b><span class="glyphicon glyphicon-trash" style="color:red;" aria-hidden="true"></span></b></a></td></tr>';
            }
            $c = 0;
            echo '</table></div>';
          } ?>
          <!--user end-->

          <!--feedback start-->
          <?php if (@$_GET['q'] == 3) {
            $result = mysqli_query($db_conn, "SELECT * FROM `feedback` ORDER BY `feedback`.`date` DESC") or die('Error');
            echo  '<div class="panel"><table class="table table-striped title1">
  <tr><td><b>S.N.</b></td><td><b>Subject</b></td><td><b>Email</b></td><td><b>Date</b></td><td><b>Time</b></td><td><b>By</b></td><td></td><td></td></tr>';
            $c = 1;
            while ($row = mysqli_fetch_array($result)) {
              $date = $row['date'];
              $date = date("d-m-Y", strtotime($date));
              $time = $row['time'];
              $subject = $row['subject'];
              $name = $row['name'];
              $email = $row['email'];
              $id = $row['id'];
              echo '<tr style="color:#2db44a"><td>' . $c++ . '</td>';
              echo '<td><a title="Click to open feedback" href="dash.php?q=3&fid=' . $id . '">' . $subject . '</a></td><td>' . $email . '</td><td>' . $date . '</td><td>' . $time . '</td><td>' . $name . '</td>
    <td><a title="Open Feedback" href="dash.php?q=3&fid=' . $id . '"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b></a></td>';
              echo '<td><a title="Delete Feedback" href="update.php?fdid=' . $id . '"><b><span class="glyphicon glyphicon-trash" style="color:red;" aria-hidden="true"></span></b></a></td>

    </tr>';
            }
            echo '</table></div>';
          }
          ?>
          <!--feedback closed-->

          <!--feedback reading portion start-->
          <?php if (@$_GET['fid']) {
            echo '<br />';
            $id = @$_GET['fid'];
            $result = mysqli_query($db_conn, "SELECT * FROM feedback WHERE id='$id' ") or die('Error');
            while ($row = mysqli_fetch_array($result)) {
              $name = $row['name'];
              $subject = $row['subject'];
              $date = $row['date'];
              $date = date("d-m-Y", strtotime($date));
              $time = $row['time'];
              $feedback = $row['feedback'];

              echo '<div class="panel"<a title="Back to Archive" href="update.php?q1=2"><b><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span></b></a><h2 style="text-align:center; margin-top:-15px;font-family: "Ubuntu", sans-serif;"><b>' . $subject . '</b></h1>';
              echo '<div class="mCustomScrollbar" data-mcs-theme="dark" style="margin-left:10px;margin-right:10px; max-height:450px; line-height:35px;padding:5px;"><span style="line-height:35px;padding:5px;">-&nbsp;<b>DATE:</b>&nbsp;' . $date . '</span>
  <span style="line-height:35px;padding:5px;">&nbsp;<b>Time:</b>&nbsp;' . $time . '</span><span style="line-height:35px;padding:5px;">&nbsp;<b>By:</b>&nbsp;' . $name . '</span><br />' . $feedback . '</div></div>';
            }
          } ?>
          <!--Feedback reading portion closed-->

          <!--add quiz start-->
          
          <?php
          if (@$_GET['q'] == 4 && !(@$_GET['step'])) {
            echo ' 
            <div class="card">
            <div class="card-body">
  <div class="row">
  <span class="title1" style="margin-left:35%;font-size:40px;"><b>Enter Exam Details</b></span><br /><br />
  <div class="col-md-3"></div><div class="col-md-12">   <form class="form-horizontal title1" name="form" action="update.php?q=addquiz"  method="POST">
  <fieldset>


  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="name"></label>  
    <div class="col-md-12">
    <input id="name" name="name" placeholder="Enter Exam Title" class="form-control input-md" type="text">
      
    </div>
  </div>



  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="total"></label>  
    <div class="col-md-12">
    <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number">
      
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="right"></label>  
    <div class="col-md-12">
    <input id="right" name="right" placeholder="Enter marks on right answer" class="form-control input-md" min="0" type="number">
      
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="wrong"></label>  
    <div class="col-md-12">
    <input id="wrong" name="wrong" placeholder="Enter minus marks on wrong answer without sign" class="form-control input-md" min="0" type="number">
      
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="time"></label>  
    <div class="col-md-12">
    <input id="time" name="time" placeholder="Enter time limit for test in minute" class="form-control input-md" min="1" type="number">
      
    </div>
  </div>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="tag"></label>  
    <div class="col-md-12">
    <input id="tag" name="tag" placeholder="Enter #tag which is used for searching" class="form-control input-md" type="text">
      
    </div>
  </div>


  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="desc"></label>  
    <div class="col-md-12">
    <textarea rows="8" cols="8" name="desc" class="form-control" placeholder="Write description here..."></textarea>  
    </div>
  </div>


  <div class="form-group">
    <label class="col-md-12 control-label" for=""></label>
    <div class="col-md-12"> 
      <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
    </div>
  </div>

  </fieldset>
  </form></div></div>
  </div>';
          }
          ?>
          <!--add exam end-->

          <!--add exam step2 start-->
          <?php
          if (@$_GET['q'] == 4 && (@$_GET['step'])) {
            echo ' 
  <div class="row">
  <span class="title1" style="margin-left:40%;font-size:30px;"><b>Enter Question Details</b></span><br /><br />
  <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="update.php?q=addqns&n=' . @$_GET['n'] . '&eid=' . @$_GET['eid'] . '&ch=4 "  method="POST">
  <fieldset>
  ';

            for ($i = 1; $i <= @$_GET['n']; $i++) {
              echo '<b>Question number&nbsp;' . $i . '&nbsp;:</><br /><!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="qns' . $i . ' "></label>  
    <div class="col-md-12">
    <textarea rows="3" cols="5" name="qns' . $i . '" class="form-control" placeholder="Write question number ' . $i . ' here..."></textarea>  
    </div>
  </div>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="' . $i . '1"></label>  
    <div class="col-md-12">
    <input id="' . $i . '1" name="' . $i . '1" placeholder="Enter option a" class="form-control input-md" type="text">
      
    </div>
  </div>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="' . $i . '2"></label>  
    <div class="col-md-12">
    <input id="' . $i . '2" name="' . $i . '2" placeholder="Enter option b" class="form-control input-md" type="text">
      
    </div>
  </div>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="' . $i . '3"></label>  
    <div class="col-md-12">
    <input id="' . $i . '3" name="' . $i . '3" placeholder="Enter option c" class="form-control input-md" type="text">
      
    </div>
  </div>
  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-12 control-label" for="' . $i . '4"></label>  
    <div class="col-md-12">
    <input id="' . $i . '4" name="' . $i . '4" placeholder="Enter option d" class="form-control input-md" type="text">
      
    </div>
  </div>
  <br />
  <b>Correct answer</b>:<br />
  <select id="ans' . $i . '" name="ans' . $i . '" placeholder="Choose correct answer " class="form-control input-md" >
    <option value="a">Select answer for question ' . $i . '</option>
    <option value="a">option a</option>
    <option value="b">option b</option>
    <option value="c">option c</option>
    <option value="d">option d</option> </select><br /><br />';
            }

            echo '<div class="form-group">
    <label class="col-md-12 control-label" for=""></label>
    <div class="col-md-12"> 
      <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
    </div>
  </div>

  </fieldset>
  </form></div>';
        }
        ?>
        <!--add exam step 2 end-->

        <!--remove exam-->



      </div>
      <!--container closed-->
    </div>
  </div>
<!-- /.content -->
<?php include('footer.php'); ?>