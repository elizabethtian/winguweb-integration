<?php
/*
 * PHP for the HTML formatted email sent to info@winguweb.org once form two is filled out.
 *
 * Created by: Elizabeth Tian, ©2016
 *
*/
	//example fields
	$write_nombre = "John";
	$write_apellido = "Doe";
	$write_email = "no-reply@example.com";
	$write_company = "Wingu";
	$write_country = "Argentina";
	$write_asunto = "Example Issue";
	$write_mensaje = "This is an example email!";

	//html email
	$message = '<html><body style="margin: 0; padding: 0;">';
    $message .= 
    '<table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
	   <td>
	    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
		 <tr>
		  <td bgcolor="#70bbd9" align="center" style="padding: 30px 0 20px 0;">
		   	<img src="WW/images/logo.png" style="display: block; height: 60%">
		  </td>
		 </tr>
		 <tr>
		  <td style="padding: 20px 0 20px 0;">
		  	<h2 style="padding: 0 0 0 20px;">Nuevo Asunto</h2>
			<p style="padding: 0 0 0 20px;">
				<strong>De:</strong> '.$write_nombre.' '.$write_apellido.'<br>
				<strong>Email:</strong> '.$write_email.'<br>
				<strong>Organización:</strong> '.$write_company.'<br>
			    <strong>País:</strong> '.$write_country.'<br>
			    <strong>Asunto:</strong> '.$write_asunto.'<br>
			    <strong>Mensaje:</strong> '.$write_mensaje.'
		    </p>
		  </td>
		 </tr>
		 <tr>
		  <td bgcolor="#70bbd9" style="padding: 20px 20px 20px 20px;">
		  </td>
		 </tr>
		</table>

	   </td>
	  </tr>
	 </table>';
    $message .= "</body></html>";

    // print out
    echo $message;

?>