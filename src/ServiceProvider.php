<?php

namespace Allswap\CryptoValidator;

use Statamic\Providers\AddonServiceProvider;
use Illuminate\Support\Facades\Validator;
use Allswap\CryptoValidator\Rules\CryptoAddressRule;
use Allswap\CryptoValidator\Modifiers\CryptoAddressModifier;

class ServiceProvider extends AddonServiceProvider
{
    protected $modifiers = [
        CryptoAddressModifier::class,
    ];

    public function bootAddon()
    {
        Validator::extend('crypto_address', function ($attribute, $value, $parameters, $validator) {
            $chain = $parameters[0] ?? 'any';
            return (new CryptoAddressRule($chain))->passes($attribute, $value);
        }, 'The :attribute must be a valid cryptocurrency address.');
    }
}
