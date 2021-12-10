		/* iNCLUISION EN HTML: 
			
			<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key={google_maps_api_key}" type="text/javascript"></script>
			
			<body onload="google_maps_initialize(); google_maps_show_address('".$direccion."','".$html_text."');" onunload="GUnload()">
			
		*/
	
	
	    var map = null;
	    var geocoder = null;
	
	
	    function google_maps_initialize() {
	      if (GBrowserIsCompatible()) {
	        map = new GMap2(document.getElementById("div_mapa"));
            map.addControl(new GSmallZoomControl3D());
            map.addControl(new GMapTypeControl());
            map.removeMapType(G_HYBRID_MAP);
	        //map.setCenter(new GLatLng(37.4419, -122.1419), 13);
	        geocoder = new GClientGeocoder();
	      }
	    }
	
	
	    function google_maps_show_address(address,html_info) {
	      if (geocoder) {
	        geocoder.getLatLng( address,
			          function(point) {
			            if (!point) {
			              //alert(address + " not found");
			            } else {
			               map.setCenter(point, 14);
			               var marker = new GMarker(point);
			               map.addOverlay(marker);
						   //map.addOverlay(createMarker(point,html_info));
							
							 GEvent.addListener(marker, "click", function() {
			            		marker.openInfoWindowHtml(html_info);
			          		}); 				   
						  
			              // As this is user-generated content, we display it as
			              // text rather than HTML to reduce XSS vulnerabilities.
			               //marker.openInfoWindow(document.createTextNode(address));
			            }
			          }
			        );
	      }
	    }
 
  