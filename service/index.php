<?php

define("ALLOWED_ORIGINS", ["http://localhost:3000", "http://192.168.3.117:3000"]);

if (isset($_SERVER["HTTP_ORIGIN"]) && in_array($_SERVER["HTTP_ORIGIN"], ALLOWED_ORIGINS)) {
    header("Access-Control-Allow-Origin: " . $_SERVER["HTTP_ORIGIN"]);
}

require __DIR__ . "/Classes/Controller.php";

// Autoload Controller classes
$controllerFiles = scandir(__DIR__ . "/Controllers");
foreach ($controllerFiles as $currFile) {
    if ($currFile != "Controller.php" && strpos($currFile, "Controller") !== false) {
        require __DIR__ . "/Controllers/" . $currFile;
    }
}

// Autoload Model classes
$modelFiles = scandir(__DIR__ . "/Models");
foreach ($modelFiles as $currFile) {
    if (strpos($currFile, ".php") !== false) {
        require __DIR__ . "/Models/" . $currFile;
    }
}

$controllerParameter = filter_input(INPUT_GET, "controller");

if ($controllerParameter && $controllerParameter != "php") {
    $controllerClassName = $controllerParameter . "Controller";
    if (class_exists($controllerClassName, false)) {
        new $controllerClassName(true);
    }
    else {
        throw new \RuntimeException("This Controller does not exist");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Web API</title>

    <link rel="stylesheet" href="https://lib.lgk.io/webfont/stylesheet.min.css">

    <style type="text/css">
        body {
            font-family: "HK Grotesk", sans-serif;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <h1>PHP Web API</h1>

    <div id="api"></div>

    <script>
        const api = document.getElementById("api");
        fetch("./Api").then(res => res.json()).then(controllers => {
            console.log(controllers);
            let content = "";
            controllers.forEach(c => {
                content += `<h2>${c.className}</h2>`;
                content += `<ul>`;
                c.actions.forEach(a => {
                    content += `<li>${a.name}`;
                    if (a.parameters && a.parameters.length > 0) {
                        content += `, parameters: ${a.parameters.map(p => p.name).join(", ")}`;
                    }
                    content += `</li>`;
                });
                content += `</ul>`;
            });
            api.innerHTML = content;
        });
    </script>
</body>
</html>