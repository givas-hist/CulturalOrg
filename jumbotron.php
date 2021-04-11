<div class="row">
    <?php
    if (getFreebox() == null) {
        echo '<div class="column-total">';
    } else {
        echo '<div class="column-principal">';
    }
    ?>
    <div>
        <?php
            // IF name was passed, do this instead
            if (isset($_GET[$link])) {
                include 'singleepisode.php';
            } else {
                include 'listepisodes.php';
            }
            ?>
        <?php
        foreach ($buttons as $item) {
            if (!isset($item->protocol)) {
                echo '<a class="' . htmlspecialchars($item->class) . '" href="external.php?name=' . htmlspecialchars($item->name) . '">' . htmlspecialchars($item->name) . '</a> ';
            } else {
                echo '<a class="' . htmlspecialchars($item->class) . '" href="external.php?name=' . htmlspecialchars($item->name) . '">' . htmlspecialchars($item->name) . '</a> ';
            }
        }
        ?>
    </div>
</div>

<?php
if (getFreebox() != null) {
    echo '
    <div class="column-freebox">
            ' . getFreebox() . '
    </div>';
}
?>
</div>