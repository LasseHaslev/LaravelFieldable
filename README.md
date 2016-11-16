# lassehaslev/fieldable

## Install
``` bash
composer require lassehaslev/fieldable
```

## Usage
## API
#### FieldType
``` php
// Add new FieldType
$fieldType = FieldType::add([
    'name'=>'FieldType name',
    'view'=>'rellative path from config( 'fieldable.views.fields' )'
]);
```

## Development
``` bash
# Install dependencies
composer install
```
