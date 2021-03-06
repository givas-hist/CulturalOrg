<?php
$correctepisode = array();
for ($i = 0; $i < sizeof($episodes); $i++) {
    if ($episodes[$i]["episode"]["filename"] == $_GET[$link]) {
        $correctepisode = $episodes[$i];
        break;
    }
}
// Check if episode was not found
if (sizeof($correctepisode) == 0) {
    echo _('Episode does not exist');
    goto end;
}

// Get mime
$mime = getmime($config["absoluteurl"] . $config["upload_dir"] . $correctepisode["episode"]["filename"]);
if (!$mime)
    $mime = null;
$type = '';
$metadata = '';
if (substr($mime, 0, 5) == 'video') {
    $type = 'video';
} elseif (substr($mime, 0, 5) == 'audio' || $mime == 'application/ogg') {
    $type = 'audio';
    $metadata = '(' . $correctepisode["episode"]["fileInfoPG"]["bitrate"] . ' kbps ' . $correctepisode["episode"]["fileInfoPG"]["frequency"] . ' Hz)';
} else {
    $type = 'invalid';
}

echo '<div> <br /> <btn class="card">';
echo '  <h1>' . $correctepisode["episode"]["titlePG"] . '</h1>';
echo '  <small>' . $correctepisode["episode"]["moddate"] . '</small><br>';
// Check for image

// The imgPG value has the highest priority
if ($correctepisode["episode"]["imgPG"] != "") {
    echo '  <img style="max-width: 50%; max-height: 50%;" src="' . $correctepisode["episode"]["imgPG"] . '"><br>';
} elseif (
    file_exists($config["absoluteurl"] . $config["img_dir"] . $correctepisode["episode"]["fileid"] . '.jpg') ||
    file_exists($config["absoluteurl"] . $config["img_dir"] . $correctepisode["episode"]["fileid"] . '.png')
) {
    // TODO Really ugly code, needs to be done more beatiful
    $filename = file_exists($config["absoluteurl"] . $config["img_dir"] . $correctepisode["episode"]["fileid"] . '.png') ?
        $config["url"] . $config["img_dir"] . $correctepisode["episode"]["fileid"] . '.png' :
        $config["url"] . $config["img_dir"] . $correctepisode["episode"]["fileid"] . '.jpg';
    echo '  <img style="max-width: 50%; max-height: 50%;" src="' . $filename . '"><br>';
}
echo '  <small>' . $correctepisode["episode"]["shortdescPG"] . '</small><br>';

/*links para baixar e editar epis??dio*/
if (isset($_SESSION["username"])) {
    echo '  <a class="btn" href="admin/episodes_edit.php?name=' . $episodes[$i]["episode"]["filename"] . '">' . $editdelete . '</a>';
}
echo '  <a class="btn" href="media/' . $correctepisode["episode"]["filename"] . '">' . $download . '</a><br>';
if ($type != 'invalid')

 {
    echo '  <h5>' . $filetype . ': ' . strtoupper(pathinfo($config["upload_dir"] . $correctepisode["episode"]["filename"], PATHINFO_EXTENSION)) . '
                - ' . $size . ': ' . $correctepisode["episode"]["fileInfoPG"]["size"] . ' MB - ' . $duration . ': ' . $correctepisode["episode"]["fileInfoPG"]["duration"] . 'm ' . $metadata . '</h5><br>';
}

/*Stream - controles*/
if (strtolower($config["enablestreaming"]) == "yes") {
    if ($type == 'audio') {
        echo '  <audio controls>';
        echo '      <source src="' . $config["upload_dir"] . $episodes[$i]["episode"]["filename"] . '" type="' . $mime . '">';
        echo '  </audio>';
    } elseif ($type == 'video') {
        echo '  <video controls width="250">';
        echo '      <source src="' . $config["upload_dir"] . $correctepisode["episode"]["filename"] . '" type="' . $mime . '">';
        echo '  </video>';
    }
}
echo '</btn></div>';

end: echo "";
?>
<br />
