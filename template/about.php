<?php 
/*
echo $txt;
echo '<br>';
echo $this->system->secure_link($controller="home",$method="hg", $label="Secure Link"); 
*/
?>
	<div id="menu">
		<?php Views::a("index.php", Views::img("home_menu", "menu/home_menu_gr.jpg", false, "img_roll_over('home_menu', 'include/image/menu/home_menu_rd.jpg');", "img_roll_over('home_menu', 'include/image/menu/home_menu_gr.jpg');"));	?>
		<?php Views::a("index.php?p=news", Views::img("news_menu", "menu/news_menu_gr.jpg", false, "img_roll_over('news_menu', 'include/image/menu/news_menu_rd.jpg');", "img_roll_over('news_menu', 'include/image/menu/news_menu_gr.jpg');"));	?>
		<?php Views::a("index.php?p=about", Views::img("about_menu", "menu/about_menu_rd.jpg", false));	?>
		<?php Views::a("#", Views::img("doc_menu", "menu/doc_menu_gr.jpg", false, "img_roll_over('doc_menu', 'include/image/menu/doc_menu_rd.jpg');", "img_roll_over('doc_menu', 'include/image/menu/doc_menu_gr.jpg');"));	?>
		<?php Views::a("index.php?p=contact", Views::img("contact_menu", "menu//contact_menu_gr.jpg", false, "img_roll_over('contact_menu', 'include/image/menu/contact_menu_rd.jpg');", "img_roll_over('contact_menu', 'include/image/menu/contact_menu_gr.jpg');"));	?>
	</div>
	<div class="clear"></div>
	</div>
	<div id="top_bar_logo"></div>
	<div id="page">
		<div id="content">
			<div id="top_image">
				<?php Views::img("frase1", "frase1.jpg"); ?>
			</div>
			<div class="bar_dotted"></div>
			<div id="box_left">
				<div class="title1" id="title_home">Un nuovo framewok, :PooF!</div>
				<div class="text1">
					:PooF � un nuovo framework che segue il design pattern <i><b>MVC</b></i> ( Model - View - Controller ).
					Offre un valido supporto al programmatore per lo sviluppo di un sito web. Grazie all'utilizzo dei modelli, delle viste e dei controllori
					si pu� tenere separato l'elaborazione dei dati dalla loro visualizzazione in modo da poter riutilizzare il codice in pi� siti web senza riscrivere tutto da capo.
					Il cuore di :PooF st� nei "<i>GlobalObject</i>", oggetti disponibili in tutte le classi tutti altamente personalizzabili tramite i loro file
					di configurazione. Vengono gi� inclusi vari GlobalObject per: l'analisi statistica, la libreria grafica, la scrittura di file XML, la gestione degli utenti, l'autenticazione degli utenti, news ecc.
					:Poof pu� essere esteso con altri GlobalObject dal programmatore in modo facile e veloce e pu� essere configurato tramite i file di configurazione rendendo lo sviluppo di un sito web molto pi� semplice.
					Grazie all'analisi statistica dei dati il framework offre all'amministratore un valido supporto per capire: la velocit� del sito, i browser utilizzati, il tempo di visita di un utente, le pagine visitate e molte altre funzionalit&agrave;.
					
				</div>
			</div>	
			<div id="box_right">
				<div style="margin-top: 60px">
					<?php Views::img("libreria_grafica", "img_libreriagrafica.jpg"); ?>	
				</div>	
			</div>
			<div class="clear"></div>
			<div class="title1" id="title_home">La presentazione:</div><br>
			<center>
				<iframe src="https://docs.google.com/present/embed?id=dc7c3tsc_125q2zxhc" frameborder="0" width="410" height="342"></iframe>
			</center>			
			</div>
	</div>	
