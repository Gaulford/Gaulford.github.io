<!DOCTYPE html>

<?php require_once("/system/controlers/page-categorias.php"); ?>

<!--[if IE 8]>         <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
    <head>
        <?php require_once("includes/head.php"); ?>
    </head>
    <body class="pages-manage-data page-categoria">
        
        <?php require_once("includes/header.php"); ?>

        <div class="cmp-container">

            <?php require_once("includes/navigation.php"); ?>
            
            <section class="cmp-content">
                <form action="#" method="post">
                    <fieldset class="cmp-box-space">
                        <h1>Categoria: Nome categoria </h1>
                        <div class="mod-input">
                            <input type="text" name="name-category" placeholder="Insira o nome da categoria" value="<?php showData( $checkCategoriaData, $sqlCategoria[0]["Categoria"], "" ); ?>">
                        </div>
                        <div class="mod-input">
                            <textarea name="desc-category" placeholder="Insira a descrição da categoria">
                                <?php showData( $checkCategoriaData, $sqlCategoria[0]["Descricao"], "" ); ?>
                            </textarea>
                        </div>
                        <?php if ( isset( $_GET ) and array_key_exists( "update", $_GET ) )  { ?>
                            <input type='hidden' name='update' value="<?php echo $_GET['update'] ?>">
                        <?php } else { ?>
                            <input type='hidden' name='insert'>
                        <?php } ?>
                        <button class="mod-btn">
                            Inserir categoria
                        </button>
                    </fieldset>
                </form>

                <?php require_once("includes/footer.php"); ?>
            </section>
        </div>

        <?php require_once("includes/scripts.php"); ?>
    </body>
</html>