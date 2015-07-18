<?php
    header("content-type:application/json");
    //include 'dbConnect.php';
    $db=new myDB("root", "root", "127.0.0.1", "personalWeb", 8889);
    
    //$id = $_POST['id'];
    $ip=$_SERVER['REMOTE_ADDR'];
    $sql="SELECT DISTINCT Session FROM  trackInput WHERE ip='" . $ip . "' and IsSaved=1";
    function callBack($row){
    	echo "<option>" . $row['Session'] . "</option>";
    }
    
    $db->executeCallback($sql, callBack); 
    echo "<option>New Session</option>";
    
    
 ?>