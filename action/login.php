<?php include('../includes/config.php') ?>
<?php
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
    $_SESSION["email"] = $email;

        $query = mysqli_query($db_conn,"SELECT * FROM `accounts` WHERE `email` = '$email' AND `password` = '$password'");
        if(mysqli_num_rows($query)>0){
            $user = mysqli_fetch_object($query);
            $_SESSION['login'] = true;
            $_SESSION['session_id'] = uniqid();
            $user_type = $user->type;
            $name = $user->name;
            $_SESSION['user_type'] = $user_type;
            $id = $user->id;
            $_SESSION['id'] = $id;
            $_SESSION["key"] =$user_type;
            $_SESSION["name"] =$name;
            header('Location:../'.$user_type.'/dashboard.php');
            exit();
        }
        else{
            echo "<script>
            alert('Wrong Email Or Password');
            location.href='http://localhost:7882/school/login.php';
            </script>";
        }
    }
        
?>