<?php

namespace Allswap\CryptoValidator\Modifiers;

use Statamic\Modifiers\Modifier;
use Allswap\CryptoValidator\Rules\CryptoAddressRule;

class CryptoAddressModifier extends Modifier
{
    protected static $aliases = ['is_crypto_address', 'valid_crypto'];

    public function index($value, $params, $context)
    {
        $chain = $params[0] ?? 'any';
        return (new CryptoAddressRule($chain))->passes('address', (string)$value);
    }
}
