<?php

require __DIR__ . '/../../../vendor/autoload.php';
use Symfony\Component\Process\Process;

// Function to download and install WordPress
function installLatestWordPress($path = 'public_html', $locale = 'en_US', $db_password = '') {
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

    # Ensure the path exists
    if (!is_dir($path)) {
      echo "Creating directory: $path\n";
      mkdir($path, 0777, true);
    }

        # Check for existing WordPress files
        if (is_dir("$path/wp-admin") || is_file("$path/wp-config.php")) {
          echo "WordPress files seem to already be present. Skipping download.\n";
          return; // Exit the function if files exist
        }

    # Download WordPress
    echo "Downloading WordPress...\n";
    $process = new Process(['wp', 'core', 'download', '--path=' . $path, '--locale=' . $locale]);
    $process->setTimeout(300); // Set timeout to 5 minutes
    $process->run(function ($type, $buffer) {
      echo " > $buffer\n";
    });
    if (!$process->isSuccessful()) {
      if ($process->isRunning()) {
        echo "Error: Download timed out after " . $process->getTimeout() . " seconds.\n";
      } else {
        echo "Error downloading WordPress: " . $process->getErrorOutput();
      }
      throw new Exception("Download failed.");
    } else {
      echo "WordPress downloaded successfully.\n";
    }

    # Unzip downloaded file (assuming it's a zip archive)
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

    # Basic installation using wp-cli (modify as needed)
    echo "Installing WordPress...\n";
    $process = new Process(['wp', 'core', 'install', '--url=http://localhost:8080', '--title=My WordPress Site', '--admin_user=admin', '--admin_password=password', '--admin_email=admin@example.com', '--locale=' . $locale, '--path=' . $path]);
    if (!$db_password) {
      $process->run(); // No database password provided (handle accordingly)
    } else {
      $process->run(function ($type, $buffer) use ($db_password) {
        if (strpos($buffer, 'Enter your MySQL database password:') !== false) {
          echo "$db_password\n"; // Provide the database password during prompt
        } else {
          echo " > $buffer\n";
        }
      });
    }
    if (!$process->isSuccessful()) {
      echo "Error installing WordPress: " . $process->getErrorOutput();
      throw new Exception("Installation failed.");
    } else {
      echo "WordPress installed successfully.\n";
    }

  } catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
  }
}

// Call the function to initiate installation
installLatestWordPress();
?>
