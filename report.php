<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Καταγγελίες Πολιτών</title>
        <link type="text/css" rel="stylesheet" href="stylesheet.css">
		<script src='https://www.google.com/recaptcha/api.js?hl=el'></script>
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
				
				<form action = "validate.php" method = "post">
					<table id="resultTable">  
						<tr>
							<th class="resultData" colspan="2">
								Στοιχεία Πολίτη
							</th>
						</tr>
                        <tr>
                            <td class="resultData">
                                Όνομα: &nbsp; <input type="text" name="cname" required>
                            </td>
                            <td class="resultData">
                                Επώνυμο: <input type="text" name="csurname" required>
                            </td>							
                        </tr>
						<tr>
                            <td class="resultData">
                                Email: &nbsp;&nbsp;&nbsp; <input type="email" name="cemail" required>
                            </td>
                            <td class="resultData">
                                Κινητό: &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="cmobile" required>
                            </td>							
                        </tr>
					</table>
					<br>
					<table id="resultTable">  
						<tr>
							<th class="resultData" colspan="2">
								Πληροφορίες για το περιστατικό
							</th>
						</tr>
                        <tr>
                            <td class="resultData" colspan="2" >
                                Διεύθυνση: &nbsp; <input type="text" name="cstreet" size="50" required>
                            </td> 
							
                        </tr>
						<tr>
                            <td class="resultData" colspan="2">
                                Αριθμός: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="cstreetnumber" required>
                            </td>                            						
                        </tr>
						<tr>
                            <td class="resultData" colspan="2">
                                ΤΚ: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="ctk" required>
                            </td>                            						
                        </tr>
						<tr>
                            <td class="resultData" colspan="2">
                                <textarea type="textarea" name="ccomplaint" rows="8" cols="58" placeholder="Πληκτρολογήστε εδώ το περιστατικό..." required></textarea>
                            </td>                            						
                        </tr>
					</table>
					<br>
					<div class="g-recaptcha" data-sitekey="6LcHMBQTAAAAAJD4NoynjvN629xn3J9MFyC-hZit"></div>
					<br>					
					<p><input type="submit" value="Αποθήκευση"></p>
					<input type="hidden" name="formsubmitted" value="formsubmitted">
				</form>
				<br>
			</div>
		</div>
	</body>
</html>