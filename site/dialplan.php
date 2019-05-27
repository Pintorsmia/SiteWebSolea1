<?php include ('haut.php'); ?>
<form id="test" action="http://192.168.141.172:8088/ari/channels/700/hold" method="post">
<input type="hidden" name="api_key" value="asterisk:asterisk"/>
</form> 
<a href='#' onclick='document.getElementById("test").submit()'>Cliquez</a>

<form id="test2" action="http://192.168.141.172:8088/ari/channels/600" method="post">
<input type="hidden" name="endpoint" value="PJSIP/80"/>
<input type="hidden" name="extension" value="site_val"/>
<input type="hidden" name="app" value="test"/>
<input type="hidden" name="timeout" value="-1"/>
<input type="hidden" name="api_key" value="asterisk:asterisk"/>
</form> 
<a href='#' onclick='document.getElementById("test2").submit()'>Appel</a>

<?php include ('bas.php'); ?>