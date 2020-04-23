
<style>

.links line {
  stroke: #999;
  stroke-opacity: 0.6;
}

.nodes circle {
  stroke: #fff;
  stroke-width: 1.5px;
}

</style>
<svg width="960" height="600"></svg>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script>




var svg = d3.select("svg"),
    width = +svg.attr("width"),
    height = +svg.attr("height");

var color = d3.scaleOrdinal(d3.schemeCategory20);

var simulation = d3.forceSimulation()
    .force("link", d3.forceLink().id(function(d) { return d.id; }))
    .force("charge", d3.forceManyBody())
    .force("center", d3.forceCenter(width / 2, height / 2));

d3.json('<?= base_url() .'painel/gulosa_json/'; ?>', function(error, graph) {
  if (error) throw error;

  var link = svg.append("g")
      .attr("class", "links")
    .selectAll("line")
    .data(graph.links)
    .enter().append("line")
      .attr("stroke-width", function(d) { return Math.sqrt(d.value); });

  var node = svg.append("g")
      .attr("class", "nodes")
    .selectAll("circle")
    .data(graph.nodes)
    .enter().append("circle")
      .attr("r", 5)
      .attr("fill", function(d) { return color(d.group); })
      .call(d3.drag()
          .on("start", dragstarted)
          .on("drag", dragged)
          .on("end", dragended));

  node.append("title")
      .text(function(d) { return d.id; });

  simulation
      .nodes(graph.nodes)
      .on("tick", ticked);

  simulation.force("link")
      .links(graph.links);

  function ticked() {
    link
        .attr("x1", function(d) { return d.source.x; })
        .attr("y1", function(d) { return d.source.y; })
        .attr("x2", function(d) { return d.target.x; })
        .attr("y2", function(d) { return d.target.y; });

    node
        .attr("cx", function(d) { return d.x; })
        .attr("cy", function(d) { return d.y; });
  }
});

function dragstarted(d) {
  if (!d3.event.active) simulation.alphaTarget(0.3).restart();
  d.fx = d.x;
  d.fy = d.y;
}

function dragged(d) {
  d.fx = d3.event.x;
  d.fy = d3.event.y;
}

function dragended(d) {
  if (!d3.event.active) simulation.alphaTarget(0);
  d.fx = null;
  d.fy = null;
}




</script>



<?php
function caminho($grafo, $orig, $dest, $caminho){
    $menor = new stdClass;
    $menor->rota = array();
    $menor->qtde = 99999999999;
    array_push($caminho, $orig);
    if($orig != $dest){
        foreach ($grafo[$orig] as $n) {
            if (!in_array($n, $caminho)) { 
                if(caminho($grafo, $n, $dest, $caminho)->qtde < $menor->qtde){
                    $menor = caminho($grafo, $n, $dest, $caminho);
                }
            }
        }
        array_push($menor->rota, $orig);
        $menor->qtde++;
        return $menor;
    }else{
        $result = new stdClass;
        $result->rota = array($dest);
        $result->qtde = 0;
        return $result;
    }
}

if(isset($_POST['enviar'])){
  //$baiano = $_POST['grafo'];
    $grafo1 = explode('/', $_POST['grafo']);
    $orig = $_POST['orig'];
    $dest = $_POST['dest'];

    $grafo = array();
    foreach ($grafo1 as $n) {
      $gf = explode(':', $n);
      if(!isset($grafo[(int)$gf[0]])){
        $grafo[(int)$gf[0]] = array();
      }
      array_push($grafo[(int)$gf[0]], (int)$gf[1]);
    }

/*$grafo[0] = array(1 ,2);
$grafo[1] = array(0, 3, 2);
$grafo[2] = array(1, 3, 0, 4);
$grafo[3] = array(1, 2, 4);
$grafo[4] = array(2, 3);*/

    /*echo "<pre>";
    var_dump($grafo);
    echo "</pre>";*/
    
    /*$grafo[0] = array(1 ,2);
    $grafo[1] = array(0, 3, 2);
    $grafo[2] = array(1, 3, 0, 4);
    $grafo[3] = array(1, 2, 4);
    $grafo[4] = array(2, 3);*/

    $caminho = array();
    $results = caminho($grafo, $orig, $dest, $caminho);

    $nodes = array();
    foreach ($grafo as $ind => $v) {
        if(in_array($ind, $results->rota)){
            $obj = new stdClass;
            $obj->id = $ind;
            $obj->group = 1;
            array_push($nodes, $obj);
        }else{
            $obj = new stdClass;
            $obj->id = $ind;
            $obj->group = 2;
            array_push($nodes, $obj);
        }
    }


    $links = array();
    foreach ($grafo as $in => $n) {
        foreach ($n as $m) {
            $obj = new stdClass;
            $obj->source = $in;
            $obj->target = $m;
            $obj->value = 1;
            array_push($links, $obj);
        }
    }


    $obj = new stdClass;
    $obj->nodes = $nodes;
    $obj->links = $links;

    $obj = json_encode($obj);
    $this->painel_model->grava_gulosa($obj);

}


/*
$grafo[0] = array(1 ,2);
$grafo[1] = array(0, 3, 2);
$grafo[2] = array(1, 3, 0, 4);
$grafo[3] = array(1, 2, 4);
$grafo[4] = array(2, 3);
echo "<pre>";
var_dump(json_encode($grafo));
echo "</pre>";*/
/*
$cont = 0;
$jsonGrafo = "{
  \"nodes\": [";
foreach ($grafo as $ind => $v) {
    if(in_array($ind, $results->rota)){
        if($cont == 0){
            $jsonGrafo .= "{\"id\": \"".$ind."\", \"group\": 1}";
        }else{
            $cont = 1;
            $jsonGrafo .= ",{\"id\": \"".$ind."\", \"group\": 1}";
        }
    }else{
        if($cont == 0){
            $jsonGrafo .= "{\"id\": \"".$ind."\", \"group\": 2}";
        }else{
            $cont = 1;
            $jsonGrafo .= ",{\"id\": \"".$ind."\", \"group\": 2}";
        }
    }
}

$jsonGrafo .= "],
  \"links\": [";

$cont = 0;
foreach ($grafo as $in => $n) {
    foreach ($n as $m) {
        if($cont == 0){
            $jsonGrafo .= "{\"source\": \"".$in."\", \"target\": \"".$m."\", \"value\": 1}";
        }else{
            $cont = 1;
            $jsonGrafo .= ",{\"source\": \"".$in."\", \"target\": \"".$m."\", \"value\": 1}";
        }
    }
}


$jsonGrafo .= "]
}";*/




//if(isset($_POST['enviar'])){
   /* $pl = $_POST['pl'];
    $pw = $_POST['pw'];
    $k = $_POST['k'];
    $result = $this->painel_model->knn($pl, $pw, $k, 'iris');

    $result1 = array();

    foreach ($result as $n) {
        array_push($result1, $n->species);
    }*
    echo "<pre>";
    var_dump($result);
    echo "</pre>";

    echo "<pre>";
    var_dump($result1);
    echo "</pre>";


    $resultado = array_count_values($result1);
    //asort($resultado);*/
    /*echo "<pre>";
    var_dump($results);
    echo "</pre>";*/

//}{0:[1,2],1:[0,3,2],2:[1,3,0,4],3:[1,2,4],4:[2,3]}
?>




    <div class="container">


        <div class="jumbotron">

            <form action="" method="post">
                grafo:
                <textarea name="grafo" class="form-control">0:1/0:2/1:0/1:3/1:2/2:1/2:3/2:0/2:4/3:1/3:2/3:4/4:2/4:3</textarea>
                <br>
                origem:
                <input name="orig" class="form-control" value="0">
                <br>
                destino:
                <input name="dest" class="form-control" value="4">
                <br>
                <div align="right">
                    <input type="submit" name="enviar" value="Submeter" class="btn btn-outline-success">
                </div>
            </form>
        </div>




    </div>

