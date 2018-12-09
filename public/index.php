<?php

/**
 * Реализовывать полноценную MVC-структуру с нуля слишком долго, по этому страница сделана "по старинке" - php+html
 */

include_once(__DIR__ . '/../vendor/autoload.php');

use App\Request;
use App\App;

$request = new Request($_GET);
$response = (new App())->htmlResponse($request);

?>
<html>
<head>
    <title>Анализ HTML-тегов на странице</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="styles/main.css" type="text/css">
</head>
<body>

<?= $response; ?>

</body>
</html>
