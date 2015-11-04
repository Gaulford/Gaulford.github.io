<!DOCTYPE html>

<?php require_once("/system/controlers/page-produtos.php"); ?>

<!--[if IE 8]>         <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
    <head>
        <?php require_once("includes/head.php"); ?>
    </head>
    <body class="pages-manage-data page-produto">
        
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
                                    <input type="text" name="name-product" placeholder="Insira o nome do produto" value="<?php showData( $checkProductData, $sqlProduct[0]["Produto"], "" ); ?>" >
                                </div>
                                <div class="mod-input">
                                    <input type="text" name="price-product" placeholder="Insira preço do produto" value="<?php showData( $checkProductData, $sqlProduct[0]["Preco"], "" ); ?>" >
                                </div>
                                <div class="mod-input">
                                    <input type="text" name="discount -product" placeholder="Insira o desconto do produto" value="<?php showData( $checkProductData, $sqlProduct[0]["Desconto"], "" ); ?>" >
                                </div>
                                <div class="mod-input">
                                    <input type="text" name="inventory-product" placeholder="Insira quantos produtos existem no estoque" value="<?php showData( $checkProductData, $sqlProduct[0]["Estoque"], "" ); ?>" >
                                </div>
                            </div>
                            <div class="mod-input col-48">
                                <textarea name="desc-product" cols="30" rows="10" placeholder="Insira a descrição do produto">
                                    <?php showData( $checkProductData, $sqlProduct[0]["Descricao"], "" ); ?>
                                </textarea>
                            </div>
                        </div>
                        <div class="grid">
                            <div class="col-48">
                                <div class="col-1-3">
                                    <h2>Ativar o produto?</h2>
                                </div>
                                <div class="mod-input-mark col-1-3">
                                    <input type="radio" name="product-active" value="1" <?php showData( $sqlProduct[0]["Ativo"], "checked", "" ); ?> >
                                    <label for="product-active">Sim</label>
                                </div>
                                <div class="mod-input-mark">
                                    <input type="radio" name="product-active" value="0" <?php showData( $sqlProduct[0]["Ativo"], "", "checked" ); ?> >
                                    <label for="product-active">Não</label>
                                </div>
                            </div>
                            <div class="col-48">
                                <div class="grid">
                                    <?php if ( $checkCategoryData ) { ?>
                                    <div class="mod-input col-48">
                                        <select name="product-category">
                                            <?php foreach ( $allCategories as $key ) { ?>
                                            <option value="<?php echo $key["idCategoria"]; ?>">
                                                <?php echo $key["Categoria"]; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php } ?>
                                    <div class="mod-input col-48">
                                        <input type="file" name="product-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            if ( isset( $_GET ) and array_key_exists( "update", $_GET ) )
                            {
                                echo "<input type='hidden' name='update'>";
                            }
                            else
                            {
                                echo "<input type='hidden' name='insert'>";
                            }
                        ?>
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