<?php

require_once('utils.inc.php');
header("Content-Type: text/plain; charset=UTF-8");

$sqlGetRadioById = "
	SELECT
	    r.*, im.nome as municipio, iu.uf
    FROM
    	radios_comunitarias r
    INNER JOIN ipso_municipio im ON r.cod_municipio = im.codigo
    INNER JOIN ipso_uf iu ON im.id_uf = iu.id_uf
    WHERE
    	r.ID = %d;";

$sqlGM_GetIndicadoresByMunicipio =
	"SELECT
		'municipio' as tipo,
		i.id_uf as uf,
		i.codigo as codigo_municipio,
		i.nome,
		i.populacao,
		i.Populacao_urbana as populacao_urbana,
		i.Populacao_rural as populacao_rural,
		truncate(i.area,0) as area,
		truncate(i.idhm+.0005,3) as idhm,
		truncate(i.esperanca_de_vida+.005,2) as esperanca_de_vida,
		truncate(i.alfabetizacao+.005,2) as alfabetizacao,
		truncate(i.renda_per_capita+.005,2) as renda_per_capita,
		truncate(i.Densidade_demografica+.005,2) as densidade_demografica
	FROM
		ipso_municipio i
	WHERE
		codigo = %d;";

$sqlGM_GetIndicadoresByEstado =
	"SELECT
		'uf' as tipo,
		i.id_uf as uf,
		iu.uf as sigla_estado,
		iu.nome as nome,
		SUM(i.populacao) as populacao,
		SUM(i.Populacao_urbana) as populacao_urbana,
		SUM(i.Populacao_rural) as populacao_rural,
		truncate(SUM(i.area),0) as area,
		truncate(sum(i.idhm*populacao)/sum(populacao)+.0005,3) as idhm,
		truncate(sum(i.esperanca_de_vida*populacao)/sum(populacao)+.005,2) as esperanca_de_vida,
		truncate(sum(i.alfabetizacao*populacao)/sum(populacao)+.005,2) as alfabetizacao,
		truncate(sum(i.renda_per_capita*populacao)/sum(populacao)+.005,2) as renda_per_capita,
		truncate(sum(populacao)/sum(area)+.005,2) as densidade_demografica
	FROM
		ipso_municipio i INNER JOIN ipso_uf iu ON i.id_uf = iu.id_uf
	WHERE
		i.id_uf = %d
	GROUP BY i.id_uf;";

$sqlGM_GetIndicadoresBrasil =
	"SELECT
		'pais' as tipo,
		NULL as uf,
		NULL as codigo_municipio,
		'Brasil' as nome,
		SUM(i.populacao) as populacao,
		SUM(i.Populacao_urbana) as populacao_urbana,
		SUM(i.Populacao_rural) as populacao_rural,
		truncate(SUM(i.area),0) as area,
		truncate(sum(i.idhm*populacao)/sum(populacao)+.0005,3) as idhm,
		truncate(sum(i.esperanca_de_vida*populacao)/sum(populacao)+.005,2) as esperanca_de_vida,
		truncate(sum(i.alfabetizacao*populacao)/sum(populacao)+.005,2) as alfabetizacao,
		truncate(sum(i.renda_per_capita*populacao)/sum(populacao)+.005,2) as renda_per_capita,
		truncate(sum(populacao)/sum(area)+.005,2) as densidade_demografica
	FROM
		ipso_municipio i
	GROUP BY tipo;";

$resPonto = query(sprintf($sqlGetRadioById,$_GET['id']));
  
/* Gravar registro  */

$logIP = $_SERVER['HTTP_X_FORWARDED_FOR'] ?  '"' . $_SERVER['HTTP_X_FORWARDED_FOR'] . '"' : '"' . $_SERVER['REMOTE_ADDR'] . '"';

$sqlLog  = "INSERT INTO `log_utilizacao` VALUES(NULL, NOW()";
$sqlLog .= ", $logIP";
$sqlLog .= ', "' . $_SERVER['HTTP_USER_AGENT'] . '"';
$sqlLog .= ", {$_GET['id']}";
$sqlLog .= ', NULL,NULL,NULL,NULL,NULL,NULL,NULL)';

query($sqlLog);

$jsonOutput  = "{\r\n\t\"marker\":\r\n";
$jsonOutput .= "\t{\r\n";

if($myPonto = @mysql_fetch_array($resPonto)) {
	$email = explode(" ",limpaString($myPonto['EMAIL']));
	if (strpos($email[0],",")) {
		$email[0] = substr($email[0],0,-1);
	}

	$jsonOutput .= "\t\t\"id\": {$myPonto['ID']},\r\n";

  	$jsonOutput .= "\t\t\t\"nom\": \"" . limpaString($myPonto['razao_social']) . "\",\r\n";
  	$jsonOutput .= "\t\t\t\"mun\": \"" . limpaString($myPonto['municipio']) . "\",\r\n";
  	$jsonOutput .= "\t\t\t\"est\": \"" . limpaString($myPonto['uf']) . "\",\r\n";
  	$jsonOutput .= "\t\t\t\"end\": \"" . limpaString($myPonto['endereco']) . "\",\r\n";
    $jsonOutput .= "\t\t\t\"lic\": \"" . limpaString($myPonto['licenciado']) . "\",\r\n";
    $jsonOutput .= "\t\t\t\"can\": " . limpaString($myPonto['canal']) . ",\r\n";
    $jsonOutput .= "\t\t\t\"fre\": " . limpaString($myPonto['frequencia']) . ",\r\n";
    $jsonOutput .= "\t\t\t\"ind\": \"" . limpaString($myPonto['indicador']) . "\",\r\n";

	$resIndicesMunicipio = query(sprintf($sqlGM_GetIndicadoresByMunicipio,$myPonto['cod_municipio']));
	if ($myMunicipio = @mysql_fetch_array($resIndicesMunicipio)) {
		$jsonOutput .= "\t},\r\n";
		$jsonOutput .= "\t\"municipio\":\r\n";
		$jsonOutput .= "\t{\r\n";

		$jsonOutput .= "\t\t\"nome\": \"" . limpaString($myMunicipio['nome']) . "\",\r\n";
		$jsonOutput .= "\t\t\"codigo\": \"" . limpaString($myMunicipio['codigo_municipio']) . "\",\r\n";
		$jsonOutput .= "\t\t\"populacao\": \"" . limpaString(number_format($myMunicipio['populacao'], 0, ",",".")) . "\",\r\n";
		$jsonOutput .= "\t\t\"populacao_urbana\": \"" . limpaString(number_format($myMunicipio['populacao_urbana'], 0, ",",".")) . "\",\r\n";
		$jsonOutput .= "\t\t\"populacao_rural\": \"" . limpaString(number_format($myMunicipio['populacao_rural'], 0, ",",".")) . "\",\r\n";
		$jsonOutput .= "\t\t\"area\": \"" . limpaString(number_format($myMunicipio['area'], 0, ",",".")) . " km&sup2;\",\r\n";
		$jsonOutput .= "\t\t\"idhm\": \"" . limpaString(number_format($myMunicipio['idhm'], 3, ",",".")) . "\",\r\n";
		$jsonOutput .= "\t\t\"esperanca_de_vida\": \"" . limpaString(number_format($myMunicipio['esperanca_de_vida'], 2, ",",".")) . " %\",\r\n";
		$jsonOutput .= "\t\t\"alfabetizacao\": \"" . limpaString(number_format($myMunicipio['alfabetizacao'], 2, ",",".")) . " %\",\r\n";
		$jsonOutput .= "\t\t\"renda_per_capita\": \"R\$ " . limpaString(number_format($myMunicipio['renda_per_capita'], 2, ",",".")) . "\",\r\n";
		$jsonOutput .= "\t\t\"densidade_demografica\": \"" . limpaString(number_format($myMunicipio['densidade_demografica'], 2, ",",".")) . "\"\r\n";
	}

	$resIndicesEstado = query(sprintf($sqlGM_GetIndicadoresByEstado,$myMunicipio['uf']));
	if ($myEstado = @mysql_fetch_array($resIndicesEstado)) {
		$jsonOutput .= "\t},\r\n";
		$jsonOutput .= "\t\"estado\":\r\n";
		$jsonOutput .= "\t{\r\n";

		$jsonOutput .= "\t\t\"nome\": \"" . limpaString($myEstado['nome']) . "\",\r\n";
		$jsonOutput .= "\t\t\"codigo\": \"" . limpaString($myEstado['uf']) . "\",\r\n";
		$jsonOutput .= "\t\t\"populacao\": \"" . limpaString(number_format($myEstado['populacao'], 0, ",",".")) . "\",\r\n";
		$jsonOutput .= "\t\t\"populacao_urbana\": \"" . limpaString(number_format($myEstado['populacao_urbana'], 0, ",",".")) . "\",\r\n";
		$jsonOutput .= "\t\t\"populacao_rural\": \"" . limpaString(number_format($myEstado['populacao_rural'], 0, ",",".")) . "\",\r\n";
		$jsonOutput .= "\t\t\"area\": \"" . limpaString(number_format($myEstado['area'], 0, ",",".")) . " km&sup2;\",\r\n";
		$jsonOutput .= "\t\t\"idhm\": \"" . limpaString(number_format($myEstado['idhm'], 3, ",",".")) . "\",\r\n";
		$jsonOutput .= "\t\t\"esperanca_de_vida\": \"" . limpaString(number_format($myEstado['esperanca_de_vida'], 2, ",",".")) . " %\",\r\n";
		$jsonOutput .= "\t\t\"alfabetizacao\": \"" . limpaString(number_format($myEstado['alfabetizacao'], 2, ",",".")) . " %\",\r\n";
		$jsonOutput .= "\t\t\"renda_per_capita\": \"R\$ " . limpaString(number_format($myEstado['renda_per_capita'], 2, ",",".")) . "\",\r\n";
		$jsonOutput .= "\t\t\"densidade_demografica\": \"" . limpaString(number_format($myEstado['densidade_demografica'], 2, ",",".")) . "\"\r\n";
	}

	$resIndicesPais = query($sqlGM_GetIndicadoresBrasil);
	if ($myPais = @mysql_fetch_array($resIndicesPais)) {
		$jsonOutput .= "\t},\r\n";
		$jsonOutput .= "\t\"pais\":\r\n";
		$jsonOutput .= "\t{\r\n";

		$jsonOutput .= "\t\t\"nome\": \"" . limpaString($myPais['nome']) . "\",\r\n";
		//$jsonOutput .= "\t\t\"codigo\": \"" . limpaString($myPais['codigo']) . "\",\r\n";
		$jsonOutput .= "\t\t\"populacao\": \"" . limpaString(number_format($myPais['populacao'], 0, ",",".")) . "\",\r\n";
		$jsonOutput .= "\t\t\"populacao_urbana\": \"" . limpaString(number_format($myPais['populacao_urbana'], 0, ",",".")) . "\",\r\n";
		$jsonOutput .= "\t\t\"populacao_rural\": \"" . limpaString(number_format($myPais['populacao_rural'], 0, ",",".")) . "\",\r\n";
		$jsonOutput .= "\t\t\"area\": \"" . limpaString(number_format($myPais['area'], 0, ",",".")) . " km&sup2;\",\r\n";
		$jsonOutput .= "\t\t\"idhm\": \"" . limpaString(number_format($myPais['idhm'], 3, ",",".")) . "\",\r\n";
		$jsonOutput .= "\t\t\"esperanca_de_vida\": \"" . limpaString(number_format($myPais['esperanca_de_vida'], 2, ",",".")) . " %\",\r\n";
		$jsonOutput .= "\t\t\"alfabetizacao\": \"" . limpaString(number_format($myPais['alfabetizacao'], 2, ",",".")) . " %\",\r\n";
		$jsonOutput .= "\t\t\"renda_per_capita\": \"R\$ " . limpaString(number_format($myPais['renda_per_capita'], 2, ",",".")) . "\",\r\n";
		$jsonOutput .= "\t\t\"densidade_demografica\": \"" . limpaString(number_format($myPais['densidade_demografica'], 2, ",",".")) . "\"\r\n";
	}
}

$jsonOutput .= "\t}\r\n";
$jsonOutput .= "}";

echo($jsonOutput);
  
function limpaString($string) {
	$string = htmlspecialchars($string, ENT_QUOTES);
	return utf8_encode(str_replace(array("\r\n","\n"),array(" "," "),$string));
}
