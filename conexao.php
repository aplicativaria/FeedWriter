<?php
class Conexao {
	
	//Instância de conexão PDO
	private static $instance = null;
	
	//Tipo de banco de dados
	private static $dbType = "mysql";
	
	/*--------------------------------------------------------------------*/
	/*             Parâmetros de configuração do banco de dados           */
	/*--------------------------------------------------------------------*/
	private static $host = "localhost";//SERVIDOR DO BANCO DE DADOS
	private static $user = "root"; //USUARIO DE CONEXÃO DO BANCO DE DADOS
	private static $senha = ""; //SENHA DE CONEXÃO DO BANCO DE DADOS
	private static $banco = "feed";//NOME DO BANCO DE DADOS
	/*--------------------------------------------------------------------*/
	
	//Define se a conexão deve ser persistente
	protected static $persistent = false;
	
	/*--------------------------------------------------------------------*/
	/*                      Lista de Tabelas do Banco                     */
	/*--------------------------------------------------------------------*/
	private static $tabelas = array (
		'TB_NOTICIAS' => 'noticias'
	);
	/*--------------------------------------------------------------------*/
	
	//Retorna a instância de conexão ao banco de dados
	public static function getInstance() {
		if(self::$persistent != FALSE) {
			self::$persistent = TRUE;
		}
		
		if (!isset(self::$instance)) {
			
			try {
				
				self::$instance = new PDO(self::$dbType.':host='.self::$host.';dbname='.self::$banco
					, self::$user
					, self::$senha
					, array(PDO::ATTR_PERSISTENT => self::$persistent));
				
			} catch (PDOException $ex) {
				exit("Erro ao estabelecer a conexão com o banco de dados". $ex->getMessage());
			}
			
		}
		
		return self::$instance;
	}
	
	//Função pra fechar a conexão com o banco de dados
	public static function close() {
		if(self::$instance != null) {
			self::$instance = null;
		}
	}
	
	//Recebe uma chave e retorna a tabela correspondente a essa chave
	public static function getTabela($chave) {
		return self::$tabelas[$chave];
	}
}
?>
