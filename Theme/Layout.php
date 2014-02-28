<?php

require dirname(__FILE__) . '/Providers/Renderer.php';
require dirname(__FILE__) . '/View/Renderers/Template.php';
require dirname(__FILE__) . '/View/Abstract.php';
require dirname(__FILE__) . '/View.php';


class Theme_Layout extends Theme_View_Abstract {
    /**
    * @var SplPriorityQueue $script
    */
    protected $scripts;

    /**
    * @var SplPriorityQueue $styles
    */
    protected $styles;
    
    public function __construct() {
        $this->scripts = new SplPriorityQueue();
        $this->styles = new SplPriorityQueue();
    }
    
    /**
    * Renders the views and wraps them in the layout template. Also injects the scripts and styles
    * @return string
    */
    public function render() {
        $output =  parent::render();
        $output = preg_replace('/<\/head>/i', $this->prepareAssets() . PHP_EOL . '</head>', $output);
        
        return $output;
    }
    
    /**
    * Prepares styles & scripts
    * @return string
    */
    protected function prepareAssets() {
        return $this->prepareScripts() . $this->prepareStyles();
    }
    
    /**
    * Prepare the scripts
    * @return string
    */
    protected function prepareScripts() {
        $scripts = '';
        if($this->scripts->count()) {
            foreach($this->scripts as $script) {
                $scripts .= '<script src="' . $script . '"></script>' . PHP_EOL;
            }
        }
        
        return $scripts;
    }
    
    /**
    * Prepare the styles
    * @return string
    */
    protected function prepareStyles() {
        $styles = '';
        if($this->styles->count()) {
            foreach($this->styles as $style) {
                $styles .= '<link href="' . $style . '" />' . PHP_EOL;
            }
        }
        
        return $styles;
    }
    
    /**
    * Adds the script file according to priority
    * @param string $script
    * @param int $priority
    * @return self for object chaining
    */
    public function addScript($script, $priority = NULL) {
        $this->scripts->insert($script, is_int($priority) ? $priority : $this->scripts->count());
        return $this;
    }
    
    /**
    * Adds the style/css file according to priority
    * @param string $style
    * @param int $priority
    * @return self for object chaining
    */
    public function addStyle($style, $priority = NULL) {
        $this->styles->insert($style, is_int($priority) ? $priority : $this->styles->count());
        return $this;
    }
    
    /**
    * Adds child view that would be wrapped in the layout
    * @param Theme_View_Abstract $view
    */
    public function addView(Theme_View_Abstract $view) {
        if($view instanceof Theme_View) {
            $view->setLayout($this);
        }
        parent::addView($view);
    }
}