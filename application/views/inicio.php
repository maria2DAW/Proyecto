<div id="headerwrap">
    <div class="container">
            <div class="row centered">
                <div class="col-lg-8 col-lg-offset-2">
                <h1>Bienvenido</h1>
                <h2>Página de Inicio</h2>
                </div>
            </div><!-- row -->
    </div><!-- container -->
</div><!-- headerwrap -->

<div id="dg">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel" style="background-color: #1abc9c; color: #ffffff;">
                    <span><strong>Usuarios<br>
                    <?=$numUsuarios;?></strong></span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel" style="background-color: #1abc9c; color: #ffffff;">
                    <span><strong>Intérpretes<br>
                    <?=$numInterpretes;?></strong></span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel" style="background-color: #1abc9c; color: #ffffff;">
                    <span><strong>Álbumes<br>
                    <?=$numAlbumes;?></strong></span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel"  style="background-color: #1abc9c; color: #ffffff;">
                    <span><strong>Letras<br>
                    <?=$numLetras;?></strong></span>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Ranquin -->
<div class="container w">
    <div class="row centered">
        <h2 align="center">TOP <?=$numTop; ?></h2>
    </div>
    <div class="row centered">
        <br><br>
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>LETRAS MÁS VISITADAS</h4>
                </div>

                <ul class="list-group" style="text-align: left">

                    <?php

                    foreach($letraMasVisitadas as $letraVis)
                    {
                        echo '<li class="list-group-item">';
                        echo '<span class="badge">'.$letraVis->visitas_letra.'</span>';
                        echo $numPuesto.'. ';
                        echo '<a href="'.base_url().'index.php/Controlador_principal/mostrar_letra/'.$letraVis->id_cancion.'">';
                        echo $letraVis->nombre_cancion.'</a></li>';

                        $numPuesto++;
                    }

                    ?>

                </ul>
            </div>
        </div><!-- col-lg-4 -->

        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>USUARIOS CON MÁS LETRAS PUBLICADAS</h4>
                </div>

                <ul class="list-group" style="text-align: left">

                    <?php

                    $numPuesto = 1;

                    foreach($usuConMasLetras as $usuLet)
                    {
                        echo '<li class="list-group-item">';
                        echo '<span class="badge">'.$usuLet->num_letras.'</span>';
                        echo $numPuesto.'. ';
                        echo $usuLet->nombre_registro_usuario.'</li>';

                        $numPuesto++;
                    }

                    ?>

                </ul>
            </div>
        </div><!-- col-lg-4 -->

        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>INTÉRPRETES CON MÁS LETRAS PUBLICADAS</h4>
                </div>

                <ul class="list-group" style="text-align: left">

                    <?php

                    $numPuesto = 1;

                    foreach($intConMasLetras as $intLet)
                    {
                        echo '<li class="list-group-item">';
                        echo '<span class="badge">'.$intLet->num_letras_int.'</span>';
                        echo $numPuesto.'. ';
                        echo $intLet->nombre_interprete.'</li>';

                        $numPuesto++;
                    }

                    ?>

                </ul>
            </div>
        </div><!-- col-lg-4 -->
    </div><!-- row -->
    <br>
    <br>
</div><!-- ranquins -->

<div id="r">
    <div class="container">
        <div class="row centered">
            <h4 title="Presione aquí" id="acercaDe" >ACERCA DE</h4>
            <br>

            <div id="contAcercaDe">
                <p><strong>Proyecto Ralizado con: </strong></p>
                <p>CodeIgniter<br> <small>Versión 3.0.1</small></p>
                <p>Bootstrap<br> <small>Versión 3.3.5</small></p>
                <p>jQuery<br> <small>Versión 1.11.3</small></p>
            </div>

        </div>
    </div>
</div>
