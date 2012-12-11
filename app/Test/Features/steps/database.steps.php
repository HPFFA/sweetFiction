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
        $collected = array();
        foreach ($modelData as $key => $value)
        {
            $collected[] = $key.': "'.$value.'"';
        }
        $numberOfInstances = $modelInstance->find('count', array('conditions' => $modelData));
        assertEquals(1, $numberOfInstances, 
            'The the specified instance of "'.$model.'" does not exist: '.implode(", ", $collected)
        );
    }
});
?>