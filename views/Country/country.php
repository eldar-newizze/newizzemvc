<header> <?php echo $data['name'] ?></header>
<main>
<?php
    echo "<div> ";
    echo "Домен: {$data['topLevelDomain'][0]}<br>";
    echo "Столица: {$data['capital']}<br>";
    echo "Регион: {$data['region']}<br>";
    echo "Более точный регион: {$data['subregion']}<br>";
    echo "Население: {$data['population']}<br>";
    echo "</div> ";

?>
</main>