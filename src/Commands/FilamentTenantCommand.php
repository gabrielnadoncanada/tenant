<?php

namespace Devlense\FilamentTenant\Commands;

use Illuminate\Console\Command;

class FilamentTenantCommand extends Command
{
    public $signature = 'filament-tenant';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
