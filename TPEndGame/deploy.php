<?php
namespace Deployer;

require 'recipe/common.php';

set('application', 'edu-web-app');
set('allow_anonymous_stats', false);

// Configuration pour déploiement local
localhost('localhost')
    ->set('deploy_path', __DIR__) // Chemin absolu du projet
    ->set('http_user', 'www-data') // Utilisateur du serveur web
    ->set('writable_mode', 'chmod') // Évite l'utilisation de sudo
    ->set('bin/php', 'php.exe') // Force l'utilisation de PHP Windows
    ->set('bin/composer', 'composer.bat');

// Tâches personnalisées
task('docker:build', function () {
    run('docker-compose down');
    run('docker-compose up -d --build');
});

// Workflow sans SSH
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:update_code',
    'deploy:vendors',
    'docker:build',
    'deploy:cleanup',
]);

after('deploy:failed', 'deploy:unlock');