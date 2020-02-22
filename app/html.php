<?php

namespace App;

class Html
{
    public static function head()
    {
        $str = <<<'EOD'
<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Magazzino</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Fira+Code&display=swap" rel="stylesheet">
    <style type="text/css">
     body {
        font-size: 14px; 
        font-family: 'Fira Code', sans-serif !important; 
        }
     .container {
  width: auto;
  padding: 10px 10px;  
}

.footer {
  background-color: #f5f5f5;
}
    </style> 
</head>
<body class="d-flex flex-column h-100">
<main role="main" class="flex-shrink-0">
  <div class="container">
EOD;
        echo $str;
    }

    public static function foot()
    {
        $str = <<<'EOD'
</div>
</main>

<footer class="footer mt-auto py-3">
  <div class="container">
    <span class="text-muted">Studio Archistico</span>
  </div>
</footer>
</body>
</html>
EOD;
        echo $str;
    }

    public static function printH1(String $str)
    {
        echo "<h1>".$str."</h1>";
    }

    public static function printH2(String $str)
    {
        echo "<h2>".$str."</h2>";
    }

    public static function println(String $str)
    {
        echo $str. "</br>";
    }
}