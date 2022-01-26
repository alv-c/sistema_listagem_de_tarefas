<?php

	require '../../../app_lista_tarefas_private/tarefa.model.php';
	require '../../../app_lista_tarefas_private/tarefa.service.php';
	require '../../../app_lista_tarefas_private/conexao.php';


	//acao tem o valor de recuperar, declarado no arquivo todas_tarefas, se a super global GET acao foi settada, então ação passa a valor o valor da super global (inserir), se não, continua com seu valor original (recuperar)
	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;


	if ($acao == 'inserir')  {

		 //criar nova tarefa
		$tarefa = new Tarefa();
		$tarefa->__set('tarefa', $_POST['tarefa']);

		$conexao = new Conexao();

		//O objeto TarefaService que irá recuperar o objeto Tarefa e a conexão para a realização das operações junto ao banco de dados -> irá receber a conexão e a tarefa para realizar as operações de CRUD
		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->inserir();

		header('Location: nova_tarefa.php?inclusao=true');

	}

	else if ($acao == 'recuperar') {
		
		$tarefa = new Tarefa();
		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);

		$tarefas = $tarefaService->recuperar();	

	}

	else if ($acao == 'atualizar') {

		$tarefa = new Tarefa();

		//usa-se essa nomeclatura pois neste exemplo o método set retorna o próprio objeto na primeira chamada do set, bastando apenas chama-lo novamente para settar o próximo atributo
		$tarefa->__set('id', $_POST['id'])->__set('tarefa', $_POST['tarefa']);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);

		$pagina = 'todas_tarefas';
		$pagina = isset($_GET['pag']) ? $_GET['pag'] : $pagina;

		if ($tarefaService->atualizar()) {
			header('Location:' . $pagina . '.php');
		}

	}

	else if ($acao == 'remover') {

		$pagina = 'todas_tarefas';
		$pagina = isset($_GET['pag']) ? $_GET['pag'] : $pagina;

		$tarefa = new Tarefa();
		$tarefa->__set('id', $_GET['id']);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->remover();

		header('Location:' . $pagina . '.php');

	}

	else if ($acao == 'marcarRealizada') {

		$pagina = 'todas_tarefas';
		$pagina = isset($_GET['pag']) ? $_GET['pag'] : $pagina;

		$tarefa = new Tarefa();
		$tarefa->__set('id', $_GET['id'])->__set('id_status', 2);

		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->marcarRealizada();

		header('Location:' . $pagina . '.php');

	}

	else if ($acao = 'recuperar_tarefas_pendentes') {

		$tarefa = new Tarefa();
		$tarefa->__set('id_status', 1);
		$conexao = new Conexao();

		$tarefaService = new TarefaService($conexao, $tarefa);

		$tarefas = $tarefaService->recuperar_pendetes();	

	}

?>