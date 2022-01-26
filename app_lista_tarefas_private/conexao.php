<?php


	class Conexao {

		private $host = 'localhost';
		private $dbname = 'php_com_pdo';
		private $user = 'root';
		private $pass = '';

		public function conectar() {

			try {

				$conexao = new PDO(
					"mysql:host=$this->host;dbname=$this->dbname", //driver de conexão (mysql), host, nome da base
					"$this->user",
					"$this->pass"
				);

				return $conexao;

			}

			catch (PDOException $e) {

				echo '<p>' . $e->getMessage() . '</p>';

			}

		}

	}

?>