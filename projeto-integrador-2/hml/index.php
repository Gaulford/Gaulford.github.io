<!DOCTYPE html>

<?php require_once("/system/controlers/page-login.php") ?>

<!--[if IE 8]>         <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
    <head>
        <?php require_once("includes/head.php"); ?>
    </head>
    <body class="page-categoria">
        
        <header class="cmp-header">
            <h1>
                Administração do site Juliet
            </h1>
        </header>

        <section class="cmp-login">
            <form action="#" method ="post" enctype="multipart/form-data" accept-charset="UTF-8">
                <fieldset>
                    <div class="user-call">
                        <div class="mod-user-photo">
                            <img src="#" alt="Foto usuário">
                            <i class="fa fa-users"></i>
                        </div>
                        <legend>Faça login em sua conta</legend>
                        <p>Insira suas credenciais abaixo</p>
                    </div>
                    
                    <div class="mod-input">
                        <i class="fa fa-user"></i>
                        <input type="text" placeholder="E-mail / Nome de usuário" name="admin-username">
                    </div>
                    <div class="mod-input">
                        <i class="fa fa-lock"></i>
                        <input type="password" placeholder="Senha" name="admin-pass">
                    </div>

                    <button class="mod-btn">
                        <i class="fa fa-unlock"></i>
                        Login
                    </button>

                    <a href="#" title="Esqueceu sua senha?">Esqueceu sua senha?</a>
                </fieldset>
            </form>
        </section>

        <?php require_once("includes/footer.php"); ?>

        <?php require_once("includes/scripts.php"); ?>
    </body>
</html>