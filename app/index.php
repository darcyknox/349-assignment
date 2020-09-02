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
</body>

<!--
<script type="text/javascript">
  fetch('http://192.168.33.10/data.json', {
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    mode: 'no-cors',
  })
  .then(response => {
    console.log("response = " + response.text())
    return response.text()
  })
  .then(data => console.log(data));
</script>
-->

<!--
<script type="text/javascript">
  fetch('http://192.168.33.10/data.json', {
    mode: 'no-cors'
  })
  .then(response => response.json())
  .then(data => console.log(data));
</script>
-->
<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
  const url = 'http://192.168.33.10//data.json';
  $.getJSON(url, function(result) {
    console.log(result)
  });
</script>

</html>
