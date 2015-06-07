<?php
$myFiles=scandir (getcwd()); /*scan current directory for files */
$currentFile=basename($_SERVER["REQUEST_URI"], ".php");//str_replace(".php", "", __FILE__); /*name of current file */
//echo '<ul>';
foreach($myFiles as $value) {
    if(strrpos($value, "php")){
        $meta=get_meta_tags($value);
        $file=(isset($meta['contenttype']) ? $meta['contenttype'] : null);
        if($file==$currentFile) {
            //echo '<li><a href="' . $value . '">' . $meta['description'] . '</a></li>';
            echo '<form  action="' . $value . '"><input class="btn btn-default" type="submit" value="' . $meta['description'] . '"></form>';
        }
    }
}   
//echo '</ul>';

?>