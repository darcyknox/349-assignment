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

<p>Select 5 players for Team A, and 5 players for Team B:</p>

<form action="#" method="post">

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

while($row = $q->fetch()){
  echo "<tr><td><input type=\"checkbox\" name = ".$row["name"]." value = ".$row["name"]."/></td><td><input type=\"checkbox\" name = ".$row["name"]." value = ".$row["name"]."/></td><td>".$row["name"]."</td><td>".$row["position"]."</td></tr>\n";
}

?>
</table>

<input type="submit" name="formSubmit" value="Submit" />

</form>

<script type="text/javascript" src="/www/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="/www/js/script.js" ></script>
</body>
</html>
