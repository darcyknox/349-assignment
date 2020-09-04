<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head><title>Database test page</title>
<style>

  html { text-align: center; }

</style>
</head>

<body>
  <h1>Results page</h1>

  <button type="button" name="button">See results</button>

  <h2 id="winText"></h2>

  <p><a href="http://192.168.33.10">Return to player selection</a></p>


<?php

  $db_host   = '192.168.33.11';
  $db_name   = 'fvision';
  $db_user   = 'webuser';
  $db_passwd = 'insecure_db_pw';

  $pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

  $pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

  $teamA = array();

  // Get table state

  $q = $pdo->query("SELECT * FROM team");

  while($row = $q->fetch()){
    $teamA[$row["lname"]] = $row["rating"];
  }

  foreach($teamA as $key => $val) {
    echo($key." : ");
    echo($val);
    echo ("<br />\n");
  }

  $jsondata = json_encode($teamA);

  $bytes = file_put_contents("data.json", $jsondata);
  //echo ("The number of bytes written are $bytes");

  // Opp team

  $oppteam = array();

  $q = $pdo->query("SELECT * FROM opp");

  while($row = $q->fetch()){
    $oppteam[$row["lname"]] = $row["rating"];
  }

  foreach($oppteam as $key => $val) {
    echo($key." : ");
    echo($val);
    echo ("<br />\n");
  }

  $jsondata = json_encode($oppteam);

  $bytes = file_put_contents("oppteam.json", $jsondata);
  //echo ("The number of bytes written are $bytes");

  /*
  while($row = $q->fetch()){
    echo ($row["lname"]);
    echo ($row["rating"]);
    echo ("<br />\n");
  }
  */

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

  $.getJSON( "data.json", function( data ) {
    var items = [];
    $.each( data, function( key, val ) {
      teamArating += parseInt(val);
      items.push( "<li id='" + key + "'>" + val + "</li>" );
    });

    $( "<ul/>", {
      "class": "my-new-list",
      html: items.join( "" )
    }).appendTo( "body" );
    console.log("Team A: " + teamArating);
  });

  $.getJSON( "oppteam.json", function( data ) {
    var items = [];
    $.each( data, function( key, val ) {
      teamBrating += parseInt(val);
      //console.log(teamArating);
      items.push( "<li id='" + key + "'>" + val + "</li>" );
    });

    $( "<ul/>", {
      "class": "my-new-list",
      html: items.join( "" )
    }).appendTo( "body" );
    console.log("Team B: " + teamBrating);

    if (teamArating > teamBrating) {
      teamAscore = winScore;
      teamBscore = loserScore;
      winnerText = "Team A wins ";
    } else if (teamArating < teamBrating) {
      teamAscore = loserScore;
      teamBscore = winScore;
      winnerText = "Team B wins ";
    }

  });


  $("button").click(() => {
    $("#winText").html(winnerText + winScore + " - " + loserScore);
  });


</script>

</body>

</html>
