<?php
class Painel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('conf');
    }



    public function index() {
        $this->load->view('header');
        $this->load->view('barra_superior');
        $this->load->view('painel/lex');
        $this->load->view('footer');
    }

    public function lex() {
        $this->load->view('header');
        $this->load->view('barra_superior');
        $this->load->view('painel/lex');
        $this->load->view('footer');
    }

    public function gulosa() {
        $this->load->view('header');
        $this->load->view('barra_superior');
        $this->load->view('painel/gulosa');
        $this->load->view('footer');
    }

    public function gulosa_json() {
        echo $this->painel_model->ver_gulosa()->json;
    }


    function teste1234(){
        $datetime1 = date_create('2017-01-01');
        $datetime2 = date_create('2017-07-01');
        $interval = date_diff($datetime1, $datetime2);
        echo $interval->format('%a dias');
    }

    public function ajax($func = null, $par = null) {
        if($func == "permissao_mostra_nucleos"){
            $dados['todos_nucleos'] = $this->permissao_model->retorna_todos_nucleos();
            echo "
            <label>Nucleo: </label>
                <select class=\"form-control\" name=\"nucleo\">
                <option>Escolha um nucleo</option>
            ";
            foreach ($dados['todos_nucleos'] as $n){
               echo" <option onclick=\"ajax('permissao_usuarios', 'permissao_mostra_usuarios', '" . $par . "-" . $n->nuc_id . "')\" value=" . $n->nuc_id . ">" . $n->nuc_nome . "</option>";
            }
            echo "</select>";
        }

        if($func == "permissao_mostra_usuarios"){
            $dados['todos_usuarios'] = $this->permissao_model->retorna_todos_usuarios();
            echo "
            <label>Usuário: </label>
            <select class=\"form-control\" name=\"user\">
            <option>Escolha um usuário</option>";
            foreach ($dados['todos_usuarios'] as $n){
                echo "<option onclick=\"ajax('permissao_permissao', 'permissao_mostra_permissao', '" . $par . "-" . $n->usu_id . "')\" value=" . $n->usu_id . ">" . $n->usu_nome . "</option>";
            }
            echo "</select>";
        }

        if($func == "permissao_mostra_permissao"){
            $parametros = explode("-", $par);
            //$dados['todas_permissoes_usuario'] = $this->permissao_model->retorna_todas_permissoes_usuario($par);
            $dados['todas_permissoes'] = $this->permissao_model->retorna_todas_permissoes($parametros[0]);
            echo "
                <a onclick=\"limpa();\" class=\"btn btn-default\">Limpar</a>
                <a onclick=\"aluno();\" class=\"btn btn-default\">Aluno</a>
                <a onclick=\"estagiario();\" class=\"btn btn-default\">Estagiário</a>
                <a onclick=\"secretaria();\" class=\"btn btn-default\">Cristina</a>
                <a onclick=\"prof_res();\" class=\"btn btn-default\">Professor Restrito</a>
                <a onclick=\"prof();\" class=\"btn btn-default\">Professor</a>
                <a onclick=\"coord();\" class=\"btn btn-default\">Coordenador</a>
                <hr>
            ";
            foreach ($dados['todas_permissoes'] as $n){
                if($this->permissao_model->verifica_todas_permissoes_usuario($par, $n->per_id)){
                    echo "<input type=\"checkbox\" name=\"" . $n->per_id . "\" id=\"" . $n->per_nome . "\" value=\"1\" checked> " . $n->per_descricao . "<br>";
                }else{
                    echo "<input type=\"checkbox\" name=\"" . $n->per_id . "\" id=\"" . $n->per_nome . "\" value=\"1\"> " . $n->per_descricao . "<br>";
                }
            }
        }

    }







    public function duvida($pag = null, $par = null) {
        $dados['user'] = $this->painel_model->retorna_dados_usuario($this->session->userdata['usu_id']);
        $dados['nucleos'] = $this->painel_model->retorna_todos_nucleos($this->session->userdata['usu_id']);
        $dados['tipos'] = $this->eventos_model->tipos();

        $this->load->view('header');
        $this->load->view('barra_superior', $dados);

        if($pag == null){
            if($this->input->post('inserir') != null){
                $arquivo = $_FILES['duv_anexo'];
                if(!empty($arquivo["name"])){ 
                    $arquivo = $this->painel_model->arquivo($arquivo, $this->conf->caminho_upload_duvida_relativo());
                }else{ 
                    $arquivo = null;
                }
                $duv_assunto = $this->input->post('duv_assunto');
                $duv_pergunta = $this->input->post('duv_pergunta');
                $data = date('Y-m-d');
                $resultado = $this->painel_model->inserir_duvida($this->session->usu_id, $duv_assunto, $duv_pergunta, $arquivo, $data);
                if($resultado){
                    $avisos[0]['message'] = "Dúvida reportada com sucesso!";
                    $avisos[0]['type'] = "success";
                }else{
                    $avisos[1]['message'] = "Houve um problema! Contate o administrador!";
                    $avisos[1]['type'] = "danger";
                }
                //$this->log_model->adicionou_evento($eve_titulo); ////registra no log
                $this->session->set_userdata('avisos', $avisos);
                redirect('painel/duvida/nr');
            }

            $this->load->view('painel/duvida/home', $dados);  
        }

        if($pag == "nr"){
            $this->session->set_userdata('pag_duvida', 'nr');
            $dados['duvidas'] = $this->painel_model->duvidas_nr($this->session->userdata['usu_id']);

            $this->load->view('painel/duvida/listar', $dados);
        }

        if($pag == "r"){
            $this->session->set_userdata('pag_duvida', 'r');
            $dados['duvidas'] = $this->painel_model->duvidas_r($this->session->userdata['usu_id']);

            $this->load->view('painel/duvida/listar', $dados);
        }

        if($pag == "ver"){
            $dados['duvida'] = $this->painel_model->ver_duvida_permissao($par, $this->session->userdata['usu_id']);
            if($dados['duvida'] != null){
                $this->load->view('painel/duvida/ver', $dados);
            }
        }

        if($pag == "apagar"){
            $dados['duvida'] = $this->painel_model->ver_duvida_permissao($par, $this->session->userdata['usu_id']);
            if($dados['duvida'] != null){
                if($this->input->post('apagar') != null){
                    $resultado = $this->painel_model->apagar_duvida($par);
                    if($resultado){
                        $avisos[0]['message'] = "Dúvida apagada com sucesso!";
                        $avisos[0]['type'] = "success";
                    }else{
                        $avisos[1]['message'] = "Houve um problema! Contate o administrador!";
                        $avisos[1]['type'] = "danger";
                    }
                    //$this->log_model->adicionou_evento($eve_titulo); ////registra no log
                    $this->session->set_userdata('avisos', $avisos);
                    redirect('painel/duvida/' . $this->session->userdata['pag_duvida']);
                }
                $this->load->view('painel/duvida/apagar', $dados);
            }
        }

        $this->load->view('footer');
    

    }






    public function avisos($par = null) {
        $dados['user'] = $this->painel_model->retorna_dados_usuario($this->session->userdata['usu_id']);
        $dados['nucleos'] = $this->painel_model->retorna_todos_nucleos($this->session->userdata['usu_id']);
        $dados['tipos'] = $this->eventos_model->tipos();

        $this->load->view('header');
        $this->load->view('barra_superior', $dados);

        if($par == null){
            $dados['aviso'] = $this->avisos_model->avisos();
            $this->load->view('painel/avisos/home', $dados);
        }else{
            if($this->input->post('apagar') != null){
                $resultado = $this->avisos_model->apagar($par);
                if($resultado){
                    $avisos[0]['message'] = "Aviso apagado com sucesso!";
                    $avisos[0]['type'] = "success";
                }else{
                    $avisos[1]['message'] = "Houve um problema! Contate o administrador!";
                    $avisos[1]['type'] = "danger";
                }
                //$this->log_model->adicionou_evento($eve_titulo); ////registra no log
                $this->session->set_userdata('avisos', $avisos);
                redirect('painel/avisos');
            }

            $dados['aviso'] = $this->avisos_model->ver($par);
            $this->load->view('painel/avisos/ver', $dados);
        }


        $this->load->view('footer');
    

    }






    public function msg($pag = null, $par = null) {
        $dados['user'] = $this->painel_model->retorna_dados_usuario($this->session->userdata['usu_id']);
        $dados['nucleos'] = $this->painel_model->retorna_todos_nucleos($this->session->userdata['usu_id']);

        $this->load->view('header');
        $this->load->view('barra_superior', $dados);

        if($par == null){
            $dados['msgs'] = $this->msg_model->conversas();
            //echo "<pre>";
            //var_dump($this->msg_model->conversas());
            //echo "</pre>";
            $this->load->view('painel/msg/home', $dados);
        }
        if($pag == "ver"){
            /*if($this->input->post('apagar') != null){
                $resultado = $this->avisos_model->apagar($par);
                if($resultado){
                    $avisos[0]['message'] = "Aviso apagado com sucesso!";
                    $avisos[0]['type'] = "success";
                }else{
                    $avisos[1]['message'] = "Houve um problema! Contate o administrador!";
                    $avisos[1]['type'] = "danger";
                }
                //$this->log_model->adicionou_evento($eve_titulo); ////registra no log
                $this->session->set_userdata('avisos', $avisos);
                redirect('painel/avisos');
            }*/

            if($this->input->post('enviar') != null){
                $men_msg = $this->input->post('men_msg');
                $resultado = $this->msg_model->inserir($par, $men_msg);
                if($resultado){
                    $avisos[0]['message'] = "Mensagem enviada com sucesso!";
                    $avisos[0]['type'] = "success";
                }else{
                    $avisos[1]['message'] = "Houve um problema! Contate o administrador!";
                    $avisos[1]['type'] = "danger";
                }
                //$this->log_model->adicionou_evento($eve_titulo); ////registra no log
                $this->session->set_userdata('avisos', $avisos);
                redirect('painel/msg');
            }

            $dados['msg'] = $this->msg_model->ver($par);
            $this->load->view('painel/msg/ver', $dados);
        }

        if($pag == "escrever"){
            if($this->input->post('enviar') != null){
                $men_msg = $this->input->post('men_msg');
                $resultado = $this->msg_model->inserir($par, $men_msg);
                if($resultado){
                    $avisos[0]['message'] = "Mensagem enviada com sucesso!";
                    $avisos[0]['type'] = "success";
                }else{
                    $avisos[1]['message'] = "Houve um problema! Contate o administrador!";
                    $avisos[1]['type'] = "danger";
                }
                //$this->log_model->adicionou_evento($eve_titulo); ////registra no log
                $this->session->set_userdata('avisos', $avisos);
                redirect('painel/msg');
            }
            $this->load->view('painel/msg/escrever', $dados);
        }



        $this->load->view('footer');
    

    }


    public function usuarios() {
        $dados['user'] = $this->painel_model->retorna_dados_usuario($this->session->userdata['usu_id']);
        $dados['nucleos'] = $this->painel_model->retorna_todos_nucleos($this->session->userdata['usu_id']);

        $this->load->view('header');
        $this->load->view('barra_superior', $dados);

        $dados['usuarios'] = $this->painel_model->todos_usuarios_ativos();
        $this->load->view('painel/usuarios/home', $dados);



        $this->load->view('footer');
    

    }

}
