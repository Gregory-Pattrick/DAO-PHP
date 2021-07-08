<?php 

class Sql extends PDO {  //Classe Sql extendendo da classe própria do PHP 
                        //Basicamente tudo que a Classe nativa do PHP "PDO" faz essa classe também vai conseguir

    private $conn; //Reserva a variavel $conn como a de conexão.

    public function __construct(){  //Function de metodo construtor na qual realiza diretamente a conexão com o DB
                                    //Esta função serve para que quando seja criado uma nova classe Sql a mesma 
                                        //se conecta automaticamente no Banco.

        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", ""); //Conectando no banco 

    }

    private function setParams($statment, $parameters = array()){ //Function para setar os parametros

        foreach ($parameters as $key => $value){   //Associando parametros ao comando basicamente define quais são os parametros
                                                    //Que a execução do codigo no banco vai fazer

            $this->setParam($statment, $key, $value); //Define o valor de consulta com o valor especificado
        }

    }

    private function setParam($statment, $key, $value){ //Função para receber os parametros que serão executados na query

        $statment->bindParam($key, $value); //Recebe os parametros a serem executados na query
    }

    public function query($rawQuery, $params = array()){  //Função para executar comandos no banco
                                                            //$rawQuery = query bruta, comando sql
                                                            //$params = são os dados que receberemos.

        $stmt = $this->conn->prepare($rawQuery);  //Criando o statment para preparar a execução do comando no Banco. 
                                                    //OBS:. Por sermos uma classe extendida de PDO temos acesso ao "prepare"

        $this->setParams($stmt, $params); //Seta os parametros que serão executados

        $stmt->execute(); //Executa o comando no banco. 

        return $stmt; //Retorna os resultados do stmt
    }

    public function select($rawQuery, $params = array()){  //Função na qual retorna os comandos do banco, como ex. "Select"

        $stmt = $this->query($rawQuery, $params); //Chamando o metodo query para executar os comando no Banco

        return $stmt->fetchAll(PDO::FETCH_ASSOC); //Retorna os dados da query. 
    }


}

?>