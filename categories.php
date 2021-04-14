<!DOCTYPE html>
<html>

<head>
    <title><?php echo htmlspecialchars($config["podcast_title"]); ?></title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($config["theme_path"]); ?>style/meuestilo.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
</head>

<body>
    <?php
    include "navbar.php";
    ?>
    <br>
        <?php
        include "js.php";
        if (!isset($_GET["cat"])) {
        ?>
        <btn class="card" style="margin-top: 30px;">
            <ol style="list-style-type:none;">
                <?php
                foreach ($categories_xml as $item) {
                    echo "<li><a href=\"categories.php?cat=" . $item->id . "\">" . $item->description . "</a></li>";
                }
                ?>
            </ol> </btn>
<br>
<hr>
<br>            
				<btn class="card"style="padding:25px;">
            <a href="categories.php?cat=all"><?php echo _('All Episodes'); ?></a> </btn>
            
        <?php
        } else {
            include 'listepisodes.php';
        }
        ?>

</body>

</html>