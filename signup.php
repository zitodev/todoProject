<div class='logDiv'>
    <h1>Register</h1>
    <p>Already have an account <a href="login.php">Login!</a></p>
    <form action="includes/register-inc.php" method="POST">
        <input id='loginInput' type="text" name='username' placeholder= 'username'>
        <input id='loginInput'  type="password" name='password' placeholder='password' min = '8'>
        <input id='loginInput'  type="password" name='confrimPassword' placeholder='confirm password' min = '8'>
        <button type='submit' name='submit' id='sub'>REGISTER</button>
    </form>
</div>