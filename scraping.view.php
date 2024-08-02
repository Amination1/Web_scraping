<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ranking</title>
    <style>
        table, th, td{
            border: 1px solid white;
        }
    </style>
</head>
<body style="background-color: black;color: white">
<h1 style="text-align: center;border: 1px solid white">Ranking Websites in iran</h1>
<table style="text-align: center">
    <tr>
        <th>Title</th>
        <th>Rank</th>
        <th>Content</th>
    </tr>
    <?php
    $xml = simplexml_load_file('ranking.xml');
    foreach ($xml->children() as $rank) {
        echo "<tr>";
        echo "<td>" . $rank->title . "</td>";
        echo "<td>" . $rank->rank . "</td>";
        echo "<td style='text-align: left'>" . $rank->site . "</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>
