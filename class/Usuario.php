<?php 

class Usuario{ //Criando a classe usuario 

    private $idusuario; //Basicamente esses dados são as colunas do banco 
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIdusuario(){  //Criando os Geters e os Seters 
        return $this->idusuario;
    }

    public function setIdusuario($value){
        $this->idusuario = $value;
    }

    public function getDeslogin(){
        return $this->deslogin;
    }

    public function setDeslogin($value){
        $this->deslogin = $value;
    }

    public function getDessenha(){
        return $this->dessenha;
    }

    public function setDessenha($value){
        $this->dessenha = $value;
    }

    public function getDtcadastro(){
        return $this->dtcadastro;
    }

    public function setDtcadastro($value){
        $this->dtcadastro = $value;
    }

    public function loadById($id){  //Metodo para carregar os dados pelo id do usuario

        $sql = new Sql(); //Chamando a classe Sql na qual realiza todas as conexões com o Banco
        
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID" =>$id)); //Criando a query

        if(count($results) > 0) { //Verifica se tem algum resultado no banco. 

            $row = $results[0]; //Criando a variavel de index 0

            $this->setIdusuario($row['idusuario']);  //Neste ponto temos os atributos preenchidos com as informações do Banco
            $this->setDeslogin($row['deslogin']); //Recebe os dados que já retornaram associativos e os envia para os Seters
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro'])); //New DateTime para tribuir a informação em Data. 

        }
    }

    public static function getList(){  //Criando uma função "static" na qual não precisa instanciar nada para chamar

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

    }

    public static function search($login){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
                ':SEARCH'=>"%".$login."%"
        ));

    }

    public function Carrega($login, $password){

        $sql = new Sql();

        $result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
            ":LOGIN"=>$login, 
            "PASSWORD"=>$password
        ));

        
        if (count($result) > 0){

            $roww = $result[0];

            $this->setIdusuario($roww['idusuario']);
            $this->setDeslogin($roww['deslogin']);
            $this->setDessenha($roww['dessenha']);
            $this->setDtcadastro(new DateTime($roww['dtcadastro']));

        } else {

            throw new Exception("Login ou senha inválidos");

        }

    }

    public function __toString(){ //toString que quando se da um echo no objeto em vez de mostrar a estrutura ele 
                                    //executa o que estiver dentro do metodo mágico __toString mostrando os dados 

        return json_encode(array( //Return em json_encode retornando os dados 
            "idusuario"=>$this->getIdusuario(),  //Retorna os dados alimentados pelos Seters
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s") //Formatando a data. 
        ));
    }


}






?>