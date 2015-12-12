<!DOCTYPE html>

<?php require_once("/system/controlers/page-lista-produtos.php"); ?>

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
                <div class="cmp-box-space">
                    <h1>Lista de produtos cadastrados</h1>

                    <div class="cmp-inset-action">
                        <a href="/produtos.php" class="mod-btn">
                            <i class="fa file-text-o"></i>
                            Inserir produto
                        </a>
                    </div>
                </div>
                
                <div class="cmp-box-no-space">
                    <?php if ( isset( $allProducts ) and !empty( $allProducts ) ) { ?>
                    <table class="cmp-table-data">
                        <thead>
                            <th>Produto</th> 
                            <th>Preço</th>
                            <th>Desconto</th>
                            <th colspan="2">Açôes</th>
                        </thead>
                        <tbody>
                            <?php foreach ( $allProducts as $key ) { ?>
                            <tr>
                                <td>
                                    <?php echo $key["Produto"]; ?>
                                </td>
                                <td>
                                    <?php echo $key["Preco"]; ?>
                                </td>
                                <td>
                                    <?php echo $key["Desconto"]; ?>
                                </td>
                                <td>
                                    <a href="/produtos.php?update=<?php echo $key["Id"]; ?>" title="Editar produto">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/lista-produtos.php?delete=<?php echo $key["Id"]; ?>" title="Excluir categoria">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php } else { ?>
                        <h1>Não existe produtos cadastrados.</h1>
                    <?php } ?>
                </div>

                <?php require_once("includes/footer.php"); ?>
            </section>
        </div>

        <?php require_once("includes/scripts.php"); ?>
    </body>
</html>