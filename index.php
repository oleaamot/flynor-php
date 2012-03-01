<?php 
session_start();
include 'lib/class.flynor.php';
include 'lib/class.avinor.php';

$langs = array (
        'en-US',
        'en-GB',
        'en',
        'fr-FR',
        'fr',
        'nb',
        'no',
	'nn',
);

$avinor   = new avinor();

$language = $avinor->accept_language($langs);

if ($language=="en")    { $language = "en"; }
if ($language=="en-US") { $language = "en"; }
if ($language=="en-GB") { $language = "en"; }
if ($language=="fr-FR") { $language = "en"; }
if ($language=="fr")    { $language = "en"; }
if ($language=="nn")    { $language = "no"; }
if ($language=="nb")    { $language = "no"; }

// $crisis['en'] = get_crisis("en");
// $crisis['no'] = get_crisis("no");

$htitle['en']   = $_SERVER['SERVER_NAME'];
$htitle['no']   = $_SERVER['SERVER_NAME'];

$credit_lbl['en']   = "<a href='about'>Information about FlyNor</a>";
$credit_lbl['no']   = "<a href='about'>Informasjon om FlyNor</a>";

$flight_number_lbl['en']   = "Flight:";
$flight_number_lbl['no']   = "Flight:";

$direct_both['en']   = "Both";
$direct_both['no']   = "Begge";

$direct_arri['en']   = "Arrivals";
$direct_arri['no']   = "Ankomster";

$direct_dept['en']   = "Departures";
$direct_dept['no']   = "Avganger";

$airport_dir['en']   = "Direction:";
$airport_dir['no']   = "Retning:";

$time_lbl['en']      = "Time:";
$time_lbl['no']      = "Tid:";

$time_from['en']     = "FROM";
$time_from['no']     = "FRA";

$time_to['en']     = "TO";
$time_to['no']     = "TIL";

$fetch_flights['en'] = "Fetch flights";
$fetch_flights['no'] = "Hent flyvninger";

$airport_lbl['en'] = "Between";
$airport_lbl['no'] = "Mellom";

$airport_destination_lbl['en']   = "and";
$airport_destination_lbl['no']   = "og";

$airline['en'] = "Operator:";
$airline['no'] = "Selskap:";

$departs['en'] = "Departure:";
$departs['no'] = "Avgang:";

$arrival['en'] = "Arrival:";
$arrival['no'] = "Ankomst:";

$gate_lbl['en'] = "Gate:";
$gate_lbl['no'] = "Gate:";

$belt_lbl['en'] = "Baggage belt:";
$belt_lbl['no'] = "Baggasjeb&aring;nd:";

$status_lbl['en'] = "Status:";
$status_lbl['no'] = "Status:";

$status_new['Ny tid'] = "New time";	
$status_new['Avreist'] = "Departured";	

$return_lbl['en']   = "<a href='#'>Return to main page</a>";
$return_lbl['no']   = "<a href='#'>Tilbake til hovedsiden</a>";

$credit['en']   = "<a href='http://www.flynor.net/privacy/'>Privacy Policy</a></p><p align='center'>Graphical design by<br /><a href='http://www.copyleft.no/'><img src='gfx/logo-hor-red-sml.png'></a></p>";

$credit['no']   = "<a href='http://www.flynor.net/privacy/'>Om personvern</a>.</p><p align='center'>Grafisk design av<br /><a href='http://www.copyleft.no/'><img src='gfx/logo-hor-red-sml.png'></a></p>";

$timeNow 	= time();
		
if(isset($_GET['airport'])){
	$airport 	= strtoupper($_GET['airport']);
	$flight_number  = strtoupper($_GET['flight_number']);
	if (isset($_GET['timeFrom'])) {
		$timeFrom = $_GET['timeFrom'];
	} else {
		$timeFrom = 2;
	}
	if (isset($_GET['timeTo'])) {
		$timeTo		= $_GET['timeTo'];
	} else {
		$timeTo = 2;
	}
	if (isset($_GET['direction'])) {
		$direction	= $_GET['direction'];
	} else {
		$direction = "D";
	}
	$destination    = $_GET['airport_destination'];
} else {
	$airport 	= "OSL";
	$timeFrom	= 1;
	$timeTo		= 6;
	$direction	= "D";
}

$directions = array(
	'B' => $direct_both[$language],
	'A' => $direct_arri[$language],
	'D' => $direct_dept[$language]
);

$airlines = array(
	'Air France'		=> 'http://www.airfrance.com/',
	'American Airlines'	=> 'http://www.americanairlines.com/',
	'Austrian Airlines'	=> 'http://www.aua.com/no/nor',
	'British Airways'	=> 'http://www.britishairways.com/',
	'Croatia Airlines'      => 'http://www.croatiaairlines.com/',
	'Czech Airlines'	=> 'http://www.czechairlines.com/',
	'Finnair Oy'		=> 'http://www.finnair.com/',
	'Icelandair'		=> 'http://www.icelandair.com/',
	'KLM'			=> 'http://www.klm.com/',
	'Lufthansa'		=> 'http://www.lufthansa.com/',
	'Norwegian'     	=> 'http://www.norwegian.no/',
	'SAS'           	=> 'http://www.sas.no/'
);

$airlineicons = array(
	'Air France'		=> 'gfx/AirFrance.png',
//	'American Airlines'	=> 'gfx/AmericanAirlines.png',
//	'Austrian Airlines'	=> 'gfx/AustrianAirlines.png',
//	'British Airways'	=> 'gfx/BritishAirways.png',
	'Croatia Airlines'	=> 'gfx/CroatiaAirlines.png',
//	'Czech Airlines'	=> 'gfx/CzechAirlines.png',
//	'Finnair Oy'		=> 'gfx/Finnair.png',
//	'Icelandair'		=> 'gfx/Icelandair.png',
	'KLM'			=> 'gfx/KLM.png',
	'Lufthansa'		=> 'gfx/Lufthansa.png',
	'Norwegian'             => 'gfx/Norwegian.png',
	'SAS'                   => 'gfx/SAS.png'
);

$airports = array(
	'OSL' => 'OSL/Oslo',
	'TRF' => 'TRF/Sandefjord&nbsp;Lufthavn&nbsp;Torp',
	'BGO' => 'BGO/Bergen',
	'KRS' => 'KRS/Kristiansand',
	'SVG' => 'SVG/Stavanger',
	'TRD' => 'TRD/Trondheim',
	'TOS' => 'TOS/Troms&oslash;',
	'AES' => 'AES/&Aring;lesund',
	'ALF' => 'ALF/Alta',
	'ANX' => 'ANX/Andenes',
	'BDU' => 'BDU/Bardufoss',
	'BVG' => 'BVG/Berlev&aring;g',
	'BOO' => 'BOO/Bod&oslash;',
	'BNN' => 'BNN/Br&oslash;nn&oslash;ysund',
	'BJF' => 'BJF/B&aring;tsfjord',
	'VDB' => 'VDB/Fagernes',
	'FRO' => 'FRO/Flor&oslash;',
	'FDE' => 'FDE/F&oslash;rde',
	'HFT' => 'HFT/Hammerfest',
	'EVE' => 'EVE/Harstad/Narvik',
	'HAU' => 'HAU/Haugesund',
	'HVG' => 'HVG/Honningsv&aring;g',
	'KKN' => 'KKN/Kirkenes',
	'KSU' => 'KSU/Kristiansund',
	'LKL' => 'LKL/Lakselv',
	'LKN' => 'LKN/Leknes',
	'MEH' => 'MEH/Mehamn',
	'MQN' => 'MQN/Mo i Rana',
	'MOL' => 'MOL/Molde',
	'MJF' => 'MJF/Mosj&oslash;en',
	'OSY' => 'OSY/Namsos',
	'NVK' => 'NVK/Narvik',
	'RRS' => 'RRS/R&oslash;ros',
	'RVK' => 'RVK/R&oslash;rvik',
	'RET' => 'RET/R&oslash;st',
	'SDN' => 'SDN/Sandane',
	'SSJ' => 'SSJ/Sandnessj&oslash;en',
	'SOG' => 'SOG/Sogndal',
	'SKN' => 'SKN/Stokmarknes',
	'LYR' => 'LYR/Longyearbyen',
	'SVJ' => 'SVJ/Svolv&aelig;r',
	'SOJ' => 'SOJ/S&oslash;rkjosen',
	'VDS' => 'VDS/Vads&oslash;',
	'VAW' => 'VAW/Vard&oslash;',
	'VRY' => 'VRY/V&aelig;r&oslash;y',
	'HOV' => 'HOV/&Oslash;rsta-Volda'
);


?>
<form action="http://www.flynor.net/#item" method="get">
<table class="search" border="0">
	<tr class="header">
		<td class="left"><img src="gfx/flynor.png" width="55" height="23" border="0"></td>
		<td class="right"><a href="http://www.avinor.no/"><img src="gfx/adata.png" width="60" height="23" border="0"></a></td>
	</tr>
	<?
	if ($crisis[$language] != "") {
	?>
	 	<tr>
	 	<th class="top" colspan="3"><? echo $crisis[$language]; ?></th>
	 	</tr>
	<?
	} 
	?>
	<tr>
		<th class="top"><label for="airport"><? echo $airport_lbl[$language]; ?></label></th>
		<td class="top">
			<select id="airport" name="airport" onchange='this.form.submit()'>
			<?php foreach($airports as $airCode => $airName):?>
			<option value="<?php echo $airCode; ?>" <?php echo ($airCode == strtoupper($_GET['airport']) ? 'selected="selected"' : ''); ?>><?php echo $airName; ?></option>
			<?php endforeach; ?>
			</select>
		</td>
	</tr>


<?php 
function getHoursFromDate($time){
	date_default_timezone_set('UTC');
	if($time != ""){
		$currentTime 	= str_replace("T", " ", $time);
		$date 			= new DateTime($currentTime);
			
		$timeZone		= new DateTimeZone('Europe/Oslo');
		$date->setTimezone($timeZone);
			
		return $date->format('d/m H:i');
	}
		
	return '';
}
$avinor->setAirport($airport)
	->setTimeFrom($timeFrom)
	->setTimeTo($timeTo);
		   
if($direction != "B") $avinor->setDirection($direction);
		   
$result = $avinor->getResult();

$results = $result;

?>
	<tr>
		<th><label for="airport_destination"><? echo $airport_destination_lbl[$language]; ?></label></th>
		<td class="directions">
		<select id="airport_destination" name="airport_destination" onchange='this.form.submit()'>
		<option value='SELECT'>SELECT AIRPORT</option>
		<?
		foreach($results as $flights) {
			$code = $flights['airport']['code'];
			$airportcode[$code] = $flights['airport']['code'];
			$airportname[$code] = $flights['airport']['name'];
		}

		asort($airportcode);
	
		foreach($airportcode as $codem)  {
			print "<option value='";
			print($codem);
			echo "' "; 
			echo ($codem == strtoupper($_GET['airport_destination']) ? 'selected="selected"' : ''); 
			echo ">";
			echo $codem . "/";
			echo utf8_decode($airportname[$codem]); 
			echo "</option>\n";
		}
		?>
		</select>
		</td>
	</tr>
	<tr>
		<th><label for="direction"><? echo $airport_dir[$language]; ?></label></th>
		<td class="directions">
			<?php foreach($directions as $dirValue => $dirMsg):?>
			<input type="radio" name="direction" class="radio" value="<?php echo $dirValue; ?>" <?php echo ($dirValue == $direction ? 'checked="checked"' : ''); ?>  onchange='this.form.submit()'>
			<?php echo $dirMsg; ?>
			<?php endforeach; ?>
		</td>
	</tr>

	<tr>
		<th><label for="timeFrom"><? echo $time_lbl[$language]; ?></label></th>
			<td><? echo $time_from[$language]; ?>&nbsp;<select name="timeFrom" class="time" onchange='this.form.submit()'>
			<?php 
			for($i = 0; $i <= 4; $i++):
				$t = 3600 * $i;
				$t = date('H', ($timeNow - $t));				
			?> 
			<option class="time" value="<?php echo $i;?>" <?php echo ($timeFrom == $i ? 'selected="selected"' : ''); ?>><?php echo $t;?></option>
			<?php
			endfor; ?>
			</select>
			&nbsp;&nbsp;&nbsp;
			<? echo $time_to[$language]; ?>&nbsp;
			<select name="timeTo" class="time"  onchange='this.form.submit()'>
			<?php 
			for($i = 1; $i <= 12; $i++):
				$t = 3600 * $i;
				$t = date('H', ($timeNow + $t));
			?> 
			<option class="time" value="<?php echo $i;?>" <?php echo ($timeTo == $i ? 'selected="selected"' : ''); ?>><?php echo $t;?></option>
			<?php
			endfor; ?>
			</select>
		</td>

	</tr>
	<tr>
		<th><label for="flight_number"><? echo $flight_number_lbl[$language]; ?></label></th>
		<td><input name="flight_number" size="6" value="<?php echo $flight_number; ?>" >&nbsp;<button type="submit" name="btnSearch"><img src="gfx/btn_search.png" width="68" height="22" border="0"></button></td>
	</tr>
<!--
	<tr>
		<th></th>
		<td></td>
	</tr>
-->
</table>
</form>
<a name="main"></a>

<?

foreach($result as $flight):

	if ($flight['airline']['name']=="Vildanden" || $flight['airline']['name']=="Danish Air Transport" || $flight['airline']['name']=="Bergen Air Transport") {
		continue;
	} else {

	$avg 	= getHoursFromDate($flight['scheduleTime']);
	$status	= $flight['status']['code'][$language] . ' ' . getHoursFromDate($flight['status']['time']);
	$gate = $flight['gate'];
	$belt = $flight['belt'];
		if($flight['airport']['code'] == $avinor->getAirport() && $flight['direction'] != "A") {
		$airport = $flight['viaAirport'][0]['name'];
		$aircode = $flight['airport']['code'];
	} else {
		$airport = $flight['airport']['name'];
		$aircode = $flight['airport']['code'];
	}
			
	if($flight['direction'] == "A"){
		$flightIcon = array(
			'src' => 'iconArrival.png',
			'text'=> $direct_arri[$language],
			'typo'=> $arrival[$language]
		);
		} else {
			$flightIcon = array(
			'src' => 'iconDeparture.png',
			'text'=> $direct_dept[$language],
			'typo'=> $departs[$language]
		);
	}
	?>
<?
	if ($aircode == $_GET['airport_destination']) {
?>
<table>
<tbody>

	<tr>
		<td>&nbsp;</td>
	</tr>

	<tr>

		<td class="direction" rowspan="5"><img src="gfx/<?php echo $flightIcon['src']; ?>" width="35" height="31" border="0" alt="<?php echo $flightIcon['text']; ?>" ></td>
		<td>

	<?	$flight_number = trim($flight_number, " /-"); 
		if ($flight_number==strtoupper($flight['flightId'])) { 
			echo '<b class="item"><a name="item"></a>';
		} else {
			echo '<b>';
		}
	?>

		<!--b -->

		<?php echo $flight['flightId'] . "&nbsp;" . $aircode . "/"; 

		// if (isset($aircode)) {
		//	echo "<a href='?airport=" . $aircode . "&direction=B'>" . utf8_decode($airport) . "</a>";
		// } else {
			echo utf8_decode($airport);
		// }

?>

</b></td>
	</tr>
	<tr>
		<td><? echo $airline[$language]; ?>
			<?php
			$airline_selected = utf8_decode($flight['airline']['name']);
			if (isset($airlineicons[$airline_selected])) {
				if ($airline_selected=="Norwegian") {
				  echo "<a href=\"" . $airlines[$airline_selected] . "fly/velg-flyvning/?D_City=" . $_GET['airport'] . "&A_City=" . $_GET['airport_destination'] . "\">";
				} else {
   				  echo "<a href=\"" . $airlines[$airline_selected] . "\">";
				}
				if (isset($airlineicons[$airline_selected])) {
					echo "<img src=\"" . $airlineicons[$airline_selected] . "\" alt=\"" . $airline_selected . "\" >";
				}
				echo "</a>";
			}
			?>
			<?php if (!isset($airlineicons[$airline_selected])) echo utf8_decode($flight['airline']['name']); ?>
		</td>
	</tr>
	<tr>
		<td><? echo $flightIcon['typo']; ?>&nbsp;<?php echo $avg; ?></td>
		<? // echo $departs[$language]; ?>
	</tr>
	<tr>
		<? if(isset($gate)) {
			echo "<td>" . $gate_lbl[$language] . " " . $gate . "</td>";
	           }
		   if(isset($belt)) {
			echo "<td>" . $belt_lbl[$language] . " " . $belt . "</td>";
		   }
		?>
	</tr>

	<tr>
		<td><? echo $status_lbl[$language]; ?> <? echo $status; ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<? if ($flight_number==strtoupper($flight['flightId'])) { echo "</div>"; } ?>
	</tbody>
	</table>
<?php 
}

}
endforeach; 
?>
<p align="center"><? echo $credit[$language]; ?></p>
<!-- AppStoreHQ:developer_claim_code:6b59d7df54d52432ad42df254a89efcdd61b132c -->
</body>
</html>
