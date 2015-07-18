<?php
    header("content-type:application/json");
    include 'dbConnect.php';
    $db=new myDB("root", "root", "127.0.0.1", "personalWeb", 8889);
    
    $session = $_POST['session'];
    $ip=$_SERVER['REMOTE_ADDR'];
    $sql="UPDATE trackInput SET IsSaved=0 WHERE ip='" . $ip . "' AND session='" . $session . "'";
    
    $db->execute($sql);
    
    
 ?>