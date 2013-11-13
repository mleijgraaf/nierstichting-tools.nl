<?php

	error_reporting(E_ALL ^ E_NOTICE);
	
	$path = dirname(__FILE__) . '/';

    $ci_index = $path . 'index.php';

    define('CRON_CI_INDEX', '/home/niertools/domains/nierstichting-tools.nl/public_html/index.php');   // Your CodeIgniter main index.php file
   // define('CRON_CI_INDEX', $ci_index);   // Your CodeIgniter main index.php file
    define('CRON', TRUE);   // Test for this in your controllers if you only want them accessible via cron


	$value = '/dotasks';


# Set run time limit
    set_time_limit(0);


    $_SERVER['PATH_INFO'] = $value;
    $_SERVER['REQUEST_URI'] = $value;
    $required['--run'] = TRUE;

# Run CI and capture the output
    ob_start();



    chdir(dirname(CRON_CI_INDEX));
    require(CRON_CI_INDEX);           // Main CI index.php file
    $output = ob_get_contents();
    
	ob_end_clean();
   


# Log the results of this run
    
    error_log("### ".date('Y-m-d H:i:s')." cron.php \n", 3, $path.'logfile.txt');
    error_log($output, 3, $path.'logfile.txt');
    error_log("\n### \n\n", 3, $path.'logfile.txt');
    


echo "\n\n";

?> 