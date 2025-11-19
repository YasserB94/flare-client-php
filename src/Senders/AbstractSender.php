<?php

namespace Spatie\FlareClient\Senders;

use Spatie\FlareClient\Senders\Support\JsonEncodableSanitizer;

abstract class AbstractSender implements Sender
{
    protected $shouldSanitizePayloads;

    /**
     * @param  array<string,mixed>  $config
     */
    public function __construct(
        protected array $config = [],
        protected readonly PayloadSanitizer $sanitizer = new JsonEncodableSanitizer
    ) {
        $this->shouldSanitizePayloads = $this->config['sanitize_malformed_data'] ?? false;
        //
    }

    public function sanitizePayloads(bool $sanitize = true): Sender
    {
        $this->shouldSanitizePayloads = $sanitize;

        return $this;
    }

    /**
     * Sanitizes the payload when applicable
     *
     * @template K of array-key
     *
     * @param  array<K,mixed>  $payload
     * @return array<K,mixed>
     */
    protected function preparePayloadForEncoding(array $payload): array
    {
        if ($this->shouldSanitizePayloads) {
            return $this->sanitizer->sanitize($payload);
        }

        return $payload;
    }
}
