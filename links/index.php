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
$avinor   = new avinor();

$language = $avinor->accept_language($langs);

if ($language=="en")    { $language = "en"; }
if ($language=="en-US") { $language = "en"; }
if ($language=="en-GB") { $language = "en"; }
if ($language=="fr-FR") { $language = "en"; }
if ($language=="fr")    { $language = "en"; }
if ($language=="nn")    { $language = "no"; }
if ($language=="nb")    { $language = "no"; }

?>

<table class="search" border="0">

	<tr class="header">
		<td class="left"><h1>FlyNor</h1></td>
		<td class="right"><div style='color: #ffffff'><a href='http://www.avinor.no/'>Airport data from Avinor</a></div></td>
	</tr>
	<tr>
	<td class="top" colspan="2">
<? 
if ($language == "en") {
?>
<h2>Useful Travel Links</h2>
<a href="https://www.flyklagenemnda.no/">Flyklagenemda</a><br />
<a href="http://www.rgf.no" target="_blank">Reisegarantifondet</a><br /> 
<a href="http://www.landsider.no" target="_blank">UDs landsider</a><br /> 
<a href="http://www.forbrukerportalen.no" target="_blank">Forbrukerportalen</a><br /> 
<a href="http://www.flypassasjer.no" target="_blank">Flypassasjer.no</a><br /> 
<a href="http://www.lovdata.no/all/hl-19930611-101.html" target="_blank">Luftfartsloven (Lovdata)</a><br />

<hr />
<p><a href="http://www.flynor.net/">Back to FlyNor.net</a></p>
<?
}
if ($language == "no") {
?>
<h2>Nyttige reiselenker</h2>
<p>
<a href="https://www.flyklagenemnda.no/">Flyklagenemda</a><br />
<a href="http://www.rgf.no" target="_blank">Reisegarantifondet</a><br /> 
<a href="http://www.landsider.no" target="_blank">UDs landsider</a><br /> 
<a href="http://www.forbrukerportalen.no" target="_blank">Forbrukerportalen</a><br /> 
<a href="http://www.flypassasjer.no" target="_blank">Flypassasjer.no</a><br /> 
<a href="http://www.lovdata.no/all/hl-19930611-101.html" target="_blank">Luftfartsloven (Lovdata)</a></p>
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
