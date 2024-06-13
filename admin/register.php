<?php
session_start(); 
include '../components/connection.php';

if (isset($_POST['register'])) {

    $id = unique_id();

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = sha1($_POST['password']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $cpass = sha1($_POST['cpassword']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../image/' . $image;

    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE email =?");
    $select_admin->execute([$email]);

    if ($select_admin->rowCount() > 0) {
        $warning_msg[]= 'User email already exists';
    } else {
        if ($pass != $cpass) {
            $warning_msg[] = 'Confirm password not matched';
        } else {
            $insert_admin = $conn->prepare("INSERT INTO `admin` (id, name, email, password, profile) VALUES (?,?,?,?,?)");
            $insert_admin->execute([$id, $name, $email, $pass, $image]);
            move_uploaded_file($image_tmp_name, $image_folder);
            $success_msg[] = 'New admin registered';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>green coffee admin panel - register page</title>
</head>
<body>
    <div class="main-container">
        <section class="main">
            <div class="form-container" id="admin_login">
                <form action="" method="post" enctype="multipart/form-data">
                    <h3>register now</h3>
                    <div class="input-field">
                        <label>user name : <sup>*</sup></label>
                        <input type="text" name="name" required placeholder="enter your name">
                    </div>
                    <div class="input-field">
                        <label>user email : <sup>*</sup></label>
                        <input type="email" name="email" required placeholder="enter your email">
                    </div>
                    <div class="input-field">
                        <label>user password : <sup>*</sup></label>
                        <input type="password" name="password" required placeholder="enter your password">
                    </div>
                    <div class="input-field">
                        <label>confirm password: <sup>*</sup></label>
                        <input type="password" name="cpassword" required placeholder="enter your confirm password">
                    </div>
                    <div class="input-field">
                        <label>select profile<sup>*</sup></label>
                        <input type="file" name="image" accept="image/*">
                    </div>
                    <button type="submit" name="register" class="btn">register now</button>
                    <p>already have an account ?<a href="login.php">login now</a></p>
                </form>
            </div>
        </section>
    </div>
    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- custom js link -->
    <script src="script.js" type="text/javascript"></script>
    <!-- alert -->
    <?php include '../components/alert.php';?>
</body>
</html>
