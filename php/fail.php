<?php
	echo '<?xml version="1.0" encoding="UTF-8" ?>' ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<style type="text/css">
		
		html, body{
		
			font-family:"Lucida Grande","Segoe UI",Helvetica, Arial, sans-serif; 
			font-size: 15px ;
			color: black ;
			
		}
		
		h1, h2, p {
			margin: 10px ;
		}
		
		h1{
			font-size: 200% ;
			font-weight: bold ;
			color: red ;
		}
		
		h2{
			font-size: 150% ;
			font-weight: bold ;
		}
		
		.name{
			font-size: 150% ;
			font-weight: bold ;
		}
		
		p{
			
		}
		
	</style>
</head>
<body>
	<div class="page">
		<h1>Fail</h1>
		
		<h2>Error</h2>
		<p><?= $error ?></p>
		
		<h2>Referer</h2>
		<p><?= $_SERVER['HTTP_REFERER'] ?></p>
		
		<h2><a href="php/phpinfo.php">see phpinfo()</a></h2>
		
		<h2>Var dump - local</h2>
		<p>
			<?php 
				
				foreach( self::$local as $k => $v ){
					echo '<p>' ;
					echo '<span class="name">' . $k . '</span>';
					echo ' : ';
					echo '<span>' . $v . '</span><br/>' ;
					echo '<p>' ;
				}
				
			?>
		</p>
		
		<h2>Var dump - get</h2>
		<p>
			<?php 
				
				foreach( $_GET as $k => $v ){
					echo '<p>' ;
					echo '<span class="name">' . $k . '</span>';
					echo ' : ';
					echo '<span>' . $v . '</span><br/>' ;
					echo '<p>' ;
				}
				
			?>
		</p>
		
		<h2>Var dump - post</h2>
		<p>
			<?php 
				
				foreach( $_POST as $k => $v ){
					echo '<p>' ;
					echo '<span class="name">' . $k . '</span>';
					echo ' : ';
					echo '<span>' . $v . '</span><br/>' ;
					echo '<p>' ;
				}
				
			?>
		</p>
		
		<h2>Var dump - cookie</h2>
		<p>
			<?php 
				
				foreach( $_COOKIE as $k => $v ){
					echo '<p>' ;
					echo '<span class="name">' . $k . '</span>';
					echo ' : ';
					echo '<span>' . $v . '</span><br/>' ;
					echo '<p>' ;
				}
				
			?>
		</p>
		
		<p><?= date(DateTime::RFC850) ?></p>
		
	</div>
</body>
</html>