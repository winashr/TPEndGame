<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'edu-web-app');

// Repository configuration
set('repository', 'git@github.com:winashr/TPEndGame.git'); // Replace with your Git repo

// Shared files/dirs between deploys (e.g., .env, Docker volumes)
add('shared_files', ['.env']);
add('shared_dirs', ['var/dbdata']); // If your DB data is stored here

// Hosts (your production server)
host('localhost')
    ->set('remote_user', 'deploy')
    ->set('deploy_path', '/var/www/{{application}}');

// Tasks

// Build Docker containers on the server
task('docker:up', function () {
    run('cd {{release_path}} && docker-compose up -d --build');
});

// Main deployment task
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',   // Runs `composer install`
    'docker:up',        // Rebuild Docker containers
    'deploy:unlock',
    'cleanup',
]);

// Fail on deployment errors
after('deploy:failed', 'deploy:unlock');