## PHP wrapper for Overheid.io

Require this package via composer.

	composer require webeau/overheid-io


For all options visit: https://overheid.io/documentatie

### Examples Kvk API

```php
use Webeau\Ovio\Kvk;
 
// Initiation with API key from overheid.io
$ovio = new Kvk($api_key);
 
// Get company info by kvk number
$data = $ovio->get('35012085');
 
// Search by postal code
$data = $ovio->search(['filter' => ['postcode' => '3083cz'], 'order' => 'desc']);
 
// Simple search by postal code
$data = $ovio->searchBy('postcode', '3083cz');
 
// Get suggestions for given search string
$data = $ovio->suggest('oudet', ['size' => 10, 'fields' => ['handelsnaam', 'straat', 'dossiernummer']])

```


### Examples Rdw API

```php
use Webeau\Ovio\Rdw;
 
// Initiation with API key from overheid.io
$ovio = new Rdw($api_key);
 
// Get car info by registration number
$data = $ovio->get('AB-12-CD');
 
// Search by type
$data = $ovio->search(['filter' => ['merk' => 'bmw'], 'order' => 'desc']);
 
// Simple search by type
$data = $ovio->searchBy('merk', 'bmw');

```

### Example paging (all APIs)

```php
$data = $ovio->search([
	'filter' => ['merk' => 'bmw'],
	'order' => 'desc',
	'page' => 1
]);
 
// After performing api call you can use
// $ovio->next();
// $ovio->prev();
// $ovio->first();
// $ovio->last();
// to fetch next page
 
$data = $ovio->next();
```

## Repo by Webeau
[Visit our website](https://webeau.nl)

## License

The MIT License (MIT).