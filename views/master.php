<!doctype html>
<html>
	<head>
		<title><?php print isset($title) ? $title : 'LEEG'; ?></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link href="css/style.css" rel="stylesheet" />
		<meta charset="UTF-8" />
	</head>
	<body>
		<?php if(isset($v_content)) include $v_content; ?>
	</body>
</html>