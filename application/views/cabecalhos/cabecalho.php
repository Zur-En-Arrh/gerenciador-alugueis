<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Ícones -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <title>Laboratório TELECOM</title>
  </head>
  <body>

    <div class="container">


      <nav class="navbar navbar-expand-lg bg-dark navbar-dark">

      
        <a href="<?php echo base_url(); ?>" class="navbar-brand mb-0 text-info">
          <img src="<?php echo base_url(); ?>imagens/logo-cefet.jpg" class="rounded-circle" width="40px" height="40px"  alt="">
        </a>
            
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nvbSite">
          <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="nvbSite">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>" class="nav-link text-info">Home</a>
            </li>
            <?php if(isset($_SESSION["id"])): ?>
            <li class="nav-item">
              <a href="<?php echo base_url().'usuario/paginaEditarPerfil' ?>" class="nav-link text-info"><?php echo $_SESSION["id"]["nome"];?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-info" href="<?php echo base_url().'usuario/logoff'; ?>">Log-Off</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-info" href="<?php echo base_url('pedido/ver_pedidos'); ?>">Pedidos</a>
            </li>
            <?php elseif(isset($_SESSION["admin"])): ?>
            <li class="nav-item">
              <a href="" class="nav-link text-info"><?php echo $_SESSION["admin"]->username;?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-info" href="<?php echo base_url().'usuario/logoff'; ?>">Log-Off</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-info" href="<?php echo base_url('pedido/ver_pedidos'); ?>">Pedidos</a>
            </li>
            <?php endif; ?>
            <!--  -->
          </ul>

            <form action="<?php echo base_url().'usuario/verificarCpf' ?>" method="post" class="form-inline">
                <input type="text" name="cpf" class="form-control ml-2 mr-2">
                <button class="btn btn-outline-info" type="submit">Logar</button>
            </form> <!-- Formulário de Busca -->
        </div> <!-- Links Do Menu -->
      </nav> <!--Menu Principal-->

      <div class="row mt-3">
          <div class="col-sm-12 mr-auto col-md-4">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-dark text-info">
            <li class="breadcrumb-item">Home</li>
            <?php foreach($breadcrumbs as $breadcrumb): ?>
            <li class="breadcrumb-item"><?php echo ucfirst($breadcrumb); ?></li>
            <?php endforeach; ?> 
          </ol>
        </nav> <!-- Nav Breadcrumb -->
          </div>
          
          <div class="col-sm-12 col-md-8">
            
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                <form class="form-inline" action="<?php echo base_url().'equipamento/pesquisa' ?>" method="GET" enctype="multipart/form-data">
                    
                    <label for="pesquisa" class="text-info mx-3" for="ordem">Pesquisa:</label>
                    <select id="status" name="status" class="form-control mx-2">
                        <option value="qualquer">Qualquer</option>
                        <option value="disponível">Disponíveis</option>
                        <option value="emprestado">Emprestados</option>
                        <option value="avariado">Avariados</option>
                        <option value="em manutenção">Em Manutenção</option>
                        <option value="alienado">Alienados</option>
                        <option value="esgotado">Esgotados</option>
                    </select>
                    <select id="ordem" name="ordem" class="form-control mx-2">
                        <option value="nome/asc">A-Z</option>
                        <option value="nome/desc">Z-A</option>                        
                    </select>
                    <input id="pesquisa" class="form-control mx-2" type="text" name="nome" />
                    <button class="btn btn-outline-info" type="submit">Buscar</button>
                </form>
            </nav>
          </div>
      </div>

      <div class="row">

        <div class="col-lg-4 col-md-12 col-sm-12">
          <div class="list-group list-group-flush">
            <li class="list-group-item bg-dark text-info disbled">Opções</li>
            <a href="<?php echo base_url('equipamento/criacao'); ?>" class="list-group-item list-group-item-action">Inserir Equipamentos Novos</a>
            <a href="<?php echo base_url('relatorio'); ?>" class="list-group-item list-group-item-action">Ver Relatórios</a>
            <a href="<?php echo base_url('usuario/ver_wishlist'); ?>" class="list-group-item list-group-item-action">Ver Pedidos Indisponíveis</a>
        </div>
        </div> <!-- Div Barra Lateral -->
        
        <div class="col-lg-8 col-md-12 col-sm-12">