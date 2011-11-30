/* Variáveis globais */
var bounds = new GLatLngBounds();
var map;
var matPontos = new Array();
var markCasa;
var boolProcuraRealizada = false;
var legenda = new Array();

var icoLicenciado = new GIcon();
var icoLicencaProvisoria = new GIcon();
var icoNaoLicenciado = new GIcon();

icoLicenciado.image = "imagens/icone-marcador-licenciado.png";
icoLicencaProvisoria.image = "imagens/icone-marcador-licencaprovisoria.png";
icoNaoLicenciado.image = "imagens/icone-marcador-naolicenciado.png";

icoLicenciado.shadow = icoLicencaProvisoria.shadow = icoNaoLicenciado.shadow  =  "imagens/icone-sombra.png";
icoLicenciado.iconSize = icoLicencaProvisoria.iconSize = icoNaoLicenciado.iconSize  =  new GSize(12, 20);
icoLicenciado.shadowSize = icoLicencaProvisoria.shadowSize = icoNaoLicenciado.shadowSize  =  new GSize(22, 20);
icoLicenciado.iconAnchor = icoLicencaProvisoria.iconAnchor = icoNaoLicenciado.iconAnchor  =  new GPoint(6, 20);
icoLicenciado.infoWindowAnchor = icoLicencaProvisoria.infoWindowAnchor = icoNaoLicenciado.infoWindowAnchor = new GPoint(5, 1);


/******************************************/

function inciaGoogleMap() {
	if (GBrowserIsCompatible()) {
		map = new GMap2(document.getElementById("map"));
	  	map.setCenter(new GLatLng(-14.782928,-52.382812),4);
		map.addControl(new GLargeMapControl());
		map.addControl(new GMapTypeControl());
		map.addControl(new GOverviewMapControl());
		map.addControl(new GScaleControl());
	  	map.checkResize();
	  	
	  	criaShapesEstados(2);
	} else {
		alert('Infelizmente seu navegador não é compatível com o GoogleMaps.');
	}
}

/******************************************/

function criaPontoCasa() {
	if (lat != null && lon != null)	{
		var icoCasa = new GIcon();
		icoCasa.image = "imagens/icone-local.png";
		icoCasa.iconSize = new GSize(20, 20);
		icoCasa.iconAnchor = new GPoint(10, 10);
		icoCasa.infoWindowAnchor = new GPoint(8, 8);

		var MarkerOptions = new Object();

		MarkerOptions.icon = icoCasa;

		markCasa = new GMarker(new GLatLng(lat,lon), MarkerOptions);
		map.addOverlay(markCasa);
	}
}

/******************************************/

function criaPonto(ponto) {
	var MarkerOptions = new Object();
	MarkerOptions.title = ponto.nom;

	switch (ponto.ico) {
		case 'lic':
			MarkerOptions.icon = icoLicenciado;
			legenda['lic'] = legenda['lic'] + 1;
			break;
		case 'plic':
			MarkerOptions.icon = icoLicencaProvisoria;
			legenda['plic'] = legenda['plic'] + 1;
			break;
		case 'nlic':
			MarkerOptions.icon = icoNaoLicenciado;
			legenda['nlic'] = legenda['nlic'] + 1;
			break;
	}

	var marker = new GMarker(ponto.coo, MarkerOptions);
	bounds.extend(ponto.coo);

	GEvent.addListener(marker, "click", function(e) {abreBalao(ponto.id)});
	GEvent.addListener(marker, "mouseover", function(e) {});
	GEvent.addListener(marker, "mouseout", function(e) {});

	matPontos[ponto.id] = marker;
	matRadios[ponto.id] = ponto;
	map.addOverlay(marker);
}

/******************************************/

function ajustaMapaPontos() {
	map.setZoom(map.getBoundsZoomLevel(bounds));
	map.setCenter(bounds.getCenter());
}

/******************************************/

function limpaMapa() {
	boolProcuraRealizada = true;
	map.clearOverlays();
	criaPontoCasa();
	bounds = new GLatLngBounds();
	removeShapesEstados();
}

/******************************************/

function abreBalao(id) {
	map.panTo(matPontos[id].getLatLng());
	matPontos[id].openInfoWindowHtml(matRadios[id].nom);
    
	matPontos[id].openInfoWindowHtml('<div class="loading">Carregando detalhes...</div>');
	getDetalhesPonto(id);
}

/******************************************/

function getDetalhesPonto(id) {
	var url = 'includes/AjaxDetalhes.php?id=' + id
	new Ajax(url,
		{
			method: 'get',
			onComplete: exibeDetalhesPonto
		}
	).request();
}

/******************************************/

function exibeDetalhesPonto(jsonResult)
{
	jsonData = eval("(" + jsonResult + ")");

	/* Monta a aba principal com as informações sobre o ponto */
	var tabPontoHtml = '<div class="infowindow">';

	var licenca = '';
	if (jsonData.marker.lic == 'definitiva') {
		licenca = 'Rádio com licença definitiva';
	} else if (jsonData.marker.lic == 'provisoria') {
		licenca = 'Rádio com licença provisoria';
	} else {
		licenca = 'Rádio outorgada, sem licença';
	}

	tabPontoHtml += '<p class="cartola">' + licenca + '</p>';
	tabPontoHtml += '<h2>' + jsonData.marker.nom + '</h2>';

	tabPontoHtml += '<table width="60%">';
	tabPontoHtml += '<tr>';
	tabPontoHtml += '<th>Canal</th><th>Freqüência</th><th>Indicador</th>';
	tabPontoHtml += '</tr>';
	tabPontoHtml += '<tr class="c2">';
	tabPontoHtml += '<td style="text-align:center;">' + jsonData.marker.can + '</td>';
	tabPontoHtml += '<td style="text-align:center;">' + jsonData.marker.fre + '</td>';
	tabPontoHtml += '<td style="text-align:center;">' + jsonData.marker.ind + '</td>';
	tabPontoHtml += '</tr>';
	tabPontoHtml += '</table>';

	tabPontoHtml += '<p class="endereco">';
	if (jsonData.marker.end != "") {
		tabPontoHtml += jsonData.marker.end + '<br>';
	}
	tabPontoHtml += jsonData.marker.mun + ' - ' + jsonData.marker.est + '</p>';

	tabPontoHtml += '</div>';

	/* Monta a aba do dataIpso */

	if (typeof(jsonData.municipio) == 'object')	{
		var tabDataIPSOHtml = '<div class="infowindow">';
		tabDataIPSOHtml += '<p class="cartola">' + licenca + '</p><h2>' + jsonData.marker.nom + '</h2>';

		tabDataIPSOHtml += '<div class="dataipso">';

		tabDataIPSOHtml += '<table border="0" cellspacing="1" cellpadding="0" class="cabecalho">';
		tabDataIPSOHtml += '<tr><th class="indice">&Iacute;ndice</td><th class="valor">' + jsonData.municipio.nome +  '</td><th class="valor">' + jsonData.estado.nome + '</td><th class="valor">Brasil</td></tr>';
		tabDataIPSOHtml += '</table>';

		tabDataIPSOHtml += '<div class="overflow">';
		tabDataIPSOHtml += '<table border="0" cellspacing="1" cellpadding="0" class="conteudo">';
		tabDataIPSOHtml += '<tr><td class="indice">IDH</td><td class="valor">' + jsonData.municipio.idhm + '</td><td class="valor">' + jsonData.estado.idhm + '</td><td class="valor">' + jsonData.pais.idhm + '</td></tr>';
		tabDataIPSOHtml += '<tr class="c2"><td>Popula&ccedil;&atilde;o</td><td class="valor">' + jsonData.municipio.populacao + '</td><td class="valor">' + jsonData.estado.populacao + '</td><td class="valor">' + jsonData.pais.populacao + '</td></tr>';
		tabDataIPSOHtml += '<tr><td>Popula&ccedil;&atilde;o rural </td><td class="valor">' + jsonData.municipio.populacao_rural + '</td><td class="valor">' + jsonData.estado.populacao_rural + '</td><td class="valor">' + jsonData.pais.populacao_rural + '</td></tr>';
		tabDataIPSOHtml += '<tr class="c2"><td>Popula&ccedil;&atilde;o urbana </td><td class="valor">' + jsonData.municipio.populacao_urbana + '</td><td class="valor">' + jsonData.estado.populacao_urbana + '</td><td class="valor">' + jsonData.pais.populacao_urbana + '</td></tr>';
		tabDataIPSOHtml += '<tr><td>&Aacute;rea</td><td class="valor">' + jsonData.municipio.area + '</td><td class="valor">' + jsonData.estado.area + '</td><td class="valor">' + jsonData.pais.area + '</td></tr>';
		tabDataIPSOHtml += '<tr class="c2"><td>Densidade demogr&aacute;fica </td><td class="valor">' + jsonData.municipio.densidade_demografica + '</td><td class="valor">' + jsonData.estado.densidade_demografica + '</td><td class="valor">' + jsonData.pais.densidade_demografica + '</td></tr>';
		tabDataIPSOHtml += '<tr><td>Taxa de alfabetiza&ccedil;&atilde;o </td><td class="valor">' + jsonData.municipio.alfabetizacao + '</td><td class="valor">' + jsonData.estado.alfabetizacao + '</td><td class="valor">' + jsonData.pais.alfabetizacao + '</td></tr>';
		tabDataIPSOHtml += '<tr class="c2"><td>Renda per capita </td><td class="valor">' + jsonData.municipio.renda_per_capita + '</td><td class="valor">' + jsonData.estado.renda_per_capita + '</td><td class="valor">' + jsonData.pais.renda_per_capita + '</td></tr>';
		tabDataIPSOHtml += '<tr><td>Esperan&ccedil;a de vida</td><td class="valor">' + jsonData.municipio.esperanca_de_vida + '</td><td class="valor">' + jsonData.estado.esperanca_de_vida + '</td><td class="valor">' + jsonData.pais.esperanca_de_vida + '</td></tr>';
		tabDataIPSOHtml += '</table>';
		tabDataIPSOHtml += '</div>';
		tabDataIPSOHtml += '</div>';
		tabDataIPSOHtml += '</div>';
	}

	if (typeof(jsonData.municipio) == 'object') {
		var infoTabs =
		[
				new GInfoWindowTab("Rádio", tabPontoHtml),
				new GInfoWindowTab("Índices", tabDataIPSOHtml)
		];
	} else {
		var infoTabs =
		[
				new GInfoWindowTab("Rádio", tabPontoHtml),
		];
	}
	
	matPontos[jsonData.marker.id].openInfoWindowTabsHtml(infoTabs);
}

/******************************************/

function criaLegenda() {
	var html = '';
	html += '<div class="titulo">Legenda dos marcadores</div><ul>';
	
	if (legenda['lic'] > 0) {
		html += '<li class="licenciado bg">Rádios com licença definitiva ('+legenda['lic']+')</li>';
	}
	
	if (legenda['plic'] > 0) {
		html += '<li class="licencaprovisoria bg">Rádios com licença provisória ('+legenda['plic']+')</li>';
	}
	
	if (legenda['nlic'] > 0) {
		html += '<li class="naolicenciado bg">Rádios outorgadas, sem licença ('+legenda['nlic']+')</li>';
	}
 
	var idLegenda = new Element('div', {'id':'legendaMapa'})
		.setHTML(html)
		.injectAfter($('map'));

	atualizaPosicaoLegenda();
}

/******************************************/
