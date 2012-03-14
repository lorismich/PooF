<style>
	#ddmenu {
		margin: 20 auto;
		padding: 0;
		text-align: center;
		width:900px;
	
	}
	
	#ddmenu li {	
		float: left;
		list-style: none;
		font: 11px Tahoma, Arial;
		width: 225px;
	}

	#ddmenu li a {	
		display: block;
		padding: 5px 12px;
		text-decoration: none;
		width: 225px;
		color: black;
		text-transform:uppercase;
		white-space: nowrap;
		text-align:center;
	}

	
	#ddmenu li ul {	
		margin: 3px 0 0 10px;
		padding: 0;
		position: absolute;
		visibility: hidden;
	}

	#ddmenu li ul li {	
		display:inline;
	}

	#ddmenu li ul li a {
		width: auto;	
		display: inline;
		color: black; 
		font-size: 10px;
		padding: 3px 10px;
	}

	#ddmenu li ul li a:hover {	
		padding: 3px 10px;
	}

	#admin_box_title_red {
		height: 15px;
		margin: 30 0 0 0;
		background-color: #860404;
	}

	#admin_box_content_red {
		border: 2px solid #4d4d4d;
		border-top: 0px;
		text-align: left;
		padding: 20 20 20 20;
		font-style: italic;
	}

	#admin_box_title {
		font-size: 12px;
		color: white;
		text-transform: uppercase;
		font-weight: bold;
		text-align: left;
		padding: 0 0 0 40;
		height: 15px;
		margin: 30 0 0 0;
		background-color: #4d4d4d;
	}

	#admin_box_content{
		border: 1px solid grey;
		border-top: 0px;
		text-align: left;
		padding: 20 20 20 20;
		font-style: italic;
	}

	ul {
		list-style-type: circle;
		padding-left: 50px;
	}

	dd {
		margin-left: 10px; 
		padding: 3px; 
		margin-bottom: 5px; 
		line-height: 1.5em
		font-size:18px;
	}
	
	dd a {
		color: black;
	}

	dt {
		float:left; 
		width: 150px; 
		padding: 3px; 
		line-height: 1.5em;
		font-weight: bold;
		font-size:13px;
	}

	dl {
		margin-left: 50px;
	}
</style>

<script type="text/javascript">
	// <![CDATA[
		var timeout    = 500;
		var closetimer = 0;
		var ddmenuitem = 0;
		
		function ddmenu_open(){
			ddmenu_canceltimer();
		   	ddmenu_close();
		   	ddmenuitem = $(this).find('ul').css('visibility', 'visible');
		}
		
		function ddmenu_close(){ 
			if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');
		}
		
		function ddmenu_timer(){
			closetimer = window.setTimeout(ddmenu_close, timeout);
		}
		
		function ddmenu_canceltimer(){  
			if(closetimer){  
				window.clearTimeout(closetimer);
		        closetimer = null;
		}}
		
		$(document).ready(function(){  
			$('#ddmenu > li').bind('mouseover', ddmenu_open)
		    $('#ddmenu > li').bind('mouseout',  ddmenu_timer)
		});
		
		document.onclick = ddmenu_close;
	// ]]>  
</script>

<div id="header">
	<div id="logo">
		<?php Views::img("logo_admin", "poof_logo_admin.jpg"); ?>
	</div>
</div>
<div class="clear"></div>
</div>
<div id="top_bar_logo"></div>
<ul id="ddmenu">
			<li><?php echo $this->system->secure_link("admin", "index", "Home"); ?></li>
			<li><a href="#">Configuration</a>
				<ul>
					<li><?php echo $this->system->secure_link("admin", "generalConfig", "General"); ?></li>
					<li><a href="#">Global Object</a></li>
				</ul>
			</li>
			<li><?php echo $this->system->secure_link("admin", "statistics", "Statistics"); ?></li>
			<li><?php echo $this->system->secure_link("admin", "log", "Log"); ?></li>
</ul>	
<div class="clear"></div>
