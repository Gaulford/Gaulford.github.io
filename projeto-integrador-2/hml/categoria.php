<!DOCTYPE html>
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
                            <input type="text" name="name-category" placeholder="Insira o nome da categoria">
                        </div>
                        <div class="mod-input">
                            <textarea name="desc-categoty" cols="30" rows="10" placeholder="Insira a descrição da categoria"></textarea>
                        </div>
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