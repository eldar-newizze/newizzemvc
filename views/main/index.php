
<?php
if (isset($_GET['code'])) {
    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', "https://oauth.vk.com/access_token?client_id=7600006&client_secret=0Py6PbDe0DTRBwEQpgxr&redirect_uri=http://95.174.98.128&code={$_GET['code']}");
    if ($res->getStatusCode() == 200) {
        $res = json_decode($res->getBody(), true);
        $_SESSION['access_token'] = $res["access_token"];
        $_SESSION['user_id'] = $res["user_id"];
        header("Location: index.php?url=vkapi/setcode");
    }
} else {
    ?>
    <header>

   <a href="https://oauth.vk.com/authorize?client_id=7600006&display=page&redirect_uri=http://95.174.98.128&scope=friends&response_type=code&v=5.124">Войти</a>

    </header>
<?php
}

