<div id="page">
	<div id="content">
		<div id="admin_box">
			<div id="admin_box_title_red"></div>
			<div id="admin_box_content_red">
				<?php echo system::$lang->admin["admin_index_top"]; ?>
			</div>
		</div>	

		<div id="admin_box">
			<div id="admin_box_title"><?php echo system::$lang->admin["General_Information"]; ?></div>
			<div id="admin_box_content">				
				<div class="left" style="width: 600px"><dl>
					<dt><?php echo system::$lang->admin[":PooF_version"]; ?>:</dt>
					<dd>
						PooF <?php echo _POOF_VERSION; ?> <br/>
						&copy; Copyright 2011 Loris Mich - License GNU GPL V3
						
					</dd>
					<dt><?php echo system::$lang->admin["Environment"]; ?>:</dt>
					<dd>
						<?php echo PHP_OS ?><br />
						<?php echo phpversion(); ?><br />
					</dd>
					<dt><?php echo system::$lang->admin["Database"]; ?>:</dt>
					<dd>
						<?php echo _DB_TYPE ?><br />
						<?php echo _DB_HOST; ?><br />
					</dd>
				</dl></div>
				<div class="left" style="padding: 50 0 0 100;">
					<a href="http://www.gnu.org/licenses/gpl-3.0.html" target="_blank"><img src="include/image/gpl.png"></a>
				</div>
				<div class="clear"></div>
			</div>
		</div>	

		<div id="admin_box">
			<div id="admin_box_title">:PooF Information</div>
			<div id="admin_box_content">				
				<div class="left" style="width: 530px;"><dl>
					<dt>Log File:</dt>
					<dd>
						<?php echo _LOG_FILE; ?> <br/>
					</dd>
					<dt>Path Controllers:</dt>
					<dd>
						<?php echo _CONTROLLER_PATH; ?><br/>
					</dd>
					<dt>Path Views:</dt>
					<dd>
						<?php echo _VIEW_PATH; ?><br/>
					</dd>
					<dt>Path Models:</dt>
					<dd>
						<?php echo _MODELS_PATH; ?><br/>
					</dd>
					<dt>Path Templates:</dt>
					<dd>
						<?php echo _TEMPLATE_PATH; ?><br/>
					</dd>
					<dt>Path Global Object:</dt>
					<dd>
						<?php echo _GLOBAL_OBJECT_PATH; ?><br/>
					</dd>
					<dt>Path Multilang:</dt>
					<dd>
						<?php echo _MULTILANG_FILE; ?><br/>
					</dd>
					<dt>Path Images:</dt>
					<dd>
						<?php echo _IMG_PATH; ?><br/>
					</dd>
				</dl></div>
				<div class="left" style="width: 420px;">
					<dl>
						<dt>Virtual Function:</dt>
						<dd>
							<?php echo _VIRTUAL_FUNCTION_ENABLE; ?> <br/>
						</dd>
						<dt>Admin Deviation:</dt>
						<dd>
							<?php echo _ADMIN_DEVIATION_NAME; ?> <br/>
						</dd>
						<dt>Configuration Table:</dt>
						<dd>
							<?php echo _DYNAMIC_CONFIGURATION_TABLE; ?> <br/>
						</dd>
						<dt>Load Args into Vars:</dt>
						<dd>
							<?php echo _LOAD_ARGS_INTO_VARS; ?> <br/>
						</dd>
						<dt>Ob Start:</dt>
						<dd>
							<?php echo _OB_START; ?> <br/>
						</dd>
						<dt>Rewrite Output:</dt>
						<dd>
							<?php echo _REWRITE_OUTPUT; ?> <br/>
						</dd>
						<dt>Default Controller:</dt>
						<dd>
							<?php echo _DEFAULT_CONTROLLER; ?> <br/>
						</dd>
						<dt>Safe POST:</dt>
						<dd>
							<?php echo _SAFE_POST; ?> <br/>
						</dd>
					</dl>
				</div>
				<div class="clear"></div>
			</div>
		</div>	
	</div>
</div>
<div id="top_bar_logo" style="margin-top: 20px"></div>
