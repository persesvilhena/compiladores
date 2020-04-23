<?php
function identifica($linhas, $regex){
    $iden = array();
    foreach ($linhas as $num_linha => $n) {
        $cont_iden = 0;
        $marcados = array();
        foreach ($regex as $tipo => $value) {

            
            preg_match_all($value, $n, $res, PREG_OFFSET_CAPTURE);

            $encontrados = $res[0];
            //var_dump($encontrados);
            
            foreach ($encontrados as $m) {
                $p_inicio = $m[1];
                $p_fim = $p_inicio + strlen($m[0]) -1;

                if(!(in_array($p_inicio, $marcados)) && !(in_array($p_fim, $marcados))){
                    foreach (range($p_inicio, ($p_fim)) as $i) {
                        array_push($marcados, $i);
                    }
                    $obj = new stdClass;
                    $obj->identificado = $m[0];
                    $obj->tipo = $tipo;
                    $obj->linha = $num_linha;
                    $obj->coluna = $m[1];
                    array_push($iden, $obj);
                }
            }  
        }
    }

    return $iden;
}


function erros($linhas, $identificado){
    $erros = array();
    foreach ($linhas as $num_linha => $n) {
        foreach ($identificado as $m) {
            if($m->linha == $num_linha){
                $n = str_replace($m->identificado, chr(254), $n);
                
                if(empty($n) || $n == "\n" || strlen($n) == 0){
                    $n = null;
                }
            }
        }
        $e = explode(chr(254), $n);


        foreach ($e as $z) {
            if((!empty($z)) && ($z != "\n") && ($z != chr(254)) && ($z != chr(13)) && ($z != chr(32)) && ($z != chr(9))){
                $obj = new stdClass;
                $obj->erro = $z;
                $obj->linha = $num_linha;
                array_push($erros, $obj);
            }
        }
    }
    /*echo "<pre>";
    var_dump($erros);
    echo "</pre>";*/

    $iden = array();
    foreach ($linhas as $num_linha => $n) {

        $cont_erro = 0;
        foreach ($erros as $value) {
            
            if($value->linha == $num_linha){
                $cont_erro = 1;
                $pos = strpos($n, $value->erro);
                if($pos >= 0){
                    $obj = new stdClass;
                    $obj->identificado = $value->erro;
                    $obj->linha = $num_linha;
                    $obj->coluna = $pos;
                    array_push($iden, $obj);
                }
            }
            
        }
        /*if(($cont_erro == 0) && (strlen($n) > 0)){
            $obj = new stdClass;
            $obj->identificado = $n;
            $obj->linha = $num_linha;
            $obj->coluna = 0;
            array_push($iden, $obj);
        }*/
    }

    return $iden;
}

function analise($texto, $regex){
    $linhas = explode("\n", $texto);

    $identificado = identifica($linhas, $regex);
    $erros = erros($linhas, $identificado);

    //echo "<hr><pre>";
    //var_dump($identificado);
    //echo "</pre><hr>";

    $obj = new stdClass;
    $obj->identificados = $identificado;
    $obj->erros = $erros;
    return $obj;
}

if(isset($_POST['enviar'])){
    $texto = $_POST['texto'];

    
    $regex = array(
        'valor' => '/(([0-9])+(\.)?([0-9])*)|((\"){1}([A-z]|[0-9]|\s)*(\"){1})/',
        'inicio' => '/(auto)/',
        'fim' => '/(house)/',
        'fl' => '/(\;)/',
        'ap' => '/(\()/',
        'fp' => '/(\))/',
        'af' => '/(\[)/',
        'ff' => '/(\])/',
        'op_rel' => '/(\=\=)|(\<)|(\>)|(\>=)|(\<=)|(\!=)/',
        'comment' => '/((\%\%)(\s|\w|\W)*)/',
        'cond' => '/(senao)|(se)/',
        'var' => '/((#)([A-z]+))/',
        'tipo' => '/(int)|(double)|(float)/',
        'tab' => '/(    +)/',
        'op_log' => '/(\&)|(\|)|(no)/',
        'op_ari' => '/(\+)|(\-)|(\*)|(\/)/',
        'att' => '/(\=)/',
        'for' => '/(for)/',
        'space' => '/(\s)/',
        'leia' => '/(leia)/',
        'escreva' => '/(escreva)/'
    );
    $res = analise($texto, $regex);

    /*foreach ($tex->erros as $key => $n) {
        if($n != null){
            //echo "erro na linha ".$key." , erro: ".$n."<br>";
        }
    }*/
    //$texto = str_split($texto);
    /*$pw = $_POST['pw'];
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
    //asort($resultado);*/
    echo "<pre>";
    //var_dump($res);
    echo "</pre>";

}
?>

<?php if(isset($res->identificados)){ ?>
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">Linha</th>
                <th scope="col">Coluna</th>
                <th scope="col">Identificado</th>
                <th scope="col">Token</th>
            </tr>
        </thead>
        <?php
        
        foreach ($res->identificados as $n) {
            if($n->tipo!='space'){
                echo "<tr><td>".$n->linha."</td><td>".$n->coluna."</td><td>".$n->identificado."</td><td>". $n->tipo."</td></tr>";
            }
        }
        
        ?>
    </table>
<?php } ?>


<?php if(isset($res->erros)){ ?>
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">Linha</th>
                <th scope="col">Coluna</th>
                <th scope="col">Identificado</th>
            </tr>
        </thead>
        <?php
        
        foreach ($res->erros as $n) {
            echo "<tr class='bg-danger'><td>".$n->linha."</td><td>".$n->coluna."</td><td>".$n->identificado."</td></tr>";
        }
        
        ?>
    </table>
<?php } ?>

<?php if(isset($res->erros1)){ ?>
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">Linha</th>
                <th scope="col">Erro</th>
            </tr>
        </thead>
        <?php
        foreach ($res->erros as $key => $n) {
            if($n != null){
                echo "<tr class='bg-danger'><td>".$key."</td><td>".$n."</td></tr>";
            }
        }
        ?>
    </table>
<?php } ?>


<!-- 
<div class="scrollmargin"></div>
<textarea id="editor">testevvazshdjk</textarea>
load ace -->





<div class="jumbotron">

    <form action="" method="post">
        Código:
        <!--<div id="editor"></div>-->
        <textarea name="texto" class="form-control" rows="15"><?php if(isset($_POST['texto'])){ echo $_POST['texto']; } ?></textarea>
        <br>
        <br>
        <div align="right">
            <input type="submit" name="enviar" value="Submeter" class="btn btn-outline-success">
        </div>
    </form>
</div>

<script src="<?= base_url(); ?>assets/editor/src/ace.js"></script>
<script>
    /*var editor1 = ace.edit("editor1", {
        theme: "ace/theme/tomorrow_night_eighties",
        mode: "ace/mode/html",
        maxLines: 30,
        wrap: true,
        autoScrollEditorIntoView: true
    });

    var editor2 = ace.edit("editor2", {
        theme: "ace/theme/tomorrow_night_blue",
        mode: "ace/mode/html",
        autoScrollEditorIntoView: true,
        maxLines: 30,
        minLines: 2
    });

    var editor = ace.edit("editor3");
    editor.setOptions({
        autoScrollEditorIntoView: true,
        maxLines: 8
    });
    editor.renderer.setScrollMargin(10, 10, 10, 10);
    */
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/tomorrow_night_eighties");
    editor.session.setMode("ace/mode/html");
    editor.setAutoScrollEditorIntoView(true);
    editor.setOption("maxLines", 100);
    var textarea = $('textarea[name="texto"]').hide();
editor.getSession().setValue(textarea.val());
editor.getSession().on('change', function(){
  textarea.val(editor.getSession().getValue());
});
</script>

