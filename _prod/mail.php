<?php
	
	if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["subject"]) && isset($_POST["comments"])) {
		
		// address and subject
		$formSubject = $_POST["subject"];
		$emailTo = "dan.zervoudakes@gmail.com";
		$emailSubject = "drzwebdev submission: $formSubject";
		
		// for redirect after form submission
		$homePage = "https://www.drzwebdev.com/?formSubmitted=true";
		
		// call form data
		$name = $_POST["name"];
		$emailFrom = $_POST["email"];
		$comments = $_POST["comments"];
		
		// begin message content
		$emailMessage = "New inquiry submitted.\n\n";
		
		function cleanString($string) {
			$bad = array("content-type", "bcc:", "to:", "cc:", "href");
			return str_replace($bad, "", $string);
		}
		
		// fill email content
		$emailMessage .= "Name: " . cleanString($name) . "\n";
		$emailMessage .= "Email: " . cleanString($emailFrom) . "\n";
		$emailMessage .= "Comments: " . cleanString($comments) . "\n";
		
		// create email headers
		$headers = "From: $emailFrom \r\nReply-To: $emailFrom \r\nX-Mailer: PHP/" . phpversion();
		
		// send email and redirect back to Home page
		@mail($emailTo, $emailSubject, $emailMessage, $headers);
		@header("Location: $homePage");
		
	}
	
?>