<!-- 
    Documentação Recaptcha V2 
    https://developers.google.com/recaptcha/docs/display
-->
<html>
  <head>
    <title>reCAPTCHA</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <form action="?" method="POST">
      <div class="g-recaptcha" data-sitekey="your_site_key"></div>
      <br/>
      <input type="submit" name="submit" value="Submit">
    </form>
  </body>
</html>

<?php 

    if(isset($_POST['submit'])):

    // INICIANDO UMA REQUISIÇÃO COM GOOGLE
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 
	    // DADOS A SEREM ENVIADOS
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
             'secret' => 'SECRET_KEY',
             'response' => $_POST['g-recaptcha-response'],
             'remoteip' => $_SERVER['REMOTE_ADDR']
         )));
 
         // RECUPERANDO OS DADOS
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $recaptcha = json_decode(curl_exec($ch), true);
 
         curl_close($ch);

        if($recaptcha['success'] == false):
        
           echo 'Confirme o recaptcha.';
        
        endif;    

    endif;    

?>