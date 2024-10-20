<?php
require_once __DIR__ . '/../src/JsonMapper.php';
require_once '../../../../../presale - Copy/vendor/netresearch/jsonmapper/example/Contact.php';
require_once '../../../../../presale - Copy/vendor/netresearch/jsonmapper/example/Address.php';

$json = json_decode(file_get_contents(__DIR__ . '/single.json'));

$mapper = new JsonMapper();
$contact = $mapper->map($json, new Contact());

$coords = $contact->address->getGeoCoords();

echo $contact->name . ' lives at coordinates '
    . $coords['lat'] . ',' . $coords['lon'] . "\n";
?>