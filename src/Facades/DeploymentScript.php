<?php

namespace BitcodeSA\DeploymentScript\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \BitcodeSA\DeploymentScript\DeploymentScript
 */
class DeploymentScript extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \BitcodeSA\DeploymentScript\DeploymentScript::class;
    }
}
