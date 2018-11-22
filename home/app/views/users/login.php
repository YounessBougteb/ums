<?=form_open('user/login')?>
	<div class="row">
		<div class="col-lg-4 offset-md-4 bg-secondary">
			<h2 class="my-4 text-center"><?=$title?></h2>
			<div class="form-group">
				<input type="text" name="username" class="form-control"
				placeholder="Enter Username" required autofocus>
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control"
				placeholder="Enter Password" required autofocus>
			</div>
			<button type="submit" class="btn btn-primary btn-block">Login</button>
			<br>
		</div>
	</div>
</form>
