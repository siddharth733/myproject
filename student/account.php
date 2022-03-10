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
  <nav class="nav navbar justify-content-center">
  <li <?php if (@$_GET['q'] == 1) echo 'class="active"'; ?>><a href="account.php?q=1" class="nav-link text-success"><h4>Home</h4></a></li>
            <li <?php if (@$_GET['q'] == 2) echo 'class="active"'; ?>><a href="account.php?q=2" class="nav-link text-success"><h4>History</h4></a></li>
            <li <?php if (@$_GET['q'] == 3) echo 'class="active"'; ?>><a href="account.php?q=3" class="nav-link text-success"><h4>Score</h4></a></li>
  </nav>
    <!--navigation menu closed-->
    <div class="container mt-5">
      <!--container start-->
      <div class="row">
        <div class="col-md-12">
          <!--home start-->
          <?php if (@$_GET['q'] == 1) {
            $result = mysqli_query($db_conn, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
            echo  '<div class="panel"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total Question</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
            $c = 1;
            while ($row = mysqli_fetch_array($result)) {
              $title = $row['title'];
              $total = $row['total'];
              $sahi = $row['sahi'];
              $time = $row['time'];
              $eid = $row['eid'];
              $q12 = mysqli_query($db_conn, "SELECT score FROM history WHERE eid='$eid' AND email='$email'") or die('Error98');
              $rowcount = mysqli_num_rows($q12);
              if ($rowcount == 0) {
                echo '<tr><td>' . $c++ . '</td><td>' . $title . '</td><td>' . $total . '</td><td>' . $sahi * $total . '</td><td>' . $time . '&nbsp;min</td>
	<td><b><a href="account.php?q=quiz&step=2&eid=' . $eid . '&n=1&t=' . $total . '" class="pull-right btn sub1" style="margin:0px;background:#2db44a; border-radius:0%"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';
              } else {
                echo '<tr style="color:#2db44a"><td>' . $c++ . '</td><td>' . $title . '&nbsp;<span title="This exam has been already solved by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td>' . $total . '</td><td>' . $sahi * $total . '</td><td>' . $time . '&nbsp;min</td>
	<td><b><a href="update.php?q=quizre&step=25&eid=' . $eid . '&n=1&t=' . $total . '" class="pull-right btn sub1" style="margin:0px;background:#C82333; border-radius:0%"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Restart</b></span></a></b></td></tr>';
              }
            }
            $c = 0;
            echo '</table></div>';
          } ?>
          <!--<span id="countdown" class="timer"></span>
<script>
var seconds = 40;
    function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds; 
    }
    document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = "Buzz Buzz";
    } else {    
        seconds--;
    }
    }
var countdownTimer = setInterval('secondPassed()', 1000);
</script>-->

          <!--home closed-->

          <!--quiz start-->
          <?php
          if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
            $eid = @$_GET['eid'];
            $sn = @$_GET['n'];
            $total = @$_GET['t'];
            $q = mysqli_query($db_conn, "SELECT  * FROM questions WHERE eid='$eid' AND sn='$sn' ");
            echo '<div class="panel" style="margin:5%">';
            while ($row = mysqli_fetch_array($q)) {
              $qns = $row['qns'];
              $qid = $row['qid'];
              echo '<b>Question &nbsp;' . $sn . '&nbsp;:<br><br>' . $qns . ' <br>';
            }
            $q = mysqli_query($db_conn, "SELECT * FROM options WHERE qid='$qid' ");
            echo '<form action="update.php?q=quiz&step=2&eid=' . $eid . '&n=' . $sn . '&t=' . $total . '&qid=' . $qid . '" method="POST"  class="form-horizontal">
<br />';

            while ($row = mysqli_fetch_array($q)) {
              $option = $row['option'];
              $optionid = $row['optionid'];
              echo '<input type="radio" name="ans" value="' . $optionid . '"><b> ' . $option . ' </b><br><br>';
            }
            echo '<br /><button type="submit" class="btn btn-primary" style="border-radius:0%"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
            //header("location:dash.php?q=4&step=2&eid=$id&n=$total");
          }
          //result display
          if (@$_GET['q'] == 'result' && @$_GET['eid']) {
            $eid = @$_GET['eid'];
            $q = mysqli_query($db_conn, "SELECT * FROM history WHERE eid='$eid' AND email='$email' ") or die('Error157');
            echo  '<div class="panel">
<center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

            while ($row = mysqli_fetch_array($q)) {
              $s = $row['score'];
              $w = $row['wrong'];
              $r = $row['sahi'];
              $qa = $row['level'];
              echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>' . $qa . '</td></tr>
      <tr style="color:#99cc32"><td>right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>' . $r . '</td></tr> 
	  <tr style="color:red"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>' . $w . '</td></tr>
	  <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>' . $s . '</td></tr>';
            }
            $q = mysqli_query($db_conn, "SELECT * FROM rank WHERE  email='$email' ") or die('Error157');
            while ($row = mysqli_fetch_array($q)) {
              $s = $row['score'];
              echo '<tr style="color:#990000"><td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td><td>' . $s . '</td></tr>';
            }
            echo '</table></div>';
          }
          ?>
          <!--quiz end-->
          <?php
          //history start
          if (@$_GET['q'] == 2) {
            $q = mysqli_query($db_conn, "SELECT * FROM history WHERE email='$email' ORDER BY date DESC ") or die('Error197');
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
            echo '</table></div>';
          }

          //ranking start
          if (@$_GET['q'] == 3) {
            echo  '<div class="panel title">
            <table class="table table-striped title1" >
            <tr style="color:white">
            <th><b>S.No</b></th>
            <th><b>Name</b></th>
            <th><b>Score</b></th>
            </tr>'; 
            $c = 0;
            $cheack1 = mysqli_query($db_conn, "SELECT * FROM accounts WHERE type='student'");;
            while ($row1 = mysqli_fetch_object($cheack1)) {
            $id = $row1->email;
            $q = mysqli_query($db_conn, "SELECT * FROM rank WHERE email='$id' ORDER BY score DESC") or die('Error223');
            while ($row = mysqli_fetch_array($q)) {
              $e = $row['email'];
              $s = $row['score'];
              $q12 = mysqli_query($db_conn, "SELECT * FROM accounts WHERE email='$e' ") or die('Error231');
              while ($row = mysqli_fetch_array($q12)) {
                $name = $row['name'];
                $gender = $row['mobile'];
              }
              $c++;
              echo '<tr style="color:#2db44a">
              <td>' . $c . '</td>
              <td>' . $name . '</td>
              <td>' . $s . '</td>';
          }
        }
            echo '</table></div>';
          }
          ?>



        </div>
      </div>
    </div>
  </div>
  <!--Footer start-->

  <!--Modal for admin login-->
  <div class="modal fade" id="login">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title"><span style="color:orange;font-family:'typo' ">LOGIN</span></h4>
        </div>
        <div class="modal-body title1">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <form role="form" method="post" action="admin.php?q=index.php">
                <div class="form-group">
                  <input type="text" name="uname" maxlength="20" placeholder="Admin user id" class="form-control" />
                </div>
                <div class="form-group">
                  <input type="password" name="password" maxlength="15" placeholder="Password" class="form-control" />
                </div>
                <div class="form-group",align="center">
                  <input type="submit" name="login" value="Login" class="btn btn-primary" />
                </div>
              </form>
            </div>
            <div class="col-md-3"></div>
          </div>
        </div>
        <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!--footer end-->

  <?php include('footer.php'); ?>