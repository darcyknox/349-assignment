<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head><title>Database test page</title>
<style>
th { text-align: left; }

table, th, td {
  border: 2px solid grey;
  border-collapse: collapse;
}

th, td {
  padding: 0.2em;
}
</style>
</head>

<body>
<h1>Database test page</h1>

<p>Select players for Team A, and players for Team B.</p>
<p>Try to pick the same amount of players for both teams.</p>

<form action="#" method="post" id="player-form">

<table id="player-table" border="1">
<tr><th>Team A</th><th>Team B</th><th>Player name</th><th>Player position</th></tr>

<?php

$db_host   = '192.168.33.11';
$db_name   = 'fvision';
$db_user   = 'webuser';
$db_passwd = 'insecure_db_pw';

$pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

$pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

$q = $pdo->query("SELECT * FROM players");

$playerratings = array();

while($row = $q->fetch()){
  echo "<tr><td><input type=\"checkbox\" name =\"a-player[]\" value = ".$row["lname"]."/></td><td><input type=\"checkbox\" name = \"b-player[]\" value = ".$row["lname"]."/></td><td>".$row["fname"]." ".$row["lname"]."</td><td>".$row["position"]."</td></tr>\n";
  $playerratings[$row["lname"]] = $row["rating"];
}

?>
</table>

<input type="submit" name="submit" value="Submit" />

</form>

<?php



if(isset($_POST['submit'])){

    $pdo->query("TRUNCATE TABLE team");
    $pdo->query("TRUNCATE TABLE opp");

    $selected_a_players = $_POST['a-player'];  // Storing Selected Value In Variable
    $selected_b_players = $_POST['b-player'];
    echo "<h1><a href='http://192.168.33.12'>Click here</a></h1>";
    $a_player_ratings = array();
    $b_player_ratings = array();

    $N = count($selected_a_players);
    echo("<h2>Team A:</h2>");
    echo("<ul>");
    for($i = 0; $i < $N; $i++) {
      echo("<li>".rtrim($selected_a_players[$i], '/')."</li>");
      $a_player_ratings[rtrim($selected_a_players[$i], '/')] = $playerratings[rtrim($selected_a_players[$i], '/')];
    }
    echo("</ul>");
    echo("\n");
    $N = count($selected_b_players);
    echo("<h2>Team B:</h2>");
    echo("<ul>");
    for($i = 0; $i < $N; $i++) {
      echo("<li>".rtrim($selected_b_players[$i], '/')."</li>");
      $b_player_ratings[rtrim($selected_b_players[$i], '/')] = $playerratings[rtrim($selected_b_players[$i], '/')];
    }
    echo("</ul>");

    // Inserting into team tests

    // Explicit insert
    /*
    $pdo->query("INSERT INTO team VALUES ('Knox','40')");
    $pdo->query("INSERT INTO team VALUES ('Bardsley','37')");
    */

    // Get table state
    /*
    $q = $pdo->query("SELECT * FROM team");

    while($row = $q->fetch()){
      echo ($row["lname"]);
    }
    */

    // Testing putting variables into query strings

    function test_print($item2, $key) {
      echo "$key: $item2<br />\n";
    }


    //array_walk($a_player_ratings, 'test_print');

    // Insert using variables
    /*
    $ln = 'Aitcheson';
    $rt = 43;
    $pdo->query("INSERT INTO team VALUES ('$ln','$rt')");
    */

    // Insert using explicit array elements

    // Home team

    foreach($a_player_ratings as $lname => $rating) {
      $pdo->query("INSERT INTO team VALUES ('$lname','$rating')");
    }

    // Get table state

    $q = $pdo->query("SELECT * FROM team");

    while($row = $q->fetch()){
      echo ($row["lname"]);
      echo ($row["rating"]);
      echo ("<br />\n");
    }

    // Opponent team

    foreach($b_player_ratings as $lname => $rating) {
      $pdo->query("INSERT INTO opp VALUES ('$lname','$rating')");
    }

    // Get table state

    $q = $pdo->query("SELECT * FROM opp");

    while($row = $q->fetch()){
      echo ($row["lname"]);
      echo ($row["rating"]);
      echo ("<br />\n");
    }

}

?>


<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/script.js" ></script>
</body>
</html>
