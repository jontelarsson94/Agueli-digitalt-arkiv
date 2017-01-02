<?php
/**
 * Configuration file for CSRF Protector z
 */
return array(
	"CSRFP_TOKEN" => "aguelicsrf",
	"logDirectory" => "../log",
	"failedAuthAction" => array(
		"GET" => 0,
		"POST" => 0),
	"errorRedirectionPage" => "http://localhost:8888/Agueli-digitalt-arkiv/arkiv/articles.php",
	"customErrorMessage" => "You are not authenticated",
	"jsPath" => "../js/csrfprotector.js",
	"jsUrl" => "http://localhost:8888/Agueli-digitalt-arkiv/arkiv/csrfp/js/csrfprotector.js", //Need to change this when changing server for project
	"tokenLength" => 10,
	"disabledJavascriptMessage" => "This site attempts to protect users against <a href=\"https://www.owasp.org/index.php/Cross-Site_Request_Forgery_%28CSRF%29\">
	Cross-Site Request Forgeries </a> attacks. In order to do so, you must have JavaScript enabled in your web browser otherwise this site will fail to work correctly for you.
	 See details of your web browser for how to enable JavaScript.",
	 "verifyGetFor" => array()
);
