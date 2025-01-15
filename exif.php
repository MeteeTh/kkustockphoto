
    <?php
    $dir = 'images/';
    $file = scandir($dir);

    $ext_list = ['jpg', 'png', 'jpeg', 'gif'];

    foreach ($file as $image_file) {
        $l = strtolower($image_file);
        $parse_file_name = explode(".", $l);
        $file_ext = end($parse_file_name);

        if (in_array($file_ext, $ext_list)) {
            $exif_data[] = exif_read_data($dir . $image_file);

            print "<pre>";
            print_r($exif_data);
            print "</pre>";
        }
    }

    ?>