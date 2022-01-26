<?php

	//CRUD

	class TarefaService {

		private $conexao = null;
		private $tarefa = null;


		//contrutor recebe "OBJETOS" com parâmetros tipados, o que traz uma maior segurança, uma vez que a aplicaçõo não aceitará parâmetros diferentes dos mencionados na função
		public function __construct(Conexao $conexao, Tarefa $tarefa) {
			
			$this->conexao = $conexao->conectar(); //attr conexão recebe o link de conexão com o banco através do método conectar do objeto conexão
			$this->tarefa = $tarefa;

		}

		public function inserir() { //create

			$query = "INSERT INTO tb_tarefas (tarefa) VALUES (:tarefa)";
			$statemet = $this->conexao->prepare($query);
			$statemet->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
			$statemet->execute();

		}

		public function recuperar() { //read

			$query = 'SELECT t.id, t.id_status, t.tarefa, s.status 
				FROM tb_tarefas as t 
				LEFT JOIN tb_status as s 
				ON (t.id_status = s.id)';

			$stmt = $this->conexao->prepare($query);
			$stmt->execute();

			$tarefas = $stmt->fetchAll(PDO::FETCH_OBJ);

			return $tarefas;

		}

		public function atualizar() { //update

			/* método prepare do objeto conexao com marcadores "?"*/

			//sem o marcador "?" usa-se a variável :tarefa
			//$query = "UPDATE tb_tarefas SET tarefa = :tarefa WHERE id = :id";

			//substitiu-se a variável :tarefa por pontos de interrogação
			$query = "UPDATE tb_tarefas SET tarefa = ? WHERE id = ?";
			$statemet = $this->conexao->prepare($query);

			//indicação no primeiro parâmetro (1) do método bindValue que a primeiro interrogação referência o attr tarefa do objeto tarefa
			$statemet->bindValue(1, $this->tarefa->__get('tarefa'));

			//indicação no primeiro parâmetro (2) do método bindValue que a segunda interrogação referência o attr id do objeto tarefa
			$statemet->bindValue(2, $this->tarefa->__get('id'));

			//caso o update seja realizado com sucesso, o método execute de statement retornará 1 para true, e N para false
			return $statemet->execute();

		}

		public function remover() {	//delete

			$query = "DELETE FROM tb_tarefas WHERE id = ?";
			$statemet = $this->conexao->prepare($query);
			$statemet->bindValue(1, $this->tarefa->__get('id'));
			$statemet->execute();

		}


		public function marcarRealizada() { //update

	
			$query = "UPDATE tb_tarefas SET id_status = ? WHERE id = ?";
			$statemet = $this->conexao->prepare($query);

			$statemet->bindValue(1, $this->tarefa->__get('id_status'));

			$statemet->bindValue(2, $this->tarefa->__get('id'));

			return $statemet->execute();

		}

		public function recuperar_pendetes() {

			$query = "SELECT t.id, t.id_status, t.tarefa, s.status 
				FROM tb_tarefas as t 
				LEFT JOIN tb_status as s 
				ON (t.id_status = s.id)
				WHERE t.id_status = ?";

			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(1, $this->tarefa->__get('id_status'));
			$stmt->execute();

			$tarefas = $stmt->fetchAll(PDO::FETCH_OBJ);

			return $tarefas;

		}

	}


?>