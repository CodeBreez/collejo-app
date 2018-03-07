<?php

namespace Collejo\App\Listeners;

use Cache;
use Collejo\App\Events\CriteriaDataChanged;
use DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Predis\Client as Redis;

class ClearCriteriaCache implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param CriteriaDataChanged $event
     *
     * @return void
     */
    public function handle(CriteriaDataChanged $event)
    {
        if ($event->model) {
            if (config('cache.default') == 'redis') {
                $this->flushRedisCache(get_class($event->model));
            } elseif (config('cache.default') == 'database') {
                $this->flushDatabaseCache(get_class($event->model));
            } else {
                Cache::flush();
            }
        }
    }

    private function flushDatabaseCache($pattern)
    {
        $connection = is_null(config('cache.stores.database.connection')) ? config('database.default') : config('cache.stores.database.connection');

        DB::connection($connection)
            ->table(config('cache.stores.database.table'))
            ->where('key', 'LIKE', '%'.str_replace('\\', '\\\\', $pattern).':%')
            ->delete();
    }

    private function flushRedisCache($pattern)
    {
        $config = config('database.redis.'.config('cache.stores.redis.connection'));

        $client = new Redis([
            'scheme'     => 'tcp',
            'host'       => $config['host'],
            'port'       => $config['port'],
            'parameters' => [
                'password' => $config['password'],
                'database' => $config['database'],
            ],
        ]);

        $keys = $client->keys('collejo:criteria:'.str_replace('\\', '\\\\', $pattern).':*');

        foreach ($keys as $key) {
            $client->del($key);
        }
    }
}
