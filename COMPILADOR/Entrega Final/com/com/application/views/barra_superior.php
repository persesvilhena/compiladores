<body class="fixed-nav sticky-footer bg-light" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">AutoHouse Compilador</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Analisador Léxico">
          <a class="nav-link" href="<?= base_url(); ?>painel/lex">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Analisador Léxico</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Analisador Sintatico">
          <a class="nav-link" href="<?= base_url(); ?>painel/">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Analisador Sintatico</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Arvore">
          <a class="nav-link" href="<?= base_url(); ?>painel/arvore">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Arvore</span>
          </a>
        </li>

      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
    <div class="content-wrapper">
    <div class="container-fluid">