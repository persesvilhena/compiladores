<?php
echo "<pre>";
var_dump($this->rede_model->ver_per());
echo "</pre>";

if(isset($_POST['enviar'])){
    $pl = $_POST['pl'];
    $pw = $_POST['pw'];
    $k = $_POST['k'];
    $result = $this->painel_model->knn($pl, $pw, $k, 'iris');

    $result1 = array();

    foreach ($result as $n) {
        array_push($result1, $n->species);
    }
    echo "<pre>";
    var_dump($result);
    echo "</pre>";

    echo "<pre>";
    var_dump($result1);
    echo "</pre>";


    $resultado = array_count_values($result1);
    //asort($resultado);
    echo "<pre>";
    var_dump($resultado);
    echo "</pre>";

}
?>




    <div class="container">


        <div class="jumbotron">

            <form action="" method="post">
                PL:
                <input name="pl" class="form-control">
                <br>
                PW:
                <input name="pw" class="form-control">
                <br>
                K:
                <input name="k" class="form-control">
                <br>
                <div align="right">
                    <input type="submit" name="enviar" value="Submeter" class="btn btn-default">
                </div>
            </form>
        </div>




    </div>

