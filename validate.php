<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Καταγγελίες Πολιτών</title>
        <link type="text/css" rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <header>
            <img src="municipality.jpg" width="500" height="180">
        </header>            
		<div id="surroundingImage">
			<div id="content">
                <h1>
                    Δήμος Πειραιά
                </h1>

<?php

	$validTags = array("cname"=>"strLengthG2", "csurname"=>"strLengthG2", "cemail"=>"strEmail", 
	 "cmobile"=>"intG6899999999L7000000000", "cstreet"=>"strLengthG2", "cstreetnumber"=>"intGZL1000", 
	 "ctk"=>"intG17999L19000", "ccomplaint"=>"strLengthG9", "formsubmitted"=>"str", "g-recaptcha-response"=>"");
	$validMethod = "POST";
	$errMsg = "";
	
	function isValidRequest() {
	
		global $validTags;
		global $validMethod;   
		global $errMsg;   
		
		switch($_SERVER['REQUEST_METHOD'])	{
		   case "GET" :
		   {
			   $cnt = count($_GET);  
			   break;
		   }
	  
		   case "POST" :
		   {
			   $cnt = count($_POST); 
			   break;
		   }
		   default:
			   $cnt = -1;
		}
	  
		if($validMethod != $_SERVER['REQUEST_METHOD'])	{
		  $errMsg = "Λάθος στην μέθοδο της αίτησης.";           
		  return false;
		}
		
		 if($cnt != count($validTags))  {
			$errMsg = "Λάθος στο πλήθος των παραμέτρων της αίτησης.";
			return false;
		}
		
		 foreach($validTags as  $key => $value) {
		  if(isset($_POST[$key])) {
			 global ${$key};  
			 ${$key} = $_POST[$key];	
			 
			 switch($value) {
			   case "strLengthG2" :
			   {
				   ${$key} = filter_var(${$key}, FILTER_SANITIZE_STRING);				  
				   
				   switch ($key) {
						    case "cname":
								$errorField = "Όνομα";
								break;
							case "csurname":
								$errorField = "Επώνυμο";
								break;
							case "cstreet":
								$errorField = "Διεύθυνση";
								break;								
				   }				   
				   
				   if(mb_strlen(${$key}, 'UTF-8') <= 2) {
					   $errMsg = "Το πεδίο '" . $errorField ."' πρέπει να έχει πάνω από 2 χαρακτήρες.";           
					   return false; 
				   }			   
				   
				  if ($key == "cstreet") { /* Η διεύθυνση θα επιτρέπεται να έχει κενά και γράμματα (ελληνικά και λατινικά). */					   
					   if(!preg_match("/^[A-Za-z\x{0386}-\x{03CE}\s]+$/u", ${$key})) {
						   $errMsg = "Το πεδίο '" . $errorField ."' πρέπει να περιέχει μόνο γράμματα."; 
						   return false;						
				       }
				  } else { /* Το όνομα και το επώνυμο δεν επιτρέπεται να έχουν κενά. Μόνο γράμματα (ελληνικά και λατινικά). */
						/* if (!ctype_alpha(${$key})) { */
						if(!preg_match("/^[A-Za-z\x{0386}-\x{03CE}]+$/u", ${$key})) {
							$errMsg = "Το πεδίο '" . $errorField ."' πρέπει να περιέχει μόνο γράμματα."; 
							return false;						
						}
				  }			   
				   			   
				   break;
			   }
			   case "strEmail" :
			   {				   
				   ${$key} = filter_var(${$key}, FILTER_SANITIZE_EMAIL);				   
				   
				   if (!filter_var(${$key}, FILTER_VALIDATE_EMAIL)) {
					   $errMsg = "Το πεδίο 'Email' δεν είναι έγκυρο."; 
				       return false;
				   }
				   break;
			   }
			   case "intG6899999999L7000000000" :
			   {				  
				   if (empty(${$key})) {
					   $errMsg = "Το πεδίο 'Κινητό' δεν πρέπει να είναι κενό ή να περιέχει την τιμή μηδέν."; 
				       return false;
				   }
				   
				   if (!ctype_digit(${$key})) {
					   $errMsg = "Το πεδίο 'Κινητό' πρέπει να περιέχει μόνο αριθμούς (θετικούς)."; 
				       return false;
				   }
				   
				   if (${$key} < 6900000000 || ${$key} >= 7000000000) {
					   $errMsg = "Το πεδίο 'Κινητό' πρέπει να αρχίζει από 69 και να έχει 10 ψηφία."; 
				       return false;
				   }
				   break;
			   }
			   case "intGZL1000" :
			   {	
			       if (empty(${$key})) {
					   $errMsg = "Το πεδίο 'Αριθμός' δεν πρέπει να είναι κενό ή να περιέχει την τιμή μηδέν."; 
				       return false;
				   }
				   
				   if (!ctype_digit(${$key})) {
					   $errMsg = "Το πεδίο 'Αριθμός' πρέπει να περιέχει μόνο αριθμούς (θετικούς)."; 
				       return false;
				   }
				   
				   if (${$key} <=0 || ${$key} > 999) {
					   $errMsg = "Το πεδίο 'Αριθμός' πρέπει να είναι θετικός ακέραιος έως 3 ψηφία."; 
				       return false;
				   }
				   break;
			   }			   
			   case "intG17999L19000" :
			   {				   
				   if (empty(${$key})) {
					   $errMsg = "Το πεδίο 'TK' δεν πρέπει να είναι κενό ή να περιέχει την τιμή μηδέν."; 
				       return false;
				   }
				   
				   if (!ctype_digit(${$key})) {
					   $errMsg = "Το πεδίο 'ΤΚ' πρέπει να περιέχει μόνο αριθμούς (θετικούς)."; 
				       return false;
				   }
				   
				   if (${$key} <18000 || ${$key} >= 19000) {
					   $errMsg = "Το πεδίο 'ΤΚ' πρέπει να αρχίζει από 18 και να έχει 5 ψηφία."; 
				       return false;
				   }
				   break;
			   }
			   case "strLengthG9" :
			   {				      
				  ${$key} = filter_var(${$key}, FILTER_SANITIZE_STRING);				  
				   
				  if(mb_strlen(${$key}, 'UTF-8') <= 9) {
					   $errMsg = "Το πεδίο του περιστατικού πρέπει να έχει τουλάχιστον 10 χαρακτήρες.";           
					   return false; 
				   }
				   break;
			   }	
			 }
		  } else {
			 $errMsg = "Το πεδίο '" . $key . "' δεν είναι αποδεκτό.";           
			 return false; 
		  }
		}
		return true;

	}
	
	function isValidCaptcha() {
		global $captchaErrorMsg;
		require_once "recaptchalib.php";
			$secret = "6LcHMBQTAAAAAK02z-zGel7sGVyTT6yuPQxXmGAX";
			$response = null;
			$reCaptcha = new ReCaptcha($secret);
			if ($_POST["g-recaptcha-response"]) {
				$response = $reCaptcha->verifyResponse(
					$_SERVER["REMOTE_ADDR"],
					$_POST["g-recaptcha-response"]
				);
			}

			if ($response != null && $response->success) {
				return true;
			} else {
				$captchaErrorMsg = "Λάθος απάντηση στο πεδίο διαχωρισμού ανθρώπου/ρομπότ." . 
				"<br>Πατήστε Επιστροφή και δοκιμάστε ξανά.";				
				return false;
			} 
	}
	
		if (isset($_POST['formsubmitted']) && $_POST['formsubmitted'] == 'formsubmitted'){
			if (!isValidCaptcha()) {
				echo "<p>$captchaErrorMsg</p>";
				echo '<br><p><a class = "modified" href="report.php">Επιστροφή</a></p><br>';
				die();
			}
			
			if(!isValidRequest()) {
				echo "<p>$errMsg</p>";
				echo '<br><p><a class = "modified" href="report.php">Επιστροφή</a></p><br>';
				die();
			} else {
				/* Καθαρισμός για SQL injection και μετά εισαγωγή στην βάση δεδομένων. */
				
				/* Χρησιμοποιούμε το @ πριν την κλήση της mysqli_connect για να μην 
					εμφανιστούν πληροφορίες για το σφάλμα και την εφαρμογή μας σε δημόσια θέα. */
				$dbc = @mysqli_connect('localhost', 'piradmin', '1234', 'pirdb')
						or die('<p>Αποτυχία σύνδεσης με την βάση δεδομένων.</p><br><p><a class = "modified" href="report.php">Επιστροφή</a></p><br>');
				mysqli_query($dbc, "SET NAMES 'utf8'");
				
				/* H mysqli_set_charset χρειάζεται για να λειτουργήσει σωστά η mysqli_real_escape_string, 
					σύμφωνα με το documentation της PHP. */
				mysqli_set_charset($dbc, 'utf8');
				
				$cemail = mysqli_real_escape_string($dbc, $cemail);
				$cname = mysqli_real_escape_string($dbc, $cname);
				$csurname = mysqli_real_escape_string($dbc, $csurname);
				$cmobile = mysqli_real_escape_string($dbc, $cmobile);
				$cstreet = mysqli_real_escape_string($dbc, $cstreet);
				$cstreetnumber = mysqli_real_escape_string($dbc, $cstreetnumber);
				$ctk = mysqli_real_escape_string($dbc, $ctk);
				$ccomplaint = mysqli_real_escape_string($dbc, $ccomplaint);				
				
				mysqli_query($dbc, "SET @cemail = " . "'" . $cemail . "'");
				mysqli_query($dbc, "SET @cname = " . "'" . $cname . "'");
				mysqli_query($dbc, "SET @csurname = " . "'" . $csurname . "'");
				mysqli_query($dbc, "SET @cmobile = " . "'" . $cmobile . "'");
				mysqli_query($dbc, "SET @cstreet = " . "'" . $cstreet . "'");
				mysqli_query($dbc, "SET @cstreetnumber = " . "'" . $cstreetnumber . "'");
				mysqli_query($dbc, "SET @ctk = " . "'" . $ctk . "'");
				mysqli_query($dbc, "SET @ccomplaint = " . "'" . $ccomplaint . "'");
				
				if (mysqli_query($dbc, "Call addReport(@cemail, @cname, @csurname, @cmobile, @cstreet, " .
				"@cstreetnumber, @ctk, @ccomplaint)")) {
					echo "<p>Το περιστατικό καταχωρήθηκε με επιτυχία.</p>";
				} else {
					echo "<p>Σφάλμα κατά την καταχώρηση του περιστατικού στην βάση δεδομένων.</p>";
				}	
				
			}
		}
		
  ?>
				<br>
				<p><a class = "modified" href="report.php">Επιστροφή</a></p>
				<br>
			</div>
		</div>
	</body>
</html>