<!DOCTYPE html>
<html>
<head>
	<title>api 编辑</title>
</head>
<body>

<table>
<?php echo validation_errors(); ?>
	<?php echo form_open('admin/api/edit'); ?>
	<tr>
		<td>接口编辑</td>
	</tr>
	<tr>
		<td>接口名</td><td><input type="text" name="apiname" value="<?php echo set_value('apiname'); ?>" ></td>
	</tr>
	<tr><td><input type="submit" name="提交"></td></tr>
	</form>
</table>
</body>
</html>