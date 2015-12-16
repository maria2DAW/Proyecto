<body>
    
<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=base_url(); ?>"><i class="fa fa-music"></i> CANTICUM</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href='<?=base_url(); ?>'>INICIO</a></li>
                <li><a href='<?=base_url(); ?>'>ACERCA DE</a></li>
                <li><a href='<?=base_url(); ?>index.php/Controlador_principal/indice_interpretes'>INTÉRPRETES</a></li>
                <li><a href='<?=base_url(); ?>'>ÁLBUMES</a></li>
                <li><a href='<?=base_url(); ?>index.php/Controlador_principal/indice_letras'>LETRAS</a></li>
                <li><a href='<?=base_url(); ?>index.php/Controlador_principal/<?=$enlaceLogin?>'><span class="glyphicon glyphicon-user"></span>  <?=$login ?></a></li>
            </ul>
        </div><!--/.nav-collapse -->           
    </div>
</nav>