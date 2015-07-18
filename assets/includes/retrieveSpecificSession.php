 <?php
    header("content-type:application/json");
    include 'dbConnect.php';
    $db=new myDB("root", "root", "127.0.0.1", "personalWeb", 8889);
    $session=$_POST['session'];
    //$id = $_POST['id'];
    $ip=$_SERVER['REMOTE_ADDR'];
    $sql="SELECT Value, Id FROM  trackInput WHERE ip='" . $ip . "' and session='" . $session . "'";
    $db->execute($sql); //returns values, if any
    
    
 ?>