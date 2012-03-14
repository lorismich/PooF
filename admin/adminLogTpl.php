<div id="page">
	<div id="content">
		<div id="admin_box">
			<div id="admin_box_title"><?php echo system::$lang->admin["Log_File"]; ?></div>
			<div id="admin_box_content">				
				<div style="padding: 50 0 0 0;">
					<center><div style="color: red"><?php echo $message; ?></div></center><br>
					<center><textarea style="width: 800; height: 480px;"><?php echo $log_txt; ?></textarea></center>
					<form action="index.php?p=admin/log/sid=<?php echo $SID; ?>" method="post">
						<br><center><input type="submit" name="Delete_Log" value="Delete Log">
					</form>
				</div>
				<div class="clear"></div>
			</div>
		</div>	
	</div>
</div>
<div id="top_bar_logo" style="margin-top: 20px"></div>
