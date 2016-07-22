# Winguweb Integration

* Winguweb website integration with Salesforce org
* Uses HTML, CSS, PHP, SOAP, jQuery, Apex, Visualforce, SOQL

You can view the WinguWeb website here.

Form 1
---
<img src="https://raw.github.com/elizabethtian/winguweb-integration/master/img/form1.png"/>

####Direct integration:

Files:
* subscribe.php, form.html, candidatos.csv

   These files contain the HTML, CSS references, and JavaScript for direct website integration. The form is connected to the PHP file subscribe.php, which uses the Salesforce SOAP API and the PHP toolkit to connect to a Salesforce org. The file queries the database using SOQL for email matching and subsequently adds a new Lead record in Salesforce if no email already exists. subscribe.php also adds information to the CSV file candidatos.csv as new Lead records are added.

Note: País is a dropdown menu.

####Using an iFrame:

Files:
* WinguSignup.vfp, WinguSignup.apxc, Success.vfp

   These files are Visualforce and Apex files for the form; they can be needed hosted on a Force.com personal site and integrated into the website using an iframe. After signing up, user information will be stored in the database (if the email address does not exist in the database prior to signup). The page will then redirect and display the success page.

####Success page:

<img src="https://raw.github.com/elizabethtian/winguweb-integration/master/img/form1success.png"/>

Form 2
---
<img src="https://raw.github.com/elizabethtian/winguweb-integration/master/img/form2.png"/>

####Direct integration:

Files:
* subscribe.php, form2.html, asuntos.csv, email.php, email.html

   These files contain the HTML, JavaScript, and CSS for form two, which allows anyone to contact Wingu with an "asunto" (question/issue). The form is connected to the PHP file subscribe.php,  which uses the Salesforce SOAP API and the PHP toolkit to connect to a Salesforce org. The file queries the database using SOQL for email matching and subsequently adds a new Lead if no email already exists. subscribe.php adds information to the CSV file candidatos.csv as new Lead records are added and adds "asunto" information to the CSV file asuntos.csv each time the form is filled out. subscribe.php also sends a HTML formatted email (which can be found in email.php and email.html) to info@winguweb.org with the issue information. 

Note: País is a dropdown menu.

####Email: 

<img src="https://raw.github.com/elizabethtian/winguweb-integration/master/img/email.png" height=300px/>

