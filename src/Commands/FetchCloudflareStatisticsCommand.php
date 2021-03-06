<?php

namespace OwenVoke\CloudflareStatsTile\Commands;

use Illuminate\Console\Command;
use OwenVoke\CloudflareStatsTile\CloudflareStatsStore;
use OwenVoke\CloudflareStatsTile\Services\Cloudflare;

class FetchCloudflareStatisticsCommand extends Command
{
    /** {@inheritdoc} */
    protected $signature = 'dashboard:fetch-cloudflare-statistics';

    /** {@inheritdoc} */
    protected $description = 'Fetch Cloudflare statistics';

    public function handle(): void
    {
        $this->info('Fetching Cloudflare statistics');

        $statistics = Cloudflare::getDomainStatistics(
            config('dashboard.tiles.cloudflare_stats.key'),
            config('dashboard.tiles.cloudflare_stats.email'),
            config('dashboard.tiles.cloudflare_stats.domains')
        );

        CloudflareStatsStore::make()->setDomainStatistics($statistics);

        $this->info('All done!');
    }
}
