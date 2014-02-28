<?php

class Theme_View_Renderer_Template implements Theme_Provider_Renderer {

    /**
     * @var Theme_View_Abstract $view
     */
    private $view;

    /**
     * Renders using template file strategy
     * @param Theme_View_Abstract $view
     */
    public function render($view) {

        if (!$view instanceof Theme_View_Abstract) {
            throw new Exception('$view must be of Theme_View_Abstract type');
        } elseif (!file_exists ($view->getTemplate()) && !is_file($view->getTemplate())) {
            throw new Exception('File not found: ' . $view->getTemplate());
        }

        $this->view = $view;
        ob_start();
        $data = $view->getData();
        extract($data);
        include $view->getTemplate();
        $output = ob_get_clean();
        return $output;
    }

    /**
     * To call layout methods seemlessly
     */
    public function __call($name, $arguments) {
        if ($this->view instanceof Theme_View) {
            $layout = $this->view->getLayout();
        } else if ($this->view instanceof Theme_Layout) {
            $layout = $this->view;
        }

        // calls the layout public methods 
        if (isset($layout) && method_exists($layout, $name)) {
            return call_user_func_array(array($layout, $name), $arguments);
        }
    }

}