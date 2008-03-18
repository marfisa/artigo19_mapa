<?
	require_once('utils.inc.php');
	header("Content-Type: text/plain; charset=UTF-8");
	
  $resPopEstados = query($sqlGetPopulacaoEstados);
  $resTelEstados = query($sqlGetTelecentrosEstados);
  
  while($myPopEstado = mysql_fetch_array($resPopEstados))
    $myPopEstados[] = $myPopEstado;

  while($myTelEstado = mysql_fetch_array($resTelEstados))
    $myTelEstados[] = $myTelEstado;

  for ($i=0; $i<count($myPopEstados); $i++)
    $myRelEstados[] = ($myTelEstados[$i]['telecentros']/$myPopEstados[$i]['populacao']);
    
  $maxRel = max($myRelEstados);

	$jsonOutput  = "{\r\n";

  for ($i=0; $i<count($myPopEstados); $i++)
  {
    $jsonOutput .= "\t'{$myPopEstados[$i]['uf']}':\r\n";
    $jsonOutput .= "\t{\r\n";
    $jsonOutput .= "\t\t'pop': {$myPopEstados[$i]['populacao']},\r\n";
    $jsonOutput .= "\t\t'tel': {$myTelEstados[$i]['telecentros']},\r\n";
    $jsonOutput .= "\t\t'opa': " . (($myTelEstados[$i]['telecentros']/$myPopEstados[$i]['populacao'])/$maxRel) . "\r\n";
    $jsonOutput .= "\t},\r\n";
  }

  $jsonOutput = substr($jsonOutput, 0, -3);
  $jsonOutput .= "\r\n";

	$jsonOutput .= "}";

  echo($jsonOutput);
	
?>
