<?php

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

$steps->Then('/^there should be a "([^"]*)":$/', function($world, $model, $table)
{
    $hash = $table->getHash();
    $modelInstance = $world->getModel($model);
    foreach ($hash as $modelData)
    {
        $modelInstances = $modelInstance->find('all', $modelData);
        $collected = array();
        foreach ($modelData as $key => $value)
        {
            $collected[] = $key.': "'.$value.'"';
        }
        assertEquals(1, sizeof($modelInstances), 
            'The the specified user does not exist: '.implode(",", $collected)
        );
    }
});
?>