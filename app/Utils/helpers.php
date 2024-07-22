<?php

use Hashids\Hashids;

if (! function_exists('hashIds')) {
    function hashIds(): Hashids
    {
        return new Hashids(salt: env('HASH_IDS_SALT'), minHashLength: env('HASH_IDS_MIN_LENGTH'));
    }
}

if (! function_exists('hashIdsEncode')) {
    /**
     * @throws \Throwable
     */
    function hashIdsEncode($value): ?string
    {
        try {
            return hashIds()->encode($value);
        } catch (Exception $e) {
            throw_if(app()->isLocal(), Exception::class, $e);

            return null;
        }
    }
}

if (! function_exists('hashIdsDecode')) {
    /**
     * @return int|mixed|null
     *
     * @throws \Throwable
     */
    function hashIdsDecode($value): mixed
    {
        if ($value === null) {
            return null;
        }

        try {
            return hashIds()->decode($value)[0];
        } catch (Exception $e) {
            throw_if(app()->isLocal(), Exception::class, $e);

            return null;
        }
    }
}
