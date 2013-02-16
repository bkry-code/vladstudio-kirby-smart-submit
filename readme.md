# Smart Submit

This is a plugin for [Kirby](http://getkirby.com/) that allows you to handle form submissions, without reloading the page. Honeypot spam protection is included.


## Installing and using

Note that Smart Submit is not usual plugin - meaning there is nothing to put into `plugins` folder!

* Put **smart-submit.js** whereever you like (f.e. in `assets/js/`).
* Put **smart-submit.php** in `site/templates/`.
* In your **content** folder, create folder `smart-submit`. Inside, create empty file `smart-submit.txt` (or whatever extension you use for content files, such as `.md`).
* This folder - `content/smart-submit/` - will also contain your submit handlers (php files). Read below for details.
* In your HTML head, include jQuery (latest please) and `smart-submit.js`. 

Example:

	// site/snippets/header.php
	echo js('//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
	echo js('assets/js/smart-submit.js');


* On your page (f.e. Contact Us), create a form. As fas as I understand Kirby, you can do is in either snippet or template. The following attributes are required for the form:

	* `id="smart-submit"`
	* `action="<?= url('smart-submit') ?>?handler=do-something"`

where `do-something` is the name of PHP handler script (described below), without `.php`.

Example:

	<form id="smart-submit" class="YOUR_CLASS_FOR_FORMS" action="<?= url('smart-submit') ?>?handler=do-something">
	…
	</form>

****

And now, the most interesting part! For every smart-submit form, you will need to create PHP handler. Simple rules:

* put it into `content/smart-submit/`.
* Name it according to the "handler" parameter you provided in form "action". In the example above, it would be `do-something.php`. 
* If you skip "handler" in the form (`action="<?= url('smart-submit') ?>"`), the plugin will search for handler PHP script by the last folder name in your page URL. F.e. if your form is at `http://mysite.com/about-me/contact/`, you should have `contact.php`.
* Inside this script, do whatever you want! Validate input, send emails, hack server, conquer the world. However, when you're done, you must output valid JSON:

	* `{"success":"Your success message"}`
	* `{"error":"Your error message"}`
	* `{"redirect":"/your/redirect/url"}`

It's good idea to include `header('Content-type: application/json');` in handler PHP file.

****	

I also recommend that you define the following CSS rules:

	form#smart-submit.disabled { opacity: 0.5; }
	smart-submit-alert {}
	smart-submit-alert-success {}
	smart-submit-alert-error {}
	
## How it works

Simply and elegantly! The JS script intercepts form submission event, and sends AJAX request to /content/smart-submit, which uses 'smart-submit' template, which calls the appropriate PHP handler from /content/smart-submit/ folder. When your PHP handler returns JSON (success/error/redirect), the returned message is shown above the form, or the page redirects.

## Honeypot

Honeypot is smart anti-spam solution included into Smart Submit plugin. Think of it as invisible Captcha! In short, it is a hidden field which counts seconds after the page has loaded. After form submission, if honeypot field < 2, Smart Submit returns anti-spam alarm.

## i18n

Here are the string you might want to translate if your site is multi-language:

	l::set('smart-submit-alarm', 'Anti-spam alarm. Please try again.');
	l::set('smart-submit-missing-handler', 'Error - handler not found. Please contact web site administrator for details.');

All other communation is defined by you in handler PHP files.
	

## Author

Author: Vlad Gerasimov <http://vladstudio.com> <vladstudio@gmail.com> 
