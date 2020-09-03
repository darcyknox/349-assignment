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

$playerrattings = array();

while($row = $q->fetch()){
  echo "<tr><td><input type=\"checkbox\" name =\"a-player[]\" value = ".$row["lname"]."/></td><td><input type=\"checkbox\" name = \"b-player[]\" value = ".$row["lname"]."/></td><td>".$row["fname"]." ".$row["lname"]."</td><td>".$row["position"]."</td></tr>\n";
  $playerrattings[$row["lname"]] = $row["rating"];
}

?>
</table>

<input type="submit" name="submit" value="Submit" />

</form>

<?php
if(isset($_POST['submit'])){
    $selected_a_players = $_POST['a-player'];  // Storing Selected Value In Variable
    $selected_b_players = $_POST['b-player'];
    echo "<h1>Submitted</h1>";
    $a_player_ratings = array();
    $b_player_ratings = array();

    $N = count($selected_a_players);
    echo("<h2>Team A:</h2>");
    echo("<ul>");
    for($i = 0; $i < $N; $i++) {
      echo("<li>".$selected_a_players[$i]."</li>");
      $a_player_ratings[rtrim($selected_a_players[$i], '/')] = $playerrattings[rtrim($selected_a_players[$i], '/')];
    }
    echo("</ul>");
    echo("\n");
    $N = count($selected_b_players);
    echo("<h2>Team B:</h2>");
    echo("<ul>");
    for($i = 0; $i < $N; $i++) {
      echo("<li>".rtrim($selected_b_players[$i], '/')."</li>");
      $b_player_ratings[rtrim($selected_b_players[$i], '/')] = $playerrattings[rtrim($selected_b_players[$i], '/')];
    }
    echo("</ul>");


    echo json_encode($a_player_ratings);
    echo json_encode($b_player_ratings);

    echo json_encode($playerrattings);

    // Inserting into team tests

    $pdo->query("TRUNCATE TABLE team");

    $pdo->query("INSERT INTO team VALUES ('Darcy','Knox','guard',88)");

    $q = $pdo->query("SELECT * FROM team");

    while($row = $q->fetch()){
      echo ($row["lastname"]);
    }

    $N = count($a_player_ratings);
    //echo($N);
    for($i = 0; $i < $N; $i++) {
      $key = key($a_player_ratings[$i]);
      $pdo->query("INSERT INTO team VALUES ('Darcy','Knox','guard',88)");
    }

    // Insert into players test
    $fn = 'Matty';
    $ln = 'Bardsley';

    $pdo->query("INSERT INTO team VALUES ('$fn','$ln','Guard',7)");

    $q = $pdo->query("SELECT * FROM team");

    while($row = $q->fetch()){
      echo ($row["lastname"]);
    }

}

?>


<script type="text/javascript">
  fetch('http://192.168.33.12', {
    method: 'POST', // or 'PUT'
    headers: {
      'Content-Type': 'application/json; charset=UTF-8'
    },
    mode: 'no-cors',
    body: {'James':98,'Curry':94}
  })
  .then(data => data.json())
  .then(res => {
    console.log('Success:', res);
  })
  .catch((error) => {
    console.error('Error:', error);
  });
</script>

<!--
<script type="text/javascript">
  const formData = new FormData();
  const fileField = document.querySelector('input[type="file"]');

  formData.append('username', 'abc123');
  formData.append('avatar', fileField.files[0]);

  fetch('http://192.168.33.10/data.json', {
    method: 'PUT',
    body: formData
  })
  .then(response => response.json())
  .then(result => {
    console.log('Success:', result);
  })
  .catch(error => {
    console.error('Error:', error);
  });
</script>
-->

<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/script.js" ></script>
</body>
</html>
