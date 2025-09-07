<?php
    require_once __DIR__ . "/class_pai.class.php";
    class Usuario extends ClassePai {
        public $nome;
        public $email;
        public $senha;
        const NOME_ARQUIVO = "../../db/usuario.txt";
        public function __construct($id, $nome, $email, $senha) {
            parent::__construct($id, "../../db/usuario.txt");
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
        }
        static public function pegaPorId($id) {
            $arquivo = fopen("../../db/usuario.txt", "r");
            while(!feof($arquivo)){
                $linha = fgets($arquivo);
                if(empty($linha))
                    continue;
                $dados = explode(self::SEPARADOR, $linha);
                if($dados[0] == $id){
                    fclose($arquivo);
                    return new Usuario($dados[0], $dados[1], $dados[2], $dados[3]);
                }
            }
            fclose($arquivo);
        }
        function montaLinhaDados()
        {
            return $this->id.self::SEPARADOR.$this->nome.self::SEPARADOR.$this->email.self::SEPARADOR.$this->senha;
        }
        static public function listar($filtroNome) {
            $arquivo = fopen("../../db/usuario.txt", "r");
            $retorno = [];
            while(!feof($arquivo)){
                $linha = fgets($arquivo);
                if(empty($linha))
                    continue;
                $dados = explode(self::SEPARADOR, $linha);
                if(str_contains($dados[1], $filtroNome)){
                    array_push($retorno, new Usuario($dados[0], $dados[1], $dados[2], $dados[3]));
                }
                
            }
            return $retorno;
        }
    }
?>