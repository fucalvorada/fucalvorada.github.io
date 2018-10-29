

<?php

function post_captcha($response){



	$fields = array(
		"secret"	=> '6Ld2LnYUAAAAAAytRHh2AqCAL6SuH4W7O25GEb3y',
		"response"	=> $response
	);

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($fields));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);


	$result = json_decode(curl_exec($curl));

	curl_close($curl);


	if(isset($result->success) && $result->success) {

		$json = ['result' => 'Seus dados foram salvos com sucesso'] ;

	} else {
		$json = ['result' => 'Por favor, tente novamente'] ;
	}

	echo json_encode($json);

}

$response = post_captcha( $_POST['token']); 

json_encode($response);


?>
