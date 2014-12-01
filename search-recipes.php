<?php

	ob_start();
	include('./header.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	// dynamic page title
	$buffer = str_replace("%TITLE%", "Search Recipes", $buffer);
	echo $buffer;

?>

<div class="styled_box" id="search_container">

</div>

<?php

	include('./footer.php');

?>