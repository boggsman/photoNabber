<?php

$fbusername = $_POST['username'];
$urls = split(",", $_POST{'pics'});

//define function to get images inside pics folder
function grab_images($dir, $urls) {
    for($i = 0; $i < sizeof($urls); ++$i) {
        if(!@copy(''.$urls[$i].'',''.$dir.'image'.$i.'.jpg')) {
            $errors= error_get_last();
            echo "COPY ERROR: ".$errors['type'];
            echo "<br />\n".$errors['message'];
        }
    }
}

//define function to delete a file
function delete_file($file) {
    if(is_file($file)) {
    unlink($file);
    }
}

//define function to delete a folder
function delete_folder($dir) {
    if(is_dir($dir)) {
        foreach(glob($dir.'*.*') as $v) {
            unlink($v);
        }
        rmdir($dir);
    }
}

//set dir to save the pics
$save_to='pics/'.$fbusername.'/';

//check is user's folder exists, if not, make a folder with the same name as the person's username
if(!file_exists( $save_to )) {
    if (!mkdir($save_to, 0755, true)) {
    die('Failed to create folders...');
    }
}

//download the pics	
grab_images($save_to, $urls);

// zip the files
shell_exec('zip pics/'.$fbusername.' '.$save_to.'*');

//delete the temp folder
delete_folder($save_to);

?>

<?php echo '{ "pics_url" : "pics/'.$fbusername.'.zip" }'; ?> }
