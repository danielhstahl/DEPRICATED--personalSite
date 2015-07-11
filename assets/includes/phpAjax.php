 <?php
    header("content-type:application/json");
    include 'dbConnect.php';
    $db=new myDB("root", "", "127.0.0.1", "personalWeb");
    
    $id = $_POST['id'];
    $value = $_POST['value'];

    $ip=$_SERVER['REMOTE_ADDR'];
    $sql="INSERT INTO trackInput values('". $ip . "', '" . $id . "', '" . $value . "')";
    try { //primary key may be violated
        $db->execute($sql);
    }
    catch(Exception $e){ //if primary key is violated, try to update instead
        $sql="UPDATE trackInput SET value='" . $value . "' WHERE ip='" . $ip . "' AND id='" . $id . "'";
        $db->execute($sql);
    }
    
 ?>