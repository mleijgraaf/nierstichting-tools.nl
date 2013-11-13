<!doctype html>
<?php if ($facebook == true) { $class = " style=\"background:none;\""; } else { $class = ""; } ?>    
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"<?php echo $class; ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"<?php echo $class; ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"<?php echo $class; ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"<?php echo $class; ?>> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		
		<title>Nierstichting</title>
		
	    <meta name="description" content="">
	    <meta name="author" content="">
	    
	    <link href="/css/stylesheet.css" rel="stylesheet">
	    <link rel="stylesheet" href="/fancybox/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
		
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		
	    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	    <!--[if lt IE 9]>
	      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->

		<meta property="og:url" content="https://nierstichting-tools.nl"/>
		<meta property="og:title" content="Receptenboekje"/>
		<meta property="og:image" content="https://nierstichting-tools.nl/Facebook_200x200.png"/>
		<meta property="og:site_name" content="Koken met minder zout, net zo lekker"/>
		<meta property="og:description" content="Minder zout eten is net zo lekker en beter voor je nieren. Download het receptenboekje!"/>


	</head>
	<?php if ($facebook == true) { $class = " style=\"background:none;\""; } else { $class = ""; } ?>
	<body<?php echo $class; ?>>
	    
	    

	<div id="fb-root"></div>
	<script>
	    
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '<?= $this->config->item("app_id"); ?>', // App ID
	      status     : true, // check login status
	      cookie     : true, // enable cookies to allow the server to access the session
	      xfbml      : true  // parse XFBML
	    });
	    
	    FB.Canvas.setAutoGrow();
	    
	    FB.Event.subscribe('edge.create', function(href, widget) {
	     _gaq.push(['_trackEvent', 'Facebook', 'Like', href]);
	    });   

	    // Additional initialization code here
	    
	    
	  };

	  // Load the SDK Asynchronously
	  (function(d){
	     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement('script'); js.id = id; js.async = true;
	     js.src = "//connect.facebook.net/nl_NL/all.js";
	     ref.parentNode.insertBefore(js, ref);
	   }(document));
	   
	</script>

	<?php if ($facebook == true) { $class = " style=\"width: 810px;height:1393px;\""; } else { $class = ""; } ?>
	    	
        <div class="container"<?php echo $class; ?>>

	<?php if ($facebook == true) { $class = " style=\"display: none\""; } else { $class = ""; } ?>
	
	    <div class="content-left"<?php echo $class; ?>></div>
	    
	    <div class="content-middle">