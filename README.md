# Statamic Multi-Chain Crypto Address Validator

A Statamic CMS addon developed by [AllSwap Protocol](https://allswap.io) for validating cryptocurrency wallet addresses.

## Features

- Validate Bitcoin (Legacy, SegWit, Taproot), EVM (Ethereum, BSC, Arbitrum, Base), Solana, TON, and TRON.
- Antlers template modifier `is_crypto_address`.
- Form validation rule `crypto_address`.

## Installation

```bash
composer require allswap/statamic-crypto-validator
```

## Antlers Usage

```antlers
{{ if wallet_address | is_crypto_address('evm') }}
  <span class="valid">Valid EVM Address</span>
{{ /if }}
```

## Official Links

- Website: https://allswap.io
- Documentation: https://allswap.io/docs
