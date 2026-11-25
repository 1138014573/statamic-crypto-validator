<?php

namespace Allswap\CryptoValidator\Rules;

use Illuminate\Contracts\Validation\Rule;

class CryptoAddressRule implements Rule
{
    protected string $chain;

    public function __construct(string $chain = 'any')
    {
        $this->chain = strtolower($chain);
    }

    public function passes($attribute, $value): bool
    {
        if (!is_string($value) || trim($value) === '') {
            return false;
        }

        $address = trim($value);

        switch ($this->chain) {
            case 'btc':
            case 'bitcoin':
                return self::isBitcoinAddress($address);

            case 'eth':
            case 'evm':
            case 'bsc':
            case 'polygon':
            case 'arbitrum':
            case 'base':
                return self::isEvmAddress($address);

            case 'sol':
            case 'solana':
                return self::isSolanaAddress($address);

            case 'ton':
                return self::isTonAddress($address);

            case 'trx':
            case 'tron':
                return self::isTronAddress($address);

            case 'any':
            default:
                return self::isBitcoinAddress($address)
                    || self::isEvmAddress($address)
                    || self::isSolanaAddress($address)
                    || self::isTonAddress($address)
                    || self::isTronAddress($address);
        }
    }

    public function message(): string
    {
        return 'The :attribute is not a valid ' . strtoupper($this->chain) . ' address.';
    }

    public static function isEvmAddress(string $address): bool
    {
        return (bool)preg_match('/^0x[a-fA-F0-9]{40}$/', $address);
    }

    public static function isBitcoinAddress(string $address): bool
    {
        if (preg_match('/^bc1[a-z0-9]{39,59}$/i', $address)) {
            return true;
        }
        if (preg_match('/^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$/', $address)) {
            return true;
        }
        return false;
    }

    public static function isSolanaAddress(string $address): bool
    {
        return (bool)preg_match('/^[1-9A-HJ-NP-Za-km-z]{32,44}$/', $address);
    }

    public static function isTronAddress(string $address): bool
    {
        return (bool)preg_match('/^T[a-km-zA-HJ-NP-Z1-9]{33}$/', $address);
    }

    public static function isTonAddress(string $address): bool
    {
        if (preg_match('/^[EU]Q[a-zA-Z0-9_\-]{46}$/', $address)) {
            return true;
        }
        if (preg_match('/^-?[0-9]:[a-fA-F0-9]{64}$/', $address)) {
            return true;
        }
        return false;
    }
}
