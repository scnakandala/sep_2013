<?php

require_once 'config.php';

class PanelMotiffManger {

    static $instance;
    private $data;

    public static function getInstance() {
        if (empty(PanelMotiffManger::$instance)) {
            PanelMotiffManger::$instance
                    = new PanelMotiffManger();
        }
        return PanelMotiffManger::$instance;
    }

    /**
     * Private constructor of the class. The class is made singleton
     */
    private function __construct() {
        $this->data = array();
    }

    public function setData($panel_motiffs) {
        foreach ($panel_motiffs as $key => $panel_motiff) {
            $size = count($panel_motiff);
            array_push($this->data, array(array_slice($panel_motiff, 2, $size), $panel_motiff[0], $panel_motiff[1]));
        }
    }

    public function getData() {
        return $this->data;
    }

}

?>
