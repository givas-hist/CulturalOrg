<?php
// List episodes
if (isset($no_episodes)) {
    echo '<div class="column-principal"><p>' . $no_episodes . '</p></div>';
} else {
    for ($i = 0; $i < sizeof($episode_chunk); $i++) {
        $item = $episode_chunk;
        $mime = getmime($config["absoluteurl"] . $config["upload_dir"] . $item[$i]["episode"]["filename"]);
        if (!$mime)
            continue;
        $type = '';
        $metadata =  '';
        if (substr($mime, 0, 5) == 'video') {
            $type = 'video';
        } elseif (substr($mime, 0, 5) == 'audio' || $mime == 'application/ogg') {
            $type = 'audio';
            $metadata = '(' . $item[$i]["episode"]["fileInfoPG"]["bitrate"] . ' kbps ' . $item[$i]["episode"]["fileInfoPG"]["frequency"] . ' Hz)';
        } else {
            $type = 'invalid';
        }

        echo '<div class="column-principal"><btn class="list">';
       
        // Check for image
        // The imgPG value has the highest priority
        if ($item[$i]["episode"]["imgPG"] != "") {
            echo '<img style="max-width: 20%; max-height: 20%; float: left; margin-top: 5px;" src="' . $item[$i]["episode"]["imgPG"] . '"><br>';
        } elseif (
            file_exists($config["absoluteurl"] . $config["img_dir"] . $item[$i]["episode"]["fileid"] . '.jpg') ||
            file_exists($config["absoluteurl"] . $config["img_dir"] . $item[$i]["episode"]["fileid"] . '.png')
        ) {
            // TODO Really ugly code, needs to be done more beatiful
            $filename = file_exists($config["absoluteurl"] . $config["img_dir"] . $item[$i]["episode"]["fileid"] . '.png') ?
                $config["url"] . $config["img_dir"] . $item[$i]["episode"]["fileid"] . '.png' :
                $config["url"] . $config["img_dir"] . $item[$i]["episode"]["fileid"] . '.jpg';
            echo '<img style="max-width: 20%; max-height: 20%; float: left; margin-top: 5px;" src="' . $filename . '"><br>';
        }
         echo '  <h1 style="margin-top: 0;"><a class="btn" href="' . $config['indexfile'] . '?' . $link . '=' . $item[$i]["episode"]["filename"] . '">' . $item[$i]["episode"]["titlePG"] . '</a></h1>';
        echo '  <small>' . $item[$i]["episode"]["moddate"] . '</small><br>';
        echo '  <small>' . $item[$i]["episode"]["shortdescPG"] . '</small><br>';
        // Display edit button if admin is logged in
        if (isset($_SESSION["username"])) {
            echo '  <a class="btn" href="admin/episodes_edit.php?name=' . $item[$i]["episode"]["filename"] . '">' . $editdelete . '</a>';
        }
        echo '  <a class="btn" href="' . $config['indexfile'] . '?' . $link . '=' . $item[$i]["episode"]["filename"] . '">' . $more . '</a>
                <a class="btn" href="media/' . $item[$i]["episode"]["filename"] . '">' . $download . '</a><br>';
        if ($type != 'invalid') {
            echo '  <small>' . $filetype . ': ' . strtoupper(pathinfo($config["upload_dir"] . $item[$i]["episode"]["filename"], PATHINFO_EXTENSION)) . '
                - ' . $size . ': ' . $item[$i]["episode"]["fileInfoPG"]["size"] . ' MB - ' . $duration . ': ' . $item[$i]["episode"]["fileInfoPG"]["duration"] . 'm ' . $metadata . '</small><br>';
        }
        if (strtolower($config["enablestreaming"]) == "yes") {
            if ($type == 'audio') {
                echo '  <audio controls>';
                echo '      <source src="' . $config["upload_dir"] . $item[$i]["episode"]["filename"] . '" type="' . $mime . '">';
                echo '  </audio>';
            } elseif ($type == 'video') {
                echo '  <video controls width="250">';
                echo '      <source src="' . $config["upload_dir"] . $item[$i]["episode"]["filename"] . '" type="' . $mime . '">';
                echo '  </video>';
            }
        }
        echo '</btn></div>';
    }
}
?>