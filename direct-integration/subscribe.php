<?php

/*
 * PHP handler that takes both form1 and form2 information when filled and integrates
 * with salesforce using the SOAP API and the PHP toolkit. 
 * 
 * Form One: Queries Salesforce database to check if the subscriber email already exists.
 * If email does not exist, creates a new Lead, adds form information to candidatos.csv,
 * and refreshes the form page with a success alert; if email does exist, refreshes
 * the form page with an error alert.
 * 
 * Form Two: Queries Salesforce database to check if the subscriber email already exists.
 * If email does not exist, creates a new Lead and adds form information to candidatos.csv.
 * Regardless if the email exists in the database, it adds form and "asunto" (issue)
 * information to asuntos.csv, sends an HTML formatted email to info@winguweb.org with
 * the issue information, and refreshes the page with a success message.
 * 
 * Created by: Elizabeth Tian, ©2016
 *
 */

ob_start();

  // SOAP_CLIENT_BASEDIR - folder that contains the PHP Toolkit and your WSDL
define("SOAP_CLIENT_BASEDIR", "soapclient");

//Fill in Salesforce username, password, and security token
define("USERNAME", '');
define("PASSWORD", '');
define("SECURITY_TOKEN", '');

require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
require_once (SOAP_CLIENT_BASEDIR.'/SforceHeaderOptions.php');
require_once ('./misc/globalconstants.php');
// require 'PHPMailer-master/PHPMailerAutoload.php';
// require_once ('../userAuth.php');

try {

  // login
  $mySforceConnection = new SforceEnterpriseClient();

  // Fill in your Salesforce WSDL here - e.g. 'wsdl.jsp.xml'
  $mySoapClient = $mySforceConnection->createConnection('');
  $mylogin = $mySforceConnection->login(USERNAME, PASSWORD . SECURITY_TOKEN);

  // check if form ONE has been filled out
  if(isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["company"]) && isset($_POST["email"]) && isset($_POST["country"])) {
    // query if email is already in database
    $email = $_POST["email"];
    $query = 'SELECT Id,Email FROM Lead';
    $query .= sprintf(" WHERE Email ='%s'", $email);
    $response = $mySforceConnection->query(($query));

    // if it is not, create a new Lead and add to csv file
    if ($response->size == 0) {
      $nombre = $_POST["nombre"];
      $apellido = $_POST["apellido"];
      $company = $_POST["company"];
      $country = $_POST["country"];

      // create new lead
      $sObject = new stdclass();
      $sObject->FirstName = $nombre;
      $sObject->LastName = $apellido;
      $sObject->Company = $company;
      $sObject->Email = $email;
      $sObject->Country__c = $country;
      
      $createResponse = $mySforceConnection->create(array($sObject), 'Lead');

      // add to csv file
      $csvdata = $nombre.",".$apellido.",".$email.",".$company.",".$country;
      $fp = fopen("candidatos.csv", "a");
      if ($fp) {
        fwrite($fp, $csvdata."\n");
        fclose($fp);
      }
      // direct back to form page with success
      header('location: form.html?success=1');
    } else {
      // direct back to form page with fail
      header('location: form.html?success=0');
    }
  }

  // check if form TWO has been filled out
  if(isset($_POST["write_nombre"]) && isset($_POST["write_apellido"]) && isset($_POST["write_company"]) && isset($_POST["write_email"]) && isset($_POST["write_country"]) && isset($_POST["write_asunto"]) && isset($_POST["write_mensaje"])) {
    echo "this"; 
    // set variables
    $write_nombre = $_POST["write_nombre"];
    $write_apellido = $_POST["write_apellido"];
    $write_company = $_POST["write_company"];
    $write_country = $_POST["write_country"];
    $write_asunto = $_POST["write_asunto"];
    $write_mensaje = $_POST["write_mensaje"];

    // query if email is already in database
    $write_email = $_POST["write_email"];
    $write_query = 'SELECT Id,Email FROM Lead';
    $write_query .= sprintf(" WHERE Email ='%s'", $write_email);
    $write_response = $mySforceConnection->query(($write_query));

    if ($write_response->size == 0) {
      // create new lead
      $sObject = new stdclass();
      $sObject->FirstName = $write_nombre;
      $sObject->LastName = $write_apellido;
      $sObject->Company = $write_company;
      $sObject->Email = $write_email;
      $sObject->Country__c = $write_country;
      
      $createResponse = $mySforceConnection->create(array($sObject), 'Lead');

      // add to csv file
      $write_csvdata = $write_nombre.",".$write_apellido.",".$write_email.",".$write_company.",".$write_country;
      $write_fp = fopen("candidatos.csv", "a");
      if ($write_fp) {
        fwrite($write_fp, $write_csvdata."\n");
        fclose($write_fp);
      }

    } else {
      // don't add a new lead
    }
    // add all questions to csv file
    $write_asuntodata = $write_nombre.",".$write_apellido.",".$write_email.",".$write_company.",".$write_country.",".$write_asunto.",".$write_mensaje;
      $fpasunto = fopen("asuntos.csv", "a");
      if ($fpasunto) {
        fwrite($fpasunto, $write_asuntodata."\n");
        fclose($fpasunto);
      }

    // use PHP Mailer if needed instead of mail()
    $header = "From: noreply@example.com\r\n"; 
    $header.= "MIME-Version: 1.0\r\n"; 
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $header.= "X-Priority: 1\r\n";  
    $subject = "Nuevo asunto desde Winguweb";
    // message in html
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
    // $message = wordwrap($message, 70, "\r\n");
    $to = "info@winguweb.org";

    $sent = mail($to, $subject, $message, $header);
  
    if ($sent) {
      // direct back to form page with success
      header('location: form2.html?success=1');
    } else {
      // direct back to form page with fail
      header('location: form2.html?success=0');
    }
  }

} catch (Exception $e) {
  print_r($mySforceConnection->getLastRequest());
  echo $e->faultstring;
}

?>