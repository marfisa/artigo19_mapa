/*

*//* Variáveis globais */
var projSelecionados = new Array;
var matRadios = new Array;
var lat = null, lon = null, end = null;
var slideEndereco, slidePchaves;
var painelMaximizado = 'procura';
var legendaFixa = false;

window.addEvent('domready', Inicia);

/******************************************/

function Inicia() {
	AjustaTamanho(); /* Ajusta o tamanho dos elementos */
	criaSlides(); /* Cria os slides */

	/* Prende os eventos */
	window.addEvent('resize',AjustaTamanho);
	$('select_uf').addEvent('change', CarregaEstados);
	$('btn_busca').addEvent('click',buscaTelecentros);
	$('togglebarra').addEvent('click', toggleBarra);
	$('a_procura').addEvent('click', function(e) {MaxPainel('procura');});
	$('a_resultados').addEvent('click', function(e) {MaxPainel('resultados');});
	$$('a#a_maisinfo, a#box_fechar').addEvent('click', toggleInformacoes);

	var endCompleter = new Autocompleter.Local($('txt_endereco'),{});
	var infoTabs = new SimpleTabs($('box_tabinfo'), {entrySelector: 'h4'});
	inciaGoogleMap();
}

/******************************************/

function toggleInformacoes(e) {
	if ($('container_info').getStyle('visibility') == 'hidden') {
		$('container_info')
			.effect('opacity', {duration: 1000, transition:Fx.Transitions.linear})
			.start(0,1);
			
		$('box_tabinfo').setStyle('display','block');

		AjustaTamanho();

		var fundoIframe = new Element('div', {'id':'fundo_iframe'})
			.setStyles({'width':window.getWidth(), 'height':window.getHeight()})
			.injectBefore($('cabecalho'))
			.addEvent('click', function(e) {toggleInformacoes(e);})
			.effect('opacity', {duration: 1000, transition:Fx.Transitions.linear})
			.start(0,0.6);
	} else {
		//$('box_tabinfo').setStyle('display','none');
		$('container_info').setStyle('visibility','hidden');
		$('fundo_iframe').remove();
	}
}

/******************************************/

function toggleBarra() {
	var tdBarra = $('td_barra');
	var tdBarraVisivel = tdBarra.getStyle('display') != 'none' ? 1 : 0;
	
	var mapCenter = map.getCenter();

	if (tdBarraVisivel) {
		tdBarra.setStyle('display','none');
		$('togglebarra')
			.removeClass('barraExpand')
			.addClass('barraContract');
	} else {
		tdBarra.setStyle('display','');
		$('togglebarra')
			.removeClass('barraContract')
			.addClass('barraExpand');
	}
		
	AjustaTamanho();
	map.panTo(mapCenter);
}

/******************************************/

function refreshToggleBarra() {
	if (!$('togglebarra')) {
		new Element('a', {'id':'togglebarra', 'href':'javascript:void(0)', 'class':'barraExpand'})
			.addEvent('click', toggleBarra)
			.injectAfter($('map'));
	}
			
	var gMapCoords = $('map').getCoordinates();
	$('togglebarra').setStyles(
		{
			'left':gMapCoords.right,
			'top':gMapCoords.top,
			'height':gMapCoords.height
		});
}

/******************************************/

function criaSlides() {
	var pchaves_texto = 'palavras chave';
	var endereco_texto = 'endereço';
	
	$('div_numradios').setStyle('display','none');

	/* Cria os slides */
	slideEndereco = new Fx.Slide('fset_endereco',
		{
			duration: 500,
			onComplete: function(e)
				{
					if ($('txt_endereco').getValue() == '') {
						$('abre_endereco').setStyle('display', '');
						$('txt_endereco').value = endereco_texto;
						$('div_numradios').setStyle('display','none');
					} else {
						$('txt_endereco').focus();
						$('fset_endereco').getParent().setStyle('height','');
					}
				}
			}
	).hide();

	slidePchaves = new Fx.Slide('fset_pchaves',
		{
			duration: 500,
			onComplete: function(e)
				{
					if ($('txt_palavraschave').getValue() == '') {
						$('abre_pchaves').setStyle('display', '');
						$('txt_palavraschave').value = pchaves_texto;
					} else {
						$('txt_palavraschave').focus();
					}
				}
		}
	).hide();
	
	$('abre_endereco').addEvent('click', function(e) {$('abre_endereco').setStyle('display', 'none'); slideEndereco.slideIn();});
	$('abre_pchaves').addEvent('click', function(e) {$('abre_pchaves').setStyle('display', 'none'); slidePchaves.slideIn();});

	$('txt_endereco').addEvent('focus', function(e) {
		if ($('txt_endereco').getValue() == endereco_texto) {
			$('txt_endereco').value = '';
		}
	});

	$('txt_endereco').addEvent('blur', function(e) {
		if ($('txt_endereco').getValue() == '') {
			slideEndereco.slideOut();
		}
	});

	$('txt_palavraschave').addEvent('focus', function(e) {
		if ($('txt_palavraschave').getValue() == pchaves_texto) {
			$('txt_palavraschave').value = '';
		}
	});

	$('txt_palavraschave').addEvent('blur', function(e) {
		if ($('txt_palavraschave').getValue() == '') {
			slidePchaves.slideOut();
		}
	});
}

/******************************************/

function AjustaTamanho() {
	var numWidthMap = $('td_barra').getStyle('display') != 'none' ? 282 : 22;
	var mapLoaded = (typeof(map) == 'object');

	if (mapLoaded) {
		var mapCenter = map.getCenter();
	}

	/* Redimensiona elementos para caber na tela */
	$('map').setStyle('height',window.getHeight()-99);
	$('map').setStyle('width',window.getWidth()-numWidthMap);

	var gMapCoords = $('map').getCoordinates();
	$('td_map').setStyle('width',gMapCoords.width+6);
	$('barra_lateral').setStyle('height',window.getHeight()-99);
	$('rodape').setStyle('width',window.getWidth()-16);
	
	if (mapLoaded) {
		map.checkResize();
		map.panTo(mapCenter);
	}

	/* Atualiza tamanho e posicao do link para expandir o mapa */
	refreshToggleBarra();
	
	/* Redimensiona as caixas da barra lateral */
	if (painelMaximizado == 'procura') {
		$('div_procura').setStyle('height',Math.round((window.getHeight()-242)));
		$('div_resultados').setStyle('height',0);
	} else {
		$('div_procura').setStyle('height',0);
		$('div_resultados').setStyle('height',Math.round((window.getHeight()-242)));
	}
	$('div_opcoes').setStyle('height',64);
	
	/* Redimensiona o box translucido sobre o Google Maps */
	if ($defined($('processando'))) {
		$('processando').setStyles(
			{
				'left':gMapCoords.left+1,
				'top':gMapCoords.top+1,
				'width':gMapCoords.width-2,
				'height':gMapCoords.height-2
			}
		);
	}

	/* Atualiza posicao do botao e caixa de legenda */
	atualizaLegendaPos();

	/* Atualiza a posicao da legenda dos estados */
	atualizaPosicaoLegenda();

	$('container_info')
		.setStyle('width', window.getWidth()-500)
		.setStyle('height', window.getHeight()-160);
	var infoCoords = $('container_info').getCoordinates();
	$('container_info')
		.setStyle('top', (window.getHeight()-infoCoords.height)/2)
		.setStyle('left', (window.getWidth()-infoCoords.width)/2);
	$$('.tab-container').setStyle('height', window.getHeight()-206);

	if ($defined($('fundo_iframe'))) {
		$('fundo_iframe').setStyles({'width':window.getWidth(), 'height':window.getHeight()});
	}
}

/******************************************/

function CarregaEstados(e) {
	if ($('select_municipio')) {
		selMunicipio = $('select_municipio')
		selMunicipio.parentNode.removeChild(selMunicipio);
	}

	if ($('select_uf').getValue() != "0") {
		var ajaxMunicipio = new Ajax('includes/AjaxUf.php?UF=' + $('select_uf').getValue(),
			{
				method: 'get',
				onComplete: function(jsonResult)
					{
						var MunicipiosObj = eval("(" + jsonResult + ")");

						selMunicipio = new Element('select',
							{
								'id':'select_municipio',
								'name':'select_municipio'
							}
						);

						optionMun = new Element('option', {'value':'0'})
							.setText('Todos os municípios')
							.injectInside(selMunicipio);
							
						for (i=0; i < MunicipiosObj.length; i++) {
							optionMun = new Element('option', {'value': MunicipiosObj[i].cod})
								.setText(MunicipiosObj[i].nome)
								.injectInside(selMunicipio);
						}
						selMunicipio.injectAfter($('select_uf'));
					}
			}
		).request();
	}
}

/******************************************/

function processandoToggle(funcao) {
	if ($defined($('processando'))) {
		var divProcessando = $('processando');
		divProcessando.effect('opacity',
			{
				duration:1000,
				transition:Fx.Transitions.linear,
				onComplete: function(e)
					{
						$('processando').remove();
						if ($type(funcao) == 'function') {
							funcao();
						}
					}
			}
		).start(0.75,0);
	} else {
		var gMap = $('map');
		var gMapCoords = gMap.getCoordinates();

		var divProcessando = new Element('div', {'id':'processando'})
			.setStyles(
				{
					'left':gMapCoords.left+1,
					'top':gMapCoords.top+1,
					'width':gMapCoords.width-2,
					'height':gMapCoords.height-2
				}
			)
			.setOpacity(0)
			.injectAfter($('map'));

		divProcessando.effect('opacity',
			{
				duration:1000,
				transition:Fx.Transitions.linear,
				onComplete: function(e)
					{
						if ($type(funcao) == 'function') {
							funcao();
						}
					}
			}).start(0,0.75);
	}
}

/******************************************/

function zera_legenda() {
	legenda['lic'] = 0;
	legenda['plic'] = 0;
	legenda['nlic'] = 0;
}

/******************************************/

function buscaTelecentros() {
	zera_legenda()
	
	var url = "includes/AjaxBusca.php?";

	if ($('select_uf').getValue() != 0) {
		url += "uf="+$('select_uf').getValue();
	}

	if ($('select_municipio')) {
		if ($('select_municipio').getValue() != 0) {
			url += "&cidade=" + $('select_municipio').getValue();
		}
	}

	if (lat != null && lon != null) {
		url += '&lat=' + lat + '&lon=' + lon + '&ntelec=' + $('select_numradios').getValue() + '&end=' + escape(end);
	}

	if ($('txt_palavraschave').getValue() != '' && $('txt_palavraschave').getValue() != 'palavras chave') {
		url += "&pchave=" + escape($('txt_palavraschave').getValue());
	}
		
	
	processandoToggle(function(e)
		{
			new Ajax(url,
				{
					method: 'get',
					onComplete: processaPontos
				}
			).request();
		});
}

/******************************************/

function processaPontos(jsonData) {
	var jsonData = eval("(" + jsonData + ")");
	var municipio = '';
	var dr = $('div_resultados');
	var ulTag, liTag;
	
	limpaMapa();

	dr.empty();

	if (jsonData.markers.length == 0) {
		$('a_resultados').setText('nenhum resultado');
	} else if (jsonData.markers.length == 1) {
		$('a_resultados').setText(jsonData.markers.length + ' resultado');
	} else {
		$('a_resultados').setText(jsonData.markers.length + ' resultados');
	}

	for (var i=0; i<jsonData.markers.length; i++) {
		if (jsonData.markers[i].mun != municipio) {
			if ($type(ulTag) == 'element') {
				ulTag.injectInside(dr);
			}

			municipio = jsonData.markers[i].mun
			new Element('p', {'class':'municipio'})
				.setText(municipio)
				.injectInside(dr);
				
			ulTag = new Element('ul', {'class':'resultados'});
		}
		
		liTag = new Element('li');
		
		if (jsonData.markers[i].ico == "lic") {
			liTag.addClass("licenciado");
		} else if (jsonData.markers[i].ico == "plic") {
			liTag.addClass("licencaprovisoria");
		} else {
			liTag.addClass("naolicenciado");
		}

		new Element('a', {'href':'javascript:abreBalao(' + jsonData.markers[i].id + ')'})
			.setText(jsonData.markers[i].nom)
			.injectInside(liTag);

		if (jsonData.markers[i].end != '') {
			new Element('p').setText(jsonData.markers[i].end).injectInside(liTag);
		}
		//if (jsonData.markers[i].tel != '') new Element('p', {'class':'tel'}).setText(jsonData.markers[i].tel).injectInside(liTag);
		//if (jsonData.markers[i].ema != '') new Element('p', {'class':'email'}).setText(jsonData.markers[i].ema).injectInside(liTag);

		liTag.injectInside(ulTag);
		criaPonto(jsonData.markers[i]);
	}
	
	criaLegenda();
	
	if (jsonData.markers.length) {
		ulTag.injectInside(dr);
		ajustaMapaPontos();
	} else {
		dr.setText('Sua busca não retornou resultados.');
	}

	/* Esconde a mensagem de carregamento */
	processandoToggle(function(e) {MaxPainel('resultados');});
}

/******************************************/

function MaxPainel(painel) {
	var divBuscaHeight = $('div_procura').getStyle('height');
	divBuscaHeight = parseInt(divBuscaHeight.substring(0,divBuscaHeight.length-2));

	var divResultsHeight = $('div_resultados').getStyle('height');
	divResultsHeight = parseInt(divResultsHeight.substring(0,divResultsHeight.length-2));

	//if (painel == 'procura')
	if (divBuscaHeight == 0) {
		var divBuscaHeightFinal = divResultsHeight + divBuscaHeight;
		var divResultsHeightFinal = 0;
		painelMaximizado = 'procura';
	} else {
		var divResultsHeightFinal = divResultsHeight + divBuscaHeight;
		var divBuscaHeightFinal = 0;
		painelMaximizado = 'resultados';
	}

	new Fx.Elements($$('#div_procura', '#div_resultados')).start({
		'0': {'height': [divBuscaHeight,divBuscaHeightFinal]},
		'1': {'height': [divResultsHeight,divResultsHeightFinal]}
	});
}

/******************************************/

function defineEndOrigem(objEnd) {
	$('txt_endereco').value = objEnd.address;
	$('txt_endereco').setStyle('display','none');

	var divEndereco = new Element('div', {'id':'end_definido'})
		.addEvent('click', function(e)
			{
				divEndereco.remove();
				$('txt_endereco').value = objEnd.address;
				$('txt_endereco').setStyle('display','');
				$('txt_endereco').focus();
				$('txt_endereco').select();
				map.removeOverlay(markCasa)
				markCasa = lat = lon = end = null;
			}
		);
		
	new Element('a', {'id':'remEndOrigem', 'href':'javascript:void(0)'})
		.addEvent('click', function(e)
			{
				divEndereco.remove();
				$('txt_endereco').value = '';
				$('txt_endereco').setStyle('display','');
				slideEndereco.slideOut();
				map.removeOverlay(markCasa)
				markCasa = lat = lon = end = null;
			}
		)
		.injectInside(divEndereco);
		
	divEndereco
		.appendText(objEnd.address)
		.injectAfter($('txt_endereco'));
		
	lat = objEnd.Point.coordinates[1];
	lon = objEnd.Point.coordinates[0];
	end = objEnd.address;
	
	$('div_numradios').setStyle('display','');
	criaPontoCasa();
}

/******************************************/
function atualizaLegendaPos() {
	if ($('aLegenda') && $('ulLegenda')) {
		var gMapCoords = $('map').getCoordinates();
		
		$('ulLegenda').setStyle('display','');
		var ulLeCoords = $('ulLegenda').getCoordinates();
		if (!legendaFixa) {
			$('ulLegenda').setStyle('display','none');
		}
		
		var aLegCoords = $('aLegenda').getCoordinates();
		
		$('aLegenda').setStyles(
			{
				'left':gMapCoords.right - aLegCoords.width - 8,
				'top':gMapCoords.top + 34
			}
		);
						
		$('ulLegenda').setStyles(
			{
				'left':gMapCoords.right - ulLeCoords.width - 8,
				'top':gMapCoords.top + aLegCoords.height + 34
			}
		);
	}
}

/******************************************/

