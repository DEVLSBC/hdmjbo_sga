<?php
class Conexao
{
    private $servidor = 'localhost';
    private $usuario  = 'root';
    private $senha    = 'kop123';
    private $banco    = 'hdmjbo';


    public function conectar()
    {
        $connect = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->banco);


        if (mysqli_connect_errno()) {
            die('Falha ao abrir banco de dados: ' . mysqli_connect_error());
        }


        mysqli_set_charset($connect, 'utf8');


        return $connect;
    }
}   
?>