<?php

require __DIR__ . '/../../../vendor/autoload.php';
use Symfony\Component\Process\Process;

// Function to download and extract WordPress
function installLatestWordPress($path = 'public_html', $locale = 'en_US', $db_password = '') {
    try {

#region Check if wp-cli is installed
        //check if wp-cli is installed
        echo "Checking if wp-cli is installed...\n";
        $process = new Process(['C:/Users/jalal/bin/wp', '--version']);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new Exception("Error checking wp-cli: " . $process->getErrorOutput());
        } else {
            echo "wp-cli is installed.\n";
        }
#endregion


        // Ensure the path exists
        if (!is_dir($path)) {
            echo "Creating directory: $path\n";
            mkdir($path, 0777, true);
        }




        // Execute the 'wp core download' command
        $process = new Process(['wp', 'core', 'download', '--path=' . $path, '--locale=' . $locale]);
        
        // $dbpass = "";
        // $process = new Process([ 'wp', 'core', 'create' ,
        //     '--path=' . $path,
        //     '--url=http://localhost:8080',
        //     '--title=WP Store',
        //     '--admin_user=admin',
        //     '--admin_password=admin',
        //     '--admin_email=admin@gmail.com',
        //     '--locale=' . $locale,
        //     '--dbname=wp_store',
        //     '--dbuser=root'
        //     // '--dbpass=' . $db_password 
        //   ]);

        $process->run(function ($type, $buffer) {
          echo "This block is executed and the output is printed on the screen\n";
            if (Process::ERR === $type) {
                echo " > $buffer\n";
            } else {
                echo " > $buffer\n";
            }
        });

        // Check for errors
        if (!$process->isSuccessful()) {
            echo "The wordpress download failed!\n";
            throw new Exception("Error downloading WordPress: " . $process->getErrorOutput());
        } else {
            echo "WordPress downloaded successfully.\n";
        }

        // Optionally extract the downloaded WordPress files if necessary
        // Add your extraction logic here if needed

    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}

// Call the function to initiate installation
installLatestWordPress();
?>
