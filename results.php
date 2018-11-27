<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works 
require_once("session.php"); ?>
<?php 
  #establishes DB connection and includes various global functions
  verify_login();
  require_once("includedFunctions.php"); 
  $mysqli = db_connection();
  if (($output = message()) !== null) {
    echo $output;
  }
  // #create pagnation
  // $results_per_page = 20;
  // if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
  // $start_from = ($page-1) * $results_per_page;
$query0 = "SET @row_number=0";
$mysqli ->query($query0);
#if new search DROP table if exists
// $query1 = "DROP TABLE IF EXISTS result";
// $mysqli -> query($query1);
  if(isset($_POST["search"])){
              $query1 = "DROP TABLE IF EXISTS result";
              $mysqli -> query($query1);
              $name = $_POST["search"];
              $field = $_POST["field"];
             #creates temporary table for results
             #if searching by ID only return 1 result
              if($_POST["field"]=="id"){
                $query2 = "CREATE TABLE result as SELECT *, (@row_number:=@row_number+1) as rn FROM ";
                $query2 .= "genbios WHERE ".$_POST["field"];
                $query2 .= " LIKE '".$name."' LIMIT 5";
              }
              else{
                $query2 = "CREATE TABLE result as SELECT *, (@row_number:=@row_number+1) as rn FROM genbios WHERE ";
                $query2 .= $_POST["field"]." LIKE ";
                if($_POST["match"]== "begins"){
                  $query2 .= "'".$name."%'"; 
                }
                elseif($_POST["match"]== "end"){
                  $query2 .= "'%".$name."'";
                }
                elseif($_POST["match"]== "exact"){
                  $query2 .= "'".$name."'";
                }
                else{
                  $query2 .= "'%".$name."%'";
                }

                if($_POST["search2"] != ""){
                  $query2 .= " ".$_POST["andOr1"]." ".$_POST["field2"]." LIKE ";
                  if($_POST["match2"]== "begins"){
                  $query2 .= "'".$_POST["search2"]."%'"; 
                  }
                  elseif($_POST["match2"]== "end"){
                    $query2 .= "'%".$_POST["search2"]."'";
                  }
                  elseif($_POST["match2"]== "exact"){
                    $query2 .= "'".$_POST["search2"]."'";
                  }
                  else{
                    $query2 .= "'%".$_POST["search2"]."%'";
                  }
                }

                if($_POST["search3"] != ""){
                  $query2 .= " ".$_POST["andOr2"]." ".$_POST["field3"]." LIKE ";
                  if($_POST["match3"]== "begins"){
                  $query2 .= "'".$_POST["search3"]."%'"; 
                  }
                  elseif($_POST["match3"]== "end"){
                    $query2 .= "'%".$_POST["search3"]."'";
                  }
                  elseif($_POST["match3"]== "exact"){
                    $query2 .= "'".$_POST["search3"]."'";
                  }
                  else{
                    $query2 .= "'%".$_POST["search3"]."%'";
                  }
                }

              }
             $mysqli->query($query2); 
             $query3 = "SELECT * FROM result";
             $result = $mysqli ->query($query3);
             $count = $result->num_rows;        
            }
  else{
    $mysqli->query($query2); 
    $query3 = "SELECT * FROM result";
    $result = $mysqli ->query($query3);
    $count = $result->num_rows;  
  }
?>

<html lang="en">
      <head>
        <title>Search Results</title>
        <link rel = "stylesheet" href = "css/resultsStyle.css" type="text/css" media="screen, projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!--  <link rel="stylesheet" href="css/styles.css"> -->
       <!--  <link href="https://fonts.googleapis.com/css?family=Muli%7CRoboto:400,300,500,700,900" rel="stylesheet"> -->
      </head>
  <header>
  <a href="search.php">Back to Search Page</a>
  <br/>
  <?php echo $count." Results Found"; ?>
  </header>
  <body>
    <table> 
      <tr> 
          <th>#</th>
          <th>ID</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Nickname</th>
          <th>Gender</th>
          <th>Job</th>
          <th>Spouse</th>
          <th>Parents</th>
          <th>Children</th>
          <th>Other Family</th>
          <th>Birth</th>
          <th>Death</th>
          <th>Place of Origin</th>
          <th>Residence</th>
          <th>Updated By</th>
          <th>Last Updated</th>
      </tr>
        <?php
              if ($result && $result ->num_rows >0){
              while($row = $result ->fetch_assoc()){
                  echo "<tr>";
                  echo "<td>";
                  echo $row["rn"];
                  echo "</td>";
                  #make ID link to person page
                  echo '<form action = "person.php" method="post" id="results-form">';
                  echo "<td>";
                  echo '<input type="hidden" name="thisRow" value='.$row["rn"].'>';
                  #echo '<input type="hidden" name="result" value='.htmlspecialchars($result).'>';
                 # echo '<input type="hidden" name="prevSearch" value='.$name.'>';
                  echo '<input type="hidden" name="count" value='.$count.'>';
                  #echo '<input type="hidden" name="field" value='.$_POST["field"].'>';
                  echo '<input type="submit" name="submit" value='.$row["id"].'>';
                  echo "</td>";
                  #continue with other results
                  echo "</form>";
                  echo "<td>";
                  echo $row["lastname"];
                  echo "</td>";
                  echo "<td>";
                  echo $row["firstname"];
                  echo "</td>";
                  echo "<td>";
                  echo $row["nickname"];
                  echo "</td>";
                  echo "<td>";
                  echo $row["gender"];
                  echo "</td>";
                  echo "<td>";
                  echo $row["occupation"];
                  echo "</td>";
                  echo "<td>";
                  echo $row["spouse"];
                  echo "</td>";
                  echo "<td>";
                  echo $row["parents"];
                  echo "</td>";
                  echo "<td>";
                  echo $row["children"];
                  echo "</td>";
                  echo "<td>";
                  echo $row["relations"];
                  echo "</td>";
                  echo "<td>";
                  echo $row["birthdate"];
                  echo "</td>";
                  echo "<td>";
                  echo $row["deathdate"];
                  echo "</td>";
                  echo "<td>";
                  echo $row["origin"];
                  echo "</td>";
                  echo "<td>";
                  echo $row["residence"];
                  echo "</td>";
                  echo "<td>";
                  echo $row["modified_by"];
                  echo "</td>";
                  echo "<td>";
                  echo $row["modified_date"];
                  echo "</td>";
                  echo "</tr>";
              }
            }
        ?>
     </table>
     </body>
     <footer>
     <?php echo $count." Results Found"; ?>
      <br/>
      <a href="search.php">Back to Search Page</a>
     </footer>
</html>