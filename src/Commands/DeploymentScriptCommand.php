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
        foreach (config('deployment-script.commands') as $command) {
            if (is_array($command)) {
                if (key_exists("command", $command)) {
                    if (key_exists("type", $command)) {
                        if ($command['type'] == 'artisan') {
                            if (key_exists("values", $command)) {
                                $this->call($command['command'], $command['values']);
                            } else {
                                $this->call($command['command']);
                            }
                        } elseif ($command['type'] == 'console') {
                            $this->info(Process::run($command['command'])->output());
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
}
