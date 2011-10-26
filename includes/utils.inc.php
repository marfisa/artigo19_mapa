<?
require_once('funcoes.inc.php');

if (!file_exists(dirname(__FILE__) . '/config.php')) {
	die('Você precisa criar o arquivo de configuração includes/config.php.');
}

require_once('config.php');

session_start();

define('SITE_TITLE', 'Mapa das r&aacute;dios comunit&aacute;rias');

/* ----------------- VERIFICACOES----------------*/

	$MesAno[1] = "janeiro";
	$MesAno[2] = "fevereiro";
	$MesAno[3] = "mar&ccedil;o";
	$MesAno[4] = "abril";
	$MesAno[5] = "maio";
	$MesAno[6] = "junho";
	$MesAno[7] = "julho";
	$MesAno[8] = "agosto";
	$MesAno[9] = "setembro";
	$MesAno[10] = "outubro";
	$MesAno[11] = "novembro";
	$MesAno[12] = "dezembro";

/* ----------------- FUNCOES --------------------*/

/* funcao erro */
function erro($szTitulo,$szTexto = NULL)
{
	echo("\r\n");
	echo("<style type=\"text/css\">\r\n");
	echo("<!--\r\n");
	echo("\r\n");
	echo("table#erroContainer {border:1px solid #909090; width:340px;}\r\n");
	echo("table#erroContainer * {font-family: Arial, sans-serif; margin:0; font-size:10pt; color:#383838;}\r\n");
	echo("td#barraSuperior {height:6px; background-color:#C00;}\r\n");
	echo("tr#Titulo td {vertical-align:center; padding:10px 6px; font-weight:bold; font-size:12pt;}\r\n");
	echo("tr#Titulo td#Erro {color:#C00;}\r\n");
	echo("tr#Titulo td#Destaque {color:#4A4A4A; text-align:right; letter-spacing:-1px;}\r\n");
	echo("td#Texto {border-top:1px solid #909090;}\r\n");
	echo("td#Texto p, td#Texto li {margin:10px 6px;}\r\n");
	echo("td#Texto ul {margin:6px 6px 6px 30px;}\r\n");
	echo("td#Texto div.codigo {font-family:Courier new; margin:5px 10px 15px;}\r\n");
	echo("td#Rodape {font-size:8pt; border-top:1px solid #909090; font-style:italic;}\r\n");
	echo("\r\n");
	echo("-->\r\n");
	echo("</style>\r\n");
	echo("\r\n");
	echo("<table id=\"erroContainer\">");
	echo("<tr><td colspan=\"2\" id=\"barraSuperior\"></td></tr>\r\n");
	echo("<tr id=\"Titulo\"><td id=\"Erro\">ERRO!</td><td id=\"Destaque\">" . $szTitulo . "</td></tr>\r\n");

	if ($szTexto)
		echo("<tr><td colspan=\"2\" id=\"Texto\">" . $szTexto . "</td></tr>\r\n");

	echo("<tr><td id=\"Rodape\" colspan=\"2\">Se o erro persistir, entre em contato com o programador.</td></tr>\r\n");
	echo("</table>\r\n");
	echo("\r\n");

	exit();
}

/* funcao query */
function query ($_szSql, $_bGetInserID = 0)
{
	global $UTIL;

	// Conecta no banco de dados
	if ($con = @mysql_connect($UTIL['DBASE_HOST'], $UTIL['DBASE_USER'], $UTIL['DBASE_PASS']))
	{
		@mysql_select_db($UTIL['DBASE_BASE']); // Seleciona o bd

		$sqlQuery = mysql_query($_szSql);

		if (mysql_errno() != 0)
		{
			$szErroTitulo = "N&atilde;o foi poss&iacute;vel consultar o banco de dados.";
			$szErroTexto = "<p>Mensagem de erro:</p><div class=\"codigo\">" . mysql_error() . "</div>";

			if ($UTIL['DEBUG'])
			{
				$szErroTexto .= "<p>Outras informa&ccedil;&otilde;es:</p>";
				$szErroTexto .= "<div class=\"codigo\">HOST: " . $UTIL['DBASE_HOST'] . "<br>";
				$szErroTexto .= "USER: " . $UTIL['DBASE_USER'] . "<br>";
				$szErroTexto .= "BASE: " . $UTIL['DBASE_BASE'] . "<br><br>";
				$szErroTexto .= "Query:<br>" .  nl2br($_szSql) . "</div>";
			}

		   erro($szErroTitulo, $szErroTexto);
		}

		// Verifica se precisa do last id
		if ($_bGetInserID == 1)
			$ret = Array($sqlQuery,mysql_insert_id());
		else
			$ret = $sqlQuery;

		// Fecha a conexo
		mysql_close($con);

		return $ret;
	}
	else
	{
			$szErroTitulo = "N&atilde;o foi poss&iacute;vel se conectar ao banco de dados.";
			$szErroTexto = "<p>Mensagem de erro:</p><div class=\"codigo\">" . mysql_error() . "</div>";
			erro($szErroTitulo, $szErroTexto);
	}
}

/* funcao montaSelect */
function montaSelect($sMySQL, $sOptionName, $sOptionValue, $sValorSelected =  0, $iTabs = 0)
{
	$resMySQL = query($sMySQL);

	while ($myDados = mysql_fetch_array($resMySQL))
	{
		echo(str_repeat("	",$iTabs));
		echo('<option value="' . utf8_encode($myDados[$sOptionValue]) . '"');
		if ($myDados[$sOptionValue] == $sValorSelected) echo(" selected");
		echo('>' . utf8_encode($myDados[$sOptionName]) . '</option>' . "\r\n");
	}

}

/* funcao exibeErro */
function exibeErro($mErros, $sMsgErro, $iTabs = 0)
{
	if (count($mErros))
	{
			echo(str_repeat("	",$iTabs) . '<div class="status">' . "\r\n");
			echo(str_repeat("	",$iTabs+1) . '<div class="erro"></div>' . "\r\n");
			echo(str_repeat("	",$iTabs+1) . '<p class="titulo">' . $sMsgErro . '</p>' . "\r\n");
			echo(str_repeat("	",$iTabs+1) . '<ul>' . "\r\n");

			for ($i=0; $i<count($mErros); $i++)
				echo(str_repeat("	",$iTabs+2) . "<li>{$mErros[$i]}</li>\r\n");

			echo(str_repeat("	",$iTabs+1) . '</ul>' . "\r\n");
			echo(str_repeat("	",$iTabs+1) . '<p>Por favor, preencha corretamente o(s) campo(s) citado(s) acima e tente novamente.</p>' . "\r\n");

			echo(str_repeat("	",$iTabs) . '</div>' . "\r\n");
	}
}

/* funcao exibeMsgOK */
function exibeMsgOK($sMensagemTit, $sMensagemTxt = 0, $iTabs = 0)
{
	if ($sMensagemTit)
	{
		echo(str_repeat("	",$iTabs) . "<div class=\"status\">\r\n");
		echo(str_repeat("	",$iTabs+1) . "<div class=\"ok\"></div>");
		echo(str_repeat("	",$iTabs+1) . "<p class=\"titulo");
		if (!$sMensagemTxt) echo(" espaco");
		echo("\">{$sMensagemTit}</p>");
		echo(str_repeat("	",$iTabs+1) . "<p>{$sMensagemTxt}</p>");
		echo(str_repeat("	",$iTabs) . "</div>");
	}
}

/* formata a data fornecida pelo mysql para o formato brasileiro */
function BrazilianDate($date = "0000-00-00")
{
   list ($ano, $mes, $dia) = split ('[/.-]', $date);
   return ("$dia/$mes/$ano");
}

function SeparaCampos($strFrase, $charSeparador = ",")
{
	$matFrase = explode($charSeparador, $strFrase);

	for ($i=0; $i<count($matFrase); $i++)
		$matValores[$i] = trim($matFrase[$i]);

	if ($matValores[0] != "" || count($matValores) != 1)
		return $matValores;
	else
		return NULL;
}

?>
