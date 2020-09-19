<header>
    <div>  <a href="index.php?url=vkapi/exitAccount"> Выйти </a></div>
    <div></div>
    <div><?php echo $_SESSION['first_name'];?></div>
    <div><?php echo "<img src = '{$_SESSION['photo_50']}'";?></div>
</header>
<main>

    <?php
    /*
     id
    first_name
    last_name
    is_closed
    can_access_closed
    domain
    city
    country
    photo\
    online
    track_code
     * */

  // var_dump($data);
    foreach($data[0]['response']['items'] as $value){
        echo "<div> ";
        echo "<img src='{$value['photo_200']}'>";
            echo "<div> ";
            echo "<h2>{$value['first_name']} {$value['last_name']}</h2>";
            if ($value['city']['title'] == '') {
                $value['city']['title'] = 'не указан';
            }
            echo " (город: {$value['city']['title']})";
            echo "</div>";
            echo "<div>";
            echo "страна: <a href='index.php?url=AnyCountry/getinfo/{$value['country']['title']}'>{$value['country']['title']}</a>" ;
            echo "</div>";
        echo "</div>";
    }
    ?>
</main>