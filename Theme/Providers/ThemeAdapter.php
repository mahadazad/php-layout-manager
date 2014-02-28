<?php

interface ThemeAdapter {

    /**
     * 
     * @param string $file
     * @param array $data
     * @param boolean $return
     */
    public function render($file, $data = array(), $return = false);

    /**
     * 
     * @param string $file
     * @param array $data
     * @param boolean $return
     */
    public function renderParital($file, $data = array(), $return = false);

    /**
     * 
     * @param string $script
     * @param int $priority
     */
    public function addScript($script, $priority = NULL);

    /**
     * 
     * @param string $style
     * @param int $priority
     */
    public function addStyle($style, $priority = NULL);

    /**
     * 
     * @param string $themePath
     */
    public function setThemePath($themePath);

    /**
     * 
     * @param string $layout
     */
    public function setLayout($layout);

    /**
     * 
     * @param string $layoutFolder
     */
    public function layoutFolder($layoutFolder);

    /**
     * 
     * @param string $viewFolder
     */
    public function viewFolder($viewFolder);
}