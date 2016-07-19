# Winguweb Integration

* Winguweb website integration with Salesforce org
* Uses HTML, CSS, PHP, SOAP, jQuery, Apex, Visualforce, SOQL

You can view the WinguWeb website here.

Form 1
---
<img src="https://raw.github.com/elizabethtian/winguweb-integration/master/form1.png"/>

####Direct integration:

Files:
* A, B, C

   These files contain the HTML, CSS references, and jQuery for direct website integration. The form is connected to the php file, which uses the Salesforce SOAP API and the PHP toolkit to query the database for email checking and subsequently add a new Lead.
   The php file also writes the information down in the csv file as users subscribe.

Note: País is a dropdown menu.

####Using an iFrame:

Files:
* WinguSignup.vfp, WinguSignup.apxc, Success.vfp

   These files are Visualforce and Apex files for the form; they can be needed hosted on a Force.com personal site and integrated into the website using an iframe. After signing up, user information will be stored in the database (if the email address does not exist in the database prior to signup). The page will then redirect and display the success page.

Success page:

<img src="https://raw.github.com/elizabethtian/winguweb-integration/master/form1success.png"/>

Form 2
---
<img src="https://raw.github.com/elizabethtian/winguweb-integration/master/form2.png"/>

####Direct integration:

Files:
* A, B, C

Note: País is a dropdown menu.
