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
			<h4 title="Metodologia">Metodologia</h4>
			<div>
				<h3>Metedologia usada no mapeamento</h3>
				<p>O Mapa das rádios comunitárias apresenta todos os serviços de radiodifusão comunitária, licenciados e não licenciados, autorizados pelo Ministério das Comunicações. De acordo com o Decreto nº 2.615 de 3 de junho de 1998, artigo 8º, "licença para funcionamento de estação é o documento que habilita a estação a funcionar em caráter definitivo, e que explicita a condição de não possuir a emissora direito à proteção contra interferências causadas por estações de telecomunicações e de radiodifusão regularmente instaladas".</p>
				<p>Os dados foram coletados no Sistema de Informação dos Serviços de Comunicação de Massa, da Agência Nacional de Telecomunicações - Anatel, disponível no site: <a href="http://sistemas.anatel.gov.br/siscom">http://sistemas.anatel.gov.br/siscom</a>. As estações foram buscadas no referido sistema estado por estado. O serviço pesquisado foi Radiodifusão Comunitária (231). </p>
				<p>A consulta inicial foi feita na tabela de entidades outorgadas em janeiro de 2008. A atualização do mapa acontecerá periodicamente, a cada (dois meses?). Possíveis diferenças nas informações são conseqüência da autorização de novas entidades a operar o serviço de radiodifusão comunitária conforme a conclusão de avisos de habilitação em andamento. Para mais informações ou colaboração escreva para <a href="mailto:radioscomunitarias@utopia.org.br">radioscomunitarias@utopia.org.br</a>.</p>
				<p>O Mapa das rádios comunitárias não faz referências se as estações autorizadas estão em funcionamento ou não. Tampouco há informações sobre rádios que estão em processo de habilitação ou não legalizadas.</p>
			</div>

			<h4 title="Sites relacionados">Sites relacionados</h4>
			<div>
				<h3>Legislação</h3>
				<p><a href="http://www6.senado.gov.br/legislacao/ListaTextoIntegral.action?id=126659">Lei nº 9.612, de 19 de fevereiro de 1998.</a><br>Institui o Serviço de Radiodifusão Comunitária e dá outras providências.</p>
				<p><a href="http://www6.senado.gov.br/legislacao/ListaTextoIntegral.action?id=127437">Decreto nº 2.615, de 03 de junho de 1998.</a><br>Aprova o Regulamento do Serviço de Radiodifusão Comunitária.</p>
				<p><a href="http://www.onu-brasil.org.br/documentos_direitoshumanos.php">Declaração Universal dos Direitos Humanos</a></p>
				<h3>Sites relacionados</h3>
				<p><a href="http://www.livreacesso.net">http://www.livreacesso.net</a></p>
				<p><a href="http://www.ipso.org.br">http://www.ipso.org.br</a></p>
				<p><a href="http://www.article19.org">http://www.article19.org</a></p>
				<p><a href="http://www.onid.org.br">http://www.onid.org.br</a></p>
				<p><a href="http://www.dataipso.utopia.org.br">http://www.dataipso.utopia.org.br</a></p>
				<p><a href="http://www.mapasdarede.utopia.org.br">http://www.mapasdarede.utopia.org.br</a></p>
				<p><a href="http://www.anatel.gov.br">http://www.anatel.gov.br</a></p>
				<p><a href="http://www.mc.gov.br">http://www.mc.gov.br</a></p>
			</div>

			<h4 title="Créditos">Créditos</h4>
			<div>
				<h3>Créditos</h3>
				<p>O Mapa das rádios comunitárias é uma iniciativa da Artigo 19 no Brasil em parceria com o Instituto de Pesquisas e Projetos Sociais e Tecnológicos - IPSO.</p>

				<h5>Artigo 19</h5>
				<p>Edição de conteúdo:</p>
				<ul>
					<li>Jamila Venturini (textos e XXX)</li>
					<li>Paula Martins</li>
					<li>Mila Molina</li>
				</ul>

				<h5>IPSO</h5>
				<p>Desenvolvimento e programação:</p>
				<ul>
					<li>Carlos Seabra (coordenação)</li>
					<li>Cauê Thenório (desenvolvimento e programação)</li>
					<li>Mariane Ottati (colaboração)</li>
					<li>Laura Tresca (textos e colaboração)</li>
					<li>Diana Pellegrini (colaboração)</li>
				</ul>

			</div>

			<h4 title="Fale conosco">Fale conosco</h4>
			<div>
				<h3>Fale conosco</h3>
				<p>Você pode entrar em contato conosco através do e-mail: <a href="mailto:radioscomunitarias@utopia.org.br">radioscomunitarias@utopia.org.br</a>.</p>
				<p>Qualquer dúvida, sugestão, reclamação ou elogio será muito bem recebido. Sua contribuição é importante para o andamento e aprimoramento do nosso trabalho.</p>
			</div>
			<h4 title="Totais">Totais</h4>
			<div>
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
			<h4 title="Artigo 19">Artigo 19</h4>
			<div>
				<h3>Sobre o Artigo 19</h3>
				<p>Colocar informações sobre o Article 19 aqui.</p>
			</div>
		</div>
	</div>
	<div id="cabecalho">
		<h1>Mapa das r&aacute;dios comunit&aacute;rias</h1>
		<div class="links"><a href="javascript:void(0)" id="a_maisinfo">Mais informa&ccedil;&otilde;es</a></div>
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
	<?
		montaSelect($sqlGetEstados, "nome", "uf", "");
	?>
					</select>
				</div>
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
