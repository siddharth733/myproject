<?php include('header.php'); ?>
<?php
if (isset($_POST['submit_value'])) {
  $name = $_POST['name'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $type = $_POST['type'];

  $check_query = mysqli_query($db_conn, "SELECT * FROM accounts WHERE email = '$email'");
  mysqli_query($db_conn, "INSERT INTO accounts (`name`,`mobile`,`email`,`password`,`type`) VALUES ('$name',$mobile,'$email','$password','$type')") or die(mysqli_error($db_conn));
  $_SESSION['success_msg'] = "SuccessFully Registered";
  header('location: user-account.php?user=' . $type);
  exit;
}

if (isset($_POST['submit_value_teacher'])) {
  $name = $_POST['name'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $type = $_POST['type'];
  $class = $_POST['class'];
  $section = $_POST['section'];

  $check_query = mysqli_query($db_conn, "SELECT * FROM accounts WHERE email = '$email'");
  $querry = mysqli_query($db_conn, "INSERT INTO accounts (`name`,`mobile`,`email`,`password`,`type`) VALUES ('$name',$mobile,'$email','$password','$type')") or die(mysqli_error($db_conn));
  if ($querry) {
    $user_id = mysqli_insert_id($db_conn);
    mysqli_query($db_conn,"INSERT INTO usermeta (`user_id`,`meta_key`,`meta_value`) VALUES ($user_id,'teacher_class','$class')");
    mysqli_query($db_conn,"INSERT INTO usermeta (`user_id`,`meta_key`,`meta_value`) VALUES ($user_id,'teacher_section','$section')");
  }
  $_SESSION['success_msg'] = "SuccessFully Registered";
  header('location: user-account.php?user=' . $type);
  exit;
}

if (isset($_POST['delete'])){
    $did = $_POST['id'];
  mysqli_query($db_conn,"DELETE FROM accounts WHERE `id` = '$did' ");
}
?>
<?php include('sidebar.php'); ?>
<style>
  span #loader {
    position: absolute;
    left: 50;
    width: 100%;
    height: 100%;
    background: #a2e2e2b5;
  }

  i.fas.fa-circle-notch.fa-spin {
    left: 50%;
    position: absolute;
    top: 50%;
    font-size: 10rem;
    transform: translate(-50%, -50%);
    transform-origin: center;
  }
  </style>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <div class="d-flex">
          <h1 class="m-0">Manage Accounts
            <a href="user-account.php?user=<?= $_REQUEST['user'] ?>&action=add-new" class="btn btn-dark  btn-sm">Add New</a>
          </h1>
        </div>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Accounts</a></li>
          <li class="breadcrumb-item active"><?php echo ucfirst($_REQUEST['user']) ?></li>
        </ol>
      </div><!-- /.col -->
      <?php
      if (isset($_SESSION['success_msg'])) { ?>
        <div class="col-12">
          <small class="text-success"><?= $_SESSION['success_msg'] ?></small>
        </div>
      <?php unset($_SESSION['success_msg']);
      } ?>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <?php if (isset($_GET['action']) && $_GET['action'] && isset($_GET['user']) && $_GET['user']=="student") { ?>
      <div class="card">
        <div class="card-body">
          <form action="" id="student-registration" method="post">
            <!-- <div class="form-group">
                <input type="text" class="form-control mb-2" placeholder="Enter Full Name" name="name">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" placeholder="Enter Your Email" name="email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Enter Your Password" name="password">
              </div> -->

            <fieldset class="border border-white p-3 form-group">
              <legend class="d-inline w-auto">Student Information</legend>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="">Full Name</label>
                    <input type="text" class="form-control mb-2" placeholder="Enter Full Name" name="name">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="">DOB</label>
                    <input type="date" class="form-control mb-2" placeholder="DOB" name="dob">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="">Mobile</label>
                    <input type="text" class="form-control mb-2" placeholder="Mobile" name="mobile">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control mb-2" placeholder="Email" name="email">
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="">Current Address</label>
                    <input type="text" class="form-control mb-2" placeholder="Enter Address" name="address">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="">City</label>
                    <input type="text" class="form-control mb-2" placeholder="Enter Country" name="city">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="">State</label>
                    <input type="text" class="form-control mb-2" placeholder="Enter State" name="state">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="">PinCode</label>
                    <input type="text" class="form-control mb-2" placeholder="Enter PinCode" name="zip">
                  </div>
                </div>

              </div>
            </fieldset>

            <fieldset class="border border-white p-3 form-group">
              <legend class="d-inline w-auto">Parent Information</legend>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="">Father Name</label>
                    <input type="text" class="form-control mb-2" placeholder="Father Name" name="father_name">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="">Father Mobile</label>
                    <input type="text" class="form-control mb-2" placeholder="Father Mobile" name="father_mobile">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="">Mother Name</label>
                    <input type="text" class="form-control mb-2" placeholder="Mother Name" name="mother_name">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="">Mother Mobile</label>
                    <input type="text" class="form-control mb-2" placeholder="Mother Mobile" name="mother_mobile">
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="">Parent_Email</label>
                    <input type="text" class="form-control mb-2" placeholder="Enter Email" name="parent_email">
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="">Permnent Address</label>
                    <input type="text" class="form-control mb-2" placeholder="Enter Full Name" name="parent_address">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="">City</label>
                    <input type="text" class="form-control mb-2" placeholder="Enter Full Name" name="parent_city">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="">State</label>
                    <input type="text" class="form-control mb-2" placeholder="Enter Full Name" name="parent_state">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="">PinCode</label>
                    <input type="text" class="form-control mb-2" placeholder="Enter Full Name" name="parent_zip">
                  </div>
                </div>

              </div>
            </fieldset>

            <!-- <fieldset class="border border-white p-3 form-group">
              <legend class="d-inline w-auto">Last Qualification</legend>
              <div class="row">
                <div class="col-lg-12">
                <div class="form-group">
                <label for="">School Name</label>
                <input type="text" class="form-control mb-2" placeholder="Enter School Name" name="school_name">
              </div>
                </div>
                <div class="col-lg">
                  <div class="form-group">
                    <label for="">Class</label>
                    <input type="text" class="form-control mb-2" placeholder="Enter Class" name="previous_class">
                  </div>
                </div>
                <div class="col-lg">
                <div class="form-group">
                    <label for="">Status</label>
                    <input type="text" class="form-control mb-2" placeholder="Enter Status" name="status">
                  </div>
                </div>
                <div class="col-lg">
                <div class="form-group">
                    <label for="">Toatal Marks</label>
                    <input type="text" class="form-control mb-2" placeholder="Enter Toatal Marks" name="total_mark">
                  </div>
                </div>

                <div class="col-lg">
                <div class="form-group">
                    <label for="">Obtain Marks</label>
                    <input type="text" class="form-control mb-2" placeholder="Obtain Mark" name="obtain_mark">
                  </div>
                </div>
                <div class="col-lg">
                <div class="form-group">
                    <label for="">Percentage</label>
                    <input type="text" class="form-control mb-2" placeholder="Enter Percentage" name="previous_percentage">
                  </div>
                </div>
              </div>
            </fieldset> -->

            <fieldset class="border border-white p-3 form-group">
              <legend class="d-inline w-auto">Addminsion detail</legend>
              <div class="row">
                <div class="col-lg">
                  <div class="form-group">
                    <label for="">Class</label>
                    <select name="class_id" id="class_id" class="form-control">
                      <option value="Select Class">Select Class</option>
                      <?php
                      $args = array(
                        'type' => 'class',
                        'status' => 'publish',
                      );
                      $classes = get_posts($args);
                      foreach ($classes as $class) { ?>
                        <option value="<?php echo $class->id ?>"><?php echo $class->title; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-lg">
                  <div class="form-group">
                    <label for="">Section</label>
                    <select name="section_id" id="section_id" class="form-control">
                      <option value="Select Section">Select Section</option>
                    </select>
                  </div>
                </div>
                <!-- <div class="col-lg">
                <div class="form-group">
                    <label for="">Subject Streem</label>
                    <input type="text" class="form-control mb-2" placeholder="Enter Full Name" name="subject_streem">
                  </div>
                </div> -->
                <div class="col-lg">
                  <div class="form-group">
                    <label for="">Date Of Addmission</label>
                    <input type="date" class="form-control mb-2" placeholder="Enter Full Name" name="doa">
                  </div>
                </div>

              </div>
            </fieldset>

            <input type="hidden" name="type" value="<?php echo $_REQUEST['user'] ?>">
            <button type="submit" name="submit" class="btn btn-success"><span id="loader" style="display:none"> <i class="fas fa-circle-notch fa-spin"></i> </span>Register</button>
          </form>
        </div>
      </div>
    <?php } else if(isset($_GET['action']) && $_GET['action'] && isset($_GET['user']) && $_GET['user']=="admin"){ ?>
      <div class="card">
        <div class="card-body">
          <form action="" method="post">
            <div class="form-group">
              <label for="Name">Name</label>
              <input type="text" name="name" placeholder="Your Full Name" class="form-control">
            </div>
            <div class="form-group">
              <label for="Mobile">Mobile</label>
              <input type="text" name="mobile" placeholder="Your Mobile" class="form-control">
            </div>
            <div class="form-group">
              <label for="Email">Email</label>
              <input type="email" name="email" placeholder="Your Email" class="form-control">
            </div>
            <div class="form-group">
              <label for="Password">Password</label>
              <input type="password" name="password" placeholder="Your Password" class="form-control">
            </div>
            <input type="hidden" name="type" value="<?php echo $_REQUEST['user'] ?>">
            <input type="submit" name="submit_value" class="btn btn-primary" value="Create">
          </form>
        </div>
      </div>
  <?php } else if(isset($_GET['action']) && $_GET['action'] && isset($_GET['user']) && $_GET['user']=="teacher"){ ?>
    <div class="card">
        <div class="card-body">
          <form action="" method="post">
            <div class="form-group">
              <label for="Name">Name</label>
              <input type="text" name="name" placeholder="Your Full Name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="Mobile">Mobile</label>
              <input type="text" name="mobile" placeholder="Your Mobile" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="Email">Email</label>
              <input type="email" name="email" placeholder="Your Email" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="Password">Password</label>
              <input type="password" name="password" placeholder="Your Password" class="form-control" required>
            </div>
            <div class="form-group">
              <div class="row">
              <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="class">Select Class</label>
                                    <select name="class" id="class" class="form-control" required>
                                        <option value="Select Class">Select Class</option>
                                        <?php
                                        $args = array(
                                            'type' => 'class',
                                            'status' => 'publish',
                                        );
                                        $classes = get_posts($args);
                                        foreach ($classes as $class) { ?>
                                            <option value="<?php echo $class->id ?>"><?php echo $class->title; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group" id="Section-Container"">
                                <label for=" class">Select Section</label>
                                    <select name="section" id="section" class="form-control" required>
                                        <option value="Select Class">Select Section</option>
                                    </select>
                                </div>
                            </div>
              </div>
            </div>
            <input type="hidden" name="type" value="<?php echo $_REQUEST['user'] ?>">
            <input type="submit" name="submit_value_teacher" class="btn btn-primary" value="Create">
          </form>
        </div>
      </div>
  <?php
   } else { ?>
      <!-- Info boxes -->
      <form action="" method="post">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Email</th>
              <th>Mobile</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $count = 1;
            $user_query = 'SELECT * FROM accounts WHERE `type` = "' . $_REQUEST['user'] . '" ';
            $user_result = mysqli_query($db_conn, $user_query);
            while ($users = mysqli_fetch_object($user_result)) { ?>
              <tr>
                <td><?= $count++ ?></td>
                <td><?php echo $users->name ?></td>
                <td><?php echo $users->email ?></td>
                <td><?php echo $users->mobile ?> <?= $users->id ?></td>
                <td><input type=hidden name=id value="<?= $users->id ?>"><button  value="Delete" name="delete" value="submit" class="btn btn-danger">Delete</button></td>
              </tr>
            <?php  }
            ?>
          </tbody>
        </table>
      </div>
      </form>
    <?php } ?>
    <!-- /.row -->
  </div>
  <!--/. container-fluid -->
</section>
<!-- /.content -->
<script>
  // jQuery(document).ready(function(){

  // })
  jQuery('#student-registration').on('submit', function() {
    // console.log(jQuery(this).serialize());
    if (true) {
      var formdata = jQuery(this).serialize();

      jQuery.ajax({
        type: "post",
        url: "http://localhost:7882/school/action/student-registration.php",
        data: formdata,
        beforeSend: function() {
          jQuery('#loader').show();
        },
        success: function(response) {
          console.log(response);
        },
        complete: function() {
          jQuery('#loader').hide();
        }
      });
    }
    return false;
  });
</script>
<script>
    jQuery(document).ready(function() {
        jQuery('#class_id').change(function() {
            jQuery.ajax({
                'url': 'ajax.php',
                'type': 'POST',
                'data': {
                    'class_id': jQuery(this).val()
                },
                success: function(response) {
                    jQuery('#section_id').html(response);
                    // console.log(response);
                }
            });
        })
    })
</script>
<?php include('footer.php'); ?>