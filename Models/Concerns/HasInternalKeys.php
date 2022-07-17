<?php

namespace App\Containers\Larabeans\Tenanter\Models\Concerns;

trait HasInternalKeys
{
    /**
     * Get the internal prefix.
     */
    public static function internalPrefix(): string
    {
        return 'tenancy_';
    }

    /**
     * Get an internal key.
     */
    public function getInternal(string $key)
    {
        return $this->getAttribute(static::internalPrefix() . $key);
    }

    /**
     * Set internal key.
     */
    public function setInternal(string $key, $value)
    {
        $this->setAttribute(static::internalPrefix() . $key, $value);

        return $this;
    }
}
