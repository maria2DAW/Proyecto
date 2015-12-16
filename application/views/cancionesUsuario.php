<div class="panel panel-default">
    <h3>Canciones</h3>

    <ul class="list-group">

        <?php

        foreach($cancionesUsuario as $canUsu)
        {
            echo '<li class="list-group-item">';
            echo $canUsu->nombre_cancion;
            echo '</li>';
        }

        ?>

    </ul>

</div>