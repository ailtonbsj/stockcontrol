<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="images/icon.png"/>

	<title>Orkidea StockControl</title>

    <?php

    include_once('model/authenticator.php');
    if(!Authenticator::hasAuthority()){
        header('location: index.php');
        exit();
    }

    include_once('useful.php');

    //bootstrap core
    includeCss('vendor/bootstrap/css/bootstrap.min.css');
    //MetisMenu
    includeCss('vendor/metisMenu/metisMenu.min.css');
    //sb-admin 2
    includeCss('dist/css/sb-admin-2.css');
    //Font Awesome
    includeCss('vendor/font-awesome/css/font-awesome.min.css');
    //bootstrap datetimepicker
    includeCss('vendor/bs_datetimepicker/css/bootstrap-datetimepicker.min.css');
    //bootstrap tagsinput
    includeCss('vendor/bs_tagsinput/bootstrap-tagsinput.css');

    //jquery
    includeJs('vendor/jquery/jquery.min.js', $cached);
    //Moment
    includeJs('vendor/moment/moment-with-locales.js', $cached);
    //bootstrap datetime picker
    includeJs('vendor/bs_datetimepicker/js/bootstrap-datetimepicker.min.js', $cached);
    //Bootbox
    includeJs('vendor/bootbox/bootbox.min.js');

    ?>
</head>
<body>
	<div id="wrapper">

		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

			<div class="navbar-header">
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand">Orkidea StockControl</a>
			</div><!--/.navbar-header-->

			<ul class="nav navbar-top-links navbar-right">
			<li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i><span id="notificacao-badge" class="badge progress-bar-danger">0</span> <i class="fa fa-caret-down"></i>
                </a>
                <ul id="notificacao-view" class="dropdown-menu dropdown-messages">
                    <li>
                        <a><div>Nenhuma Notificação.</div></a>
                    </li>
                </ul><!-- /.dropdown-alerts -->
            </li><!-- /.dropdown -->
			<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?= $_SESSION['user'] ?></a>
                        <li class="divider"></li>
                        <li><a href="index.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li><!-- /.dropdown -->
			</ul><!-- /.navbar-top-links -->

			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
						<li>
							<a href="#"><i class="fa fa-list-ol fa-fw"></i> Categoria<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
							<li><a href="#" id="add-cat-menu">Nova Categoria</a></li>
								<li><a href="#" id="list-cat-menu">Listar Categorias</a></li>
							</ul><!-- /.nav-second-level -->
						</li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Retirante<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <li><a href="#" id="add-ret-menu">Novo Retirante</a></li>
                                <li><a href="#" id="list-ret-menu">Listar Retirantes</a></li>
                            </ul><!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-child fa-fw"></i> Fornecedor<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <li><a href="#" id="add-for-menu">Novo Fornecedor</a></li>
                                <li><a href="#" id="list-for-menu">Listar Fornecedores</a></li>
                            </ul><!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> Produto<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="#" id="add-pro-menu">Novo Produto</a></li>
                                <li><a href="#" id="list-pro-menu">Listar Produtos</a></li>
                            </ul><!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-exchange fa-fw"></i> Estoque<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="#" id="in-sto-menu">Entrada de Material</a></li>
                                <li><a href="#" id="out-sto-menu">Saida de Material</a></li>
                                <li><a href="#" id="list-in-sto-menu">Listar Entradas</a></li>
                                <li><a href="#" id="list-out-sto-menu">Listar Saidas</a></li>
                            </ul><!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#" id="about-menu"><i class="fa fa-info-circle fa-fw"></i> Sobre</a>
                        </li>
					</ul>
				</div>
			</div>

		</nav>


		<!-- Page Content -->
		<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
			&nbsp;
				<!--<h1 class="page-header">&nbsp;</h1>-->
			</div><!--/.col-lg-12-->
				<?php

				//class parent
                includeJs('controller/Controller.js');

				//View
				include('view/retirante.html');
                include('view/listRetirante.html');
                //Controller
                includeJs('controller/Retirante.js');


                //View
                include('view/fornecedor.html');
                include('view/listFornecedor.html');
                //Controller
                includeJs('controller/Fornecedor.js');

                //View
                include('view/categoria.html');
                include('view/listCategoria.html');
                //Controller
                includeJs('controller/Categoria.js');

                //View
                include('view/produto.html');
                include('view/listProduto.html');
                //Controller
                includeJs('controller/Produto.js');

                //View
                include('view/estoque.html');
                include('view/listEstoque.html');
                //Controller
                includeJs('controller/Estoque.js');
                includeJs('controller/EntradaEstoque.js');
                includeJs('controller/SaidaEstoque.js');

                //Controller
                includeJs('controller/Notificacao.js');

				//include('view/categoria.html');
				//include('view/listCategoria.html');



                //include('view/listFornecedor.html');
                //include('view/fornecedor.html');


                //includeJs('controller/Categoria.js');

                //includeJs('controller/Fornecedor.js');

				?>
                <script>
                function isInt(x) {
                   var y = parseInt(x, 10);
                   return !isNaN(y) && x == y && x.toString() == y.toString();
                }

                $(function(){
                    rc = new RetiranteController();
                    fc = new FornecedorController();
                    cc = new CategoriaController();
                    pc = new ProdutoController();
                    es = new EntradaEstoqueController();
                    sm = new SaidaEstoqueController();
                    nt = new Notificacao();
                    $('#about-menu').click(function(){
                        bootbox.alert({
                            title: "Sobre",
                            message: "Desenvolvido por:<br><br>"+
                            "Ailton B.S, J<br><br>"+
                            "<a target='_blank' href='https://ailtonbsj.wordpress.com'>https://ailtonbsj.wordpress.com</a>",
                            callback: function(){}
                        });
                    });
                    es.insert();
                });
                </script>
			</div>
		</div><!--/#page-wrapper-->
	</div><!--/#wrapper-->
    <?php
    //bootstrap core
    includeJs('vendor/bootstrap/js/bootstrap.min.js', $cached);
    //metis menu
    includeJs('vendor/metisMenu/metisMenu.min.js', $cached);
    //sb-admin 2
    includeJs('dist/js/sb-admin-2.js', $cached);

    ?>
</body>
</html>
