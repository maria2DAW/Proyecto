<div class="container">
    <div class="row centered">

        <h3 align="center" >Índice de Álbumes</h3>

        <br>

        <ul id="listaLetCanLetra" class="pagination" >
            <li><a onclick="cargarAlbumesPorSimbolo()" >#</a></li>

            <?php

            foreach(range('A', 'Z') as $letter)
            { ?>
                <li><a <?php if($letter == 'N') { echo 'id="linkAlbLetraN"'; } ?> onclick="cargarAlbumPorLetra('<?=$letter;?>')" >
                    <?=$letter;?>
                </a></li>

                <?php
            }
            ?>

            <li><a onclick="cargarAlbumesPorNumero()">0-9</a></li>
        </ul>

        <br><br>

        <div id="cargaListaAlbumes">

        </div>
    </div>
</div>