<?php
// config for BitcodeSA/DeploymentScript
return [
    "commands" => [
        [
            "type" => "console",
            "command" => "git pull"
        ],
        [
            "type" => "console",
            "command" => "composer install --optimize-autoloader",
        ],
        [
            "type" => "artisan",
            "command" => "migrate",
            "values" => [
                "--force" => true
            ]
        ],
        [
            "type" => "artisan",
            "command" => "cache:clear",
        ],
    ]
];
