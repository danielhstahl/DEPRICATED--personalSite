 <?php
    header("content-type:application/json");
    include 'dbConnect.php';
    $db=new myDB("root", "", "127.0.0.1", "personalWeb");
    
    //$id = $_POST['id'];
    $ip=$_SERVER['REMOTE_ADDR'];
    $sql="SELECT Value, id FROM  trackInput WHERE ip='" . $ip . "'";
    $db->execute($sql); //returns values, if any
    
    
 ?>