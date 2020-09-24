<link rel="stylesheet" href="public/css/style.css">
<?php
session_start();

$friends = $data['response']['items'];
//var_dump($friends);
$_SESSION['$friends'] = $friends;


echo '<ul id = webLinks>';
$idElem = 0;
foreach ($friends as $friend){

    $img = '<img src=' . $friend['photo_200_orig'];
    $link = '<li><a href=https://vk.com/id' . $friend['id'] . '>'
        . $friend['first_name'] . ' ' . $friend['last_name'] . '</a></li>';
    $country = $friend['country']['title'];
    $city = $friend['city']['title'];
    echo '<br>' . '<br>';
    echo $img . ' ' . $link . ' ' . $country . ' ' . $city;

    $idElem++;
}
echo '</ul>';
?>
<!--<script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    $("#webLinks a").on('click', function () {
        console.log(this.id);

        let data = callAllfnt(this.id);

            console.log(data[1]);

       // console.log(data);
    });

    function callAllfnt(id) {

        let php =
       return  "<?php /*echo $_SESSION['friends']; */?>"


    }
</script>
-->
