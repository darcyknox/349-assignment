<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head><title>NBA Greats Game Simulator</title>
<style>

  html { text-align: center; }

</style>
</head>

<body>
  <h1>Results page</h1>

  <button type="button" name="button">See results</button>

  <h2 id="winText"></h2>

  <p><a href="">Return to player selection</a></p>


<?php

  $db_host   = 'database-1.c1ijhezymkfb.us-east-1.rds.amazonaws.com';
  $db_name   = 'database-1';
  $db_user   = 'admin';
  $db_passwd = 'knoda778';

  $pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

  $pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

  $teamA = array();

  // Get table state

  $q = $pdo->query("SELECT * FROM teamA");

  while($row = $q->fetch()){
    $teamA[$row["lname"]] = $row["rating"];
  }

  echo("<h4>Team A player ratings</h4>");

  foreach($teamA as $key => $val) {
    echo($key." : ");
    echo($val);
    echo ("<br />\n");
  }

  $jsondata = json_encode($teamA);

  $bytes = file_put_contents("teamA.json", $jsondata);

  // teamB

  $teamB = array();

  $q = $pdo->query("SELECT * FROM teamB");

  while($row = $q->fetch()){
    $teamB[$row["lname"]] = $row["rating"];
  }

  echo("<h4>Team B player ratings</h4>");

  foreach($teamB as $key => $val) {
    echo($key." : ");
    echo($val);
    echo ("<br />\n");
  }

  $jsondata = json_encode($teamB);

  $bytes = file_put_contents("teamB.json", $jsondata);

?>

<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>

<script type="text/javascript">

  let teamAscore;
  let teamArating = 0;
  let teamBscore;
  let teamBrating = 0;

  let winScore = Math.ceil(Math.random() * (120 - 70) + 70);
  let loserScore = Math.floor(Math.random() * (winScore - 70) + 70);
  let winnerText;

  // Handle JSON here

  $.getJSON( "teamA.json", function( data ) {
    $.each( data, function( key, val ) {
      teamArating += parseInt(val);
    });
    console.log("Team A: " + teamArating);
  });

  $.getJSON( "teamB.json", function( data ) {
    $.each( data, function( key, val ) {
      teamBrating += parseInt(val);
    });
    console.log("Team B: " + teamBrating);



  });

  // Button handler
  $("button").click(() => {

    // Determine winner based on aggregate player rating
    if (teamArating > teamBrating) {
      teamAscore = winScore;
      teamBscore = loserScore;
      winnerText = "Team A wins ";
    } else if (teamArating < teamBrating) {
      teamAscore = loserScore;
      teamBscore = winScore;
      winnerText = "Team B wins ";
    }

    $("#winText").html(winnerText + winScore + " - " + loserScore);

  });


</script>

</body>

</html>
