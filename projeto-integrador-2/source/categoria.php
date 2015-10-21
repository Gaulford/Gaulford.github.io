<!DOCTYPE html>
<!--[if IE 8]>         <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/modules/modules.css">
        <link rel="stylesheet" href="assets/css/components/components.css">
        <link rel="stylesheet" href="assets/css/pages/page-categoria.css">
    </head>
    <body class="page-categoria">
        
        <header class="cmp-header">
            <a href="#" title="Mostrar / ocultar menu" class="action-menu">
                <i class="fa fa-reorder"></i>
            </a>

            <h1>
                Administração do site Juliet
            </h1>

            <nav class="cmp-breadcrumbs">
                <ul>
                    <li>
                        <a href="#" title="Home">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Lista categorias">
                            Lista categorias
                        </a>
                    </li>
                </ul>
            </nav>
        </header>

        <div class="cmp-container">

            <nav class="cmp-access">
                <article class="mod-user-logged">
                    <a href="#" title="Emma Stone" class="user-photo">
                        <img src="assets/img/thumb-user.jpg" alt="Emma Stone">
                    </a>
                    <div class="user-infos">
                        <h1>Emma Stone</h1>
                        <p>
                            <i class="fa fa-map-marker"></i>
                            Santa Ana, CA
                        </p>
                    </div>
                    <a href="#" title="Sair" class="btn-sair">
                        <i class="fa fa-power-off"></i>
                    </a>
                </article>

                <h2>Menu principal</h2>

                <ul>
                    <li>
                        <a href="#" title="Home">
                            <i class="fa fa-home"></i>
                            Home
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Usuários">
                            <i class="fa fa-users"></i>
                            Usuários
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Produtos">
                            <i class="fa fa-square"></i>
                            Produtos
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" title="Categorias">
                            <i class="fa fa-ticket"></i>
                            Categorias
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>

            <section class="cmp-content">
                <h1>Categoria:Nome categoria </h1>
                <input type="text" name="name-category" placeholder="Insira o nome da categoria">
                <textarea name="desc-categoty" cols="30" rows="10" placeholder="Insira a descrição da categoria"></textarea>
                <button>
                    Inserir categoria
                </button>

                <footer class="cmp-footer">
                    <details open="open">
                        <summary>
                            © 2015 by <a href="#" title="William Magalhães Rodrigues">William Magalhães Rodrigues</a>.
                        </summary>
                    </details>
                </footer>
            </section>
        </div>

        <script src="assets/js/lib/jquery/jquery.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>