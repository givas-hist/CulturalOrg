<div id="barra">
		<a class="titlebar" href="<?php echo $config['indexfile']; ?>"><?php echo $config["podcast_title"]; ?></a>
				<a href="admin/" target="_blank">Admin</a>
	        <?php
            if (strtolower($config["categoriesenabled"]) == "yes") {
            ?>
            <a href="categories.php">Categorias</a>
            <?php
            }
            ?>
            <a href="http://www.givaldo.com.br" >Nossa História</a>
      		<a href="<?php echo $config['indexfile']; ?>">Início</a>
</div>
