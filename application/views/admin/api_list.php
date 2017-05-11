<!DOCTYPE html>
<html>
<head>
	<title>api 列表</title>
</head>
<body>

	<table>
		<tr>
			<th>名称</th>
			<th>创建时间</th>
			<th>是否有效</th>
			<th>操作</th>
		</tr>
		<?php foreach ($result as $value): ?>
			<tr>
				<td><?php echo $value['apiname']?></td>
				<td><?php echo $value['create_time']?></td>
				<td><?php echo $value['is_del']?></td>
				<td><a href="">删除</a>|参数<a href="<?php echo site_url()."/admin/api/apiinfo/".$value['id'] ?>">查看</a>/<a <a href="<?php echo site_url()."/admin/api/infoedit/".$value['id'] ?>">编辑</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php echo $this->pagination->create_links(); ?>
</body>
</html>