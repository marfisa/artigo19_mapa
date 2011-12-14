<?php

	require_once("includes/utils.inc.php");

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<title><?php echo SITE_TITLE;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/padrao.css" rel="stylesheet" type="text/css">
<link href="css/SimpleTabs.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo($GoogleMapsKey); ?>"></script>
<script language="JavaScript" type="text/JavaScript" src="js/mootools-release-1.11.js"></script>
<script language="JavaScript" type="text/JavaScript" src="js/estados.js"></script>
<script language="JavaScript" type="text/JavaScript" src="js/principal.js"></script>
<script language="JavaScript" type="text/JavaScript" src="js/gmap.js"></script>
<script language="JavaScript" type="text/JavaScript" src="js/autocompleter.js"></script>
<script language="JavaScript" type="text/JavaScript" src="js/SimpleTabs.js"></script>
</head>

<body>
	<div id="container_info">
		<a href="javascript:void(0)" id="box_fechar">fechar</a>
		<div id="box_tabinfo">
			<h4 title="Histórico">Histórico</h4>
			<div>
				<p>O Mapa das Rádios Comunitárias nasceu em 2008, de uma parceria entre o Instituto de Pesquisa e Projetos Sociais e Tecnológicos – IPSO e
				a ARTIGO 19. Foi atualizado e retomado somente pela ARTIGO 19 em 2011 como o primeiro passo para a construção do Observatório de Comunicação Comunitária.</p>
				<p><B>Ficha técnica</B><br />
				Realização: ARTIGO 19<br />
				Concepção: Instituto de Pesquisa e Projetos Sociais e Tecnológicos – IPSO e ARTIGO 19<br />
				</p>
				
				<p>
					<i>2008</i><br />
					Equipe do IPSO envolvida:<br />
					Carlos Seabra (coordenação geral)<br />
					Mariane Ottati (gerenciamento executivo)<br />
					Laura Tresca (coordenação de projeto)<br />
					Cauê Thenório (programação)<br />
					Daniel Medeiros (programação)<br />
					Rodrigo Sampaio Primo (programação)<br />
				</p>
				<p>
					Equipe da ARTIGO 19 envolvida:<br />
					Paula Martins (coordenação geral)<br />
					Jamila Venturini (coordenação e produção de conteúdo)<br />
					Mila Molina (apoio)
				</p>
				<p>
					<i>2011</i><br />
					Paula Martins (coordenação geral)<br />
					Laura Tresca  (coordenação de conteúdo)<br />
					Carlos Seabra (consultoria)<br />
					José Eduardo Bernardes e Jamila Venturini  (produção de conteúdo)<br />
					Rodrigo Sampaio Primo (desenvolvimento)
				</p>
				<p>
					<b>Fontes de informações:</b><br />
					Sistema	de Informação dos Serviços de Comunicação de Massa, da Agência Nacional de Telecomunicações – Anatel e Ministério das Comunicações.
				</p>		
				<p>Para	mais informações ou colaboração escreva	para&nbsp;<A HREF="mailto:comunicacao@artigo19.org">comunicacao@artigo19.org</A></p>
			</div>
			
			<h4 title="Metodologia">Metodologia</h4>
			<div>
				<h3>Metedologia usada no mapeamento</h3>
				<p>O mapa das rádios comunitárias traz uma compilação das rádios comunitárias outorgadas pelo Ministério das Comunicações.</p>
				<p>Os dados foram coletados no Sistema de Informação dos Serviços de Comunicação de Massa (Siscom), da Agência Nacional de Telecomunicações (Anatel) e estão disponíveis no site <a href="http://sistemas.anatel.gov.br/siscom" target="_blank">http://sistemas.anatel.gov.br/siscom</a>.  As estações foram buscadas no referido sistema, estado por estado. O serviço pesquisado foi Radiodifusão Comunitária (231).</p>
				<p>O resultado da pesquisa foi comparado com as listas publicadas no site do Ministério Comunicações em PDF para constatação da atualidade dos dados.</p>
				<p>O mapa traz informações sobre a localidade da estação, sua freqüência e a razão social da associação responsável pela emissora. As rádios estão divididas entre as que possuem licença definitiva, licença provisória e as que não possuem licença para funcionamento, apesar de já terem a outorga do Ministério.</p>
				<p>Segundo o Decreto 2.615/98, a Licença para Funcionamento de Estação é o documento que habilita a estação a funcionar em caráter definitivo. A licença definitiva é emitida após decreto legislativo do Congresso Nacional. A outorga concedida pelo Ministério das Comunicações, portanto, só tem efeitos legais após deliberação do Congresso, conforme o parágrafo 3º do artigo 223 da Constituição Federal. A licença provisória, por sua vez, é emitida pelo Ministério das Comunicações se, em um prazo de 90 dias, o Congresso Nacional não apreciar o pedido encaminhado pelo Ministério. A licença provisória permite que a rádio funcione normalmente e vale até a publicação do decreto legislativo.</p>
				<p>A consulta que resultou neste mapa foi feita em dezembro de 2011. Do total de 4394 rádios comunitárias existentes, não constam no mapa 506 rádios, porque não tinham seus endereços disponíveis na Anatel. Outras possíveis diferenças nas informações são conseqüência da autorização de novas entidades a operar o serviço de radiodifusão comunitária, conforme a conclusão de avisos de habilitação em andamento. Para mais informações ou colaboração escreva para <a href="mailto:comunicacao@artigo19.org">comunicacao@artigo19.org</a>.</p>
				<p>Atenção: o mapa das rádios comunitárias não identifica se as estações estão efetivamente em funcionamento ou não, apenas indica - de acordo com as informações fornecidas pela Anatel - quais estão autorizadas a funcionar. Rádios em processo de habilitação ou não legalizadas não foram abordadas neste levantamento.</p>
			</div>
			
			<h4 title="Totais">Totais</h4>
			<div>
				<p>De janeiro de 2008 a dezembro de 2011 (quatro anos), foram inseridos 1.283 novos registros de rádios comunitárias no sistema.</p>
				<h3>Por estado</h3>
				<p>
					<table cellspace="1" border="0" class="info">
						<tr>
							<th>Estado</td>
							<th>Licença definitiva</td>
							<th>Licença provisória</td>
							<th>Outorgada, sem licença</td>
							<th>Total</td>
						</tr>
				
				<?


	$sqlPontosPorEstado =
		"SELECT
			u.nome,
			SUM(licenca = 'definitiva') as lic,
			SUM(licenca = 'provisoria') as plic,
			SUM(licenca = 'sem') as nlic,
			COUNT(*) as total
		FROM
			`radios_comunitarias` r
		INNER JOIN
			`ipso_municipio` m ON r.cod_municipio = m.codigo
		INNER JOIN
			`ipso_uf` u ON m.`id_uf` = u.id_uf
		WHERE
			`VISIVEL` = 1
		GROUP BY
			m.id_uf
		ORDER BY
			u.uf";
			
	$resPontos = query($sqlPontosPorEstado);
	
	$corFundo = " class=\"c2\"";
	
	while($ponto = mysql_fetch_array($resPontos))
	{
		echo("						<tr{$corFundo}>\r\n");
		echo("							<td>" . utf8_encode($ponto['nome']) . "</td>\r\n");
		echo("							<td>" . utf8_encode($ponto['lic']) . "</td>\r\n");
		echo("							<td>" . utf8_encode($ponto['plic']) . "</td>\r\n");
		echo("							<td>" . utf8_encode($ponto['nlic']) . "</td>\r\n");
		echo("							<td>" . utf8_encode($ponto['total']) . "</td>\r\n");
		echo("						</tr>\r\n");
		
		if ($corFundo == " class=\"c2\"")
			$corFundo = "";
		else
			$corFundo = " class=\"c2\"";
	}
				?>
					</table>
				</p>
				<h3>Por região</h3>
				<p>
					<table cellspace="1" border="0" class="info">
						<tr>
							<th>Região</td>
							<th>Licença definitiva</td>
							<th>Licença provisória</td>
							<th>Outorgada, sem licença</td>
							<th>Total</td>
						</tr>
				<?


	$sqlPontosPorRegiao =
		"SELECT
			re.nome,
			SUM(licenca = 'definitiva') as lic,
			SUM(licenca = 'provisoria') as plic,
			SUM(licenca = 'sem') as nlic,
			COUNT(*) as total
		FROM
			`radios_comunitarias` r
		INNER JOIN
			`ipso_municipio` m ON r.cod_municipio = m.codigo
		INNER JOIN
			`ipso_uf` u ON m.`id_uf` = u.id_uf
		INNER JOIN
			`ipso_regiao` re ON u.`id_regiao` = re.id_regiao
		WHERE
			`VISIVEL` = 1
		GROUP BY
			re.nome
		ORDER BY
			re.nome";
			
	$resPontos = query($sqlPontosPorRegiao);
	
	while($ponto = mysql_fetch_array($resPontos))
	{
		echo("						<tr{$corFundo}>\r\n");
		echo("							<td>{$ponto['nome']}</td>\r\n");
		echo("							<td>{$ponto['lic']}</td>\r\n");
		echo("							<td>{$ponto['plic']}</td>\r\n");
		echo("							<td>{$ponto['nlic']}</td>\r\n");
		echo("							<td>{$ponto['total']}</td>\r\n");
		echo("						</tr>\r\n");

		if ($corFundo == " class=\"c2\"")
			$corFundo = "";
		else
			$corFundo = " class=\"c2\"";

	}
				?>
					</table>

				</p>
			</div>

			<h4 title="Contribua!">Contribua!</h4>
			<div>
				<p>Qualquer informação sobre as rádios listadas no mapa nos ajudará a aprimorá-lo. Se tiver dados sobre o funcionamento das rádios, correções em relação aos dados oferecidos no mapa, relatos, denúncias etc., entre em contato conosco.</p>
				<p>Basta escrever um e-mail para <a href="mailto:comunicacao@artigo19.org">comunicacao@artigo19.org</a>.</p>
				<p>Qualquer dúvida, sugestão, reclamação ou elogio será muito bem recebido. Sua contribuição é importante para o desenvolvimento e aprimoramento do nosso trabalho.</p>
			</div>

			<h4 title="Sites relacionados">Sites relacionados</h4>
			<div>
				<h3>Sites relacionados</h3>
				<p>Artigo 19: <a href="http://www.artigo19.org" target="_blank">http://www.artigo19.org</a></p>
				<p>Agência Nacional de Telecomunicações: <a href="http://www.anatel.gov.br" target="_blank">http://www.anatel.gov.br</a></p>
				<p>Associação Brasileira de Radiodifusão Comunitárias: <a href="http://www.abraconacional.org" target="_blank">http://www.abraconacional.org</a></p>
				<p>Associação Mundial de Rádios Comunitárias: <a href="http://www.brasil.amarc.org/" target="_blank">http://www.brasil.amarc.org/</a></p>
				<p>Criar Brasil: <a href="http://www.criarbrasil.org.br" target="_blank">http://www.criarbrasil.org.br</a></p>
				<p>Instituto de Pesquisas e Projetos Sociais e Tecnológicos: <a href="http://www.ipso.org.br" target="_blank">http://www.ipso.org.br</a></p>
				<p>Ministério das Comunicações: <a href="http://www.mc.gov.br" target="_blank">http://www.mc.gov.br</a></p>
				<p>Oboré - Projetos Especiais em Comunicações e Artes: <a href="http://www.obore.com" target="_blank">http://www.obore.com</a></p>
				<p>Observatório do Direito à Comunicação: <a href="http://www.direitoacomunicacao.org.br" target="_blank">http://www.direitoacomunicacao.org.br</a></p>
				<p>Observatório Nacional de Inclusão Digital: <a href="http://www.onid.org.br" target="_blank">http://www.onid.org.br</a></p>
				<p>Radiotube: <a href="http://www.radiotube.org.br" target="_blank">http://www.radiotube.org.br</a></p>
			</div>
		</div>
	</div>
	<div id="cabecalho">
		<h1>Mapa das r&aacute;dios comunit&aacute;rias</h1>
		<div class="links"><a href="javascript:void(0)" id="a_maisinfo">Mais informa&ccedil;&otilde;es</a></div>
		<div class="links"><a href="http://artigo19.org/jurisprudencia/" target="_blank">Jurisprudência</a></div>
	</div>
	<table id="container" cellspacing="0" cellpadding="0">
		<tr>
		<td id="td_map">
		<div id="map"></div>
		</td>
		<td id="td_barra">
		<div id="barra_lateral">
			<a href="javascript:void(0)" title="Procura" id="a_procura" class="titulo">Encontrar r&aacute;dios em...</a>
			<div id="div_procura" class="container">
				<div id="container_uf">
					<select name="select_uf" id="select_uf">
						<option value="0">Todo o Brasil</option>
						<? montaSelect($sqlGetEstados, "nome", "uf", ""); ?>
					</select>
				</div>
				
				<select name="select_tipo" id="select_tipo">
					<option value="">Todos os tipos de licença</option>
					<option value="definitiva">Licença definitiva</option>
					<option value="provisoria">Licença provisória</option>
					<option value="sem">Outorgada, sem licença</option>
				</select>
				
				<br /><br />
								
				<a id="abre_endereco" href="javascript:void(0)">Pr&oacute;ximos a um endere&ccedil;o</a>
				<fieldset id="fset_endereco">
					<legend>Pr&oacute;ximos a um endere&ccedil;o</legend>
					<input id="txt_endereco" name="endereco" type="text" value="endere&ccedil;o" />
					<div id="div_numradios">
						Listar as
						<select name="num_proximos" id="select_numradios">
							<option value="5">5</option>
							<option value="10" selected="selected">10</option>
							<option value="50">50</option>
							<option value="100">100</option>
						</select>
						r&aacute;dios mais pr&oacute;ximas
					</div>
				</fieldset>
	
				<a id="abre_pchaves" href="javascript:void(0)">Por palavra-chave</a>
				<fieldset id="fset_pchaves">
					<legend>Palavras chave</legend>
					<input id="txt_palavraschave" name="palavras_chave" type="text" value="palavras chave" />
				</fieldset>

				<div id="container_busca">
					<input id="btn_busca" name="pesquisar" type="button" value="pesquisar" />
				</div>
				
				<p id="p_validacao"></p>
			</div>
			<a href="javascript:void(0)" title="Resultados" id="a_resultados" class="titulo">Resultados</a>
			<div id="div_resultados" class="container"></div>
			<a href="javascript:void(0)" title="Op&ccedil;&otilde;es" id="a_opcoes" class="titulo">Voc&ecirc; pode...</a>
			<div id="div_opcoes" class="container">
				<ul id="ul_opcoes">
					<li><a href="includes/Imprime.php" target="_blank" class="impressora">Imprimir lista</a></li>
					<li><a href="includes/DownloadCsv.php" class="tabela">Exportar planilha CSV</a></li>
					<li><a href="includes/DownloadKml.php" class="mundo">Exportar para Google Earth</a></li>
				</ul>
			</div>
		</div>
		</td>
	</tr>
	</table>
	<div id="rodape"><a href="http://www.article19.org/work/regions/latin-america/portuguese.html" target="_blank">Artigo 19 - Defendendo a liberdade de expressão e informação</a></div>

</body>
</html>
