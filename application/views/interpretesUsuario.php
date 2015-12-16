<div class="panel panel-default">
    <h3>Intérpretes</h3>

    <ul class="list-group">

        <?php

        foreach($interpretesUsuario as $intUsu)
        {
            echo '<li class="list-group-item">';
            echo $intUsu->nombre_interprete;
            echo '</li>';
        }

        ?>

    </ul>
</div>