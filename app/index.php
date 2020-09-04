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
  <h1>Test page 2</h1>
  <p><a href="http://192.168.33.10">Return to player selection</a></p>


<?php

  $db_host   = '192.168.33.11';
  $db_name   = 'fvision';
  $db_user   = 'webuser';
  $db_passwd = 'insecure_db_pw';

  $pdo_dsn = "mysql:host=$db_host;dbname=$db_name";

  $pdo = new PDO($pdo_dsn, $db_user, $db_passwd);

  $newarray = array();

  // Get table state

  $q = $pdo->query("SELECT * FROM team");

  while($row = $q->fetch()){
    $newarray[$row["lname"]] = $row["rating"];
  }

  foreach($newarray as $key => $val) {
    echo($key." : ");
    echo($val);
    echo ("<br />\n");
  }

  $jsondata = json_encode($newarray);

  $bytes = file_put_contents("data.json", $jsondata);
  echo ("The number of bytes written are $bytes");

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

  let teamAscore, teamBscore;
  let teamArating = 0;

  // Handle JSON here

  $.getJSON( "data.json", function( data ) {
    var items = [];
    $.each( data, function( key, val ) {
      teamArating += parseInt(val);
      //console.log(teamArating);
      items.push( "<li id='" + key + "'>" + val + "</li>" );
    });

    $( "<ul/>", {
      "class": "my-new-list",
      html: items.join( "" )
    }).appendTo( "body" );
    console.log(teamArating);
  });




</script>

</body>

</html>
