	<div id="menu">
		<?php Views::a("index.php", Views::img("home_menu", "menu/home_menu_gr.jpg", false, "img_roll_over('home_menu', 'include/image/menu/home_menu_rd.jpg');", "img_roll_over('home_menu', 'include/image/menu/home_menu_gr.jpg');"));	?>
		<?php Views::a("index.php?p=news", Views::img("news_menu", "menu/news_menu_gr.jpg", false, "img_roll_over('news_menu', 'include/image/menu/news_menu_rd.jpg');", "img_roll_over('news_menu', 'include/image/menu/news_menu_gr.jpg');"));	?>
		<?php Views::a("index.php?p=about", Views::img("about_menu", "menu/about_menu_gr.jpg", false));	?>
		<?php Views::a("#", Views::img("doc_menu", "menu/doc_menu_gr.jpg", false, "img_roll_over('doc_menu', 'include/image/menu/doc_menu_rd.jpg');", "img_roll_over('doc_menu', 'include/image/menu/doc_menu_gr.jpg');"));	?>
		<?php Views::a("index.php?p=contact", Views::img("contact_menu", "menu/contact_menu_rd.jpg", false, "img_roll_over('contact_menu', 'include/image/menu/contact_menu_rd.jpg');", "img_roll_over('contact_menu', 'include/image/menu/contact_menu_rd.jpg');"));	?>
	</div>
	<div class="clear"></div>
	</div>
	<div id="top_bar_logo"></div>
	<div id="page">
		<div id="content">
			<div id="top_image">
				<?php Views::img("frase2", "frase2.jpg"); ?>
			</div>
			<div class="bar_dotted"></div>
			<div id="box_left" style="width: 250px">
				<div class="title1" id="title_home">Contact</div>
				<div class="text1" style="margin-top: 40px; padding-left: 50px;">
					<?php Views::img("me", "me.jpg"); ?>	<br><br><br>
					<center><?php Views::img("php_logo", "php_logo.png"); ?></center>	<br>
					<center><?php Views::img("apache_logo", "apache_logo.jpg"); ?></center>	<br>
					<center><?php Views::img("mysql_logo", "mysql_logo.gif"); ?></center>	<br><br>
					<center><?php Views::img("android_logo", "android_logo.png"); ?></center>	<br>
				</div>
			</div>	
			<div id="box_left">
				<div style="margin-top: 80px; padding-left: 80px; ">
					<b>Name:</b>: Loris <br><br>
					<b>Nickname:</b>: !D4ng3R! <br><br>
					<b>Surname:</b>: Mich <br><br><br>
					<b>Email:</b>: <i>d4ng3r92[at]facebook[dot]com</i><br><br><br><br>

					<div class="title2" id="title_home">About d4ng3r:</div>
					I am Loris Mich a web-programmer and web-designer. I was born 18 years ago in Cavalese and 3 years ago I started develop web sites.<br>
					I studied html for static pages, css for the page layout, php for dynamic pages and SQL for the database.<br>
					I also develop in Phython, JavaScript and C# and I work in a differet operating system: Windolws, MacOS and Linux.<br>
					I just started to study the development on Android for the smartphone applcation.<br>
					<br><br>
					<div class="title2" id="title_home">Main knowledge:</div>
					<ul id="knowledge">
						<li style="list-style-type:disc;">Cross Browser Web Site Developement</li>
						<li style="list-style-type:disc;">PHP, ASP.NET and Javascript Programming</li>
						<li style="list-style-type:disc;">Microsoft C# and Python Programming</li>
						<li style="list-style-type:disc;">Windows, Linux, Mac Administration</li>
						<li style="list-style-type:disc;">MySql and Firebird Design and Programming</li>
						<li style="list-style-type:disc;">Apache and IIS Administration</li>
						<li style="list-style-type:disc;">Android Developer</li>
					</ul>
					<br><br>
					<div class="title2" id="title_home">Contact me on:</div><br>
					<a href="http://www.facebook.com/D4ng3R92" target="_black"><?php Views::img("facebook_logo", "facebook_logo.png"); ?></a><span style="margin-left: 50px"><a href="http://www.linkedin.com/in/d4ng3r92" target="_black"><?php Views::img("linkedin_logo", "linkedIn_logo.png"); ?></span></a><br>
				</div>	
			</div>
			<div class="clear"></div>
			
		</div>
	</div>	
