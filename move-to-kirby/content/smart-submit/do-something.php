<?php 

header('Content-type: application/json');


//validate using Kirby toolkit
$errors = array();
if (!get('name'))            	{ die('{"error":"'.(l::get('error.name-required') ?: 'Please enter your name.').'"}'); }
if (!v::email(get('email'))) 	{ die('{"error":"'.(l::get('error.email-invalid') ?: 'Please enter valid e-mail address.').'"}'); }
if (!get('text'))            	{ die('{"error":"'.(l::get('error.message-required') ?: 'Message is required.').'"}'); }

// .....
// do actual work here! Send email, add info to database, whatever.
// .....


die('{"success":"Form has been submitted! Woo-hoo! Here is what you submitted: '.addslashes(serialize(get())).'"}');
