<?php

interface Theme_Provider_Renderer {

	/**
	* @param string | Theme_View_Abstract
	*/
    public function render($view);
}