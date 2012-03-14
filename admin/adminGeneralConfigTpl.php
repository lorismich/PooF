<div id="page">
	<div id="content">
		<div id="admin_box">
			<div id="admin_box_title_red"></div>
			<div id="admin_box_content_red">
				In this area you can configure the general parameters of the framework,you can find the other parameters in the configuration files.
				<br>Changing the configuration of the framework can be dangerous ,before change it you should always do a complete backup.	
			</div>
		</div>	

		<div id="admin_box">
			<div id="admin_box_title"><?php echo system::$lang->admin["General_Configuration"]; ?></div>
			<div id="admin_box_content">				
			<form action="index.php?<?php echo _GET_PAGE_NAME; ?>=admin/generalConfig/sid=<?php echo $SID; ?>" method="post">							
				<div class="left" style="width: 460px"><dl>
					<dt>Site Name</dt>
					<dd>
						<input type="text" name="_SITE_NAME" value="<?php echo _SITE_NAME; ?>">
					</dd>
					<dt>Default Controller</dt>
					<dd>
						<input type="text" name="_DEFAULT_CONTROLLER" value="<?php echo $GLOBALS['_configTable']['_DEFAULT_CONTROLLER']; ?>">
					</dd>
					<dt>Controller 404</dt>
					<dd>
						<input type="text" name="_CONTROLLER_404" value="<?php echo $GLOBALS['_configTable']['_CONTROLLER_404']; ?>">
					</dd>
					<dt>Image Path</dt>
					<dd>
						<input type="text" name="_IMG_PATH" value="<?php echo $GLOBALS['_configTable']['_IMG_PATH']; ?>">
					</dd>
					<dt>Multi Lang Cookie</dt>
					<dd>
						<input type="text" name="_NAME_COOKIE_MULTILANG" value="<?php echo $GLOBALS['_configTable']['_NAME_COOKIE_MULTILANG']; ?>">
					</dd>
					
					<br>
					<dt>Ob Start</dt>
					<dd>
						<?php 
							if($GLOBALS['_configTable']['_OB_START'])						
								echo '<input type="checkbox" name="_OB_START" value="true" checked>';
							else
								echo '<input type="checkbox" name="_OB_START" value="true" >';
						?>
						</dd>
				</dl></div>
				<div class="left" style="width: 490px"><dl>
					<dt>Get Page Name</dt>
					<dd>
						<input type="text" name="_GET_PAGE_NAME" value="<?php echo $GLOBALS['_configTable']['_GET_PAGE_NAME']; ?>">
					</dd>
					
					<dt>Multilang Res. Path</dt>
					<dd>
						<input type="text" name="_MULTILANG_FILE" value="<?php echo $GLOBALS['_configTable']['_MULTILANG_FILE']; ?>">
					</dd>
					<dt>Default Res. Lang</dt>
					<dd>
						<input type="text" name="_MULTILANG_DEFAULT" value="<?php echo $GLOBALS['_configTable']['_MULTILANG_DEFAULT']; ?>">
					</dd>
					<dt>Refresh SID Time</dt>
					<dd>
						<input type="text" name="_REFRESH_SID" value="<?php echo $GLOBALS['_configTable']['_REFRESH_SID']; ?>">
					</dd>
					<dt>Default Language</dt>
					<dd>
						<input type="text" name="_DEFAULT_LANG" value="<?php echo $GLOBALS['_configTable']['_DEFAULT_LANG']; ?>">
					</dd><br>
					<dt>Rewrite Output</dt>
					<dd>
						<?php 
							if($GLOBALS['_configTable']['_REWRITE_OUTPUT'])						
								echo '<input type="checkbox" name="_REWRITE_OUTPUT" value="true" checked>';
							else
								echo '<input type="checkbox" name="_REWRITE_OUTPUT" value="true">';
						?>
					</dd>
					
				</dl><br><br></div>
				<br>
				<center><input type="submit" name="submit" value="Change Configuration"></center>
			</form>
			<div class="clear"></div>
			</div>
			<div id="admin_box">
			<div id="admin_box_title"><?php echo system::$lang->admin["Router_Configuration"]; ?></div>
				<form action="index.php?<?php echo _GET_PAGE_NAME; ?>=admin/generalConfig/sid=<?php echo $SID; ?>" method="post">					
				<div id="admin_box_content">	
					<dl>
					<dt>Path Error Controller</dt>
					<dd>
						<input type="text" name="_CONTROLLER_PATH_ROUTER" value="<?php echo $txt_path_router; ?>">
					</dd><br>
					<dt>Router Deviation</dt>
					<dd>
						<textarea name="_router_deviation" rows="4" cols="45"><?php echo $txt_router_deviation; ?></textarea>
					</dd>
					<dt>Router Ban IP</dt>
					<dd>
						<textarea name="_router_bans_ip" rows="4" cols="45"><?php echo $txt_router_bans_ip; ?></textarea>
					</dd><br>
					<center><input type="submit" name="submit_router" value="Change Router Configuration"></center>				
				</div>	
				</form>
			</div>
		</div>	
	</div>
</div>
<div id="top_bar_logo" style="margin-top: 20px"></div>
