<?php

require __DIR__ . '/../../../vendor/autoload.php';
use Symfony\Component\Process\Process;

// Function to download and install WordPress
function installLatestWordPress($path = 'public_html', $locale = 'en_US') {
    try {
        #region Check if wp-cli is installed
        echo "Checking if wp-cli is installed...\n";
        $process = new Process(['C:/Users/jalal/bin/wp', '--version']); // Replace with your wp-cli.phar path
        $process->setTimeout(120); // Set timeout to 2 minutes
        $process->run();
        if (!$process->isSuccessful()) {
            throw new Exception("Error checking wp-cli: " . $process->getErrorOutput());
        } else {
            echo "wp-cli is installed.\n";
        }
        #endregion

        #region Ensure the path exists
        if (!is_dir($path)) {
            echo "Creating directory: $path\n";
            mkdir($path, 0777, true);
        }
        #endregion

        #region Lookup for the wp-config.php file inside the path, if it exists, then the installation is already done
        if (file_exists($path . '/wp-config.php')) {
            echo "WordPress is already installed in the specified path: $path\n";
            return;
        }
        #endregion

                # Download WordPress
                echo "Downloading WordPress...\n";
                $process = new Process(['curl', '-o', $path . '/latest.zip', 'https://wordpress.org/latest.zip']);
                $process->setTimeout(300); // Set timeout to 5 minutes
                $process->run(function ($type, $buffer) {
                    echo " > $buffer\n";
                });
                if (!$process->isSuccessful()) {
                    throw new Exception("Error downloading WordPress: " . $process->getErrorOutput());
                } else {
                    echo "WordPress downloaded successfully.\n";
                }
        
                # Unzip downloaded file (assuming it's a zip archive)
                echo "Extracting WordPress files...\n";
                $downloadedFile = "$path/latest.zip"; // Modify filename if different
                if (!file_exists($downloadedFile)) {
                    throw new Exception("Downloaded file not found: $downloadedFile");
                }
                $zip = new ZipArchive();
                if ($zip->open($downloadedFile) !== TRUE) {
                    throw new Exception("Could not open zip archive: $downloadedFile");
                }
        
                $zip->extractTo($path);
                $zip->close();
                echo "WordPress files extracted successfully.\n";

                
        # Move extracted WordPress files to the public_html directory
        echo "Moving WordPress files to public_html directory...\n";
        $wordpressDir = $path . '/wordpress';
        $targetDir = $path; // Assuming you want the WordPress files directly in the public_html directory
        if (is_dir($wordpressDir)) {
            move_all_files($wordpressDir, $targetDir); // Recursively move files within subdirectories
            if (is_dir($wordpressDir)) {
                rmdir($wordpressDir); // Remove the original wordpress directory
            }
            echo "WordPress files moved successfully.\n";
        } else {
            echo "Warning: WordPress directory not found: $wordpressDir\n";
        }

        // #region Download WordPress core files directly using wp-cli
        // echo "Downloading WordPress core files...\n";
        // $process = new Process(['C:/Users/jalal/bin/wp', 'core', 'download', '--locale=' . $locale, '--path=' . $path]); // Replace with your wp-cli.phar path
        // $process->setTimeout(300); // Set timeout to 5 minutes
        // $process->run(function ($type, $buffer) {
        //     echo " > $buffer\n";
        // });
        // if (!$process->isSuccessful()) {
        //     throw new Exception("Error downloading WordPress core files: " . $process->getErrorOutput());
        // } else {
        //     echo "WordPress core files downloaded successfully.\n";
        // }
        // #endregion

        #region Create the database if it does not exist
        echo "Creating database if it does not exist...\n";
        $mysqlPath = 'C:/xampp/mysql/bin/mysql.exe'; // Modify path if different
        $process = new Process([$mysqlPath, '-u', 'root', '-e', 'CREATE DATABASE IF NOT EXISTS wordpress;']);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new Exception("Error creating database: " . $process->getErrorOutput());
        } else {
            echo "Database created or already exists.\n";
        }
        #endregion

        #region Create wp-config.php file if it doesn't exist
        if (!file_exists($path . '/wp-config.php')) {
            echo "Creating wp-config.php file...\n";

            $extraPhp = <<<'PHP'
define('WP_DEBUG', false);
PHP;
            $process = new Process([
                'C:/Users/jalal/bin/wp', 'config', 'create', 
                '--dbname=wordpress', 
                '--dbuser=root', 
                '--dbpass=', 
                '--dbhost=localhost', 
                '--dbcharset=utf8mb4', 
                '--dbcollate=', 
                '--path=' . $path,
                '--extra-php=' . $extraPhp
            ]);
            $process->run();
            if (!$process->isSuccessful()) {
                throw new Exception("Error creating wp-config.php: " . $process->getErrorOutput());
            } else {
                echo "wp-config.php created successfully.\n";
            }
        } else {
            echo "wp-config.php already exists. Skipping creation.\n";
        }
        #endregion

        #region Basic installation using wp-cli
        echo "Installing WordPress...\n";
        $process = new Process(['C:/Users/jalal/bin/wp', 'core', 'install', '--url=http://localhost:8080/wp-installer/public_html/', '--title=My WordPress Site', '--admin_user=admin', '--admin_password=password', '--admin_email=admin@example.com', '--locale=' . $locale, '--path=' . $path]); // Replace with your wp-cli.phar path
        $process->run(function ($type, $buffer) {
            echo " > $buffer\n";
        });
        if (!$process->isSuccessful()) {
            throw new Exception("Error installing WordPress: " . $process->getErrorOutput());
        } else {
            echo "WordPress installed successfully.\n";
        }
        #endregion

    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}

// Function to recursively move files and subdirectories
function move_all_files($source, $destination) {
    if (!is_dir($destination)) {
        mkdir($destination, 0777, true);
    }
    $files = scandir($source);
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;
        $source_file = $source . '/' . $file;
        $destination_file = $destination . '/' . $file;
        if (is_dir($source_file)) {
            move_all_files($source_file, $destination_file); // Recursively move files within subdirectories
        } else {
            rename($source_file, $destination_file);
        }
    }
    if (is_dir($source)) {
        rmdir($source); // Remove the source directory after moving all files
    }
}
// Call the function to initiate installation
installLatestWordPress();
?>

