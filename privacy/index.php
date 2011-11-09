<?php 
session_start();
include '../lib/class.flynor.php';
include '../lib/class.avinor.php';
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
$language = "en";
?>

<table class="search" border="0">
	<tr class="header">
		<td class="left"><img src="../gfx/flynor.png" width="55" height="23" border="0"></td>
	</tr>
	<tr>
	<td class="top">
<? 
if ($language == "en") {
?>
	<h2>Privacy policy for FLYNOR.NET</h2>
	<p>The following statement discloses the information gathering and dissemination practices for the web pages under the <a href="http://www.flynor.net/">FLYNOR.NET</a> domain.
	<p><b>IP addresses and GPS positions</b></p>
	<a href="http://www.flynor.net/">FLYNOR.NET</a> may collect and log visitors' IP addresses and GPS positions to gather statistics of web site usage for internal use, to help diagnose problems with servers and to administer Web sites.
	<p><b>External links</b></p>
	The <a href="http://www.flynor.net/">FLYNOR.NET</a> web pages will contain links to other sites.  <a href="http://www.flynor.net/">FLYNOR.NET</A> is not responsible for the privacy practices nor the content of such web sites.
	<p><b>Customer data</b></p>
	<p>Records of customer data that may be held by <a href="http://www.flynor.net/">FLYNOR.NET</a> will not be sold or shared with other parties.</p>
	<hr />
	<p>Please contact <a href="mailto:ole+privacy@flynor.net">me</a> (ole+privacy@flynor.net) if you have any questions regarding this privacy policy.</p>
	<hr />
	<p><a href="http://www.flynor.net/">Back to FlyNor.net</a></p>
<?
}
if ($language == "no") {
?>
	<h2>Om personvern p&aring; FLYNOR.NET</h2>
	<p>F&oslash;lgende utsagn beskriver praksis for innsamling av informasjon og for nettsteder under domenet <a href="http://www.flynor.net/">FLYNOR.NET</a>.</p>
	<p><b>IP-adresser</b></p>
	<p><a href="http://www.flynor.net/">FLYNOR.NET</a> kan samle informasjon om bes&oslash;kendes IP-adresser og geoposisjon for &aring; samle
	statistikk for bruk av nettstedet til intern bruk, for &aring; diagnostisere problemer med servere og for &aring; administrere nettstedet.</p>
	<p><b>Eksterne lenker</b></p>
	Websidene p&aring; <a href="http://www.flynor.net/">FLYNOR.NET</a> inneholder lenker til andre nettsteder. <a href="http://www.flynor.net/">FLYNOR.NET</A> 
	er ikke ansvarlig for personvernet eller innholdet p&aring; slike nettsteder</p>
	<p><b>Kundedata</b></p>
	<p>Bes&oslash;ksdata som er lagret av <a href="http://www.flynor.net/">FLYNOR.NET</a> vil aldri bli solgt eller delt med andre.</p>
	<hr />
	<p><a href="http://www.flynor.net/">Tilbake til FlyNor.net</a></p>
<?
}
?>
	</td>

	</tr>
</table>

</body>
</html>
