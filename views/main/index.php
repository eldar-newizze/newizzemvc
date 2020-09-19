<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>newizzemvc</title>
</head>
<body>
<li><a href="/RandomFriends">Запрос ВК</a></li>

</body>
</html>
<?php
session_start();

foreach ($_SESSION['friends'] as $friend){
   echo $friend['last_name'] . ' ' . $friend['first_name'] . '<br>';

}

