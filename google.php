<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>Google Map Test by Deawx</title>
<script src="http://maps.google.com/maps/api/js?sensor=false"           type="text/javascript"></script>
<style>
html {
  height: auto;
}

body {
  height: auto;
  margin: 0;
  padding: 0;
}
#map {
  height: auto;
  position: absolute;
  bottom:0;
  left:0;
  right:0;
  top:0;
}

@media print {
  #map {
    height: 950px;
  }
}
</style>
</head>
<body>
<div id="map" style="width: 600px; height: 300px;margin-left:300px;margin-top:200px"></div>

<script type="text/javascript">   
 var locations = [   
    ['smile Computer', 15.564902217975098, 101.84617855587827],  
	];    
var map = new google.maps.Map(document.getElementById('map'), {      
zoom: 18,      
center: new google.maps.LatLng(15.564902217975098, 101.84617855587827),      
mapTypeId: google.maps.MapTypeId.ROADMAP   
});    
var infowindow = new google.maps.InfoWindow();    
var marker, i;    for (i = 0; i < locations.length; i++) {        
marker = new google.maps.Marker({        
position: new google.maps.LatLng(locations[i][1], locations[i][2]),       
map: map   
});     

google.maps.event.addListener(marker, 'click', (function(marker, i) {        
return function() {         
 infowindow.setContent(locations[i][0]);          
 infowindow.open(map, marker);        
 }      
 })
 (marker, i));    
 }  
 </script>
</body>
</html>

