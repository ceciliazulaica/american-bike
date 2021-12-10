$(document).ready(function()
{

	// SLIDER

	$('#slider div.slides').after('<nav class="pagination"></nav>');

	$('#slider div.slides').cycle(
	{
		fx: "fade",
		slides: ".slide",
		speed: 700,
		prev: "#slider .prev",
		next: "#slider .next",
		pager: "#slider .pagination",
		pagerTemplate: "<a href='#'>{{slideNum}}</a>",
		pagerActiveClass: "active"
	});



	// MENU

	$('#secciones div article, #footer nav ul li').each(function()
	{
		$(this).find('a').click(function()
		{
			var id = $(this).attr('href');

			$('html, body').stop().animate({ scrollTop: $(id).offset().top - 50 }, 3000);

			return false;
		});
	});

	$('a.subir').click(function()
	{
		$('html, body').stop().animate({ scrollTop: $('body').offset().top }, 2000);

		return false;
	});



	// TRANSITION

	$('#secciones').addClass('transition');

	var section = $('#content > section');

	$(section).each(function(index, item)
	{
		$(window).scroll(function()
		{
			var position = $(section[index]).offset();

			var height = $(window).height();

			height = height / 1.5;

			if ( $(document).scrollTop() > position.top - height )
			{
				$(section[index]).addClass('transition');
			}
		});
	});

	$('#contacto-info article').hover(function()
	{
		$('#contacto-info').addClass('active');
	});



	// NOTICIAS

	$('#noticias div.slides').after('<nav class="pagination"></nav>');

	$('#noticias div.slides').cycle(
	{
		fx: "fade",
		slides: ".slide",
		timeout: 0,
		speed: 900,
		prev: "#noticias .prev",
		next: "#noticias .next",
		pager: "#noticias .pagination",
		pagerTemplate: "<a href='#'>{{slideNum}}</a>",
		pagerActiveClass: "active"
	});



	// MAPA

	$('#contacto h2').after('<div id="mapa"></div>');

	function initialize()
	{
		var myLatlng = new google.maps.LatLng(-34.592008599999986,-58.41261100000005);

		var mapOptions =
		{
			zoom: 16,
			scrollwheel: true,
			center: myLatlng,
			styles: [{
				featureType:'all',
				stylers: [{saturation: -100}, {gamma: 1.3}]
			}]
		};

		var map = new google.maps.Map(document.getElementById('mapa'), mapOptions);

		var contentString = '<div class="gm-iw gm-sm">'+
							'<div class="gm-title">American Bike</div>'+
							'<div class="gm-basicinfo">'+
							'<div class="gm-addr">Av. Coronel Diaz 1664</div>'+
							'<div class="gm-phone">Tel.: 011-4822-0889</div>'+
							'</div>'+
							'</div>';

		var infowindow = new google.maps.InfoWindow(
		{
			content: contentString
		});

		var marker = new google.maps.Marker(
		{
			position: myLatlng,
			map: map,
			icon: 'img/ico_location.svg'
		});

		google.maps.event.addListener(marker, 'click', function()
		{
			infowindow.open(map, marker);
		});
	}

	google.maps.event.addDomListener(window, 'load', initialize);
});