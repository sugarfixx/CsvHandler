# CSV Handler

Easy conversion from CSV file to php array or array of objects

### Installation


To require service into existing project, add this to composer.json
````
{
    "repositories": [
      {
        "type": "vcs",
        "url": "git@github.com:sugarfixx/csvhandler.git"
      }
    ]   
}
````

Run
```angular2html
composer require sugarfixx/csvhandler
```
Or if you are starting a blank project from a clean composer.json
```angular2html

{
    "require": {
            "sugarfixx/handler":"0.1"
        },
        "repositories": [
          {
            "type": "vcs",
            "url": "git@github.com:sugarfixx/csvhandler.git"
          }
        ]   
    }
}
```


Run
```angular2html
composer require sugarfixx/kafkaservice
```


#### Usage example
```php
use CsvHandler\CsvHandler

// set the file
$file = 'sample.csv';

// set mapping default returnes as source
$mapping = [
    'oldFieldName' =>'newFieldName'
];

// set return as array of objects (default = true)
$returnObjects = true // false return assoc array

// set delimeter default is , comma
 $delimeter = ';';


$csvHandler = new CsvHandler( $file, $mapping);

$csvHandler->getData();


```
