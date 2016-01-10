VAT Free Zones in the European Union
====================================

This is a simple class to check based on country/region ISO
and the zip/postal code if a place in the EU is considered
a tax free zone based on https://en.wikipedia.org/wiki/European_Union_value_added_tax.

Install via Composer

```json
{
    "require": {
        "koosh/vat-utility": "dev-master"
    }
}
```

Example usage

```php
use koosh\VATUtility;

if (EUVATFreeZone::isEUTaxFreeZone('FI', 22100)) {
    // Is VAT free zone.
} else {
    // Is not VAT free zone.
}
```
