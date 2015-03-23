<?php
/* Use this document to find out html entities of special signs like umlaute or cyrilic letters and use them in your translated document */ 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Find out hmlt entities of special signs like umlaute or cyrilic letters</title>
</head>
<body>
<form method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<td>Enter sign or phrase here:</td>
			<td><input type="text" name="input" <?php echo (isset($_POST['input'])?"value='".htmlentities($_POST['input'])."'":'') ?> /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="evaluate"/></td>
		</tr>
<?php
if( isset($_POST['input']) )
{ 
?>		<tr>
			<td>'<?php echo htmlentities($_POST['input']) ?>'&nbsp;&nbsp;=&gt;</td>
			<td><?php echo htmlentities(htmlentities($_POST['input'])); ?></td>
		</tr>
<?php
}
?>
	</table>
</form>

</body>
</html>
