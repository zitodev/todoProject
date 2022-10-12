<?php
require_once "includes/database.php";
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>To Do List</title>
	<link rel="stylesheet" type="text/css" href="todo.css">
	<!-- <link rel="stylesheet"  href="css/font-awesome.min.css"> -->
</head>

<body>
  <?php
  session_start();
  if($_SESSION['sessionuser']){
    ?>
	<div class="container">
  <h2><?php echo "Welcome,"." ".	$_SESSION['sessionuser']; ?> </h2>
  <?php
  }else{
    header("Location: login.php");
    echo "<li><input type='checkbox'><button>x delete</button><p></p><span></span></li>";
  }
  ?>
  <h4 class="logout"><a href="logout.php">Logout</a></h4>
  <h3>To Do List</h3>
  <input type="text" id="newtask" placeholder="Title...">
  <button onclick="newElement()" class="addBtn">ADD ITEMS</button>
</div>
<ul id="taskList">

</ul>
<script src="projectWork.js"></script>

<script>

window.onload = () =>{
  let tasks = getTodoList()
  for(let i = 0; i < tasks.todome.length; i++){
    let task = tasks.todome[i]
      createTodo(task.name, task.isCompleted)
    }

  }
  
 function createTodo(taskNameUl, isCompleted = false){
  let inputTask = document.getElementById('taskList')
  let li = document.createElement('li')
  let checkbox = document.createElement('input')
  let del = document.createElement('button')
  let createdDate = document.createElement('p')
  let completedDate = document.createElement('span')
  let timeWrapper = document.createElement('div')

  let tasks = getTodoList()
        for(let i = 0; i < tasks.todome.length; i++){
    let todo = tasks.todome[i]
      createdDate.innerHTML = 'task created on: ' + todo.date
      }
 
  del.innerHTML = 'x delete'
  del.className = 'deleted'
  checkbox.type = 'checkbox'
  checkbox.className = 'check'


 if(isCompleted){
    checkbox.checked = true
    li.classList.toggle('checked')
       let tasks = getTodoList()
        for(let i = 0; i < tasks.todome.length; i++){
    let todo = tasks.todome[i]
        completedDate.innerHTML = 'task completed on: ' +todo.completionDate
      }
  }
 
  

  checkbox.addEventListener('click', () => {
      const status = toggleStatus(taskNameUl)
      console.log("status:", status)
      if(status === true) {
        let tasks = getTodoList()
        for(let i = 0; i < tasks.todome.length; i++){
    let todo = tasks.todome[i]
        completedDate.innerHTML = 'task completed on: ' + todo.completionDate

        console.log(todo.completionDate)
      }
      } else {
        completedDate.innerHTML = ''
      }

      li.classList.toggle('checked')
  })
  

 
  del.addEventListener('click', () => {
    let  deleted = deleteStatus(taskNameUl)
    if(deleted){
      inputTask.removeChild(li)
    }
  })
  li.innerHTML = taskNameUl 
  li.appendChild(createdDate)
  li.appendChild(completedDate)
  li.appendChild(checkbox)
  li.appendChild(del)
  inputTask.appendChild(li)
 }

   
  
function newElement() {
      let inputList = document.getElementById("newtask").value
      if (inputList) {
       let todoAdded = addTodo(inputList)
       // alert(date)
       if(todoAdded){
        createTodo(inputList)
       }
      
      }else if(inputList === ""){
        alert('input some taks please!')
        return false
      }

}
  
        

</script>

</body>
</html>
