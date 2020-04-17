<?php
function ajeita($valor){
    $aux_op = array();
    $aux = array();

    foreach ($valor as $n) {
        if($n == "*" || $n == "/"){
            if(isset($aux_op[0])){
                array_push($aux, $aux_op);
                array_push($aux_op, $n);
            }else{
                array_push($aux_op, $n);
            }
        }else{
            array_push($aux, $n);
        }
    }

    array_push($aux, $aux_op);
    return $aux;
}





function posfix($exp){


    $op = array();
    $aux = array();
    $pilha = array();
    foreach ($exp as $n) {
        if($n == "+" || $n == "-"){
            array_push($exp, ajeita($aux));
            $aux = array();
            array_push($op, $n);
        }else{
            array_push($aux, $n);
        }
    }
    var_dump(ajeita($aux));
    array_push($exp, ajeita($aux));
    //$result = array();


    /*foreach ($teste as $n) {
        //echo $n . "<br>";
        array_push($result, ajeita($n));
        $n = ajeita($n);
        //echo $n . "<br>";
    }*/


    $resultado = $exp[0];
    $cont = 1;
    var_dump($op);

    foreach ($op as $n) {
        echo "teste";
        $resultado .= $exp[$cont];
        $resultado .= $n;
        $cont++;
    }
    return $resultado;
}

function verifica_parenteses($exp){
    $pilha = array();
    foreach ($exp as $n) {
        if($n == "("){
            array_push($pilha, "(");
        }
        if($n == ")"){
            array_pop($pilha);
        }
    }
    if(empty($pilha)){
        return 1;
    }else{
        return 0;
    }
}
function tem_parenteses($exp){
    $tem = 0;
    foreach ($exp as $n) {
        if(($n == "(") || ($n == ")")){
            $tem = 1;
        }
    }
    return $tem;
}

function organiza($exp){
    $aux = array();
    $cont = 0;
    $res = array();
    $zerou = 0;
    if(tem_parenteses($exp)){
        foreach ($exp as $n) {
            if($n == ")"){
                $cont--;
                if($cont == 0){
                    $zerou = 1;
                }
            }
            if($cont != 0){
                array_push($aux, $n);
            }
            if($n == "("){
                $cont++;
            }
            if($cont == 0){
                if($zerou == 0){
                    array_push($res, $n);
                }else{
                    if(isset($aux[0])){
                        array_push($res, organiza($aux));
                    }
                    $aux = array();
                }
            }
        }
        return $res;

    }else{
        return $exp;
    }
    
}


//$texto = $_POST['texto'];
$texto = "(1/2*(3+4)*(5-1)*3)";
//$texto = ")1/2*(3+4)*(5-1)*3(";
///$texto = "1/2*3+4*5-1*3";
$texto = str_split($texto);

echo "<pre>";
var_dump(posfix(organiza($texto)[0]));
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


        <footer class="footer">
        <p>&copy; Rodrigo homem do dinheiro</p>
        </footer>

    </div>



</body>
</html>

