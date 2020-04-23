<?php
$url = 'C:/xampp/htdocs/com/';
//$url = base_url();
function arvore($var){
    if(is_array($var)){
        $res = array();
        foreach ($var as $n) {
            array_push($res, arvore($n));
        }
        $obj = new stdClass;
        $obj->name = "";
        $obj->children = $res;
        return $obj;
    }else{
        $obj = new stdClass;
        $obj->name = (string)$var;
        return $obj;
    }
}



function erro_sin($e){
    $e = substr($e, 20, -2);
    $e = explode(",", $e);
    $obj = new stdClass;
    $obj->encontrado = $e[1];
    $obj->linha = $e[2];
    return $obj;
}

function erro_lex($e){
    $e = substr($e, 10, -1);
    $e = explode(" ", $e);
    $obj = new stdClass;
    $obj->encontrado = $e[0];
    $obj->linha = $e[1];
    return $obj;
}

function erro($var){
    $var = substr($var, 0, -5);
    $erros = explode("|||", $var);
    unset($erros[0]);
    $erro_sin = array();
    $erro_lex = array();
    foreach ($erros as $n) {
        if(substr($n, 0, 9) == "Erro sin:"){
            array_push($erro_sin, erro_sin($n));
        }else{
            array_push($erro_lex, erro_lex($n));
        }
    }
    echo "<pre>";
    //var_dump($erros, $erro_sin, $erro_lex);
    echo "</pre>";
    $obj = new stdClass;
    $obj->sin = $erro_sin;
    $obj->lex = $erro_lex;
    return $obj;
}

if(isset($_POST['enviar_arquivo'])){
    $arquivo = $_FILES['arquivo'];

    $arquivo["name"] = strtolower($arquivo["name"]);
    $ext = explode(".", $arquivo["name"]);
    if($ext[1] == "ah"){
        $caminho_imagem =  $url . 'src/codigo.ah';
        move_uploaded_file($arquivo["tmp_name"], $caminho_imagem);
    }
}




if(isset($_POST['enviar'])){
    $arq =  $url . 'src/codigo.ah';
    $text = $_POST['texto'];
    $file = fopen($arq, 'w');
    fwrite($file, $text);
    fclose($file);

    $var = shell_exec("python ".$url."src/analizadorSintactico.py");
    //var_dump($var);
    if($var[0] == "|"){
        $erros = erro($var);
    }else{
        $var = str_replace(chr(34), chr(176), $var);
        $var = str_replace(chr(39), chr(34), $var);
        $var = str_replace(chr(176), chr(39), $var);
        $var = json_decode($var);
        $var = json_encode(arvore($var));

        $arq =  $url . 'flare.json';
        $file = fopen($arq, 'w');
        fwrite($file, $var);
        fclose($file);
    }
}


$arq =  $url . 'src/codigo.ah';
$texto = fopen($arq, "r");
?>

<?php if(isset($erros->sin)){ ?>
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">Encontrado Erro Sintatico</th>
                <th scope="col">Linha</th>
            </tr>
        </thead>
        <?php
        
        foreach ($erros->sin as $n) {
            echo "<tr><td>".($n->encontrado)."</td><td>".$n->linha."</td></tr>";
        }
        
        ?>
    </table>
<?php } ?>

<?php if(isset($erros->lex)){ ?>
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th scope="col">Encontrado Erro Lexico</th>
                <th scope="col">Linha</th>
            </tr>
        </thead>
        <?php
        
        foreach ($erros->lex as $n) {
            echo "<tr><td>".($n->encontrado)."</td><td>".$n->linha."</td></tr>";
        }
        
        ?>
    </table>
<?php } ?>


<div class="jumbotron">
    <form method="post" action="" enctype="multipart/form-data" class="form-inline">

            <div class="form-group">
                <label>Arquivo:</label>
                <input type="file" name="arquivo" value="">
            </div>
            
            <div align="right">
                <input type="submit" name="enviar_arquivo" value="Abrir" class="btn btn-outline-success">
            </div>
            <a href="http://localhost/com/painel/download" class="btn btn-outline-success" style="margin-left: 20px;">Salvar</a>
    </form>
    <hr>
    Código: 
    <pre id="editor"><?php 
        if(isset($texto)){ 
            echo stream_get_contents($texto);
            fclose($texto);
        }else{
            /*echo "%% valor zero para desligado%%
%% valor diferente de zero para ligado%%

auto %%INICIO%%

    #lampada = 0; 
    #arcondicionado = 0;
    #tv = 0;
    #tempArcondicionado = 18; %% temperatura do ar condicionado%%
    leia(#entrada);
    
    se(#entrada==#tv)[
        #arcondicionado = 1;
        leia(#temp);
escreva(#temp);
        #tempArcondicionado = #temp;
    ]senao[
        escreva(#temp);
    ]
house %%FIM%%";*/
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