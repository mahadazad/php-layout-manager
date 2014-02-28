<?php

require_once dirname(__FILE__) . '/Theme/Layout.php';
require_once dirname(__FILE__) . '/Theme/Providers/ThemeAdapter.php';

class Theme implements ThemeAdapter {

    /**
     * @var Theme_Layout
     */
    protected $layoutManager;

    /**
     * @var string path of the theme directory, default to /webroot/application/themes/default/
     */
    protected $themePath;

    /**
     * @var string Default layout
     */
    protected $layout = 'main';

    /**
     * @var string layout directory name inside theme directory
     */
    protected $layoutFolder = 'layouts';

    /**
     * @var string layout views name inside theme directory
     */
    protected $viewsFolder = 'views';

    /**
     * @var Theme_Provider_Renderer
     */
    protected $_renderer = null;

    public function __construct() {
        $this->themePath = dirname(__FILE__) . '/../themes/default/';
        $this->layoutManager = new Theme_Layout();
    }

    /**
     * Renders the views with layout
     * @param string $file view name without .php suffix
     * @param array $data
     * @param boolean $return return or output the view 
     */
    public function render($file, $data = array(), $return = false) {
        $layout = $this->layoutManager;
        $view = new Theme_View();

        $view->setData($data);
        $view->setTemplate($this->resolveViewPath($file));

        $layout->setData($data);
        $layout->setRenderer($this->getRenderer());
        $layout->addView($view);
        $layout->setTemplate($this->resolveLayoutPath());

        $output = $layout->render();

        if ($return) {
            return $output;
        }
        echo $output;
    }

    /**
     * Renders the view without layout
     * @param string $file view name without .php suffix
     * @param array $data
     * @param boolean $return return or output the view 
     */
    public function renderParital($file, $data = array(), $return = false) {
        $view = new Theme_View();
        $view->setData($data);
        $view->setRenderer($this->getRenderer());
        $view->setTemplate($this->resolveViewPath($file));

        $output = $view->render();

        if ($return) {
            return $output;
        }
        echo $output;
    }

    /**
     * @param string
     * @return string path of view
     */
    protected function resolveViewPath($view) {
        return $this->themePath . $this->viewsFolder . '/' . $view . '.php';
    }

    /**
     * @return string path of layout file
     */
    protected function resolveLayoutPath() {
        return $this->themePath . $this->layoutFolder . '/' . $this->layout . '.php';
    }

    /**
     * @return Theme_Provider_Renderer
     */
    protected function getRenderer() {
        if ($this->_renderer == null) {
            $this->_renderer = new Theme_View_Renderer_Template();
        }
        return $this->_renderer;
    }

    /**
     * @param string $script
     * @param int $priority
     * @return $this
     */
    public function addScript($script, $priority = NULL) {
        $this->layoutManager->addScript($script, $priority);
        return $this;
    }

    /**
     * 
     * @param string $style
     * @param int $priority
     * @return $this
     */
    public function addStyle($style, $priority = NULL) {
        $this->layoutManager->addStyle($style, $priority);
        return $this;
    }

    /**
     * 
     * @param string $themePath
     * @return $this
     */
    public function setThemePath($themePath) {
        $this->themePath = $themePath;
        return $this;
    }

    /**
     * Layout name without .php inside layouts folder
     * @param string $layout
     * @return $this
     */
    public function setLayout($layout) {
        $this->layout = $layout;
        return $this;
    }

    /**
     * Layout folder inside themes folder
     * @param string $layoutFolder
     * @return $this
     */
    public function layoutFolder($layoutFolder) {
        $this->layoutFolder = $layoutFolder;
        return $this;
    }

    /**
     * Views folder inside themes folder
     * @param string $layoutFolder
     * @return $this
     */
    public function viewFolder($viewFolder) {
        $this->viewsFolder = $viewFolder;
        return $this;
    }

}