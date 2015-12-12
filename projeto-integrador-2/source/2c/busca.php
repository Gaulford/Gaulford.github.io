<!DOCTYPE html>

<?php require_once("/system/controlers/page-busca.php"); ?>

<!--[if IE 8]>         <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
    <head>
        <?php require_once("includes/head.php"); ?>
    </head>
    <body class="pages-list-data page-list-produto">
        
        <?php require_once("includes/header.php"); ?>

        <div class="cmp-container">

            <?php require_once("includes/navigation.php"); ?>

            <section class="cmp-content">
                <form action="busca.php" method="get" enctype="application/x-www-form-urlencoded" class="cmp-box-space">
                    <fieldset class="grid">
                        <div class="col-48 mod-input">
                            <input type="text" name="busca" placeholder="Insira o nome do produto"> 
                        </div>
                        <div class="col-48">
                            <div class="grid">
                                <?php if ( $checkCategoryData ) { ?>
                                <div class="col-48 mod-input">
                                    <select name="categoria">
                                        <option value="">Selecione uma categoria</option>
                                        <?php foreach ( $allCategories as $key ) { ?>
                                            <option value="<?php echo $key["Categoria"]; ?>">
                                                <?php echo $key["Categoria"]; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <?php } ?>
                                <div class="col-48">
                                    <button class="mod-btn">
                                        Buscar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
                
                <?php if ( isset( $searchResult ) and !empty( $searchResult ) ) { ?>
                <div class="cmp-box-no-space">
                    <table class="cmp-table-data">
                        <thead>
                            <th>Produto</th> 
                            <th>Preço</th>
                            <th>Desconto</th>
                            <th>Categoria</th>
                            <th colspan="2">Açôes</th>
                        </thead>
                        <tbody>
                            <?php foreach ( $searchResult as $key ) { ?>
                            <tr>
                                <td>
                                    <?php echo $key["nomeProduto"]; ?>
                                </td>
                                <td>
                                    <?php echo $key["precProduto"]; ?>
                                </td>
                                <td>
                                    <?php echo $key["descontoPromocao"]; ?>
                                </td>
                                <td>
                                    <?php echo $key["nomeCategoria"]; ?>
                                </td>
                                <td>
                                    <a href="/produtos.php?update=<?php echo $key["idProduto"]; ?>" title="Editar produto">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/lista-produtos.php?delete=<?php echo $key["idProduto"]; ?>" title="Excluir produto">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    
                    <?php require_once("includes/footer.php"); ?>
                </div>
                <?php } else { ?>
                <div class="cmp-box-space">
                    <h1>Os resultados da busca aparecerão aqui.</h1>
                </div>
                <?php } ?>
            </section>
        </div>

        <?php require_once("includes/scripts.php"); ?>
    </body>
</html>