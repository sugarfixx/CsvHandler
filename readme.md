# CSV Handler

Easy conversion from CSV file to php array or array of objects

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
