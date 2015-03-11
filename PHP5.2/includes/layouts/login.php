<!-- Login modal -->
<div class="modal fade loginPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Please Login</h4>
			</div>
			<div class="modal-body">
				<form action="scripts/login_scripts.php" method="POST" class="form-horizontal" role="form">
					<div class="form-group">
						<div class="col-sm-3"><label for="username">Username</label></div>
						<div class="col-sm-9">
							<input type="text" name="username" class="form-control" id="username" placeholder="please enter your username">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-3"><label for="password">Password</label></div>
						<div class="col-sm-9">
							<input type="password" name="password" class="form-control" id="password" placeholder="please enter your username">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-3">&nbsp;</div>
						<div class="col-sm-9">
							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-3">&nbsp;</div>
						<div class="col-sm-9">
							<a href="register.php">Register</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>