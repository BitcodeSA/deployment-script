<?php

namespace BitcodeSA\DeploymentScript\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class DeploymentScriptCommand extends Command
{
    public $signature = 'deploy';

    public $description = 'Run The commands that are in the config file';

    public function handle(): int
    {
        if (config('deployment-script.allow_in_production', false)) {
            $this->error("Deploy Script is not allow in Production Environment");
            return self::FAILURE;
        }

        foreach ($this->getCommands() as $command) {
            if (is_array($command)) {
                if (key_exists("command", $command)) {
                    if (key_exists("type", $command)) {
                        if ($command['type'] == 'artisan') {
                            $this->runArtisanCommand($command);
                        } elseif ($command['type'] == 'console') {
                            $this->runConsoleCommand($command);
                        } else {
                            $this->error("Command type is not correct for: " . $command['command']);
                            sleep(1);
                        }
                    } else {
                        $this->error("Command type is not specified for: " . $command['command']);
                        sleep(1);
                    }
                } else {
                    $this->error("Command key is not specified for: " . implode(",", $command));
                    sleep(1);
                }
            } else {
                $this->error("Command structure is not correct for: " . $command);
                sleep(1);
            }
        }
        return self::SUCCESS;
    }

    protected function getCommands()
    {
        $command_array = "commands";

        if (app()->isProduction()) {
            $command_array = config('deployment-script.production', $command_array);
        }

        return config("deployment-script.$command_array", []);
    }

    protected function runArtisanCommand($command)
    {
        if (key_exists("values", $command)) {
            $this->call($command['command'], $command['values']);
        } else {
            $this->call($command['command']);
        }
    }

    protected function runConsoleCommand($command)
    {
        $this->info(Process::run($command['command'])->output());
    }
}
