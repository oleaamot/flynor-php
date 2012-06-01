<?php
function get_strike ($language) {
  if ($language=="no") {
    $bodyline = "<b style='color: #aa0000'>En eventuell streik i vekterbransjen fra fredag 1. juni vil skape store forstyrrelser i flytrafikken.  Konsekvensene blir spesielt omfattende p&aring; Oslo Lufthavn, Gardermoen (OSL).  Her oppfordrer flyselskapene passasjerer som ikke m&aring; reise fredag 1. juni til &aring; finne andre reisem&aring;ter, og kansellere eller booke om flyreisen til en senere avgang.<br /><a href='http://www.avinor.no/'>Les mer hos Avinor p&aring; www.avinor.no</a></b>";
  }
  if ($language=="en") {
    $bodyline = "<b style='color: #aa0000'>An eventual strike in the security guard sector from Friday 1 June will cause major disruptions in air traffic. The consequences will be particularly severe at Oslo Airport Gardermoen (OSL).  The airlines encourage passengers who do not have to travel Friday 1 June to use other modes of transport and cancel or rebook their flight for a later date.</b><br /><a href='http://www.avinor.no/en/avinor'>Read more at Avinor on www.avinor.no</a>";
  }
  return $bodyline;
}
?>
