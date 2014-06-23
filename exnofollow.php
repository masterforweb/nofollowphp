<?php

 	require('nofollow.php');

 	
 	$html ='<p><a href="argumenti.ru" ></a></p><p><a href="argumentiru.com"></a></p>';	
	echo nofollowphp::make($html)
	->addfilter(array('argumenti.ru', 'argumentiru.com'))
	->get(); 