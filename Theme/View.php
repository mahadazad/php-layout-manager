<?php

class Theme_View extends Theme_View_Abstract {

    /**
    * @var Theme_Layout $layout
    */
    protected $layout;

    /**
    * @param Theme_Layout $layout
    */
    public function setLayout(Theme_Layout $layout) {
        $this->layout = $layout;
    }

    /**
    * @return Theme_Layout
    */
    public function getLayout() {
        return $this->layout;
    }

}