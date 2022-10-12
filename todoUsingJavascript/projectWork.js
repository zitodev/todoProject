//to get todo from the localstorage
function getTodoList(){
	let strData = localStorage.getItem('task1');
	if(strData){
		return JSON.parse(strData)
		console.log(strData)
	}else{
		return{
//if the items is not found inside the localstorage den the items will be stored inside todome as an array

			todome: []
		}
	}

}
//to todo to the localstorage
function saveTodoList(list){
	localStorage.setItem('task1', JSON.stringify(list))
}


function addTodo(todoName){
	let newTodo ={
		name : todoName,
		date: new Date().toLocaleString(),
		isCompleted: false
	}
	//to check if task already exist
	let tasks = getTodoList()
	for(let i = 0; i < tasks.todome.length; i++){
		let todo = tasks.todome[i]
		if(todoName === todo.name){
			alert('task already exist')
			return false
		}

	}
	tasks.todome.push(newTodo)
	saveTodoList(tasks)
	return true
}

//to check if todo is completed
function toggleStatus(todoNameLi, date = new Date().toLocaleString()){
	let tasks = getTodoList()
	for(let i = 0; i < tasks.todome.length; i++){
		let todo = tasks.todome[i]
		if(todoNameLi === todo.name){
			todo.isCompleted = !todo.isCompleted
			if(todo.isCompleted){
				todo.completionDate = new Date().toLocaleString()
				// completedDate(todo.completionDate)

			
							}else{
				delete todo.completionDate
			}
			tasks.todome[i] = todo
			saveTodoList(tasks)
			return todo.isCompleted

		}

	}
	
	
}

function deleteStatus(todoNameLi){
	let tasks = getTodoList()
	for(let i = 0; i < tasks.todome.length; i++){
		let todo = tasks.todome[i]
		if(todoNameLi === todo.name){
			tasks.todome.splice(i,1)
			saveTodoList(tasks)
			return true

		}

	}
	return false
	
}