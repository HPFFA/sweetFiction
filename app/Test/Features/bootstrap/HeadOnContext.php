<?php

require_once "BaseContext.php";

use Behat\Mink\Mink,
    Behat\Mink\Session,
    Behat\Mink\Driver\Selenium2Driver;

use Selenium\Client as SeleniumClient;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php'; 



class HeadOnContext extends BaseContext
{
    public function __construct(array $parameters)
    {
        parent::__construct($parameters);
        $session = new Session(
            new Selenium2Driver(
                'chrome',
                'base_url'
        ));
        $session->start();
        $this->setMink(new Mink($session));
    }
}
?>