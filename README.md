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

// Get the full path to the field type view
// To overwrite the setting, edit fieldable.views.path in config/fieldable.php
$fieldType->viewPath();
```

## Development
``` bash
# Install dependencies
composer install
```
