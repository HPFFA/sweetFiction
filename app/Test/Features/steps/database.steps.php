<?php

use Behat\Behat\Context\Step\Given,
    Behat\Behat\Context\Step\When,
    Behat\Behat\Context\Step\Then;

$steps->Given('/^there is a "([^"]*)":$/', function($world, $model, $table) 
{
  $hash = $table->getHash();
  $modelInstance = $world->getModel($model);
  foreach ($hash as $modelData) 
  {
    $modelInstance->create(array($model => $modelData));
    $modelInstance->save();
  }
});

function numberOfOccurrences($world, $model, $modelData)
{
  $collected = array();
  foreach ($modelData as $key => $value)
  {
      $collected[] = $key.': "'.$value.'"';
  }
  return $world->getModel($model)->find('count', array('conditions' => $modelData));
}

function countModelOccurrences($world, $count, $model, $table) {
    $hash = $table->getHash();
    foreach ($hash as $modelData)
    {
        $numberOfInstances = numberOfOccurrences($world, $model, $modelData);
        assertEquals($count, $numberOfInstances, 
            'Found '.$numberOfInstances.' instead of '.$count.' expected instances of the "'.$model.'"'
        );
    }
}

$steps->Then('/^there should be (\d+) "([^"]*)":$/', function($world, $count, $model, $table) {
  countModelOccurrences($world, $count, $model, $table);
});

$steps->Then('/^there should be a "([^"]*)":$/', function($world, $model, $table) {
  countModelOccurrences($world, 1, $model, $table);
});

$steps->Then('/^there should be no "([^"]*)":$/', function($world, $model, $table) {
    countModelOccurrences($world, 0, $model, $table);
});

$steps->Given('/^there should be no "([^"]*)"$/', function($world, $model) {
    $numberOfInstances = numberOfOccurrences($world, $model, array());
    assertEquals(0, $numberOfInstances, "Found ".$numberOfInstances.' '.$model.' instances, but expected 0');
});



?>