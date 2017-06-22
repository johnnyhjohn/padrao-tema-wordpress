jQuery(document).ready(function($){

    var lat  = Number($("#map").data('lat'))
    ,    lng = Number($("#map").data('long'));


    $(document).on('click', '.repeatable-add', function( e ) {
        e.preventDefault();
        var $this = $(this);
        var item = $this.parents('.telefones');
        var novoitem = item.find('.item:last').clone( true );
        novoitem.find('input').val('');
        var name = novoitem.find('input').attr('name');
        
        name = name.split('[');
        name = name[0] + '['+ (parseInt(name[1].replace(']', '')) + 1) +']';
        novoitem.find('input').attr('name', name);
        item.append(novoitem);
    });

    $(document).on('click', '.repeatable-remove', function( e ) {
        e.preventDefault();
        if($('.telefones').find('.item').length <= 1) {
            return false;
        }

        $(this).parent('.item').remove();
    });


    $(document).on('change', '#acf-field-estante', function(e){
        $(".taxonomia").val($(this).val());
    });
    var marker;
    function mapaMetaBox() {

        var mapOptions = {
          center: {lat: lat, lng: lng},
          zoom: 13,
          scrollwheel: false,
        };

        if($('#acf-field-estante').val() == 'sim') {
            var markerIcon = '../wp-content/themes/pegai/image/estante.png';
            $(".taxonomia").val('sim');
        } else{
            var markerIcon = '../wp-content/themes/pegai/image/pontodecoleta.png';
            $(".taxonomia").val('não');
        }

        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
    
        var input = (
            document.getElementById('pac-input'));
    
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
    
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    
        marker = new google.maps.Marker({
          position : {lat: lat, lng: lng},
          map: map,
          draggable : true
        });
    
        var infowindow = new google.maps.InfoWindow();
    
        google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(map, marker);
        });
    
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            infowindow.close();
            var place = autocomplete.getPlace();
            if (!place.geometry) {
              return;
            }

            if (place.geometry.viewport) {
              map.fitBounds(place.geometry.viewport);
            } else {
              map.setCenter(place.geometry.location);
              map.setZoom(17);
            }
            
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
    
            $(".local").val(place.name);
            $(".lat").val(place.geometry.location.lat);
            $(".lng").val(place.geometry.location.lng);
    
            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
                place.formatted_address + '</div>');
            infowindow.open(map, marker);
        });

        google.maps.event.addListener( marker, 'drag', function() {
            $(".lat").val(this.position.lat());
            $(".lng").val(this.position.lng());
        });

    }
    
    google.maps.event.addDomListener(window, 'load', mapaMetaBox);        

    $(document).on('click', '#change-street', function( event ) {
        event.preventDefault();
        
        if($('#acf-field-estante').val() == 'sim') {
            var markerIcon = '../wp-content/themes/pegai/image/estante.png';
            $(".taxonomia").val('sim');
        } else{
            var markerIcon = '../wp-content/themes/pegai/image/pontodecoleta.png';
            $(".taxonomia").val('não');
        }
        if( ($('#heading').val() == '') && ($('#pitch').val() == '')) {
            var pov = {
                heading: 270,
                pitch: 0
            }
        }else{
            var pov = {
                heading: Number($('#heading').val()),
                pitch: Number($('#pitch').val())
            }            
        }

        panorama = new google.maps.StreetViewPanorama(
            document.getElementById('map'), {
            position: {lat: lat, lng: lng},
            pov: pov,
            visible: true,
        });

        marker = new google.maps.Marker({
          position : {lat: lat, lng: lng},
          map: panorama,
          icon: markerIcon,
          draggable : true
        });

        google.maps.event.addListener( marker, 'drag', function() {
            $(".lat").val(this.position.lat());
            $(".lng").val(this.position.lng());
        });
        
        panorama.addListener('pov_changed', function() {
            $('#heading').val(panorama.getPov().heading);
            $('#pitch').val(panorama.getPov().pitch);
        });
    });

    $('.custom_upload_image_button').click(function() {

        let $this = $(this);

        formfield = $this.siblings('.custom_upload_image');
        preview = $this.siblings('.custom_preview_image');
        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        window.send_to_editor = function(html) {
            imgurl = $(html).attr('src');
            classes = $(html).attr('class');
            id = classes.replace(/(.*?)wp-image-/, '');
            formfield.val(imgurl);
            preview.attr('src', imgurl);
            tb_remove();
        }
        return false;
    });
     
    $('.custom_clear_image_button').click(function() {
        let $this = $(this);

        var defaultImage = $this.parent().siblings('.custom_default_image').text();
        $this.parent().siblings('.custom_upload_image').val('');
        $this.parent().siblings('.custom_preview_image').attr('src', defaultImage);

        return false;
    });
 

})


//AIzaSyBCAKUTbamk1pEER1vty-_nB2UHYKnO37Y