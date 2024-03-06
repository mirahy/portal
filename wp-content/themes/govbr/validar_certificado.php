<?php


/*
Template Name: Validar Certificado
*/

get_header();

the_breadcrumb();

?>


<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <h1>Validar Certificado</h1><br>


<?php

$validar = $_GET['validar_codigo'];

echo '<form action="" method="get" accept-charset="utf-8">
         <label for="codigo">Insira o código do certificado que deseja consultar:</label><br/>
            <input type="Text" id="codigo" name="codigo_validacao" size="12">
            <input type="hidden" id="validar" name="validar_codigo" value="1">
            <button class="btn btn-primary" type="submit">Validar</button>
      </form>';

if ($validar) {

    $codigo_validacao = $_GET['codigo_validacao'];
    
    $certificado   = validar_certificado($codigo_validacao);
    
    if(!empty($certificado)){
        foreach ($certificado as $value) {
        $participante  = $value['firstname'].' '.$value['lastname'];
        $nome_evento   = $value['nome_evento'];
        $data_inicio   = $value['data_inicio'];
        $data_fim      = $value['data_fim']? $value['data_fim']:"";
        $carga_horaria = $value['carga_horaria'];
        $tipo          = $value['nome_tipo'];
        $aprovado      = $value['aprovado'];
        }

        if($aprovado){

         echo '<br><div class="bg-success cert-success" style="padding: 15px">
					<h3>Certificado Válido  <span class="glyphicon glyphicon-thumbs-up"></span></h3>
					
               Este certificado pertence a <b>'.$participante.'</b></br>
               Atividade: '.$nome_evento.'</br>				
					Carga horária: <b>'.$carga_horaria.' horas</b></br>';
			
			if(empty($data_fim)) {
					echo 'Data: <b>'.$data_inicio.'</b></br>';
			}else {
					echo 'Data: de <b>'.$data_inicio.'</b> a <b>'.$data_fim.'</b></br>';	
							
			}
					
         echo 'Código de Validação: <b>'.$codigo_validacao.'</b>
         </div>';

         }else{
        		echo '<br><div class="bg-danger cert-danger" style="padding: 15px">
                Certificado inativo  <span class="glyphicon glyphicon-thumbs-down"></span>
              </div>';
         }

    }
    else{
        echo '<br><div class="bg-danger" style="padding: 15px">
                Este certificado não consta em nossa base de dados <span class="glyphicon glyphicon-thumbs-down"></span>
              </div>';
    }
}

?>
        </div>
    </div>
</div>

<?php


function validar_certificado($codigo_validacao){

    $repositorios = get_repositorios();
 
    foreach ($repositorios as $repositorio) {

        $certificado = busca_certificado($codigo_validacao,
                                         $repositorio['host'],
                                         $repositorio['banco'],
                                         $repositorio['usuario'],
                                         $repositorio['senha'],
                                         $repositorio['prefixo']);
        if (!empty($certificado)) {
            return $certificado;
        }
    }

    return null;
}

function get_repositorios(){

    global $wpdb;

    $sql = 'SELECT * FROM bancos_certificados;';

    // realiza a consulta no banco de dados do wordpress e retorna o resultado
    return $wpdb->get_results($sql, ARRAY_A);

}

function busca_certificado($codigo_validacao, $host, $banco, $usuario, $senha, $prefixo){
    $pdo = null;
    try {
        $pdo = new PDO("pgsql:host= ".$host.";dbname= ".$banco."", $usuario, $senha);
    } catch(PDOException $e) {
        echo $e;
        mostrarMensagemDeErro('Ocorreu um erro ao obter certificado! Entre em contato com a equipe de TI através do e-mail: <b>ti.ead@ufgd.edu.br</b>');
    }

    $sql = "SELECT u.firstname, u.lastname, i.nome_evento, i.data_inicio, i.data_fim, i.carga_horaria, g.aprovado
            FROM ".$prefixo."certificado_gerados g
            INNER JOIN ".$prefixo."user u ON u.id = g.participante
            INNER JOIN ".$prefixo."certificado_info i  ON i.id = g.certificado_info
            WHERE g.codigo_validacao = '".$codigo_validacao."' LIMIT 1;";

    $stmt = $pdo->prepare($sql);
    $resultado = $stmt->execute();

    if( ! $resultado ){
       return false;
    }

    $certificado = $stmt->fetchAll();

    return $certificado;
}


get_footer();
