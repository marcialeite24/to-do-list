<?php 
	$action = 'getPendingTasks';
	require 'task_controller.php';
?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App To Do List</title>

		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		
		<script>
			function edit(id, text) {
				let form = document.createElement('form');
				form.action = 'index.php?pag=index&action=update';
				form.method = 'post';
				form.className = 'row';

				let inputTask = document.createElement('input');
				inputTask.type = 'text';
				inputTask.name = 'task';
				inputTask.className = 'col-9 form-control';
				inputTask.value = text;

				let inputId = document.createElement('input');
				inputId.type = 'hidden';
				inputId.name = 'id';
				inputId.value = id;

				let button = document.createElement('button');
				button.type = 'submit';
				button.className = 'col-3 btn btn-info';
				button.innerHTML = 'Update';

				form.appendChild(inputTask);
				form.appendChild(inputId);
				form.appendChild(button);
				
				let task =document.getElementById('task_'+id);
				task.innerHTML = '';
				task.insertBefore(form, task[0]);
			}

			function remove(id) {
				location.href = 'index.php?pag=index&action=remove&id='+id;
			}

			function markAsDone(id) {
				location.href = 'index.php?pag=index&action=markAsDone&id='+id;
			}
		</script>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App To Do List
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="#">Pending tasks</a></li>
						<li class="list-group-item"><a href="new_task.php">New task</a></li>
						<li class="list-group-item"><a href="all_tasks.php">All tasks</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container page">
						<div class="row">
							<div class="col">
								<h4>Pending tasks</h4>
								<hr />

								<?php foreach ($tasks as $key => $task) { ?>
									<div class="row mb-3 d-flex align-items-center task">
										<div class="col-sm-9" id="task_<?= $task->id ?>">
											<?= $task->task ?>
										</div>
										<div class="col-sm-3 mt-2 d-flex justify-content-between">
											<i class="fas fa-trash-alt fa-lg text-danger" onclick="remove(<?= $task->id ?>)"></i>
											<i class="fas fa-edit fa-lg text-info" onclick="edit(<?= $task->id ?>, '<?= $task->task ?>')"></i>
											<i class="fas fa-check-square fa-lg text-success" onclick="markAsDone(<?= $task->id ?>)"></i>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>