<!DOCTYPE html>
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
                                    <input type="text" name="name-user" placeholder="Insira o nome do usuário">
                                </div>
                                <div class="mod-input">
                                    <input type="text" name="login-user" placeholder="Insira o login do usuário">
                                </div>
                                <div class="mod-input">
                                    <select name="profile-user">
                                        <option value="">Perfil A</option>
                                        <option value="">Perfil B</option>
                                        <option value="">Perfil C</option>
                                        <option value="">Perfil D</option>
                                        <option value="">Perfil E</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-48">
                                <div class="mod-input">
                                    <input type="password" name="password-user" placeholder="Insira a senha do usuário">
                                </div>
                                <div class="mod-input">
                                    <input type="text" name="reenter-password-user" placeholder="Insira novamente a senha do usuário">
                                </div>
                                <div class="col-48">
                                    <div class="col-1-3">
                                        <h2>Usuário ativo?</h2>
                                    </div>
                                    <div class="mod-input-mark col-1-3">
                                        <input type="radio" name="user-active">
                                        <label for="user-active">Sim</label>
                                    </div>
                                    <div class="mod-input-mark">
                                        <input type="radio" name="user-active">
                                        <label for="user-active">Não</label>
                                    </div>
                                </div>
                            </div>
                        </div>
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