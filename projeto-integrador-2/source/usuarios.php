<!DOCTYPE html>

<?php require_once("system/controlers/page-usuarios.php"); ?>

<!--[if IE 8]>         <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
    <head>
        <?php require_once("includes/head.php"); ?>
    </head>
    <body class="pages-manage-data page-usuario">
        
        <?php require_once("includes/header.php"); ?>

        <div class="cmp-container">

            <?php require_once("includes/navigation.php"); ?>

            <section class="cmp-content">
                <form action="#" method="post">
                    <fieldset class="cmp-box-space">
                        <h1>Usuário: Nome usuário</h1>
                        <div class="grid">
                            <div class="col-48">
                                <div class="mod-input">
                                    <input type="text" name="name-user" placeholder="Insira o nome do usuário" value="<?php showData( $checkUserData, $sqlUser[0]["Nome"], "" ); ?>">
                                </div>
                                <div class="mod-input">
                                    <input type="text" name="login-user" placeholder="Insira o login do usuário" value="<?php showData( $checkUserData, $sqlUser[0]["Login"], "" ); ?>">
                                </div>
                                <div class="mod-input">
                                    <select name="profile-user">
                                        <?php foreach ( $allProfile as $key ) { ?>
                                            <?php if ( $sqlUser[0]["Perfil"] == $key["tipoPerfil"] ) { ?>
                                            <option value="<?php echo $key['tipoPerfil']; ?>" selected>
                                                Perfil <?php echo $key["tipoPerfil"]; ?>
                                            </option>
                                            <?php } else { ?>
                                            <option value="<?php echo $key['tipoPerfil']; ?>">
                                                Perfil <?php echo $key["tipoPerfil"]; ?>
                                            </option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-48">
                                <div class="mod-input">
                                    <input type="password" name="password-user" placeholder="Insira a senha do usuário">
                                </div>
                                <div class="col-48">
                                    <div class="col-1-3">
                                        <h2>Usuário ativo?</h2>
                                    </div>
                                    <div class="mod-input-mark col-1-3">
                                        <input type="radio" name="user-active" value="1" <?php showData( $sqlUser[0]["Ativo"], "checked", "" ); ?>>
                                        <label for="user-active">Sim</label>
                                    </div>
                                    <div class="mod-input-mark">
                                        <input type="radio" name="user-active" value="0" <?php showData( $sqlUser[0]["Ativo"], "", "checked" ); ?>>
                                        <label for="user-active">Não</label>
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
                            Inserir usuário
                        </button>
                    </fieldset>
                </form>

                <?php require_once("includes/footer.php"); ?>
            </section>
        </div>

        <?php require_once("includes/scripts.php"); ?>
    </body>
</html>