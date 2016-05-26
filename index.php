<?php

	require 'config.php';
	
	//On GET, draw the page. On POST, send the email.
	
	$method = $_SERVER['REQUEST_METHOD'];
	if ($method == 'POST'){
			$success = do_email();

			$redirect = $success
				? from_request('redirect', 'success.htm')
				: from_request('error', 'error.htm');
			
			//Don't render the default page
			// Redirect to success or fail
			header("location: $redirect");
	}

	function do_email(){
	
		global $default_recipient;
		global $default_subject;
		global $bot_email;
		global $reply_to;
		
		$to      = $default_recipient;
		$subject = from_request('subject', $default_subject);
		$message = from_request('content', '[[Warning for administrator: Someone sent a POST request to the bot without a content parameter. Weird, huh.]]');
		$headers = "From: $bot_email \r\n" .
			"Reply-To: $reply_to\r\n" .
			'X-Mailer: PHP/' . phpversion();

		//echo "Sending $subject to $to\n----------\n$message\n----------\n$headers\n...";
		return mail($to, $subject, $message, $headers);
		//echo "\n\n...Sent!";
	}

	function from_request($k, $default){
		if (isset($_POST[$k])){
			return $_POST[$k] != ""
				? $_POST[$k]
				: $default;
		}
		elseif (isset($_GET[$k])){
			return $_GET[$k] != ""
				? $_GET[$k]
				: $default;
		}
		return $default;
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Haitatsunin on <?php echo $domain; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="hai.css">

</head>
<body>
	<div id="wrap">
		<h1>Hi, I'm Hai!</h1>
	</div>
	
	<img src="bot.png" id="bot" alt="Image of a robot with an envelope" />
	
	<p>Nice to meet you!</p>
	<p>My name is Haitatsunin, but you can call me Hai. I'm the messenger robot who sends emails on behalf of <?php echo $domain; ?>!</p>
	<p>Sorry, but there's nothing much to see here. You could press the Back button in your browser I suppose.</p>

	<p>
		<small>
		I was created by <a href="http://stegriff.co.uk">SteGriff</a> (@SteGriff)
		and I'm <a href="http://github.com/stegriff/hai">Open Source on Github</a>
		</small>
	</p>
	<p>&nbsp;</p>
	
</body>
</html>