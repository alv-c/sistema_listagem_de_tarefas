<?php


	class Tarefa {

		private $id = null;
		private $id_status = null;
		private $tarefa = null;
		private $data_cadastro = null;

		public function __get($attr) {
			return $this->$attr;
		}

		public function __set($attr, $value) {
			$this->$attr = $value;

			//retorna o próprio objeto para que a chamada deste método em tarefa_controller não precise de mais de uma instância para settar mais de um atributo
			return $this;
		}

	}

?>