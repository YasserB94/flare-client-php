<?php

namespace Spatie\FlareClient\Senders;

use Spatie\FlareClient\Senders\Support\JsonEncodableSanitizer;

abstract class AbstractSender implements Sender
{
    protected $shouldSanitizePayloads = false;

    public function __construct(
        protected array $config = [],
        protected readonly PayloadSanitizer $sanitizer = new JsonEncodableSanitizer
    ) {
        //
    }

    public function sanitizePayloads(bool $sanitize = true): Sender
    {
        $this->shouldSanitizePayloads = $sanitize;

        return $this;
    }

    /**
     * Sanitizes the payload when applicable
     */
    protected function preparePayloadForEncoding(array $payload): array
    {
        if ($this->shouldSanitizePayloads) {
            return $this->sanitizer->sanitize($payload);
        }

        return $payload;
    }
}
