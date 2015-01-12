<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="スタジオ・ジムの検索ツールコナミ/セントラル/ティップネス/ジェクサー/NAS/他">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ジム検索ツール｜GymLocater　スタジオ・ジムの検索ツールコナミ/セントラル/ティップネス/ジェクサー/NAS/他</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>
	<body>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56429220-1', 'auto');
  ga('send', 'pageview');

</script>

<!--#include virtual="/include/header.txt" -->

<br />
<br />
<br />
	<section class="container">
		<h1>GymLocater</h1>
		<p>ジム検索ツール</p>



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




	</section>

	<footer class="container">Copyright(c) GymLog Co.,Ltd.All Rights Reserved</footer>	

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>