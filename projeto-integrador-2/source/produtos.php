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
                <form action="#" method="post" enctype="multipart/form-data">
                    <fieldset class="cmp-box-space">
                        <h1>Produto: Nome produto</h1>
                        <div class="grid">
                            <div class="col-48">
                                <div class="mod-input">
                                    <input type="text" name="name_product" placeholder="Insira o nome do produto" value="<?php showData( $checkProductData, $sqlProduct[0]["Produto"], "" ); ?>" >
                                </div>
                                <div class="mod-input">
                                    <input type="text" name="price_product" placeholder="Insira preço do produto" value="<?php showData( $checkProductData, $sqlProduct[0]["Preco"], "" ); ?>" >
                                </div>
                                <div class="mod-input">
                                    <input type="text" name="discount_product" placeholder="Insira o desconto do produto" value="<?php showData( $checkProductData, $sqlProduct[0]["Desconto"], "" ); ?>" >
                                </div>
                                <div class="mod-input">
                                    <input type="text" name="inventory_product" placeholder="Insira quantos produtos existem no estoque" value="<?php showData( $checkProductData, $sqlProduct[0]["Estoque"], "" ); ?>" >
                                </div>
                            </div>
                            <div class="mod-input col-48">
                                <textarea name="desc_product" placeholder="Insira a descrição do produto">
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
                                    <input type="radio" name="active_product" value="1" <?php showData( $sqlProduct[0]["Ativo"], "checked", "" ); ?> >
                                    <label for="product-active">Sim</label>
                                </div>
                                <div class="mod-input-mark">
                                    <input type="radio" name="active_product" value="0" <?php showData( $sqlProduct[0]["Ativo"], "", "checked" ); ?> >
                                    <label for="product-active">Não</label>
                                </div>
                            </div>
                            <div class="col-48">
                                <div class="grid">
                                    <?php if ( $checkCategoryData ) { ?>
                                    <div class="mod-input col-48">
                                        <select name="category_product">
                                            <?php foreach ( $allCategories as $key ) { ?>
                                                <?php if ( isset( $_GET["update"] ) and $key["idCategoria"] == $_GET["update"]  ) { ?>
                                                <option value="<?php echo $key["idCategoria"]; ?>" selected>
                                                    <?php echo $key["Categoria"]; ?>
                                                </option>
                                                <?php } else { ?>
                                                <option value="<?php echo $key["idCategoria"]; ?>">
                                                    <?php echo $key["Categoria"]; ?>
                                                </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php } ?>
                                    <div class="mod-input col-48">
                                        <input type="file" name="image_product">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ( isset( $_GET ) and array_key_exists( "update", $_GET ) )  { ?>
                            <input type='hidden' name='update' value="<?php echo $_GET['update'] ?>">
                        <?php } else { ?>
                            <input type='hidden' name='insert'>
                        <?php } ?>
                        <button class="mod-btn">
                            Inserir produto
                        </button>
                        <?php if ( $sqlProduct[0]["Imagem"] ) { ?>
                        <button class="mod-btn act-show-lightbox">
                            Visualizar imagem
                        </button>
                        <?php } ?>
                    </fieldset>

                    <?php if ( $sqlProduct[0]["Imagem"] ) { ?>
                    <div class="cmp-overlay"></div>
                    <div class="cmp-lightbox act-hide-lightbox">
                        <a href="#" title="Fechar" class="act-close-lightbox">
                            <i class="fa fa-times"></i>
                        </a>
                        <figure>
                            <img src="<?php echo 'data:image;base64,'.base64_encode($sqlProduct[0]["Imagem"]); ?>">
                        </figure>
                    </div>
                    <?php } ?>
                </form>

                <?php require_once("includes/footer.php"); ?>
            </section>
        </div>

        <?php require_once("includes/scripts.php"); ?>
    </body>
</html>