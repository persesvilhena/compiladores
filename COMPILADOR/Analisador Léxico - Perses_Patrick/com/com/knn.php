<?php
$conexao = new mysqli("localhost", "root", "", "am");

$pl = 1.3;
$pw = 0.3;
$query = "select *, sqrt(pow(`petal_length` - $pl, 2) + pow(`petal_width` - $pw, 2)) as dist from iris
order by dist asc";
$sql = $conexao->query($query);
$result = $sql->fetch_array(MYSQLI_ASSOC);
$result = mysqli_fetch_array($sql);

/*
foreach ($teste as $n) {
    $aux['species'] = $n['species'];
    $aux['distancia']= sqrt(pow(($n['petal_length'] - $pl),2) + (pow(($n['petal_width'] - $pw), 2)));
    array_push($res, $aux);
}*/




echo "<pre>";
var_dump($result);
echo "</pre>";



/*
echo "<pre>";
var_dump($result);
var_dump($op);
echo "</pre>";
echo $resultado;
*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Php eh foda</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <link href="https://getbootstrap.com/docs/3.3/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="header clearfix">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation" class="active"><a href="#">Home</a></li>
                    <li role="presentation"><a href="#">About</a></li>
                    <li role="presentation"><a href="#">Contact</a></li>
                </ul>
            </nav>
            <h3 class="text-muted">...</h3>
        </div>

        <div class="jumbotron">
            <h1>...</h1>
            <form action="" method="post">
                <textarea name="texto" class="form-control" rows="10"></textarea>
                <br>
                <div align="right">
                    <input type="submit" name="enviar" value="Submeter" class="btn btn-default">
                </div>
            </form>
        </div>

        <div class="row marketing">
            <?= $resultado ?>
        </div>



    </div>



</body>
</html>

