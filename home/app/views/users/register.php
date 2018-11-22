<?=form_open('user/register')?>
<div class="row">
	<div class="col-lg-4 offset-md-4 bg-secondary">
		<h2 class="my-4 text-center"><?=$title?></h2>
		<div class="text-primary">
			<?=validation_errors()?>
		</div>
		<div class="form-group">
			<input type="text" name="first_name" class="form-control" placeholder="First Name" value="<?=set_value('first_name')?>">
		</div>
		<div class="form-group">
			<input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?=set_value('last_name')?>">
		</div>
		<div class="form-group">
			<input type="text" name="username" class="form-control" placeholder="Username" value="<?=set_value('username')?>">
		</div>
		<div class="form-group">
			<input type="email" name="email" class="form-control" placeholder="E-mail Address" value="<?=set_value('email')?>">
		</div>
		<div class="form-group">
			<input type="password" name="password" class="form-control" placeholder="Password" value="<?=set_value('password')?>">
		</div>
		<div class="form-group">
			<input type="password" name="password2" class="form-control" placeholder="Confirm Password" value="<?=set_value('password2')?>">
		</div>
		<button type="submit" class="btn btn-primary btn-block">Submit</button>
		<br>
		</div>
	</div>
</form>
