<?php
function ajeita($valor){
    $aux_op = null;
    $valor = str_split($valor);
    (string)$aux = null;

    foreach ($valor as $n) {
        if($n == "*" || $n == "/"){
            if($aux_op != null){
                $aux .= $aux_op;
                $aux_op = $n;
            }else{
                $aux_op = $n;
            }
        }else{
            $aux .= $n;
        }
    }

    $aux .= $aux_op;
    return $aux;
}


function conjunto($valor){

}




function acerta($texto){

    $texto = str_split($texto);
    $teste = array();
    $op = array();
    (string)$aux = null;
    $pilha = array();
    foreach ($texto as $n) {
        if($n == "+" || $n == "-"){
            array_push($teste, ajeita($aux));
            $aux = null;
            array_push($op, $n);
        }else{
            $aux .= $n;
        }
    }
    array_push($teste, ajeita($aux));
    //$result = array();


    /*foreach ($teste as $n) {
        //echo $n . "<br>";
        array_push($result, ajeita($n));
        $n = ajeita($n);
        //echo $n . "<br>";
    }*/


    $resultado = $teste[0];
    $cont = 1;


    foreach ($op as $n) {
        $resultado .= $teste[$cont];
        $resultado .= $n;
        $cont++;
    }
    return $resultado;
}


$texto = $_POST['texto'];

echo acerta($texto);




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


        <footer class="footer">
        <p>&copy; Rodrigo homem do dinheiro</p>
        </footer>

    </div>



</body>
</html>

