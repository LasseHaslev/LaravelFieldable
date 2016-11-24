# lassehaslev/fieldable

## Install
``` bash
composer require lassehaslev/laravel-fieldable
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
#### Install dependencies
``` bash
# Install dependencies
composer install

# Install dependencies for automatic tests
yarn
```

#### Runing tests
``` bash
# Run one time
npm run test

# Automaticly run test on changes
npm run dev
```
