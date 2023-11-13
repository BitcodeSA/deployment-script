<?php

namespace BitcodeSA\DeploymentScript;

use BitcodeSA\DeploymentScript\Commands\DeploymentScriptCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DeploymentScriptServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('deployment-script')
            ->hasConfigFile()
            ->hasCommand(DeploymentScriptCommand::class);
    }
}
