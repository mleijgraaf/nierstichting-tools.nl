

		<div class="footer">
		  <div class="left">
		    Nierstichting © 2013
		  </div>
		  <div class="right">
		    <a href="/html/actievoorwaarden.html" id="see-actievoorwaarden">Actievoorwaarden</a>
		  </div>
		</div>

		</div>	<!-- / CONTAINER !-->


		<?php if ($this->config->item("live") == true) { ?>
		<!-- Google-code voor remarketingtag -->
		<!--------------------------------------------------
		Remarketingtags mogen niet worden gekoppeld aan gegevens waarmee iemand persoonlijk kan worden geïdentificeerd of op pagina's worden geplaatst die binnen gevoelige categorieën vallen. Meer informatie en instructies voor het instellen van de tag zijn te vinden op: http://google.com/ads/remarketingsetup
		--------------------------------------------------->
		<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 977736204;
		var google_custom_params = window.google_tag_params;
		var google_remarketing_only = true;
		/* ]]> */
		</script>
		<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
		</script>
		<noscript>
		<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/977736204/?value=0&amp;guid=ON&amp;script=0"/>
		</div>
		</noscript>

		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', '<?= $this->config->item("ua_code"); ?>']);
			<? if($this->session->userdata('utm_source') != '') : ?>
				_gaq.push(['_setCampNameKey', '<?=$this->session->userdata("utm_campaign");?>']);
				_gaq.push(['_setCampSourceKey', '<?=$this->session->userdata("utm_source");?>']);
				_gaq.push(['_setCampMediumKey', '<?=$this->session->userdata("utm_medium");?>']);
				_gaq.push(['_setCampContentKey', '<?=$this->session->userdata("utm_content");?>']);
			<? endif; ?>
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>

		<?php } ?>		

		<script src="/fancybox/jquery.fancybox.js"></script>
		<script src="/js/6pp.js"></script>
		<script src="/js/app.js"></script>
		


	
	</body>
</html>

