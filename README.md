# oxid-customergraph
OXID eShop GraphQL ExtendType Example

# hkreuter/oxid-customergraph

[![Build Status](https://img.shields.io/travis/com/hkreuter/oxid-customergraph/master.svg?style=for-the-badge&logo=travis)](https://travis-ci.com/hkreuter/oxid-customergraph) [![PHP Version](https://img.shields.io/packagist/php-v/hkreuter/oxid-customergraph.svg?style=for-the-badge)](https://github.com/hkreuter/oxid-customergraph) [![Stable Version](https://img.shields.io/packagist/v/hkreuter/oxid-customergraph.svg?style=for-the-badge&label=latest)](https://packagist.org/packages/hkreuter/oxid-customergraph)

## Usage

This assumes you have the OXID eShop up and running and installed and activated the `oxid-esales/graphql-base`
and `oxid-esales/graphql-storefront` module.

### Install

```bash
$ composer require hkreuter/oxid-customergraph
```

After requiring the module, you need to head over to the OXID eShop admin and
activate the module.

### How to use

As customer I want to set as short (e.g max 254 characters) 'about me' description which is stored in
an extra field in the oxuser table. Use ExtendType to extend Storefront module's Customer DataType
so that the extra field can be queried in customer query.

```graphql
type Customer
{
    ...
    aboutme: String!
}

type Query {
    setAboutMe (
        aboutme: String
    ):  Customer!
}
```

## Testing

### Linting, syntax, static analysis and unit tests

```bash
$ composer test
```

### Integration tests

- install this module into a running OXID eShop
- change the `test_config.yml`
  - add module to the `partial_module_paths`
  - set `activate_all_modules` to `true`

```bash
$ ./vendor/bin/runtests
```

## License

GPLv3, see [LICENSE file](LICENSE).
