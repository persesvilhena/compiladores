<?php

class Painel_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    function knn($p1, $p2, $qtd, $tabela){
        $this->db->select('*, sqrt(pow(`petal_length` - ' . $p1 . ', 2) + pow(`petal_width` - '.$p2.', 2)) as dist');
        $this->db->from($tabela);
        $this->db->limit($qtd);
        $this->db->order_by('dist', 'asc');
        return $this->db->get()->result();
    }

    function grava_gulosa($data){
        $data = array('json' => $data);
        $this->db->where('id', 1);
        $this->db->update('gulosa', $data);
        return $this->db->affected_rows();
    }
    function ver_gulosa(){
        $this->db->select('*');
        $this->db->from('gulosa');
        $this->db->where('id', 1);
        return $this->db->get()->result()[0];
    }

    function retorna_dados_usuario($id = null){
        if($id == null){ $id = $this->session->userdata['usu_id']; }
        $this->db->select('*');
        $this->db->from('cc_usuario');
        $this->db->join('cc_cidade', 'usu_cidade = cid_id', 'inner');
        $this->db->join('cc_estado', 'cid_estado_id = est_id', 'inner');
        $this->db->join('cc_pais', 'est_pais_id = pai_id', 'inner');
        $this->db->where('cc_usuario.usu_id', $id);
        $user = $this->db->get()->result()[0];
        $user->grupos = $this->retorna_todos_grupos_usuario($id);
        //$user->avisos = $this->avisos();
        //$user->teste(){
        //    return "teste";
        //}
        $user->avisos_msg = $this->avisos_model->avisos(4);
        $user->qtd_avisos_msg = $this->avisos_model->qtd_avisos_total();
        $user->msg = $this->msg_model->conversas(4);
        $user->qtd_msg = $this->msg_model->qtd_msg_total();
        /*function teste(){
            return "teste";
        }*/
        return $user;
    }

    function retorna_todos_grupos_usuario($id){
        $this->db->select('*');
        $this->db->from('cc_grupo');
        $this->db->join('cc_grupo_usuario', 'gru_id = gro_grupo_id', 'inner');
        $this->db->where('gro_usuario_id', $id);   
        return $this->db->get()->result();
    }



    function retorna_todos_nucleos(){
        $this->db->select('*');
        $this->db->from('cc_nucleo');
        return $this->db->get()->result();
    }

    function retorna_todos_nucleos_usuario($tipo = null){
        /*if($tipo == null){
            $this->db->select('*');
            $this->db->from('cc_nucleo');
            $nucleos = $this->db->get()->result();
            $cont = 0;
            foreach ($nucleos as $n){
                if($this->permissao_model->verifica_permissao_nucleo($n->nuc_id)){
                    $result[$cont] = $n;
                    $result[$cont]->qtde_noticias = $this->retorna_qtde_noticias_nucleo($n->nuc_id)->qtde;
                    $result[$cont]->qtde_eventos = $this->retorna_qtde_eventos_nucleo($n->nuc_id)->qtde;
                    $cont++;
                }
            }
            return $result;
        }*/
        /*if($tipo == 1){
            $this->db->select('*');
            $this->db->from('cc_nucleo');
            $nucleos = $this->db->get()->result();
            $cont = 0;
            foreach ($nucleos as $n){
                if($this->permissao_model->verifica_permissao_nucleo($n->nuc_id, $tipo)){
                    $result[$cont] = $n;
                    $result[$cont]->qtde_noticias = $this->retorna_qtde_noticias_nucleo($n->nuc_id)->qtde;
                    //$result[$cont]->qtde_eventos = $this->retorna_qtde_eventos_nucleo($n->nuc_id)->qtde;
                    $cont++;
                }
            }
            return $result;
        }*/
        if($tipo != null){
            $this->db->select('*');
            $this->db->from('cc_nucleo');
            $nucleos = $this->db->get()->result();
            $cont = 0;
            foreach ($nucleos as $n){
                if($this->permissao_model->verifica_permissao_nucleo($n->nuc_id, $tipo)){
                    $result[$cont] = $n;
                    $result[$cont]->qtde_noticias = $this->retorna_qtde_noticias_nucleo($n->nuc_id)->qtde;
                    $result[$cont]->qtde_eventos = $this->retorna_qtde_eventos_nucleo($n->nuc_id)->qtde;
                    $result[$cont]->qtde_projetos = $this->retorna_qtde_projetos_nucleo($n->nuc_id)->qtde;
                    $result[$cont]->qtde_publicacao = $this->retorna_qtde_publicacao_nucleo($n->nuc_id)->qtde;
                    $cont++;
                }
            }
            if(isset($result)){
                return $result;
            }else{
                return new stdClass;
            }
        }
        
    }
    function retorna_qtde_noticias_nucleo($id_nucleo){
        $this->db->select('count(*) as qtde');
        $this->db->from('cc_nucleo');
        $this->db->join('cc_noticia_nucleo', 'cc_noticia_nucleo.noo_nucleo_id = cc_nucleo.nuc_id', 'inner');
        $this->db->join('cc_noticia', 'cc_noticia.not_id = cc_noticia_nucleo.noo_noticia_id', 'inner');
        $this->db->where('cc_nucleo.nuc_id', $id_nucleo);
        return $this->db->get()->result()[0];
    }
    function retorna_qtde_eventos_nucleo($id_nucleo){
        $this->db->select('count(*) as qtde');
        $this->db->from('cc_nucleo');
        $this->db->join('cc_evento_nucleo', 'nuc_id = evl_nucleo_id', 'inner');
        $this->db->join('cc_evento', 'eve_id = evl_evento_id', 'inner');
        $this->db->where('cc_nucleo.nuc_id', $id_nucleo);
        return $this->db->get()->result()[0];
    }
    function retorna_qtde_projetos_nucleo($id_nucleo){
        $this->db->select('count(*) as qtde');
        $this->db->from('cc_nucleo');
        $this->db->join('cc_projeto_nucleo', 'nuc_id = pre_nucleo_id', 'inner');
        $this->db->join('cc_projeto', 'pro_id = pre_projeto_id', 'inner');
        $this->db->where('cc_nucleo.nuc_id', $id_nucleo);
        return $this->db->get()->result()[0];
    }
    function retorna_qtde_publicacao_nucleo($id_nucleo){
        $this->db->select('count(*) as qtde');
        $this->db->from('cc_nucleo');
        $this->db->join('cc_publicacao_nucleo', 'nuc_id = puo_nucleo_id', 'inner');
        $this->db->join('cc_publicacao', 'pub_id = puo_publicacao_id', 'inner');
        $this->db->where('cc_nucleo.nuc_id', $id_nucleo);
        return $this->db->get()->result()[0];
    }

   /* function retorna_todos_nucleos($id){
        $this->db->select('*');
        $this->db->from('cc_nucleo_usuario');
        $this->db->join('cc_nucleo', 'cc_nucleo_usuario.nuo_nucleo_id = cc_nucleo.nuc_id', 'inner');
        $this->db->join('cc_papel', 'cc_nucleo_usuario.nuo_papel_id = cc_papel.pap_id', 'inner');
        $this->db->where('cc_nucleo_usuario.nuo_usuario_id', $id);
        return $this->db->get()->result();
    }*/


    function retorna_todos_usuarios(){
        $this->db->select('*');
        $this->db->from('cc_usuario');
        return $this->db->get()->result();
    }

    function todos_usuarios_ativos(){
        $this->db->select('*');
        $this->db->from('cc_usuario_ativo');
        return $this->db->get()->result();
    }
    


    function foto($foto, $caminho, $fotoantiga = null){
        return $this->arquivos->foto($foto, $caminho, $fotoantiga);
    }

    /*function foto1($foto, $caminho, $fotoantiga = null){
        if (!empty($foto["name"])) {
            $foto["name"] = strtolower($foto["name"]);
            $largura = 5000;
            $larguramin = 1;
            $altura = 2500;
            $tamanho = 5000000;
            $ext = explode(".", $foto["name"]);
            //preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
            if($ext[1] != "gif" && $ext[1] != "bmp" && $ext[1] != "png" && $ext[1] != "jpg" && $ext[1] != "jpeg"){
                $avisos[0]['message'] = "Formato incompatível!";
                $avisos[0]['type'] = "danger";
            } else {
                $dimensoes = getimagesize($foto["tmp_name"]);
                if($dimensoes[0] > $largura) {
                    $avisos[1]['message'] = "A largura da imagem não deve ultrapassar ".$largura." pixels!";
                    $avisos[1]['type'] = "danger";
                }
                if($dimensoes[0] < $larguramin) {
                    $avisos[2]['message'] = "A largura da imagem não deve ser menor de ".$larguramin." pixels!";
                    $avisos[2]['type'] = "danger";
                }
                if($dimensoes[1] > $altura) {
                    $avisos[3]['message'] = "A altura da imagem não deve ultrapassar ".$altura." pixels!";
                    $avisos[3]['type'] = "danger";
                }
                if($foto["size"] > $tamanho) {
                    $avisos[4]['message'] = "A imagem deve ter no máximo ".$tamanho." bytes";
                    $avisos[4]['type'] = "danger";
                }
            }
            if (!isset($avisos)){
                $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
                $caminho_imagem = $caminho . $nome_imagem;
                move_uploaded_file($foto["tmp_name"], $caminho_imagem);
                if($fotoantiga != null){
                    unlink($caminho . $fotoantiga);
                }
            }
            if(!isset($avisos)){
                return $nome_imagem;
            }else{
                $this->session->set_userdata('avisos', $avisos);
                return null;
            }
        }else{
            $avisos[5]['message'] = "Imagem não encontrada!";
            $avisos[5]['type'] = "danger";
            $this->session->set_userdata('avisos', $avisos);
            return null;
        }
    }*/

    function arquivo($arquivo, $caminho, $arquivoantigo = null){
        return $this->arquivos->arquivo($arquivo, $caminho, "pdf|rar|zip|jpg|jpeg|gif|bmp|png", $arquivoantigo);
        /*if (!empty($arquivo["name"])) {
            $arquivo["name"] = strtolower($arquivo["name"]);
            $tamanho = 5000000;
            $ext = explode(".", $arquivo["name"]);
            if($ext[1] != "pdf" && $ext[1] != "rar" && $ext[1] != "zip" && $ext[1] != "jpg" && $ext[1] != "jpeg" && $ext[1] != "gif" && $ext[1] != "bmp" && $ext[1] != "png"){
                $avisos[0]['message'] = "Formato incompatível!";
                $avisos[0]['type'] = "danger";
            } else {
                if($arquivo["size"] > $tamanho) {
                    $avisos[1]['message'] = "O arquivo deve ter no máximo ".$tamanho." bytes";
                    $avisos[1]['type'] = "danger";
                }
            }
            if (!isset($avisos)){
                $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
                $caminho_imagem = $caminho . $nome_imagem;
                move_uploaded_file($arquivo["tmp_name"], $caminho_imagem);
                if($arquivoantigo != null){
                    unlink($caminho . $arquivoantigo);
                }
            }
            if(!isset($avisos)){
                return $nome_imagem;
            }else{
                $this->session->set_userdata('avisos', $avisos);
                return $arquivoantigo;
            }
        }else{
            $avisos[2]['message'] = "Arquivo não encontrado!";
            $avisos[2]['type'] = "danger";
            $this->session->set_userdata('avisos', $avisos);
            return $arquivoantigo;
        }*/
    }

    function arquivo_projeto($arquivo, $caminho, $arquivoantigo = null){
        return $this->arquivos->arquivo($arquivo, $caminho, "pdf|doc|odt", $arquivoantigo);
        /*if (!empty($arquivo["name"])) {
            $arquivo["name"] = strtolower($arquivo["name"]);
            $tamanho = 5000000;
            $ext = explode(".", $arquivo["name"]);
            if($ext[1] != "pdf" && $ext[1] != "doc" && $ext[1] != "odt"){
                $avisos[0]['message'] = "Formato incompatível!";
                $avisos[0]['type'] = "danger";
            } else {
                if($arquivo["size"] > $tamanho) {
                    $avisos[1]['message'] = "O arquivo deve ter no máximo ".$tamanho." bytes";
                    $avisos[1]['type'] = "danger";
                }
            }
            if (!isset($avisos)){
                $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
                $caminho_imagem = $caminho . $nome_imagem;
                move_uploaded_file($arquivo["tmp_name"], $caminho_imagem);
                if($arquivoantigo != null){
                    unlink($caminho . $arquivoantigo);
                }
            }
            if(!isset($avisos)){
                return $nome_imagem;
            }else{
                $this->session->set_userdata('avisos', $avisos);
                return $arquivoantigo;
            }
        }else{
            $avisos[2]['message'] = "Arquivo não encontrado!";
            $avisos[2]['type'] = "danger";
            $this->session->set_userdata('avisos', $avisos);
            return $arquivoantigo;
        }*/
    }

    function avisos(){
        if(isset($this->session->userdata['avisos'])){
            $avisos = $this->session->userdata['avisos'];
            $this->session->set_userdata('avisos', null);
            foreach ($avisos as $a) {
                return "<div class=\"alert alert-". $a['type'] ." alert-dismissible\" role=\"alert\" style=\"margin-top: 15px;\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
                    <strong>Aviso!</strong> ". $a['message'] ."
                </div>";
            }
        }
    }


    function inserir_duvida($id_user, $duv_assunto, $duv_pergunta, $duv_anexo, $duv_data){ 
        $data = array(
        'duv_usuario_pergunta' => $id_user,
        'duv_assunto' => $duv_assunto,
        'duv_pergunta' => $duv_pergunta,
        'duv_anexo' => $duv_anexo,
        'duv_data' => $duv_data
        );
        $this->db->insert('cc_duvida', $data);
        return $this->db->affected_rows();
    }
    function duvidas_nr($id){
        $this->db->select('*');
        $this->db->from('cc_duvida');
        $this->db->where('duv_usuario_pergunta', $id);
        $this->db->where('duv_usuario_resposta', null);
        return $this->db->get()->result();
    }
    function duvidas_r($id){
        $this->db->select('*');
        $this->db->from('cc_duvida');
        $this->db->where('duv_usuario_pergunta', $id);
        $this->db->where('duv_usuario_resposta !=', null);
        return $this->db->get()->result();
    }
    function ver_duvida($par){
        $this->db->select('*');
        $this->db->from('cc_duvida');
        $this->db->where('duv_id', $par);
        return $this->db->get()->result()[0];
    }
    function ver_duvida_permissao($par, $id_user){
        $this->db->select('*');
        $this->db->from('cc_duvida');
        $this->db->where('duv_usuario_pergunta', $id_user);
        $this->db->where('duv_id', $par);
        if(isset($this->db->get()->result()[0])){
            return $this->ver_duvida($par);
        }else{
            return null;
        }
    }
    function apagar_duvida($par){
        $duvida = $this->ver_duvida($par);
        if($duvida->duv_anexo != null){
            unlink($this->conf->caminho_upload_duvida_relativo() . $duvida->duv_anexo);
        }
        $this->db->where('duv_id', $par);
        $this->db->delete('cc_duvida');
        return $this->db->affected_rows();
    }

    function apagar_usuario($id){
        $this->db->where('aut_usuario_id', $id);
        $this->db->delete('cc_autor_noticia');

        $this->db->where('auo_usuario_id', $id);
        $this->db->delete('cc_autor_evento');

        $this->db->where('nuo_usuario_id', $id);
        $this->db->delete('cc_nucleo_usuario');

        $this->db->where('nua_usuario', $id);
        $this->db->delete('cc_nucleo_usuario_permissao');

        $this->db->where('usu_id', $id);
        $this->db->delete('cc_usuario');
        return $this->db->affected_rows();
    }

    function ver_todas_duvidas_nr(){
        $this->db->select('*');
        $this->db->from('cc_duvida');
        $this->db->where('duv_usuario_resposta', null);
        return $this->db->get()->result();
    }
    function ver_todas_duvidas_r(){
        $this->db->select('*');
        $this->db->from('cc_duvida');
        $this->db->where('duv_usuario_resposta !=', null);
        return $this->db->get()->result();
    }
    function responder_duvida($id, $duv_resposta){ 
        $data = array(
        'duv_resposta' => $duv_resposta,
        'duv_usuario_resposta' => $this->session->userdata['usu_id']
        );
        $this->db->where('duv_id', $id);
        $this->db->update('cc_duvida', $data);
        return $this->db->affected_rows();
    }





    


}
