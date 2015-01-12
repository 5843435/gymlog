<html>
<head>
<title>Geolocation API を使った現在地の取得サンプル</title>
<!-- localhost 用のキー使用 -->
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAnfs7bKE82qgb3Zc2YyS-oBT2yXp_ZAY8_ufC3CFXhHIE1NvwkxSySz_REpPq-4WZA27OwgbtyR3VcA"></script>
<script type="text/javascript">
    google.load("maps", "2.x");

    function initialize() {
        if (navigator.geolocation) {
            //Geolocation API を使った現在地の取得
            navigator.geolocation.getCurrentPosition(showPosition, handleError);
        }
    }

    //現在地の位置情報を表示する
    function showPosition(position) {
        document.getElementById("location").innerHTML = "(" + position.coords.latitude + ", " + position.coords.longitude + ")";

        showAddress(position.coords.latitude, position.coords.longitude);
    }

    function handleError(error) {
        document.getElementById("location").innerHTML = error.message;
    }

    //住所を表示する
    function showAddress(latitude, longitude) {
        try {
            var gclient = new google.maps.ClientGeocoder();
            var pos = new google.maps.LatLng(latitude, longitude);

            //Google Map API を使って住所を取得
            gclient.getLocations(pos, function(response) {
                if (response && response.Status.code == 200) {
                    document.getElementById("address").innerHTML = response.Placemark[0].address;
                }
            });
        }
        catch (e) {
            alert(e.message);
        }
    }

    google.setOnLoadCallback(initialize);
</script>
</head>
<body onunload="GUnload()">
<h1>現在地</h1>
<div id="location"></div>
<div id="address"></div>

<?php
$lat1 = 35.6343071;
$lon1 = 139.7130383;
$lat2 = 36.6343071;
$lon2 = 140.7130383;

$hoge=location_distance($lat1, $lon1, $lat2, $lon2);
echo $hoge["distance"];
echo '<p>';
echo $hoge["distance_unit"];

?>

<?php
function location_distance($lat1, $lon1, $lat2, $lon2){
	$lat_average = deg2rad( $lat1 + (($lat2 - $lat1) / 2) );
	$lat_difference = deg2rad( $lat1 - $lat2 );
	$lon_difference = deg2rad( $lon1 - $lon2 );
	$curvature_radius_tmp = 1 - 0.00669438 * pow(sin($lat_average), 2);
	$meridian_curvature_radius = 6335439.327 / sqrt(pow($curvature_radius_tmp, 3));
	$prime_vertical_circle_curvature_radius = 6378137 / sqrt($curvature_radius_tmp);
	
	$distance = pow($meridian_curvature_radius * $lat_difference, 2) + pow($prime_vertical_circle_curvature_radius * cos($lat_average) * $lon_difference, 2);
	$distance = sqrt($distance);
	
	$distance_unit = round($distance);
	if($distance_unit < 1000){
		$distance_unit = $distance_unit."m";
	}else{//1000m以上ならkm表記
		$distance_unit = round($distance_unit / 100);
		$distance_unit = ($distance_unit / 10)."km";
	}
	return array("distance" => $distance, "distance_unit" => $distance_unit);
}
?>

</body>
</html>