<?php
  session_start();
  if(!$_SESSION['sessionuser']){ 
    header("Location: login.php");
  }
  require_once "../includes/database.php";
 ?>

<?php 
  if(isset($_POST['submit'])){
      $addTask = $_POST['addtask'];
      $userId = $_SESSION['sessionId'];
    if(!empty($addTask)){
      $todo = "SELECT todoName FROM todo WHERE todoName= '$addTask'";
      $result = $conn->query($todo);
      if($row = mysqli_fetch_assoc($result)){
        if($row['todoName'] === $addTask){
          $errors = "task already exist";
          return header("Location:todo_page.php?error='$errors'");
        }
           
      }
      $date = date('Y-m-d g:i:s');
        $query = "INSERT INTO todo(todoName, owner_id, createdAt) VALUE('$addTask', '$userId', '$date')";
        $add = $conn->query($query);
        header('Location:todo_page.php');
    }
  }
  if(isset($_GET['del'])){
    $id = $_GET['del'];
    mysqli_query($conn, "DELETE FROM todo WHERE id =".$id);
    header('Location:todo_page.php');
}
if(isset($_GET['todo_id'])){
  $todoId = $_GET['todo_id'];

  $taskResp = mysqli_query($conn, "SELECT * FROM todo WHERE id = '$todoId'");
  $task = mysqli_fetch_assoc($taskResp);

  if(empty($task))
    header('Location:todo_page.php');

  if($task['isCompleted'] == 0) {
    $completedDate = date('Y-m-d g:i:s');
    $query1 = "UPDATE todo SET dateCompleted = ('$completedDate'), isCompleted = '1' WHERE id =".$todoId;
  } else {
    $completedDate = null;
    $query1 = "UPDATE todo SET dateCompleted = ('$completedDate'), isCompleted = '0' WHERE id =".$todoId;
  }

  $add1 = $conn->query($query1);
  header('Location:todo_page.php');
}
  
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>To Do List</title>
	<link rel="stylesheet" type="text/css" href="todopagestyle.css">
	<!-- <link rel="stylesheet"  href="css/font-awesome.min.css"> -->
</head>

<body>
	<div class="container">
  <h2>
    <?php echo "Welcome,"." ".	$_SESSION['sessionuser']; ?> </h2>
  <h4 class="logout"><a href="logout.php">Logout</a></h4>
  <h1>To Do List</h1>
  <div>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="text" id="newtask" placeholder="Title..." name="addtask">
    <button class="addBtn" name="submit">ADD ITEMS</button>
<table>
        <thead>
            <tr>
                <th>Tasks</th>
                <th>createdDate</th>
                <th>completedDate</th>
                <th style="width: 60px;" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $userId = $_SESSION['sessionId'];
            $tasks = mysqli_query($conn, "SELECT * FROM todo WHERE owner_id = '$userId'");
            $i = 1;
            while($row = mysqli_fetch_array($tasks)){?>
            <tr>
                <td class="task"><?php echo $row['todoName'];?></td>
                <td class="displayDate">task is created at:<?php echo " ". $row['createdAt']; ?></td>
                <td  class="displayDate">task is completed at:<?php echo " ". $row['dateCompleted']; ?></td>
                <td><input type='checkbox' id="checks" <?php echo $row['isCompleted'] == 1 ? "checked" : ""; ?> onclick = "clickedTodoCheckBox(<?php echo $row['id']; ?>)" ></td>
                <td class="delete"><a href="todo_page.php?del=<?php echo $row['id']?>">X</a></td>
            </tr>
            <?php $i ++;}?>
        </tbody>
    </table> 
    </form>
    <footer>
<p style="text-align: center; color:white;">copyright &copy; 2022 zitoblog.com</p>
</footer>
</div>
  
<script>
function clickedTodoCheckBox(todoId) {
  console.log("TODO id:", todoId);
  window.location.href = "todo_page.php?todo_id="+todoId;
 }   
</script>

</body>
</html>
