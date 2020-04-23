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


function limpa($res){
    foreach ($res as $i => $v) {
        if($v->tipo == "comment" || $v->tipo == "space" || $v->tipo == "tab"){
            unset($res[$i]);
        }
    }
    return $res;
}
function reordena($arr){
    $res = array();
    foreach ($arr as $n) {
        array_push($res, $n);
    }
    $qtde_linhas = 0;
    foreach ($res as $n) {
        if($n->linha > $qtde_linhas){
            $qtde_linhas = $n->linha;
        }
    }
    $qtde_colunas = 0;
    foreach ($res as $n) {
        if($n->coluna > $qtde_colunas){
            $qtde_colunas = $n->coluna;
        }
    }
    $result = array();
    foreach (range(0, $qtde_linhas) as $l) {
        foreach (range(0, $qtde_colunas) as $c) {
            foreach ($res as $n) {
                if(($n->linha == $l) && ($n->coluna == $c)){
                    array_push($result, $n);
                }
            }
        }
    }
    foreach ($result as $i => $n) {
        $n->id = $i;
    }
    return $result;
}


function variavel($sin){
    if($sin[0]->tipo == "var" ||
    $sin[0]->tipo == "valor" ||
    $sin[0]->tipo == "ap" ||
    $sin[0]->tipo == "fp" ||
    $sin[0]->tipo == "af" ||
    $sin[0]->tipo == "ff" ||
    $sin[0]->tipo == "fl" ||
    $sin[0]->tipo == "op_rel" ||
    $sin[0]->tipo == "cond" ||
    $sin[0]->tipo == "tipo" ||
    $sin[0]->tipo == "op_log" ||
    $sin[0]->tipo == "op_ari" ||
    $sin[0]->tipo == "att" ||
    $sin[0]->tipo == "for" ||
    $sin[0]->tipo == "leia" ||
    $sin[0]->tipo == "escreva"){
        unset($sin[$ele->id]);
    }
    return $sin;
}

$gram = array();
$gram['expressao'] = array('t_var|t_att|expressao', 't_var|t_fl', 't_valor|t_fl');
$gram['program'] = array('t_inicio|expressao|t_fim');
$sin = array();
//var_dump($gram);
$pilha = array();
global $sin;
global $gram;
global $pilha;

function n_term($tipo){
    global $sin;
    reset($sin);
    $ele = current($sin);
    next($sin);
    $prox = current($sin);
    
}

function terminal($tipo){
    global $sin;
    reset($sin);
    $ele = current($sin);
    if($ele->tipo == $tipo){
        unset($sin[$ele->id]);
        return 1;
    }else{
        return 0;
    }
}



function programa(){
    n_term('program');
}

function parser(){
    return programa();
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

    $program = limpa($res->identificados);
    $program = reordena($program);
    $sin = $program;
    echo "<pre>";
    var_dump(parser());
    echo "</pre>";


}
?>

<?php if(isset($res->identificadosx)){ ?>
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
                echo "<tr><td>".($n->linha+1)."</td><td>".$n->coluna."</td><td>".$n->identificado."</td><td>". $n->tipo."</td></tr>";
            }
        }
        
        ?>
    </table>
<?php } ?>


<?php if(isset($res->errosx)){ ?>
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
            echo "<tr class='bg-danger'><td>".($n->linha+1)."</td><td>".$n->coluna."</td><td>".$n->identificado."</td></tr>";
        }
        
        ?>
    </table>
<?php } ?>

<?php if(isset($res->erros1x)){ ?>
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
    Código:
    <pre id="editor"><?php 
        if(isset($_POST['texto'])){ 
            echo $_POST['texto']; 
        }else{
            echo "%% valor zero para desligado
%% valor diferente de zero para ligado

auto %%INICIO

    #lampada = 0; 
    #arcondicionado = 0;
    #tv = 0;
    #tempArcondicionado = 18; %% temperatura do ar condicionado
    leia(#entrada);
    
    se(#entrada==1)[
        #lampada = 1;
    ]
    se(#entrada==2)[
        #tv = 1;
    ]
    se(#entrada==3)[
        #arcondicionado = 1;
        leia(#temp);
escreva(#temp);
        #tempArcondicionado = #temp;
    ]
house %%FIM";
        }
        ?></pre>

    <form action="" method="post" id="codigo">
        
        <!--<div id="editor"></div>-->
        <textarea name="texto" id="texto" style="display: none;"></textarea>
        <br>
        <br>
        <div align="right">
            <button onclick="teste();" name="enviar" value="enviar" class="btn btn-outline-success">Submeter</button>
        </div>
    </form>
</div>

<script src="<?= base_url(); ?>assets/editor/src/ace.js"></script>
<script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/tomorrow");
    editor.session.setMode("ace/mode/html");
    editor.setAutoScrollEditorIntoView(false);
    editor.setOption("maxLines", 100);
    //editor.setValue("the new text here");
    function teste(){
        //alert(editor.getValue());
        document.getElementById('texto').innerHTML = editor.getValue();
        document.getElementById("codigo").submit();
    }
</script>

