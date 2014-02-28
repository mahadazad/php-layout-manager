<?php

abstract class Theme_View_Abstract {

    protected $_views = array();
    protected $renderer;
    protected $template;
    protected $data = array('content' => '');


    /**
    * renders the current view and its children
    * output of children views can be found in $content variable
    * @return string
    */
    public function render() {
        if (!$this->renderer instanceof Theme_Provider_Renderer) {
            throw new Exception('Renderer not set.');
        }

        $content = '';
        foreach ($this->getViews() as $view) {
            if (!$view->getRenderer() instanceof Theme_Provider_Renderer) {
                $view->setRenderer($this->getRenderer());
            }
            $content .= $this->getRenderer()->render($view);
        }
        $this->data['content'] = $content;

        return $this->getRenderer()->render($this);
    }

    /**
    * Add a child view in the current view
    * @param Theme_View_Abstract $view
    */
    public function addView(Theme_View_Abstract $view) {
        $this->_views[] = $view;
    }

    /**
    * returns the child views
    * @return array of Theme_View_Abstract
    */
    public function getViews() {
        return $this->_views;
    }

    /**
    * Returns the view renderer object
    *@return Theme_Provider_Renderer 
    */
    public function getRenderer() {
        return $this->renderer;
    }


    /**
    * Sets the view renderer
    * @param Theme_Provider_Renderer $renderer
    */
    public function setRenderer(Theme_Provider_Renderer $renderer) {
        $this->renderer = $renderer;
    }

    /**
    * @return returns template script of the view
    */
    public function getTemplate() {
        return $this->template;
    }

    /**
    * @param template script of the view
    */
    public function setTemplate($tpl) {
        $this->template = $tpl;
    }

    /**
    * @return array of data that gets exposed in the view script
    */
    public function getData() {
        return $this->data;
    }

    /**
    * Set the data that will be passed to the view script
    * @param array
    */
    public function setData(array $data) {
        $this->data = $data;
    }

}