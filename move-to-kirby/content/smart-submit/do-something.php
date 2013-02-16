<?php 

header('Content-type: application/json');


//validate using Kirby toolkit
$errors = array();
if (!get('name'))            	{ die('{"error":"Please enter your name."}'); }
if (!v::email(get('email'))) 	{ die('{"error":"Please enter valid e-mail address."}'); }
if (!get('text'))            	{ die('{"error":"Message is required."}'); }

// .....
// do actual work here! Send email, add info to database, whatever.
// .....


die('{"success":"Form has been submitted! Woo-hoo! Here is what you submitted: '.addslashes(serialize(get())).'"}');
