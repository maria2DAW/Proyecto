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
                <li><a href='<?=base_url(); ?>index.php/Controlador_principal/indice_letras'>LETRAS</a></li>
                <li><a href='<?=base_url(); ?>index.php/Controlador_principal/indice_interpretes'>INTÉRPRETES</a></li>
                <li><a href='<?=base_url(); ?>index.php/Controlador_principal/indice_albumes'>ÁLBUMES</a></li>
                <li><a href='<?=base_url(); ?>index.php/Controlador_principal/<?=$enlaceLogin?>'><span class="glyphicon glyphicon-user"></span>  <?=$login ?></a></li>
            </ul>
        </div><!--/.nav-collapse -->           
    </div>
</nav>

<div id="green">
    <div class="container">

        <div class="row">
            <div class="col-lg-4">
                <h4>BUSCADOR DE LETRAS</h4>
            </div>
        </div>

        <div class="row">

            <br>

            <form action='<?= base_url(); ?>index.php/Controlador_principal/busqueda' method='post' role="form" class="form-inline">

                <div class="col-lg-4">

                    <div class="input-group">
                        <select class="form-control" id="selectBusqueda" name="selectBusqueda">
                            <option value="busletra">Por Letra</option>
                            <option value="bustitulo">Por Título</option>
                            <option value="busalbum">Por Álbum</option>
                            <option value="businterprete">Por Intérprete</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label class="sr-only" for="inputBusqueda">Búsqueda</label>
                        <input type="text" class="form-control" id="inputBusqueda" name="inputBusqueda"
                               value='<?= set_value('inputBusqueda');?>' placeholder="Introduzca su búsqueda">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="submit">
                              <span class="glyphicon glyphicon-search"></span>
                          </button>
                        </span>
                    </div>
                    <?=form_error('inputBusqueda')?>
                </div>
            </form>
        </div>
    </div>
</div>