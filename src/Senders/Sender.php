<?php

namespace Spatie\FlareClient\Senders;

use Closure;
use Spatie\FlareClient\Enums\FlarePayloadType;
use Spatie\FlareClient\Senders\Support\Response;

interface Sender
{
    /**
     * @param  Closure(Response): void  $callback
     */
    public function post(
        string $endpoint,
        string $apiToken,
        array $payload,
        FlarePayloadType $type,
        Closure $callback,
    ): void;

    /**
     * Whether to sanitize payloads before sending.
     *
     * Enabling this will recursively strip any malformed UTF-8 data from the given payload.
     */
    public function sanitizePayloads(bool $sanitize = true): Sender;
}
