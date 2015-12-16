<div class="container">
    <div class="row centered">

        <a href='<?=base_url(); ?>index.php/Controlador_principal/categoriasLetra' class="btn btn-info btn-sm" >Categorías</a><br>

        <h3 align="center" >Índice de letras</h3>

        <br>

        <ul id="listaLetCanLetra" class="pagination" >
            <li><a onclick="cargarCancionesPorSimbolo()" >#</a></li>

            <?php

            foreach(range('A', 'Z') as $letter)
            { ?>
                <li><a <?php if($letter == 'N') { echo 'id="linkCanLetraN"'; } ?> onclick="cargarCancionPorLetra('<?=$letter;?>')" >
                    <?=$letter;?>
                </a></li>

                <?php
            }
            ?>

            <li><a onclick="cargarCancionesPorNumero()">0-9</a></li>
        </ul>

        <br><br>

        <div id="cargaListaLetras">

        </div>
    </div>
</div>