

function validateEmail(elementValue){      
   var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
   return emailPattern.test(elementValue); 
 } 

function shareOnFacebook() {

    FB.ui(
    {
	method: 'feed',
	link: 'https://nierstichting-tools.nl/redirect?utm_source=facebook.com&utm_medium=CPC&utm_campaign=downloadboekje&utm_content=receptenboekje',
	picture: 'https://nierstichting-tools.nl/Facebook_200x200.png',
	name: 'Koken met minder zout, net zo lekker',
	caption: '',
	description: 'Minder zout eten is net zo lekker en beter voor je nieren. Download het receptenboekje!'
	},
    
    function(response) {
	
	if (response && response.post_id) {
	    addShare('https://nierstichting-tools.nl/redirect?utm_source=facebook.com&utm_medium=CPC&utm_campaign=downloadboekje&utm_content=receptenboekje');
	}
    
    }

);



}

$(function(){

	// tekstvak limit plugin
	// usage: $('element').limiter('100', $('countelement'));
    $.fn.extend( {
        limiter: function(limit, elem) {
            $(this).on("keyup focus", function() {
                setCount(this, elem);
            });
            function setCount(src, elem) {
                var chars = src.value.length;
                if (chars > limit) {
                    src.value = src.value.substr(0, limit);
                    chars = limit;
                }
                elem.html( limit - chars );
            }
            setCount($(this)[0], elem);
        }
    });


	$('a.connect').click(function(){
				
		FB.login(function(response) {
			
			if (response.authResponse)
			{
				FB.api('/me', function(response) {
					window.location.href="/volgendepagina";
				});
			}
			
			else
			{
				alert('U moet de app toestaan om verder te kunnen gaan.');
			}
			
		}, {scope: 'email'});

		return false;
		
	});


    $('#submit').click(function(){

    	var error = false;
        

    	var voornaam = $('#voornaam').val();
    	var achternaam = $('#achternaam').val();
    	var postcode = $('#postcode').val();
    	var huisnummer = $('#huisnummer').val();
    	var adres = $('#adres').val();
    	var plaats = $('#plaats').val();
    	var email = $('#email').val();
        var optin = $('#optin').prop('checked');
        
        
        
    	if( voornaam == '' ) { error = true; }
    	if( achternaam == '' ) { error = true; }
    	if( postcode == '' ) { error = true; }
    	if( huisnummer == '' ) { error = true; }
    	if( adres == '' ) { error = true; }
    	if( plaats == '' ) { error = true; }
    	if( optin != true ) { error = true; }        
    	if( !validateEmail(email) ) { error = true; }

        
      var geslacht = $('input[name=geslacht]').is(':checked');
      
        
        if (geslacht == false)
    	{
    		error = true;
    	}      
        


    	if(error == true)
    	{
    		alert('vul alle verplichte velden in a.u.b.');
    	}
    	else
    	{

    	var data = $('#form1').serialize();
        

    		$.ajax({
    			type: 'GET',
    			data: data,
    			url: '/ajax/postform',
                        dataType: 'json',
    			success: function(result)
    			{
                              
     				if(result.error == false)
    				{
    					window.location = '/bedankt/';
    				}
    				else
    				{
                                       if (result.html == 'bestaat_al') {
                                          
                                          alert('Dit e-mailadres heeft al een keer meegedaan');
                                       } else {
                                          alert('De gegevens konden niet worden opgeslagen');
                                       }
    				}
    			}
    		});

    	}
        
        


    	return false;

    });
    
    

    $('a.sharebutton').click(function(){
        _gaq.push(['_trackEvent', 'facebook', 'facebook share', 'Deel deze actie']);
    });



 if ($('.autocomplete').length > 0) {  $('.autocomplete').applyAutocomplete();  }


      
   $("#see-actievoorwaarden").fancybox({
	width : 900,
	height : 500,
	fitToView : false,
	autoSize : false,
        type              : 'iframe'  
     });
 
     
 });