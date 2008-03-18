<?php
  require_once('utils.inc.php');
  set_time_limit(180);

  function limpaString($string)
  {
    if (substr($string, -2) == ', ')
      $string = substr($string, 0 , -2);
    elseif (substr($string, -1) == ',' || substr($string, -1) == ' ')
      $string = substr($string, 0 , -1);

  	return str_replace(array("\r\n","\n"),array(" "," "),htmlspecialchars($string, ENT_NOQUOTES));
  }

  $sqlBusca  = "SELECT ";

  if ($_GET['lat'] && $_GET['lon'] && $_GET['ntelec'])
  {
    $lat = $_GET['lat'];
    $long = $_GET['lon'];
    $ntelec = $_GET['ntelec'];
    $sqlBusca .= "SQRT((({$lat}-t.`LATITUDE`)*({$lat}-t.`LATITUDE`))+(({$long}-t.`LONGITUDE`)*({$long}-t.`LONGITUDE`))) as DISTANCIA,";
  }

  $sqlBusca .= "t.* FROM `telecentros` t ";
  $sqlBusca .= "INNER JOIN `ipso_municipio` m ON t.COD_MUNICIPIO = m.codigo ";
  $sqlBusca .= "INNER JOIN `ipso_uf` u ON m.id_uf = u.id_uf ";
  $sqlBusca .= "WHERE ";

  if ($_GET['projetos'])
  {
    $projetos = explode("|",$_GET['projetos']);
    
    $strProjetos = "";

    $sqlBusca .= "(";
    for ($i=0; $i<count($projetos); $i++)
    {
      $sqlBusca .= "(";
      $sqlBusca .= "`PROJETO` = '{$projetos[$i]}' OR ";
      $sqlBusca .= "`PROJETO` LIKE '{$projetos[$i]},%' OR ";
      $sqlBusca .= "`PROJETO` LIKE '%,{$projetos[$i]},%' OR ";
      $sqlBusca .= "`PROJETO` LIKE '%,{$projetos[$i]}'";
      $sqlBusca .= ") OR ";
    }

    $sqlBusca = substr($sqlBusca, 0, -4);
    $sqlBusca .= ") AND ";
  }

  if ($_GET['cidade'])
  {
    $sqlBusca .= "(";
    $sqlBusca .= "m.codigo = {$_GET['cidade']}";
    $sqlBusca .= ") AND ";
  }
  elseif ($_GET['uf'])
  {
    $sqlBusca .= "(";
    $sqlBusca .= "u.uf = '{$_GET['uf']}'";
    $sqlBusca .= ") AND ";
  }

  if ($_GET['pchave'])
  {
    $palavraschave = explode(" ",$_GET['pchave']);
    $camposSearch = array('TELECENTRO', 'ENTIDADE', 'BAIRRO', 'ENDERECO', 'TELEFONE', 'TELEFONE2', 'TELEFONE3', 'EMAIL', 'EMAIL2', 'EMAIL3');

    $sqlBusca .= "(";
    for ($i=0; $i<count($palavraschave); $i++)
    {
      $sqlBusca .= "(";
      for ($j=0; $j<count($camposSearch); $j++)
      {
        $sqlBusca .= "(`{$camposSearch[$j]}` LIKE '%" . utf8_encode($palavraschave[$i]) . "%') OR ";
      }
      $sqlBusca = substr($sqlBusca, 0, -4);
      $sqlBusca .= ") AND ";
    }
    $sqlBusca = substr($sqlBusca, 0, -5);
    $sqlBusca .= ") AND ";
  }
  $sqlBusca .="`VISIVEL` = 1 ORDER BY ";

  if ($_GET['lat'] && $_GET['lon'])
    $sqlBusca .= "DISTANCIA, ";

  $sqlBusca .="m.nome, t.TELECENTRO ";

  if ($_GET['lat'] && $_GET['lon'])
    $sqlBusca .= "LIMIT 0, $ntelec";
    
  $resTelecentros = query($sqlBusca);

  header("Content-Type: application/vnd.google-earth.kml+xml; charset=UTF-8;");
  header("Content-Disposition: attachment; filename=\"Telecentros.kml\";");

  $kmlBody  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?" . ">\r\n";
  $kmlBody .= "<kml xmlns=\"http://earth.google.com/kml/2.2\">\r\n";
  $kmlBody .= "\t<Document>\r\n";

  while ($telec = mysql_fetch_array($resTelecentros))
  {
  	$kmlBody .= "\t\t<Placemark>\r\n";
  	$kmlBody .= "\t\t\t<name>" . limpaString($telec['TELECENTRO']) . "</name>\r\n";
  	$kmlBody .= "\t\t\t<description>\r\n\t\t\t<![CDATA[\r\n";
  	
  	if ($telec['ENTIDADE'])
  	 $kmlBody .= "\t\t\t\t<b>Entidade:</b> " . limpaString($telec['ENTIDADE']) . "<br /><br />\r\n\r\n";

  	$kmlBody .= "\t\t\t\t<b>Endere&ccedil;o:</b><br />\r\n";

  	if ($telec['ENDERECO'])
  		$kmlBody .= "\t\t\t\t" . limpaString(str_replace("\n","<br />\r\n",$telec['ENDERECO']));

  	if ($telec['BAIRRO'])
  			$kmlBody .= ", " . $telec['BAIRRO'] . "<br />\r\n";

  	$kmlBody .= limpaString($telec['MUNICIPIO']) . " - " . limpaString($telec['ESTADO']) . "<br />\r\n";

  	if ($telec['CEP'])
  			$kmlBody .= "\t\t\t\tCEP: " . $telec['CEP'] . "<br />";

  	$kmlBody .= "<br />\r\n\r\n";

  	if ($telec['TELEFONE'])
  		$kmlBody .= "\t\t\t\t<b>Telefone:</b> " . limpaString($telec['TELEFONE']) . "<br>\r\n";
  	if ($telec['EMAIL'])
  		$kmlBody .= "\t\t\t\t<b>Email:</b> " . limpaString($telec['EMAIL']) . "<br /><br />\r\n\r\n";
  	if ($telec['url'])
  		$kmlBody .= "\t\t\t\t<b>Site:</b> " . limpaString($telec['url']) . "<br>\r\n";

    $projTelecentro = explode(",",$telec['PROJETO']);
    $strProjetos = "";
    
    for ($i=0; $i<count($projTelecentro); $i++)
    {
      $myProjeto = mysql_fetch_array(query(sprintf($sqlGetProjetoById,$projTelecentro[$i])));
      $strProjetos .= $myProjeto['NOME'] . ", ";
    }
    $strProjetos = substr($strProjetos, 0 , -2);

    $kmlBody .= "\t\t\t\t<b>Projeto";

    if ($i > 1) $kmlBody .= "s";

    $kmlBody .= ":</b> " . limpaString($strProjetos) . "<br>\r\n";

  	$kmlBody .= "\t\t\t]]>\r\n\t\t\t</description>\r\n";
  	$kmlBody .= "\t\t\t<Point>\r\n\t\t\t\t<coordinates>" . limpaString($telec['LONGITUDE'] ) . "," . limpaString($telec['LATITUDE']) . "</coordinates>\r\n\t\t\t</Point>\r\n";
  	$kmlBody .= "\t\t</Placemark>\r\n";
  }

  $kmlBody .= "\t</Document>\r\n";
  $kmlBody .= "</kml>";

  echo($kmlBody);
?>
