        
    
    <div class="paginas">

        <?php for($i = 1; $i <= $numero_paginas; $i++):?>
            <?php if(pagina_actual() == $i):?>
                <a class="active" href="#"><?php echo $i;?></a>
            <?php else:?>
                <a href="recetas_cocteles.php?p=<?php echo $i;?>"><?php echo $i;?></a>
            <?php endif;?>
        <?php endfor; ?>

    </div>