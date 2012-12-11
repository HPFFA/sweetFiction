<?php # features/bootstrap/FeatureContext.php

use Behat\Behat\Context\ClosuredContextInterface;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\Step\Given,
    Behat\Behat\Context\Step\When,
    Behat\Behat\Context\Step\Then;
use Behat\CommonContexts\MinkRedirectContext;

if (file_exists(__DIR__ . '/../support/bootstrap.php')) {
    require_once __DIR__ . '/../support/bootstrap.php';
}

class FeatureContext extends MinkContext implements ClosuredContextInterface
{
    public $parameters = array();

    public function __construct(array $parameters) {
        $this->parameters = $parameters;

        if (file_exists(__DIR__ . '/../support/env.php')) {
            $world = $this;
            require(__DIR__ . '/../support/env.php');
        }
        $this->useContext('MinkRedirectContext', new MinkRedirectContext());
    }

    /**
     * Opens specified page.
     *
     * @Given /^(?:|I )am on (the)? "(?P<page>[^"]+)"$/
     * @When /^(?:|I )go to (the)? "(?P<page>[^"]+)"$/
     */
    public function visit($page)
    {
        parent::visit($page);
    }

    /**
     * Checks, that current page PATH is equal to specified.
     *
     * @Then /^(?:|I )should be on (the)? "(?P<page>[^"]+)"$/
     */
    public function assertPageAddress($page)
    {
        parent::assertPageAddress($page);
    }

   


    public function getStepDefinitionResources()
    {
        return glob(__DIR__.'/../steps/*.php');
    }

    public function getHookDefinitionResources()
    {
        return array(__DIR__ . '/../support/hooks.php');
    }

    public function locatePath($path) {
        return parent::locatePath($this->getPathTo($path));
    }

    public function __call($name, array $args) {
        if (isset($this->$name) && is_callable($this->$name)) {
            return call_user_func_array($this->$name, $args);
        } else {
            $trace = debug_backtrace();
            trigger_error(
                'Call to undefined method ' . get_class($this) . '::' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
                E_USER_ERROR
            );
        }
    }


    public function getModel($name) {
        $model = ClassRegistry::init(array('class' => $name, 'ds' => 'test'));
        return $model;
    }

    /**
     * @BeforeScenario
     */
    public static function cleanDatabase() {
        $models = App::objects('model');
        $db = ConnectionManager::getDataSource('test_suite');
        foreach ($models as $model)
        {
            if ($model != 'AppModel')
            {
                $modelClass = ClassRegistry::init(array('class' => $model, 'ds' => 'test'));
                $db->truncate($modelClass->table);
            }

        }
    }
}