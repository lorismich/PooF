<style>
	#login_box {
		margin: 100px auto;
		text-align: center;
		width: 400px;
		height: 300px;
	}
	#login_box_top {
		background-image: url('include/image/admin_login_top.png');
		width: 400px;
		height: 34px;
	}

	#login_box_content {
		height: 232px;
		width: 399px;
		background-color: #4d4d4d;
		text-align: left;
		color: white;
		font-style: italic;
		text-transform: uppercase;
	}

	#login_box_content form {
		text-align: center;
		padding-top: 50px;
		margin: 0 auto;
	}

	#login_box_content form input {
		border: 0px;
		margin-left: 20px;
	}

	#login_box_bottom {
		background-image: url('include/image/admin_login_bottom.png');
		width: 400px;
		height: 34px;
	}
		
</style>
<div id="header">
	<div id="logo">
		<?php Views::img("logo_admin", "poof_logo_admin.jpg"); ?>
	</div>
</div>
<div class="clear"></div>
</div>
<div id="top_bar_logo"></div>
<div id="page">
	<div id="content">
		<div id="login_box">
			<div id="login_box_top"></div>
			<div id="login_box_content">
				<form action="index.php?p=admin" method="post">				
				Username: <input type="text" name="admin_user">  <br/><br/><br/>
				Password: <input type="password" name="admin_pass"> <br/><br/><br/>
				<input type="image" src="include/image/admin_login.jpg">
				</form> 
			</div>
			<div id="login_box_bottom"></div>
		</div>
	</div>
</div>
