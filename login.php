<?php 
    require_once "includes/database.php";

    if(isset($_POST['submit'])) {

        $user_name = $_POST['username'];
        $password = $_POST['password'];
      if(!empty($user_name) && !empty($password)){
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username = '$user_name' AND password = '$password'";
        $p = $conn->query($query);
        if($row = mysqli_fetch_assoc($p)){
            session_start();
            $_SESSION['sessionId'] = $row['id'];
        	$_SESSION['sessionuser'] = $row['username'];
            header('Location:./projectWork.php?success=loginsuccessful');


        }else{
            header('Location:./login.php?error=invalidlogindetails');
        }

      }

    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
	<link rel="stylesheet" type="text/css" href="todo.css">
</head>
<body>
    <div class='logDiv'>
    <h1>Log In</h1>
    <p>No account <a href="signup.php">Register here</a></p>
    <form action="" method='POST'>
        <input id='loginInput' type="text" name='username' placeholder= 'username'>
        <input id='loginInput' type="password" name='password' placeholder='password'>
        <button type='submit' name="submit" id='sub'>LOGIN</button>
    </form>
</div>
</body>
</html>

