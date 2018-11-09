<?php require_once("session.php"); ?>
<?php 
  #establishes DB connection and includes various global functions
  verify_login();
  require_once("includedFunctions.php"); 
  $mysqli = db_connection();
  if (($output = message()) !== null) {
    echo $output;
  }

/*if(isset($_POST["search"])){
  echo $_POST["field"];
}*/
if(isset($_POST["search"])){
    $name = $_POST["search"];
    $name = preg_replace("#[^0-9a-z]#i","", $name);

    if($_POST["field"]=="id"){
      $query = "SELECT * FROM ";
      $query .= "genbios WHERE ".$_POST["field"];
      $query .= " LIKE '%".$name."%' LIMIT 1";
    }
    else{
    $query = "SELECT * FROM ";
    $query .= "genbios WHERE ".$_POST["field"];
    $query .= " LIKE '%".$name."%'";
    }
    $result = $mysqli->query($query);
    if ($result && $result ->num_rows >0){
      /*echo "<table><tr><thead>";
        echo "<th>ID</th><th>First Name</th><th>Last Name</th>";
        echo "</tr></thead></table>";
      echo "<table>";*/
      while($row = $result ->fetch_assoc()){
              echo $row["id"]." ".$row["firstname"]." ".$row["lastname"]."<hr /><br />";
    }
      echo "</table>";
}
}

?>
