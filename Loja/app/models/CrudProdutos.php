<?php
/**
 * Created by PhpStorm.
 * User: JEFFERSON
 * Date: 16/11/2017
 * Time: 10:56
 */

require_once "Conexao.php";
require_once "Produto.php";

class CrudProdutos {

    private $conexao;
    public $produto;

    public function __construct() {
        $this->conexao = Conexao::getConexao();
    }

    public function salvar(Produto $produto){
        $sql = "INSERT INTO tb_produtos (nome, preco, categoria, estoque) VALUES ('$produto->nome', '$produto->preco', '$produto->categoria', '$produto->estoque')";

        $this->conexao->exec($sql);
    }

    public function getProduto(int $codigo){
        $consulta = $this->conexao->query("SELECT * FROM tb_produtos WHERE codigo = $codigo");
        $produto = $consulta->fetch(PDO::FETCH_ASSOC); //SEMELHANTES JSON ENCODE E DECODE

        return new Produto($produto['nome'], $produto['preco'], $produto['categoria'], $produto ['estoque'], $produto['codigo']);

    }

    public function getProdutos(){
        $consulta = $this->conexao->query("SELECT * FROM tb_produtos");
        $arrayProdutos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        //Fabrica de Produtos
        $listaProdutos = [];
        foreach ($arrayProdutos as $produto){
            $listaProdutos[] = new Produto($produto['nome'], $produto['preco'], $produto['categoria'], $produto ['estoque'], $produto['codigo']);
        }

        return $listaProdutos;

    }
    public function excluirProdutos(int $codigo){

        $this->conexao->query("DELETE FROM tb_produtos WHERE codigo = $codigo");
    }

    public function editar(Produto $produto){

        $this->conexao->exec("UPDATE tb_produtos
 SET nome ='$produto->nome', preco = $produto->preco, categoria = '$produto->categoria', estoque = '$produto->estoque' where codigo= $produto->codigo");
    }
    

    //public function comprar(int $codigo, int $quantidade){

    // $this->conexao->query("UPDATE tb_produtos SET quantidade=(quantidade - $quantidade) WHERE codigo = $codigo");
    //}


}

