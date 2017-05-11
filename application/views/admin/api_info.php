
		 <div class="span9">
		  <div class="row-fluid">
			<div class="page-header">
				<h1>所有参数 <small></small></h1>
			</div>
			<table class="table table-striped table-bordered table-condensed">
				<thead>
					<tr>
						<th>ID</th>
						<th>参数名</th>
						<th>默认值</th>
						<th>固定</th>
						<th>操作</th>
					<!-- 	<th>Role</th>
						<th>Status</th>
						<th></th> -->
					</tr>
				</thead>
				<tbody>
				<?php foreach ($info as $value):?>
					<tr class="list-users">
					<td><?php echo $value['id']?></td>
					<td><?php echo $value['key']?></td>
					<td><?php echo $value['def_value']?></td>
					<td><?php if ($value['is_fixed']) {
								echo "是";
							}else{
								echo "否";
								}?></td>
					<td><a href="<?php echo $up.$value['id'];?>">修改</a>|<a href="<?php echo $del.$value['id'];?>">删除</a></td>
					<!-- <td>Admin</td>
					<td><span class="label label-success">Active</span></td>
					<td>
						<div class="btn-group">
							<a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">Actions <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
								<li><a href="#"><i class="icon-trash"></i> Delete</a></li>
								<li><a href="#"><i class="icon-user"></i> Details</a></li>
								<li class="nav-header">Permissions</li>
								<li><a href="#"><i class="icon-lock"></i> Make <strong>Admin</strong></a></li>
								<li><a href="#"><i class="icon-lock"></i> Make <strong>Moderator</strong></a></li>
								<li><a href="#"><i class="icon-lock"></i> Make <strong>User</strong></a></li>
							</ul>
						</div>
					</td> -->
				</tr>
				<?php endforeach;?>
				
				</tbody>
			</table>

			<!-- <a href="new-user.html" class="btn btn-success">New User</a> -->
		  </div>

		  <div class="row-fluid">
			<div class="page-header">
				<h1>添加参数 <small></small></h1>
			</div>
	<form class="form-horizontal" action="<?php echo site_url()?>/admin/api/infoedit" method="post"> 

				<fieldset>
					<div class="control-group">
						<label class="control-label" for="name">参数名</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="name" value="Admin" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="email">默认值</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="email" value="travis@provider.com" />
						</div>
					</div>
				<!-- 	<div class="control-group">
						<label class="control-label" for="pnohe">Phone</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="phone" value="xxx-xxx-xxxx" />
						</div>
					</div> -->
				<!-- 	<div class="control-group">
						<label class="control-label" for="city">City</label>
						<div class="controls">
							<input type="text" class="input-xlarge" id="city" value="My City" />
						</div>
					</div>	 -->
					<div class="control-group">
						<label class="control-label" for="role">是否固定</label>
						<div class="controls">
							<select id="role">
								<option value="admin" >是</option>
								<option value="mod" selected>否</option>
								<!-- <option value="user">User</option> -->
							</select>
						</div>
					</div>	
					<!-- <div class="control-group">
						<label class="control-label" for="active">Active?</label>
						<div class="controls">
							<input type="checkbox" id="active" value="1" checked />
						</div>
					</div> -->
					<div class="controls" ><!-- class="form-actions" -->
						<input type="submit" class="btn btn-success btn-large" value="Save Changes" /> <a class="btn" href="users.html">Cancel</a>
					</div>					
				</fieldset>
			</form>
		  </div>
        </div>
      </div>
</div>
<!-- <table>

	<tr>
		<th>参数</th>
		<th>默认值</th>
		<th>是否固定</th>
		<th>操作</th>
	</tr>
	
	<tr><td colspan="4"><h2 style="text-align: center;">添加 </h2></td></tr>
	<tr style="text-align: center;">
	<?php echo form_open('admin/api/infoedit'); ?>
		<?php echo form_hidden('apiid', $hid); ?>
		<td>
			<input type="text"  name="key">
		</td>
		<td>
			<input type="text" name="def_value">
		</td>
		<td>
			<input type="radio"  name="is_fixed" value="1">是<input type="radio" checked="true"  name="is_fixed" value="0">否
		</td>
		<td>
			<input type="submit" value="提交">
		</td>
	</form>
	</tr>
</table> -->