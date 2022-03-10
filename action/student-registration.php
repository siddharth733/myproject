<?php include('../includes/config.php'); ?>
<?php
if(isset($_POST['type']) && $_POST['type']=='student' && !empty($_POST['email'])){
    $name = isset($_POST['name'])?$_POST['name']:'';
    $dob = isset($_POST['dob'])?$_POST['dob']:'';
    $mobile = isset($_POST['mobile'])?$_POST['mobile']:'';
    $email = isset($_POST['email'])?$_POST['email']:'';
    $address = isset($_POST['address'])?$_POST['address']:'';
    $city = isset($_POST['city'])?$_POST['city']:'';
    $state = isset($_POST['state'])?$_POST['state']:'';
    $zip = isset($_POST['zip'])?$_POST['zip']:'';
    $password = date('dmY',strtotime($dob));

    $father_name = isset($_POST['father_name'])?$_POST['father_name']:'';
    $father_mobile = isset($_POST['father_mobile'])?$_POST['father_mobile']:'';
    $mother_name = isset($_POST['mother_name'])?$_POST['mother_name']:'';
    $mother_mobile = isset($_POST['mother_mobile'])?$_POST['mother_mobile']:'';
    $parent_email = isset($_POST['parent_email'])?$_POST['parent_email']:'';
    $parent_address = isset($_POST['parent_address'])?$_POST['parent_address']:'';
    $parent_city = isset($_POST['parent_city'])?$_POST['parent_city']:'';
    $parent_state = isset($_POST['parent_state'])?$_POST['parent_state']:'';
    $parent_zip = isset($_POST['parent_zip'])?$_POST['parent_zip']:'';
    
    // $school_name = isset($_POST['school_name'])?$_POST['school_name']:'';
    // $previous_class = isset($_POST['previous_class'])?$_POST['previous_class']:'';
    // $status = isset($_POST['status'])?$_POST['status']:'';
    // $total_mark = isset($_POST['total_mark'])?$_POST['total_mark']:'';
    // $obtain_mark = isset($_POST['obtain_mark'])?$_POST['obtain_mark']:'';
    // $previous_percentage = isset($_POST['previous_percentage'])?$_POST['previous_percentage']:'';

    $class = isset($_POST['class_id'])?$_POST['class_id']:'';
    $section = isset($_POST['section_id'])?$_POST['section_id']:'';
    // $subject_streem = isset($_POST['subject_streem'])?$_POST['subject_streem']:'';
    $doa = isset($_POST['doa'])?$_POST['doa']:'';
    $type = isset($_POST['type'])?$_POST['type']:'';
    $date_add = date('Y-m-d');
    
    $check_query = mysqli_query($db_conn, "SELECT * FROM accounts WHERE email = '$email'");
    if(mysqli_num_rows($check_query)>0){
        echo "Email Already Exist";
    }else{
    $querry = mysqli_query($db_conn, "INSERT INTO accounts (`name`,`email`,`mobile`,`password`,`type`) VALUES ('$name','$email','$mobile','$password','$type')") or die(mysqli_error($db_conn));
    mysqli_query($db_conn, "INSERT INTO accounts (`name`,`email`,`mobile`,`password`,`type`) VALUES ('$father_name','$parent_email','$father_mobile','$password','parent')") or die(mysqli_error($db_conn));
    if ($querry) {
        $user_id = mysqli_insert_id($db_conn);
        }
    }
    $usermeta = array(
        'name' => $name,
        'dob' => $dob,
        'address' => $address,
        'city' => $city,
        'state' => $state,
        'zip' => $zip,

        'father_name' => $father_name,
        'father_mobile' => $father_mobile,
        'mother_name' => $mother_name,
        'mother_mobile' => $mother_mobile,
        'parent_email' => $parent_email,
        'parent_address' => $parent_address,
        'parent_city' => $parent_city,
        'parent_state' => $parent_state,
        'parent_zip' => $parent_zip,

        // 'school_name' => $school_name,
        // 'previous_class' => $previous_class,
        // 'status' => $status,
        // 'total_mark' => $total_mark,
        // 'obtain_mark' => $obtain_mark,
        // 'previous_percentage' => $previous_percentage,

        'class' => $class,
        'section' => $section,
        // 'subject_streem' => $subject_streem,
        'doa' => $parent_state,
        'parent_state' => $doa
    );

    foreach($usermeta as $key => $value){
    mysqli_query($db_conn, "INSERT INTO usermeta (`user_id`,`meta_key`,`meta_value`) VALUES ('$user_id','$key','$value')") or die(mysqli_error($db_conn));
    }
}
    // echo json_encode($_POST);
?>