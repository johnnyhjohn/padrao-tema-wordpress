$(document).ready(function(){
	
	$('#banner').slick({
	  	slidesToShow   : 1,
	  	slidesToScroll : 1,
	  	autoplay 	   : true,
	    dots 		   : false,
	  	autoplaySpeed  : 4000,
	});

    $('#btn-mobile').menuMobile('menu-gaveta');
    $('#form').contato();

    let mapa        = document.getElementById('mapa');
    let mapOptions  = {
        center: {lat: Number(-25.092176), lng: Number(-50.1619103)},
		scrollwheel: false,
        zoom 	: 13
    };

    // Instância do mapa no elemento que setamos como `mapa` e as opções de Configuração
    let map = new google.maps.Map(mapa, mapOptions);
});
