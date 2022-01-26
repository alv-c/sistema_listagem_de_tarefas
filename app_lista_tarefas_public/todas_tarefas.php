<?php

	$acao = 'recuperar';
	require 'tarefa_controller.php';

	/*echo '<pre>';
	print_r($tarefas);
	echo '</pre>';*/

?>


<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<script>
			let editar = (id, txt_tarefa) => {

				//form
				let form = document.createElement('form')
				form.action = 'tarefa_controller.php?acao=atualizar'
				form.method = 'post'
				form.className = 'row'

				//input
				let inputTarefa = document.createElement('input')
				inputTarefa.type = 'text'
				inputTarefa.name = 'tarefa'
				inputTarefa.className = 'form-control col-9'
				inputTarefa.placeholder = 'Atualizar tarefa'
				inputTarefa.value = txt_tarefa

				//input hidden para guardar id da tarefa a ser atualizada
				let inputId = document.createElement('input')
				inputId.type = 'hidden'
				inputId.name = 'id'
				inputId.value = id


				//submit
				let button = document.createElement('button')
				button.type = 'submit'
				button.className = 'btn btn-info col-3'
				button.innerHTML = 'Atualizar'

				//colocar o input dentro do form
				form.appendChild(inputTarefa)

				//colocar o input hidden dentro do form
				form.appendChild(inputId)

				//colocar o buttond entro do form
				form.appendChild(button)

				let tarefa = document.getElementById('tarefa_' + id)

				tarefa.innerHTML = ''

				//insertBefore(arvore de elementos a ser adicionada, nó (filho) dentro do elemento selecionado, que a árvore de elementos será adicioanda) -> permite fazer com que uma árvore de elementos HTML, seja inserida dentro de outro elemento já redenrizado
				tarefa.insertBefore(form, tarefa[0]) //como tarefa não tem nenhum elemento filho, o form será adicionado como primeiro elemento filho (índice 0), dentro do elemento tarefa

			}

			function remover(id) {
				window.location.href = 'todas_tarefas.php?acao=remover&id=' + id
			}

			function marcarRealizada(id) {
				window.location.href = 'todas_tarefas.php?acao=marcarRealizada&id=' + id
			}

		</script>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />

								<!--acessando o objeto tarefa, dentro do indíce do array de objetos tarefas-->
								<?php foreach ($tarefas as $indice => $tarefa) { ?>

									<div class="row mb-3 d-flex align-items-center tarefa">
										<div class="col-sm-9" id="tarefa_<?= $tarefa->id; ?>">
											<?= $tarefa->tarefa; ?> (<?= $tarefa->status; ?>)
										</div>
										<div class="col-sm-3 mt-2 d-flex justify-content-between">

											<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $tarefa->id ?>)" style="cursor: pointer"></i>

											<?php if ($tarefa->id_status != 2) { ?>

												<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $tarefa->id; ?>, '<?= $tarefa->tarefa; ?>')" style="cursor: pointer"></i>

												<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $tarefa->id; ?>)" style="cursor: pointer"></i>

											<?php } ?>

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