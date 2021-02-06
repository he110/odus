<?php

declare(strict_types=1);

namespace App\Service\Channels;

use Generator;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;
use Telegram\Bot\Api as Client;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Objects\Update;

class TelegramService
{
    private const CACHE_KEY_LAST_ID = 'telegram_service_last_id';

    private Client $client;

    private CacheItemPoolInterface $cache;

    public function __construct(string $accessToken)
    {
        $this->client = new Client($accessToken);
    }

    /**
     * @required
     *
     * @param CacheItemPoolInterface $cache
     *
     * @return TelegramService
     */
    public function setCache(CacheItemPoolInterface $cache): self
    {
        $this->cache = $cache;

        return $this;
    }

    /**
     * @return Generator<Update>
     * @throws TelegramSDKException
     * @throws InvalidArgumentException
     */
    public function getUpdates(): Generator
    {
        $cachedId     = $this->cache->getItem(self::CACHE_KEY_LAST_ID);

        $lastUpdateId = $cachedId->isHit() ? $cachedId->get() : 0;

        $updates = $this->client->getUpdates([
            'offset' => $lastUpdateId
        ]);
        foreach ($updates as $update) {
            $updateId = $update->get('update_id');
            if ($updateId <= $lastUpdateId) {
                continue;
            }

            yield $update;
            $lastUpdateId = $updateId;
        }

        $cachedId->set($lastUpdateId);
        $this->cache->save($cachedId);
    }
}
