<div class="panel panel-default">
    <h3>Álbumes</h3>

    <ul class="list-group">

        <?php

        foreach($albumesUsuario as $albUsu)
        {
            echo '<li class="list-group-item">';
            echo $albUsu->nombre_album;
            echo '</li>';
        }

        ?>

    </ul>

</div>