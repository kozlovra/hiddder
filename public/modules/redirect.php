<?php
$redirect_url = explode('/', $_SERVER['REQUEST_URI']);
$links = R::findOne('link', 'hash = ?', [$redirect_url[1]]);
$link = $links->url;
if ($links->hash == $redirect_url[1]) {
	$views = R::load('link', $links->id);
	$views->views = ($views->views + 1);
	R::store($views);
	?>
	<meta http-equiv="refresh" content="0;<?php echo rawurldecode($link) ?>">
	<?php
}else{
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	require 'modules/404.php';
}