<?php
function get_strike ($language) {
  if ($language=="no") {
    $bodyline = "<h3>VIKTIG MELDING TIL REISENDE</h3><b style='color: #aa0000'>Opptrappingen av vekterstreiken mandag 4. juni har f&oslash;rt til at sikkerhetskontrollen ved flere lufthavner er stengt. Ankomster vil i utgangpunktet ikke v&aelig;re ber&oslash;rt av streiken, men forsinkelser og kanselleringer vil forekomme p&aring; grunn av flyselskapenes logistikkutfordringer.<br />Alle passasjerer bes &aring; forholde seg til informasjon fra sitt flyselskap om den enkelte flygning og m&oslash;te opp p&aring; lufthavnen i god tid f&oslash;r avreise. P&aring; avinor.no og osl.no vil det bli gitt informasjon om status i trafikken.<br />Streiken rammer i &oslash;yeblikket sikkerhetskontrollene ved Oslo lufthavn, Stavanger, Bergen, Trondheim, Troms&oslash;, Haugesund, &Aring;lesund, Kristiansund, Alta, Bod&oslash;, Sandnessj&oslash;en og Flor&oslash; (bare offshore).<br /><a href='http://www.avinor.no/'>Se n&aelig;rmere informasjon om konsekvensene av streiken ved de nye lufthavnene som er rammet hos Avinor p&aring; www.avinor.no</a></b>";

  }
  if ($language=="en") {
    $bodyline = "<h3>IMPORTANT NOTICE TO TRAVELLERS</h3><b style='color: #aa0000'>The escalation of the security guards strike on Monday 4 June has led to security checkpoints being closed at several airports. Arrivals will not in themselves be affected by the strike, but cancellations and delays will occur because of the airlines' logistical issues.<br />All passengers are asked to refer to information from their airline about their flight and to arrive at the airport in good time before departure. Information about traffic status will be given on avinor.no and osl.no.<br />The strike is currently affecting security controls at Oslo Airport, Stavanger, Bergen, Trondheim, Troms&oslash;, Haugesund, &Aring;lesund, Kristiansund, Alta, Bod&oslash;, Sandnessj&oslash;en and Flor&oslash; (only offshore).</b><br /><a href='http://www.avinor.no/en/avinor'>Read more about the consequences of the strike at the new airports to be affected at Avinor on www.avinor.no</a>";
  }
  // return $bodyline;
}
?>
