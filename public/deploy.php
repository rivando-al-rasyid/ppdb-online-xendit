<?php

// Base path where the symlinks will be created
$basePath = '/home/user/public_html/';

// Get all files and directories inside /home/user/laravel/public/
$originalPaths = glob('/home/user/laravel/public/*');

foreach ($originalPaths as $originalPath) {
    // Extract the name of the file or directory
    $name = basename($originalPath);
    
    // Define the symlink path
    $symlinkPath = $basePath . $name;

    // Create the symlink
    if (symlink($originalPath, $symlinkPath)) {
        echo "Symlink for $originalPath created successfully at $symlinkPath\n";
    } else {
        echo "Failed to create symlink for $originalPath\n";
    }
}
?>
