<?php

require_once "cabecalho.php"; ?>

<?php

require_once "../../models/CrudProdutos.php";
$crud= new CrudProdutos();
$produto=$crud->getProduto($_GET['codigo']);
?>

<h2>Editar Produtos</h2>
<form action="../../controllers/controladorProduto.php?acao=editar" method="post">
    <div class="form-group">
        <label for="produto">Produto:</label>
        <input value="<?= $produto->nome ?>" name="nome" type="text" class="form-control" id="produto" aria-describedby="nome produto" placeholder="">
    </div>

    <div class="form-group">
        <label for="preco">Preço</label>
        <input value="<?= $produto->preco ?>" name="preco" type="number" step="0.01" class="form-control" id="preco" placeholder="">
    </div>
    
    <div class="form-group">
        <label for="Categoria">Categoria</label>
        <select name="categoria" class="form-control" id="categoria">
            <option <?php if($produto->categoria== "MOBA") {echo "selected";} ?> >MOBA</option>
            <option <?php if($produto->categoria== "Periféricos") {echo "selected";} ?> >Periféricos</option>
            <option <?php if($produto->categoria== "Processadores") {echo "selected";} ?> >Processadores</option>
            <option <?php if($produto->categoria== "PSU") {echo "selected";} ?> >PSU</option>
            <option <?php if($produto->categoria== "VGA") {echo "selected";} ?> >VGA</option>


        </select>
    </div>

    <div class="form-group">
        <label for="quantidade">Quantidade</label>
        <input value="<?= $produto->estoque ?>" name="estoque" type="number" class="form-control" >
    </div>

    

    <input type="hidden" name="codigo" value="<?= $produto->codigo ?>">

    <button type="submit" class="btn btn-success">Atualizar produto</button>

</form>

<?php require_once "rodape.php"; ?>
