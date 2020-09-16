<?php
$data = $data[0];
echo "<h1>API по пользователю {$data['userId']}</h1>";

if ($data[0]['error'] !== NULL) {
    echo $data[0]['error'];
} else {
    foreach ($data as $item => $value) {
        if($item != 'userId') {
            echo "<img src='{$value['photo']}'>";
            echo "<a href='https://vk.com/id{$value['id']}'>{$value['last_name']} {$value['first_name']}</a>";
            echo " from {$value['city']} ({$value['country'][0]['name']} 
        => 
        {$value['country'][0]['alpha2Code']}, where capital is {$value['country'][0]['capital']})";
            echo "<br>";
        }
    }
}


