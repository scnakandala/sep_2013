<?php

class LoginTest extends PHPUnit_Extensions_Selenium2TestCase {

    protected function setUp() {
        $this->setBrowser('firefox');
        $this->setBrowserUrl("http://localhost/sep_2013/web/admin/users/login_form");
    }

    /**
     * Function to test the login function of the web app
     */
    public function testLogin() {
        $this->selectWindow("name=fbMainContainer");
        $this->click("id=fbInspectButton");
        $this->click("css=input.btn.btn-primary");
        $this->waitForPageToLoad("30000");
    }

}

?>
