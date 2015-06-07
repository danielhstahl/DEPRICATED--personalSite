<?php
$myFiles=scandir (getcwd()); /*scan current directory for files */
$currentFile=explode ('.', basename($_SERVER["REQUEST_URI"]));
$currentFile=$currentFile[0] . '.php';
$metaCurr=get_meta_tags($currentFile);
$keyWords=(isset($metaCurr['keywords']) ? $metaCurr['keywords'] : null);
foreach($myFiles as $value) {
    if(strrpos($value, "php")){
        $meta=get_meta_tags($value);
        $file=(isset($meta['keywords']) ? $meta['keywords'] : null);
        if($file==$keyWords && $value!=$currentFile) {
            echo '<a href="' . $value . '">' . $meta['description'] . '</a>';
        }
    } 
}  


?>