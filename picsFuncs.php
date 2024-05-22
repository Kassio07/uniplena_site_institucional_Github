<?php
class PICS{
	//Upload
	public function upload($arquivo, $caminho, $nomeImagem, $extensao){
		//Sem alterar o nome
		if(empty($nomeImagem) || $nomeImagem == ""){
			$nomet = $arquivo["tmp_name"];
			$nome = $arquivo["name"];
			copy($nomet,$caminho.$nome);
			}
		else{
			$nomet = $arquivo["tmp_name"];
			$nome = $arquivo["name"] = $nomeImagem.".".$extensao;
			copy($nomet,$caminho.$nome);
			}
		//Retorno
		$retorno = array();
		$retorno['nome'] = $nome;
		return $retorno;
		}
	//Hora de Agora
	public function agora(){
		$data = date("d/m/Y");
		$hora = date("H:i");
		$tempo =  $data." - ".$hora;
		
		$retorno = array();
		$retorno['data'] = $data;
		$retorno['hora'] = $hora;
		$retorno['completa'] = $tempo;
		return $retorno;
		}
	//Diferença de Dias
	public function diferencaDias($data1, $data2){
	 	$d1 = new DateTime($data1);
        $d2 = new DateTime($data2);
        $intervalo = $d1->diff($d2);
        $dias = explode("+", $intervalo->format('%R%a'));
        return $dias[1];
	}
	//Mascaras
	public function mascaras($texto,$tipo){
		switch($tipo){
			case "moeda":
				$texto = number_format($texto,2,",",".");
			break;
			case "inserirMoeda":
				$texto = str_replace(".","",$texto);
				$texto = str_replace(",",".",$texto);
			break;
			}
		$retorno = $texto;
		return $retorno;
		}
	//Função de Buscar o CEP
	public function busca_cep($x){
		$resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($x).'&formato=query_string');
		if(!$resultado){
			$resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";
			}
		parse_str($resultado, $retorno); 
		return $retorno;
		}
	//Dia da semana
	public function diaSemana($data){
		$data = explode("-",$data);
		$diasemana = date("w", mktime(0,0,0,$data[1],$data[2],$data[0]) );
		switch($diasemana) {
			case"0": $diasemana = "Domingo";       break;
			case"1": $diasemana = "Segunda-Feira"; break;
			case"2": $diasemana = "Terça-Feira";   break;
			case"3": $diasemana = "Quarta-Feira";  break;
			case"4": $diasemana = "Quinta-Feira";  break;
			case"5": $diasemana = "Sexta-Feira";   break;
			case"6": $diasemana = "Sábado";        break;
			}		
		return $diasemana;
		}
	//Mês do Ano
	public function mostrarMes($data){
		switch($data) {
			case"1": $diasemana = "Janeiro";       break;
			case"2": $diasemana = "Fevereiro"; break;
			case"2": $diasemana = "Março";   break;
			case"4": $diasemana = "Abril";  break;
			case"5": $diasemana = "Maio";  break;
			case"6": $diasemana = "Junho";   break;
			case"7": $diasemana = "Julho";   break;
			case"8": $diasemana = "Agosto";   break;
			case"9": $diasemana = "Setembro";   break;
			case"10": $diasemana = "Outubro";   break;
			case"11": $diasemana = "Novembro";   break;
			case"12": $diasemana = "Dezembro";   break;
			}		
		return $diasemana;
		}
	//Data para inserir no banco
	public function dataInserir($data){
		$data = explode("/",$data);
		$data = $data[2]."-".$data[1]."-".$data[0];
		return $data;
		}
	//Data para mostrar
	public function dataMostrar($data){
		$data = explode("-",$data);
		$data = $data[2]."/".$data[1]."/".$data[0];
		return $data;
		}
	//Data para mostrar
	public function dataMostrarCurta($data){
		$data = explode("-",$data);
		$data = $data[2]."/".$data[1];
		return $data;
		}
	//Data para mostrar
	public function dataMostrarArray($data){
		$data = explode("-",$data);
		$dataReturn[0] = $data[2];
		$dataReturn[1] = $data[1];
		$dataReturn[2] = $data[0];
		return $dataReturn;
		}
	//Mostrar TimeStanp
	public function timeStampMostrar($dado){
		$dado = explode(" ", $dado);
		$data = $this->dataMostrar($dado[0]);
		return $data." - ".$dado[1];
		}
	//Mostrar Data TimeStanp
	public function DataTimeStampMostrar($dado){
		$dado = $this->timeStampMostrar($dado);
		$dado = explode(" - ", $dado);
		$data = $dado[0];
		return $data;
		}
	//Mostrar Data TimeStanp para Inserir
	public function DataTimeStampInserir($dado){
		$dado = $this->timeStampMostrar($dado);
		$dado = explode(" - ", $dado);
		$data = $dado[0];
		$data = $this->dataInserir($data);
		return $data;
		}
	//Mostrar Hora TimeStanp
	public function HoraTimeStampMostrar($dado){
		$dado = $this->timeStampMostrar($dado);
		$dado = explode(" - ", $dado);
		$data = $dado[1];
		return $data;
		}
	//Mostrar Data PagSeguro
	public function dataPagSeguro($dado){
		$dado = explode("T",$dado);
		$data = $this->dataMostrar($dado[0]);
		$hora = explode(".",$dado[1]);
		return $data." - ".$hora[0];
		}
	//Função do nome do Produtos
	public function produtoNome($nome){
		$nome = explode(" ",$nome);
		$nome = implode("-",$nome);
		return $nome;
		}
	//Devolver Situação
	public function situacaoCliente($situacao){
		switch($situacao){
			case 0:
			$situacao = "Não Respondido";
			$cor = "#FFF";
			break;
			case 1:
			$situacao = "Fechado";
			$cor = "#47e264";
			break;
			case 2:
			$situacao = "Descartado";
			$cor = "#FD3C31";
			break;
			case 3:
			$situacao = "Em negociação";
			$cor = "#FF0";
			break;
			case 4:
			$situacao = "Em andamento";
			$cor = "#6262FF";
			break;
			break;
			case 5:
			$situacao = "Prospecção";
			$cor = "#F90";
			break;
			}
			$retorno['situacao'] = $situacao;
			$retorno['cor'] = $cor;
			return $retorno;
		}
	//Devolver Tipo de Mensagem
	public function tipoMensagem($tipo){
		switch($tipo){
			case 0: 
			$icon = "fa-user";
			$texto = "Fale Conosco";
			break;
			case 1: 
			$icon = "fa-info-circle";
			$texto = "Informação";
			break;
			case 2: 
			$icon = "fa-phone";
			$texto = "Ligação";
			break;
			case 3: 
			$icon = "fa-whatsapp";
			$texto = "WhatsApp";
			break;
			case 4: 
			$icon = "fa-envelope-o";
			$texto = "E-mail";
			break;
			case 5: 
			$icon = "fa-file-pdf-o";
			$texto = "Histórico (análise)";
			break;
			case 6: 
			$icon = "fa-file-text-o";
			$texto = "Resposta (Análise)";
			break;
			case 7: 
			$icon = "fa-book";
			$texto = "Documentação";
			break;
			case 8: 
			$icon = "fa-credit-card";
			$texto = "Pagamento";
			break;
			case 9: 
			$icon = "fa-trash-o";
			$texto = "Descartado";
			break;
			case 10: 
			$icon = "fa-compress";
			$texto = "Pré-Matrícula";
			break;
			case 11: 
			$icon = "fa-calendar-plus-o";
			$texto = "Prospecção";
			break;
		}
		$retorno['icon'] = $icon;
		$retorno['texto'] = $texto;
		return $retorno;
	}
	//Devolver Telefone
	public function telefoneFunc($telefone){
		$telefone = explode("-",$telefone);
		$operadora = $telefone[1];
		$telefone = str_replace("(","",$telefone[0]);
		$telefone = str_replace(")","",$telefone);
		$telefone = str_replace(" ","",$telefone);
		$telefone = str_replace(".","",$telefone);
		$retorno['operadora'] = trim(preg_replace('/\s\s+/', ' ',$operadora));
		$retorno['telefone'] = trim(preg_replace('/\s\s+/', ' ',$telefone));
		return $retorno;		
		}
	//Devolver Interesse
	public function devolverInteresse($tipo,$valor){
		//Devolver em Branco
		if($valor == ""){$retorno = "";}
		//Devolver Texto
		elseif($tipo == 1){
			switch($valor){
				case 1:$retorno = "Licenciatura para Graduados";break;
				case 2:$retorno = "Pedagogia para Licenciados";break;
				case 3:$retorno = "Segunda Licenciatura";break;
				case 4:$retorno = "Pós Graduação";break;
				case 5:$retorno = "Pedagogia para Licenciados - FIES";break;
				}
			}
		//Devolver o COD
		else{
			switch($valor){
				case "Licenciatura para Graduados":$retorno = 1;break;
				case "Pedagogia para Licenciados":$retorno = 2;break;
				case "Segunda Licenciatura":$retorno = 3;break;
				case "Pós Graduação":$retorno = 4;break;
				case "Pedagogia para Licenciados - FIES":$retorno = 5;break;
				}			
			}
		//Retorna o Valor
		return $retorno;
		}

	//Devolver Números
	public function soNumero($str) {
	    return preg_replace("/[^0-9]/", "", $str);
		}

	//Mensagem de Alerta
	public function alertMSG($tipo, $msg){
		//Sucesso
		if($tipo == 1){
			$content = "
				<div class='alert alert-success alert-dismissible fade in' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                  </button>
                  ".$msg."
                 </div>";
			}
		else{
			$content = "
				<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                  </button>
                  ".$msg."
                 </div>";
			}
		return $content;
	}
	
	//Devolver Status Aluno
	public function statusAluno($status){
		switch($status){
			case 0: $retorno['tipo']="default"; $retorno['texto']="Não Respondido"; break;
			case 1: $retorno['tipo']="success"; $retorno['texto']="Estudando"; break;
			case 2: $retorno['tipo']="danger"; $retorno['texto']="Descartado"; break;
			case 3: $retorno['tipo']="warning"; $retorno['texto']="Negociação"; break;
			case 4: $retorno['tipo']="primary"; $retorno['texto']="Andamento"; break;
			case 5: $retorno['tipo']="dark"; $retorno['texto']="Prospecção"; break;
			}
		return $retorno;
	}

	//Devolver Status Matrícula
	public function statusMatricula($status){
		switch($status){
			case 0: $retorno['tipo']="danger"; $retorno['texto']="Cancelada"; break;
			case 1: $retorno['tipo']="primary"; $retorno['texto']="Estudando"; break;
			case 2: $retorno['tipo']="success"; $retorno['texto']="Formado"; break;
			}
		return $retorno;
	}

	//Devolver Status Fatura
	public function statusFatura($status){
		switch($status){
			case 0: $retorno['tipo']="dark"; $retorno['texto']="Cancelada"; break;
			case 1: $retorno['tipo']="warning"; $retorno['texto']="Aguardando Pagamento"; break;
			case 2: $retorno['tipo']="danger"; $retorno['texto']="Vencida"; break;
			case 3: $retorno['tipo']="success"; $retorno['texto']="Recebida"; break;
			}
		return $retorno;
	}

	//Devolver Status Certificacao
	public function statusCertificacao($status){
		switch($status){			
			case 0: $retorno['tipo']="danger"; $retorno['texto']="Cancelada"; break;
			case 1: $retorno['tipo']="warning"; $retorno['texto']="Em Análise"; break;
			case 2: $retorno['tipo']="primary"; $retorno['texto']="Em Confecção"; break;
			case 3: $retorno['tipo']="info"; $retorno['texto']="Ag. Retirada"; break;
			case 4: $retorno['tipo']="success"; $retorno['texto']="Entregue"; break;
			}
		return $retorno;
	}
	

	//Devolver Status Lote
	public function statusLote($status){
		switch($status){
			case 0: $retorno['tipo']="danger"; $retorno['texto']="Cancelada"; break;
			case 1: $retorno['tipo']="warning"; $retorno['texto']="Em Preparação"; break;
			case 2: $retorno['tipo']="info"; $retorno['texto']="Em Confecção"; break;
			case 3: $retorno['tipo']="success"; $retorno['texto']="Recebido"; break;
			}
		return $retorno;
	}

	//Devolver Status Aluno
	public function htmlStatus($status){
		//Status
		if($status){
			//Prepara os dados
			$retorno['tipo'] = "success";
			$retorno['texto'] = "Ativo";
			$retorno['tipoInverso'] = "danger";
			$retorno['textoInverso'] = "Desativar";
			$retorno['iconeInverso'] = "fa fa-trash-o";
			$retorno['acao'] = "desativar";
		}
		else{
			//Prepara os dados
			$retorno['tipo'] = "danger";
			$retorno['texto'] = "Inativo";
			$retorno['tipoInverso'] = "success";
			$retorno['textoInverso'] = "Ativar";
			$retorno['iconeInverso'] = "fa fa-check-circle";
			$retorno['acao'] = "ativar";
		}
		return $retorno;
	}

	//Mostrar Mascaras
	public function maskMostrar($val, $mask){
		 $maskared = '';
		 $k = 0;
		 for($i = 0; $i<=strlen($mask)-1; $i++){
			if($mask[$i] == '#'){
				if(isset($val[$k]))
				$maskared .= $val[$k++];
			}
			else{
				if(isset($mask[$i]))
				$maskared .= $mask[$i];
			}
		 }
		 return $maskared;
		}

	//Inserir Notificações
	public function inserirNotificacao($tipo, $tdest, $iddest, $msg, $link){
		//Icone
		switch ($tipo) {
			case '1':
				$tipo_notificacao = '1';
				$icon_notificacao = 'info-circle';
				$titulo_notificacao = 'Informação';
				break;
			case '2':
				$tipo_notificacao = '2';
				$icon_notificacao = 'paper-plane';
				$titulo_notificacao = 'Atividade';
				break;
			case '3':
				$tipo_notificacao = '3';
				$icon_notificacao = 'bullhorn';
				$titulo_notificacao = 'Fórum';
				break;
			
			default:
				$tipo_notificacao = '1';
				$icon_notificacao = 'info-circle';
				$titulo_notificacao = 'Informação';
				break;
		}
		//Cadastra no Banco
		$inserirN = mysql_query("INSERT INTO notificacoes SET tipo_destinatario='$tdest', id_destinatario='$iddest', tipo_notificacao='$tipo_notificacao', titulo_notificacao='$titulo_notificacao', link_notificacao='$link', icon_notificacao='$icon_notificacao', mensagem_notificacao='$msg', lido_notificacao='0', ativo_notificacao='1'");
		if($inserirN){return true;}
		else{return false.mysql_error();}
	}

	//Diferença de tempo - notificações
	public function haTempo($dateInicial){
		$start_date = new DateTime($dateInicial);
        $since_start = $start_date->diff(new DateTime());
        $dias = $since_start->days;
        //Texto do retorno
        switch($dias){
        	case 0: 
        		$num = $since_start->i; 
        		$txtRetorn = $num." minuto"; 
        		$tip = '1';         		
    		break;
    		case ($dias >= 1 && $dias < 360): 
        		$num = $since_start->days; 
        		$txtRetorn = $num." dia"; 
        		$tip = '2';         		
    		break;    		
        	case ($dias >= 360): 
        		$num = $since_start->y;
        		$txtRetorn = $num." ano"; 
        		$tip = '3';         		 
    		break;
        	default: 
        		$num = $since_start->m; 
        		$txtRetorn = $num." mes"; 
        		$tip = '4';         		
    		break;
        }
        //Plural ou Singular
        switch($tip){
        	case 1:
        		$fimT = ($num > 1) ? "s" : "";  
        	break;
        	case 2:
        		$fimT = ($num > 1) ? "s" : ""; 
        	break;
        	case 3: 
        		$fimT = ($num > 1) ? "s" : "";
        	break;
        	case 4: 
        		$fimT = ($num > 1) ? "es" : "";
        	break;
        	default:
        		$fimT = "";
        	break;
        }

        //Retorno
        return $txtRetorn.$fimT;
	}

	//Data Reduzida para mostrar
	public function dataReduzidaMostrar($data){
		$data = explode("-",$data);
		$data = $data[2]."/".$data[1];
		return $data;
		}
	//Data Reduzida para mostrar
	public function dataReduzidaMostrar2($data){
		$data = explode("/",$data);
		$data = $data[0]."/".$data[1];
		return $data;
		}

	//Retornar icon de acordo com a extensão
	public function iconExtensao($extensao){
		switch ($extensao) {
			case 'txt':
				$icon = "fa fa-file-text-o";
				break;
			case 'doc':
				$icon = "fa fa-file-word-o";
				break;
			case 'docx':
				$icon = "fa fa-file-word-o";
				break;
			case 'pdf':
				$icon = "fa fa-file-pdf-o";
				break;
			case 'ppt':
				$icon = "fa fa-file-powerpoint-o";
				break;
			case 'pttx':
				$icon = "fa fa-file-powerpoint-o";
				break;
			case 'jpg':
				$icon = "fa fa-file-image-o";
				break;
			case 'jpeg':
				$icon = "fa fa-file-image-o";
				break;
			case 'png':
				$icon = "fa fa-file-image-o";
				break;
			case 'gif':
				$icon = "fa fa-file-image-o";
				break;
			case 'xls':
				$icon = "fa fa-file-excel-o";
				break;
			case 'xlsx':
				$icon = "fa fa-file-excel-o";
				break;
			default:
				$icon = "fa fa-file-o";
				break;
			}
		return $icon;
	}

	//Retornar letra de acordo o número
	public function retornaLetra($num){
		switch ($num) {
			case 1:
				$letra = "A";
				break;
			case 2:
				$letra = "B";
				break;
			case 3:
				$letra = "C";
				break;
			case 4:
				$letra = "D";
				break;
			case 5:
				$letra = "E";
				break;
			case 6:
				$letra = "F";
				break;
			case 7:
				$letra = "G";
				break;
			case 8:
				$letra = "H";
				break;
			case 9:
				$letra = "I";
				break;
			case 10:
				$letra = "J";
				break;
			case 11:
				$letra = "K";
				break;
			case 12:
				$letra = "L";
				break;
			case 13:
				$letra = "M";
				break;
			case 14:
				$letra = "N";
				break;
			case 15:
				$letra = "O";
				break;
			case 16:
				$letra = "P";
				break;
			case 17:
				$letra = "Q";
				break;
			case 18:
				$letra = "R";
				break;
			case 19:
				$letra = "S";
				break;
			case 20:
				$letra = "T";
				break;
			case 21:
				$letra = "U";
				break;
			case 22:
				$letra = "V";
				break;
			case 23:
				$letra = "W";
				break;
			case 24:
				$letra = "X";
				break;
			case 25:
				$letra = "Y";
				break;
			case 26:
				$letra = "Z";
				break;
			default:
				$letra = "A";
				break;
			}
		return $letra;
	}

	//Extensões permitidas para uoload
	public function extUpload($extensao){
		$extensoes = array('txt', 'doc', 'docx', 'pdf', 'ppt', 'xlsx', 'xls', 'gif', 'png', 'jpeg', 'jpg', 'pttx');
		if(in_array($extensao, $extensoes)){return true;}
		else{return false;}
	}

	//Calcular a comissão dos vendedores
	public function comissaoVendedor($matriculas)
	{
		if($matriculas >= 20 && $matriculas <=29){$percent = 0.2;}
		elseif($matriculas >= 30 && $matriculas <=39){$percent = 0.3;}
		elseif($matriculas >= 40){$percent = 0.4;}
		else{$percent = 0.0;}
		$comi = ($matriculas * 199) * $percent;
		return $comi;

	}

	//Tipo de Fatura
	public function tipoFatura($tipo){
		switch($tipo){
			case 1:$retorno = "Taxa de Matrícula";break;
			case 2:$retorno = "Mensalidade";break;
			case 3:$retorno = "Dependência Acadêmica";break;
			case 4:$retorno = "Acordo";break;
			}
		return $retorno;
	}

	//Mascaras em String
	public function mascaraString($val, $mask){
	    $maskared = '';
	    $k = 0;
	    for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
	        if ($mask[$i] == '#') {
	            if (isset($val[$k])) {
	                $maskared .= $val[$k++];
	            }
	        } else {
	            if (isset($mask[$i])) {
	                $maskared .= $mask[$i];
	            }
	        }
	    }
	    return $maskared;
	}

	//Buscar link da farura no Asaas
	public function asaasLinkFatura($idfatura){
		//Inicia o curl
		$ch = curl_init();
		//Tipo de solicitação
		$urlAsaas = "https://www.asaas.com/api/v3/payments/".$idfatura;
		curl_setopt($ch, CURLOPT_URL, $urlAsaas);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("access_token: 75441a8cf9f83bd4d4ca748db1427e0780754d5111e21a096299d20a36bc7ba2"));
		//Executa
		$execurl = curl_exec($ch);
		//Resposta positiva
		$resposta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($resposta == '200'){
			//Transforma em array
			$retorno = json_decode($execurl, true);
			//Redireciona
			$link_pagamento = $retorno['invoiceUrl'];    
		}
		else{
			$link_pagamento = "#";
		}
		//Encerra o curl
		curl_close($ch);
		//Retorna o link
		return $link_pagamento;
	}

	//Buscar um cliente no Asaas
	public function asaasBuscarCliente($cpf){
		//Inicia o curl
		$ch = curl_init();
		//Tipo de solicitação
		$urlAsaas = "https://www.asaas.com/api/v3/customers?cpfCnpj=".$cpf;
		curl_setopt($ch, CURLOPT_URL, $urlAsaas);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("access_token: 75441a8cf9f83bd4d4ca748db1427e0780754d5111e21a096299d20a36bc7ba2"));
		//Executa
		$execurl = curl_exec($ch);
		//Resposta positiva
		$resposta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($resposta == '200'){
			//Transforma em array
			$retorno = json_decode($execurl, true);
			//Verifica se achou o cliente
			if($retorno['totalCount'] >= 1){
				$id = preg_replace("/[^0-9]/", "", $retorno['data'][0]['id']);
				$return = $id;
			}
			else{
				$return = 0;
			}
			
		}
		else{
			$return = 0;
		}
		//Encerra o curl
		curl_close($ch);
		return $return;
	}

	//Buscar um parcelamento no Asaas
	public function asaasBuscarParcelamento($idParcelamento, $limit){
		$ch = curl_init();
		//Tipo de solicitação
		$urlAsaas = "https://www.asaas.com/api/v3/payments?installment=".$idParcelamento."&limit=".$limit;
		curl_setopt($ch, CURLOPT_URL, $urlAsaas);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "Content-Type: application/json",
		  "access_token: 75441a8cf9f83bd4d4ca748db1427e0780754d5111e21a096299d20a36bc7ba2"
		));
		//Executa
		$execurl = curl_exec($ch);
		//Resposta positiva
		$resposta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($resposta == '200'){
			//Transforma em array
			$retorno = json_decode($execurl, true);
			$return = array();
			//Prepara o retorno
			$parc = $retorno['data'];
			$c = 0;
			foreach($parc as $dado){
				$return[$c]['descricao'] = $dado['description'];
				$return[$c]['valor'] =  $dado['value'];
				$return[$c]['vencimento'] = $dado['dueDate'];
				$return[$c]['id'] = $dado['invoiceNumber'];
				$c = $c + 1;
			}
		}
		else{
			$return = 0;
		}
		//Encerra o curl
		curl_close($ch);
		return $return;
	}

	//Buscar uma cobrança no Asaas
	public function asaasBuscarCobranca($idClienteAsaas, $limit){
		$ch = curl_init();
		//Tipo de solicitação
		$urlAsaas = "https://www.asaas.com/api/v3/payments?customer=".$idClienteAsaas."&limit=".$limit;
		curl_setopt($ch, CURLOPT_URL, $urlAsaas);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "Content-Type: application/json",
		  "access_token: 75441a8cf9f83bd4d4ca748db1427e0780754d5111e21a096299d20a36bc7ba2"
		));
		//Executa
		$execurl = curl_exec($ch);
		//Resposta positiva
		$resposta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($resposta == '200'){
			//Transforma em array
			$retorno = json_decode($execurl, true);
			$return = array();
			//Prepara o retorno
			$parc = $retorno['data'];
			$c = 0;
			foreach($parc as $dado){
				$return[$c]['descricao'] = $dado['description'];
				$return[$c]['valor'] =  $dado['value'];
				$return[$c]['vencimento'] = $dado['dueDate'];
				$return[$c]['id'] = $dado['invoiceNumber'];
				$c = $c + 1;
			}
		}
		else{
			$return = 0;
		}
		//Encerra o curl
		curl_close($ch);
		return $return;
	}

	//Cadastrar um cliente no Asaas
	public function asaasAddCliente($cpf, $nome, $email, $ra, $telefone){
		//Inicia o curl
		$ch = curl_init();
		//Tipo de solicitação
		$urlAsaas = "https://www.asaas.com/api/v3/customers";
		curl_setopt($ch, CURLOPT_URL, $urlAsaas);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{
		  \"name\": \"$nome\",
		  \"email\": \"$email\",
		  \"phone\": \"$telefone\",
		  \"mobilePhone\": \"$telefone\",
		  \"cpfCnpj\": \"$cpf\",
		  \"observations\": \"$ra\"
		}");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "Content-Type: application/json",
		  "access_token: 75441a8cf9f83bd4d4ca748db1427e0780754d5111e21a096299d20a36bc7ba2"
		));
		//Executa
		$execurl = curl_exec($ch);
		//Resposta positiva
		$resposta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($resposta == '200'){
			//Transforma em array
			$retorno = json_decode($execurl, true);
			//Verifica se achou o cliente
			$id = preg_replace("/[^0-9]/", "", $retorno['id']);
			$return = $id;
		}
		else{
			$return = 0;
		}
		//Encerra o curl
		curl_close($ch);
		return $return;
	}

	//Cadastrar uma fatura (pre-matrícula e fatura individual)
	public function asaasAddCobranca($idcliente, $valor, $vencimento, $descricao){
		//Inicia o curl
		$ch = curl_init();
		//Tipo de solicitação
		$urlAsaas = "https://www.asaas.com/api/v3/payments";
		curl_setopt($ch, CURLOPT_URL, $urlAsaas);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{
		  \"customer\": \"$idcliente\",
		  \"billingType\": \"UNDEFINED\",
		  \"value\": \"$valor\",
		  \"dueDate\": \"$vencimento\",
		  \"description\": \"$descricao\"
		}");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "Content-Type: application/json",
		  "access_token: 75441a8cf9f83bd4d4ca748db1427e0780754d5111e21a096299d20a36bc7ba2"
		));
		//Executa
		$execurl = curl_exec($ch);
		//Resposta positiva
		$resposta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($resposta == '200'){
			//Transforma em array
			$retorno = json_decode($execurl, true);
			//Verifica se achou o cliente
			$id = preg_replace("/[^0-9]/", "", $retorno['invoiceNumber']);
			$return = $id;
		}
		else{
			$return = 0;
		}
		//Encerra o curl
		curl_close($ch);
		return $return;
	}

	//Cadastrar um parcelamento (mensalidades)
	public function asaasAddParcelamento($idcliente, $valor, $quantidade, $vencimento){
		//Inicia o curl
		$ch = curl_init();
		//Tipo de solicitação
		$urlAsaas = "https://www.asaas.com/api/v3/payments/";
		curl_setopt($ch, CURLOPT_URL, $urlAsaas);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{
		  \"customer\": \"$idcliente\",
		  \"billingType\": \"UNDEFINED\",
		  \"installmentValue\": \"$valor\",
		  \"installmentCount\": \"$quantidade\",
		  \"dueDate\": \"$vencimento\"
		}");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "Content-Type: application/json",
		  "access_token: 75441a8cf9f83bd4d4ca748db1427e0780754d5111e21a096299d20a36bc7ba2"
		));
		//Executa
		$execurl = curl_exec($ch);
		//Resposta positiva
		$resposta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($resposta == '200'){
			//Transforma em array
			$retorno = json_decode($execurl, true);
			//Verifica se achou o cliente
			$id = preg_replace("/[^0-9]/", "", $retorno['installment']);
			$return = $id;
		}
		else{
			$return = 0;
		}
		//Encerra o curl
		curl_close($ch);
		return $return;
	}

	//Retorna Sexo
	public function retornaSexo($sexo){
		if($sexo == 1){
			$retorno['sexo'] = 'Masculino';
			$retorno['letra'] = 'o';
		}
		elseif($sexo == 2){
			$retorno['sexo'] = 'Feminino';
			$retorno['letra'] = 'a';
		}
		else{
			$retorno['sexo'] = '';
			$retorno['letra'] = '';
		}
		return $retorno;
	}

	//Retorna data completa
	public function retornaDataCompleta($data){
		$d = explode("-", $data);
		$mes = $this->mostrarMes($d[1]);
		$retorno = $d[2].' de '.$mes.' de '.$d[0];
		return $retorno;
	}

	//Enviando um e-mail único
	public function enviarEmail($emailFrom, $nomeFrom, $emailTo, $nomeTo, $emailReply, $nomeReply, $assunto, $descricao, $msg, $anexo){
		//Inicia o curl
		$ch = curl_init();
		//Tipo de solicitação
		$urlMail = "https://www.uniplenaeducacional.com.br/Mail/index.php";
		//Campos
		$fields = array(
			'emailFrom' => $emailFrom,
			'nomeFrom' => $nomeFrom, 
			'emailTo' => $emailTo,
			'nomeTo' => $nomeTo,
			'emailReply' => $emailReply,
			'nomeReply' => $nomeReply,
			'assunto' => $assunto,
			'descricao' => $descricao,
			'msg' => $msg,
			'anexo' => $anexo
		);
		curl_setopt($ch, CURLOPT_URL, $urlMail);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		//Executa
		$execurl = curl_exec($ch);
		//Resposta positiva
		$resposta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		//Retorno
		return $execurl;
	}

	//Fila de Fale Conosco
	public function filaVendedor($interesse){
	  switch ($interesse) {
	    case '1':
	      $strAND = "curso_faleconosco='1' OR curso_faleconosco='6'";
	      break;
	    case '2':
	      $strAND = "curso_faleconosco='2' OR curso_faleconosco='3' OR curso_faleconosco='7'";
	      break;
	    case '3':
	      $strAND = "curso_faleconosco='2' OR curso_faleconosco='3' OR curso_faleconosco='7'";
	      break;
	    case '4':
	      $strAND = "curso_faleconosco='4' OR curso_faleconosco='5' OR curso_faleconosco='8'";
	      break;
	    case '5':
	      $strAND = "curso_faleconosco='4' OR curso_faleconosco='5' OR curso_faleconosco='8'";
	      break;
	    default:
	      $strAND = "curso_faleconosco='1' OR curso_faleconosco='6'";
	      break;
	    }
        //Fila de Vendedores
        $busca_vendedores = mysql_query("SELECT * FROM funcionarios WHERE nivel_funcionario='3' AND ativo_funcionario='1' ORDER BY nome_funcionario ASC");
        //Ultimo vendedor a receber o fale
        $busca_ultimo_vendedor = mysql_query("SELECT * FROM mensagens_alunos WHERE id_funcionario_faleconosco != '' AND (".$strAND.") ORDER BY data_mensagem DESC LIMIT 1");
        while ($res_ultimo = mysql_fetch_array($busca_ultimo_vendedor)) {
          $id_ultimo_fale = $res_ultimo['id_funcionario_faleconosco'];
        }
        $daVez = "0";
        $id_primeiro = '';
        $id_vendedor_vez = '';
        while ($resVendedores = mysql_fetch_array($busca_vendedores)) {
          //Primeiro da fila
          if($id_primeiro == ''){$id_primeiro = $resVendedores['id_funcionario'];}
          //Verifica se o ulimo da vez passou
          if($daVez == '1'){$id_vendedor_vez = $resVendedores['id_funcionario']; $daVez = '0';}
          //Array da Fila
          if($id_ultimo_fale == $resVendedores['id_funcionario']){$daVez = "1";}
        }
        //Verifica se ficou em branco
        if($id_vendedor_vez == ''){$id_vendedor_vez = $id_primeiro;}
        //Retorno
        return $id_vendedor_vez;
	}

	//Fila de Fale Conosco
	public function filaVendedorMult($interesse){
	  switch ($interesse) {
	    case '14':
	      $strAND = "curso_faleconosco='14'";
	      break;
	    case '15':
	      $strAND = "curso_faleconosco='15'";
	      break;
	    case '16':
	      $strAND = "curso_faleconosco='16'";
	      break;
	    default:
	      $strAND = "curso_faleconosco='14'";
	      break;
	    }
        //Fila de Vendedores
        $busca_vendedores = mysql_query("SELECT * FROM funcionarios WHERE nivel_funcionario='5' AND ativo_funcionario='1' ORDER BY nome_funcionario ASC");
        //Ultimo vendedor a receber o fale
        $busca_ultimo_vendedor = mysql_query("SELECT * FROM mensagens_alunos WHERE id_funcionario_faleconosco != '' AND (".$strAND.") ORDER BY data_mensagem DESC LIMIT 1");
        while ($res_ultimo = mysql_fetch_array($busca_ultimo_vendedor)) {
          $id_ultimo_fale = $res_ultimo['id_funcionario_faleconosco'];
        }
        $daVez = "0";
        $id_primeiro = '';
        $id_vendedor_vez = '';
        while ($resVendedores = mysql_fetch_array($busca_vendedores)) {
          //Primeiro da fila
          if($id_primeiro == ''){$id_primeiro = $resVendedores['id_funcionario'];}
          //Verifica se o ulimo da vez passou
          if($daVez == '1'){$id_vendedor_vez = $resVendedores['id_funcionario']; $daVez = '0';}
          //Array da Fila
          if($id_ultimo_fale == $resVendedores['id_funcionario']){$daVez = "1";}
        }
        //Verifica se ficou em branco
        if($id_vendedor_vez == ''){$id_vendedor_vez = $id_primeiro;}
        //Retorno
        return $id_vendedor_vez;
	}

	//Retorna Cookies
	public function retornaCookies(){
		//Pega os Cookies do navegador
		$cookies = explode('; ', $_SERVER['HTTP_COOKIE']);
		$allCookies = [];
		foreach($cookies as $cookie) {
		    $keyAndValue = explode('=', $cookie);
		    $allCookies[$keyAndValue[0]] = $keyAndValue[1];
		}
		return $allCookies;
	}

	//Evento de ViewContent - META
	public function addViewContentMeta($id, $nome, $email, $telefone){
		//Prepara os dados
		$pixel = "771048314965198";
		$acessToken = "EAAFT0hmqyo8BOyw1nFyirdkyGY8DK3NlLZANjf6buDY1K3SY3VdEX1mGoTZBntYeNfbZCFLc3PTN5r3SkkGRt4VWv8ZCnDcZAaKK3GmZBeONsOnLr2FOmPdavVa3PE6V1sZBAwBUjQPobFdvnIGgcxuiEPFf7X24MW7IPlbeBGu9ZAAvZBeBMunZCSSErX1XKNdwZDZD";
		$urlMeta = "https://graph.facebook.com/v19.0/".$pixel."/events?access_token=".$acessToken;
		$event_time = strtotime("now");
		$url = "https://www.uniplenagraduacao.com.br".$_SERVER["REQUEST_URI"];
		$ip = $_SERVER['REMOTE_ADDR'];
		$navegador = $_SERVER['HTTP_USER_AGENT'];
		$cookies = $this->retornaCookies();
		$fbc = (array_key_exists('_fbc', $cookies) && $cookies['_fbc'] != '') ? $cookies['_fbc'] : 'null';
		$fbp = (array_key_exists('_fbp', $cookies) && $cookies['_fbp'] != '') ? $cookies['_fbp'] : 'null';
		$nome_hash = hash('sha256', $nome);
		$email_hash = hash('sha256', $email);
		$telefone_hash = hash('sha256', $telefone);
		//Inicia o curl
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $urlMeta);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, '{
		    "data": [
		        {
		            "event_name": "ViewContent",
		            "event_time": '.$event_time.',
		            "action_source": "website",
		            "event_source_url" : "'.$url.'",
		            "user_data": {
		                "client_ip_address": "'.$ip.'",
		                "client_user_agent": "'.$navegador.'",
		                "fbc": "'.$fbc.'",
		                "fbp": "'.$fbp.'",
		                "external_id": ["'.$id.'"],
						"em": ["'.$email_hash.'"],
					    "ph": ["'.$telefone_hash.'"],
						"fn": ["'.$nome_hash.'"]
		            }
		        }
		    ]
		}');
		//HEADERs
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",
		  "access_token: ".$acessToken));
		//Executa
		$execurl = curl_exec($ch);
		//Resposta positiva
		$resposta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		//Retorna o código
		return $resposta;
	}

	//Evento de PageView - META
	public function addPageViewMeta($id, $nome, $email, $telefone){
		//Prepara os dados
		$pixel = "771048314965198";
		$acessToken = "EAAFT0hmqyo8BOyw1nFyirdkyGY8DK3NlLZANjf6buDY1K3SY3VdEX1mGoTZBntYeNfbZCFLc3PTN5r3SkkGRt4VWv8ZCnDcZAaKK3GmZBeONsOnLr2FOmPdavVa3PE6V1sZBAwBUjQPobFdvnIGgcxuiEPFf7X24MW7IPlbeBGu9ZAAvZBeBMunZCSSErX1XKNdwZDZD";
		$urlMeta = "https://graph.facebook.com/v19.0/".$pixel."/events?access_token=".$acessToken;
		$event_time = strtotime("now");
		$url = "https://www.uniplenagraduacao.com.br".$_SERVER["REQUEST_URI"];
		$ip = $_SERVER['REMOTE_ADDR'];
		$navegador = $_SERVER['HTTP_USER_AGENT'];
		$cookies = $this->retornaCookies();
		$fbc = (array_key_exists('_fbc', $cookies) && $cookies['_fbc'] != '') ? $cookies['_fbc'] : 'null';
		$fbp = (array_key_exists('_fbp', $cookies) && $cookies['_fbp'] != '') ? $cookies['_fbp'] : 'null';
		$nome_hash = hash('sha256', $nome);
		$email_hash = hash('sha256', $email);
		$telefone_hash = hash('sha256', $telefone);
		//Inicia o curl
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $urlMeta);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, '{
		    "data": [
		        {
		            "event_name": "PageView",
		            "event_time": '.$event_time.',
		            "action_source": "website",
		            "event_source_url" : "'.$url.'",
		            "user_data": {
		                "client_ip_address": "'.$ip.'",
		                "client_user_agent": "'.$navegador.'",
		                "fbc": "'.$fbc.'",
		                "fbp": "'.$fbp.'",
		                "external_id": ["'.$id.'"],
						"em": ["'.$email_hash.'"],
					    "ph": ["'.$telefone_hash.'"],
						"fn": ["'.$nome_hash.'"]
		            }
		        }
		    ]
		}');
		//HEADERs
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",
		  "access_token: ".$acessToken));
		//Executa
		$execurl = curl_exec($ch);
		//Resposta positiva
		$resposta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		//Retorna o código
		return $resposta;
	}

	//Evento de Cadastro - META
	public function addCadastroMeta($id, $nome, $email, $telefone){
		//Prepara os dados
		$pixel = "771048314965198";
		$acessToken = "EAAFT0hmqyo8BOyw1nFyirdkyGY8DK3NlLZANjf6buDY1K3SY3VdEX1mGoTZBntYeNfbZCFLc3PTN5r3SkkGRt4VWv8ZCnDcZAaKK3GmZBeONsOnLr2FOmPdavVa3PE6V1sZBAwBUjQPobFdvnIGgcxuiEPFf7X24MW7IPlbeBGu9ZAAvZBeBMunZCSSErX1XKNdwZDZD";
		$urlMeta = "https://graph.facebook.com/v19.0/".$pixel."/events?access_token=".$acessToken;
		$event_time = strtotime("now");
		$url = "https://www.uniplenagraduacao.com.br".$_SERVER["REQUEST_URI"];
		$ip = $_SERVER['REMOTE_ADDR'];
		$navegador = $_SERVER['HTTP_USER_AGENT'];
		$cookies = $this->retornaCookies();
		$fbc = (array_key_exists('_fbc', $cookies) && $cookies['_fbc'] != '') ? $cookies['_fbc'] : 'null';
		$fbp = (array_key_exists('_fbp', $cookies) && $cookies['_fbp'] != '') ? $cookies['_fbp'] : 'null';
		$nome_hash = hash('sha256', $nome);
		$email_hash = hash('sha256', $email);
		$telefone_hash = hash('sha256', $telefone);
		//Inicia o curl
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $urlMeta);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, '{
		    "data": [
		        {
		            "event_name": "Lead",
		            "event_time": '.$event_time.',
		            "action_source": "website",
		            "event_source_url" : "'.$url.'",
		            "user_data": {
		                "client_ip_address": "'.$ip.'",
		                "client_user_agent": "'.$navegador.'",
		                "fbc": "'.$fbc.'",
		                "fbp": "'.$fbp.'",
		                "external_id": ["'.$id.'"],
						"em": ["'.$email_hash.'"],
					    "ph": ["'.$telefone_hash.'"],
						"fn": ["'.$nome_hash.'"]
		            }
		        }
		    ]
		}');
		//HEADERs
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",
		  "access_token: ".$acessToken));
		//Executa
		$execurl = curl_exec($ch);
		//Resposta positiva
		$resposta = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		//Envia o PageView
		$viewcontent = $this->addViewContentMeta($id, $nome, $email, $telefone);
		//Envia o ViewContent
		$pagview = $this->addPageViewMeta($id, $nome, $email, $telefone);
		//Retorna o código
		if($resposta == '200' && $pagview == '200' && $viewcontent == '200'){
			return 200;
		}
		else{
			return 500;
		}
	}

}
		
?>