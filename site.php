<?php

use \Amcommerce\Page;;

$app->get('/', function() {
	
	$page = new Page();

	$page->setTpl("index");

});

?>
