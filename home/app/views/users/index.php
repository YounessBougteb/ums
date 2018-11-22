<div class="table-responsive">
	<table class="table table-striped table-bordered">
		<thead class="thead-dark">
			<tr>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Username</th>
				<th>Email</th>
				<th>Created</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($users as $u) : ?>
			<tr>
				<td><?php echo $u['id']; ?></td>
				<td><?php echo $u['first_name']; ?></td>
				<td><?php echo $u['last_name']; ?></td>
				<td><?php echo $u['username']; ?></td>
				<td><?php echo $u['email']; ?></td>
				<td><?php echo $u['created']; ?></td>
				<td>
					<a href="<?php echo site_url('user/edit/'.$u['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
					<a href="<?php echo site_url('user/delete/'.$u['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
</div>