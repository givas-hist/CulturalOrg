<div id="barra">
	        <a href="<?php echo $config['indexfile']; ?>">Home</a>
            <?php
            if (strtolower($config["categoriesenabled"]) == "yes") {
            ?>
            <a href="categories.php"><?php echo $categories; ?></a>
            <?php
            }
            ?>
            <a href="admin/" target="_blank">Admin</a>
      
</div>
