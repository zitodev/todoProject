<?php 
    require_once "includes/database.php";
   

    if(isset($_POST['submit'])) {

        $user_name = $_POST['username'];
        $password = $_POST['password'];
        $confimr_password = $_POST['confirmPassword'];

        if(!empty($password)) {
            
            if(strlen($password) < 5 ){
                $message = "password must be above five digits";
                return header("Location:./signup.php?error='$message'");    
            }

            if($password != $confimr_password) {
               return header('Location:./signup.php?error=passworddidntmatch'); 
            }

            $password_1 = md5($password);
            $query = "INSERT INTO users(username, password) VALUES('$user_name', '$password_1');";
            $q = $conn->query($query);
            header('Location:./login.php?success=registractionsuccessful');
        }
            
            // $query = "INSERT INTO users(username, password) VALUES(?, ?);";
           
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
    <h1>Register</h1>
    <p>Already have an account <a href="login.php">Login!</a></p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <input id='loginInput' type="text" name='username' placeholder= 'username'>
        <input id='loginInput'  type="password" name='password' placeholder='password' min = '8'>
        <input id='loginInput'  type="password" name='confirmPassword' placeholder='confirm password' min = '8'>
        <button type='submit' name='submit' id='sub'>REGISTER</button>
    </form>
</div>
</body>
</html>

