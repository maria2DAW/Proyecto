<div class="container">
    <div class="row centered">
        <h3 align="center" >Índice de intérpretes</h3>

        <br>

        <ul id="listaIntLetra" class="pagination" >
            <li><a onclick="cargarSimbolos()" >#</a></li>

            <?php

            foreach(range('A', 'Z') as $letter)
            { ?>
                <li><a <?php if($letter == 'N') { echo 'id="linkIntLetraN"'; } ?> onclick="cargarLetra('<?=$letter;?>')" >
                <?=$letter;?>
                </a></li>

            <?php
            }
            ?>

            <li><a onclick="cargarNumeros()">0-9</a></li>
        </ul>

        <br><br>

        <div id="cargaListaInterpretes">

        </div>
    </div>
</div>
