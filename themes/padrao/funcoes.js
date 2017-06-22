/**
*
*	@author Johnny
*   
*	@param {Object} dados 		- Objeto do formulário com os campos
*	@return {Promisse} $.ajax 	- Retorna uma promisse com o resultado do ajax
*
*	@description
*	Função criada para disparo de email em ajax
*/

const contato = ( dados ) => {
	let erros 	= false;
	let data 	= {};

	$('.obrigatorio').remove();
	
	$.each(dados, (key, value) => {	
		if($.trim(value.value).length == 0 || !value.validity.valid){
			$(value).after('<p class="obrigatorio">Campo '+ $(value).attr('name') +' obrigatório!</p>');
			erros = true;
		}
		data[$(value).attr('name')] = value.value;
	});
	
	if(erros){
		return false;
	}
	
	return $.ajax({
		url 	: contato_url,
		method 	: 'POST',
		data  	: data
	});
}


const setMarkers = ( locais, pontos, map ) => {
    let pins = [];
    let markerIcon;
    /**
    *   Fazemos um loop em pontos onde criaremos um pin
    *   Customizado caso seja estante ou ponto, e em seguida
    *   Colocamos o pin no mapa no local que foi cadastrado.
    */
    $.each( pontos , function(key, value){
        // Verificação se é uma estante ou apenas um ponto de coleta
        if(value.taxonomia == "sim"){
            markerIcon = template_url + '/image/estante.png';
        } else{
            markerIcon = template_url + '/image/pontodecoleta.png';
        }
        //  Montamos uma variável local como Objeto contendo os valores
        //  De localidade de cada ponto.
        let latlong = {lat: Number(value.lat), lng: Number(value.lng)};
        //  Adicionamos o Objeto no nosso Array de locais.
        locais.push( latlong );

        //  Criamos o pin customizado com a localização e a imagem
        //  Colocando no mapa.
        let marker = new google.maps.Marker({
            position : {lat: Number(value.lat), lng: Number(value.lng)},
            map: map,
            icon: markerIcon
        });

        pins.push(marker);
        //  Criamos uma caixa de informação para quando a pessoa
        //  Clicar no pin ela abrir e mostrar informações.
        let infowindow = new google.maps.InfoWindow();
        
        if(value.link){
            infowindow.setContent('\
            <div>\
                <strong>' + value.local + '</strong><br>\
                <p style="white-space: pre-line;">' + value.conteudo + '</p><br>\
                <strong>' + value.titulo + '</strong><br>\
                <a href="'+ value.link +'">' + value.titleLink + '</a>\
            </div>');
        } else{
            infowindow.setContent('\
                <div>\
                    <strong>' + value.local + '</strong><br>\
                    <p style="white-space: pre-line;">' + value.conteudo + '</p>\
                    <strong>' + value.titulo + '</strong><br>\
                </div>');
        }
        
        google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(map, marker);
        });      
    });
    let markerCluster = new MarkerClusterer(map, pins, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
}
/**
*   @author Johnny
*
*   @param  {Array} pontos - Um array com todos os pontos
*   @param  {Array} local  - Um array com latitude e longitude
*
*   @description
*   Função que instanciará o mapa com todos os pontos passados como argumento
*   Incluindo a funcionalidade de montar a rota e autocomplete do campo de busca.
*	#############################################################################
*	USAR APENAS PARA QUANDO é PONTO CADASTRADO
*   
*/
const initMapa = (pontos, local) => {

    /**
    *   @author Johnny
    *
    *   @description
    *   Instanciação dos serviços e display da API de Directions do Google
    *   O Qual será responsável por renderizar as rotas traçadas no mapa.
    */
    //  -------------------------------------------------------------------
    //  Criaremos um array vazio para colocar os valores da posição de cada
    //  Ponto cadastrado para usarmos posteriormente.
    let locais  = [];
    /**
    *   Criaremos uma váriavel pegando o elemento onde o mapa será gerado 
    *   E um Objeto com as opções do mapa, centralizando ele no primeiro ponto
    *   Cadastrado
    */
    let mapa        = document.getElementById('map');
    let mapOptions  = {
        center: {lat: Number(local['lat']), lng: Number(local['lng'])},
        zoom: 5
    };

    // Instância do mapa no elemento que setamos como `mapa` e as opções de Configuração
    let map = new google.maps.Map(mapa, mapOptions);
    
    let panorama = new google.maps.StreetViewPanorama(
        document.getElementById('map'), {
        position: {lat: Number(local['lat']), lng: Number(local['lng'])},
        pov: {
            heading: Number(local['heading']),
            pitch: Number(local['pitch'])
        },
        addressControlOptions: {
          position: google.maps.ControlPosition.BOTTOM_CENTER
        },
        linksControl: true,
        panControl: true,
        enableCloseButton: true
    });

    map.setStreetView(panorama);

    // Chama função para montar os pins.
    setMarkers( locais, pontos, map );
}

/**
*	@author Johnny
*	
*	@param opcao {String} - ID do menu mobile (Obrigatório : 'menu-gaveta', 'menu-lateral')	
*
*	@description
*	Função para menu mobile
*/ 
$.fn.menuMobile = function( opcao ) {
	let menu = $('#' + opcao);

	this.bind("click.menuMobile",  () => {
		this.toggleClass('active');
        menu.toggleClass('active');
   	});

	return this;
}

/**
*	@author Johnny
*	
*	@description
*	Função para evento de submit de formulário
*/ 
$.fn.contato = function() {
	return this.bind('submit.contato', ( event ) => {
		event.preventDefault();
		let dados = this[0].elements;

		this.find('input[type=submit]').attr('disabled','disable');
		$('.mensagem').remove();

		try{
			contato( dados ).then( ( data ) => {
				let resposta = JSON.parse( data );
				this.find('input[type=submit]').removeAttr('disabled');
				this.append('<p class="mensagem '+ resposta.codigo +'">'+ resposta.mensagem +'</p>');	
				if( resposta.codigo == "sucesso" ){
					$.each(dados, (key, value) => {	
						if($(value).attr('type') != 'submit'){
							$(value).val('');
						}
					});
				}
			});
		} catch(e){
			this.find('input[type=submit]').removeAttr('disabled');
			this.append('<p class="mensagem erro">Preencha todos os campos.</p>');
		}
		return false;
	});
}

