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
                        <h1>Produto: Nome produto</h1>
                        <div class="grid">
                            <div class="col-48">
                                <div class="mod-input">
                                    <input type="text" name="name-product" placeholder="Insira o nome do produto">
                                </div>
                                <div class="mod-input">
                                    <input type="text" name="price-product" placeholder="Insira preço do produto">
                                </div>
                                <div class="mod-input">
                                    <input type="text" name="discount-product" placeholder="Insira o desconto do produto">
                                </div>
                                <div class="mod-input">
                                    <input type="text" name="inventory-product" placeholder="Insira quantos produtos existem no estoque">
                                </div>
                            </div>
                            <div class="mod-input col-48">
                                <textarea name="desc-product" cols="30" rows="10" placeholder="Insira a descrição do produto"></textarea>
                            </div>
                        </div>
                        <div class="grid">
                            <div class="col-48">
                                <div class="col-1-3">
                                    <h2>Ativar o produto?</h2>
                                </div>
                                <div class="mod-input-mark col-1-3">
                                    <input type="radio" name="product-active">
                                    <label for="product-active">Sim</label>
                                </div>
                                <div class="mod-input-mark">
                                    <input type="radio" name="product-active">
                                    <label for="product-active">Não</label>
                                </div>
                            </div>
                            <div class="col-48">
                                <div class="grid">
                                    <div class="mod-input col-48">
                                        <select name="product-category">
                                            <option value="1">Categoria 1</option>
                                            <option value="2">Categoria 2</option>
                                            <option value="3">Categoria 3</option>
                                        </select>
                                    </div>
                                    <div class="mod-input col-48">
                                        <input type="file" name="product-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="mod-btn">
                            Inserir produto
                        </button>
                    </fieldset>
                </form>

                <?php require_once("includes/footer.php"); ?>
            </section>
        </div>

        <?php require_once("includes/scripts.php"); ?>
    </body>
</html>