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

function countModelOccurrences($world, $count, $model, $table) {
    $hash = $table->getHash();
    $modelInstance = $world->getModel($model);
    foreach ($hash as $modelData)
    {
        $collected = array();
        foreach ($modelData as $key => $value)
        {
            $collected[] = $key.': "'.$value.'"';
        }
        $numberOfInstances = $modelInstance->find('count', array('conditions' => $modelData));
        assertEquals($count, $numberOfInstances, 
            'The expected number of instances ('.$count.') of "'.$model.'" does not match: '.implode(", ", $collected)
        );
    }
}

$steps->Then('/^there should be (\d+) "([^"]*)":$/', function($world, $count, $model, $table) {
  countModelOccurrences($world, $count, $model, $table);
});

$steps->Then('/^there should be a "([^"]*)":$/', function($world, $model, $table) {
  countModelOccurrences($world, 1, $model, $table);
});

$steps->Given('/^there should be no "([^"]*)":$/', function($world, $model, $table) {
    countModelOccurrences($world, 0, $model, $table);
});


?>