<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Breadcrumbs {
	
	/**
	 * Breadcrumbs stack
	 *
     */
	private $breadcrumbs = array();
	 	
	 /**
	  * Constructor
	  *
	  * @access	public
	  *
	  */
	public function __construct()
	{	
		// Breadcrumbs display options
		$this->tag_open			= '<ol class="breadcrumb">';
		$this->tag_close		= '</ol>';
		$this->crumb_open		= '<li class="breadcrumb-item">';
		$this->crumb_last		= '<li class="breadcrumb-item active" aria-current="page">';
		$this->crumb_close		= '</li>';
		
		log_message('debug', "Breadcrumbs Class Initialized");
	}
	
	// --------------------------------------------------------------------

	/**
	 * Append crumb to stack
	 *
	 * @access	public
	 * @param	string $page
	 * @param	string $href
	 * @return	void
	 */		
	function add($page, $href)
	{
		// no page or href provided
		if (!$page OR !$href) return;
		
		// Prepend site url
		$href = base_url($href);
		
		// push breadcrumb
		$this->breadcrumbs[$href] = array('page' => $page, 'href' => $href);
	}
	
	// --------------------------------------------------------------------

	/**
	 * Generate breadcrumb
	 *
	 * @access	public
	 * @return	string
	 */		
	function show()
	{
		if ($this->breadcrumbs) {
		
			// set output variable
			$output = $this->tag_open;
			
			// construct output
			foreach ($this->breadcrumbs as $key => $crumb) {
				$keys = array_keys($this->breadcrumbs);
				if (end($keys) == $key) {
					$output .= $this->crumb_last.''.$crumb['page'].''.$this->crumb_close;
				} else {
					$output .= $this->crumb_open.'<a href="'.$crumb['href'].'">'.$crumb['page'].'</a>'.$this->crumb_close;
				}
			}
			
			// return output
			return $output.$this->tag_close.PHP_EOL;
		}
		
		// no crumbs
		return '';
	}
}
// END Breadcrumbs Class

/* End of file Breadcrumbs.php */
/* Location: ./application/libraries/Breadcrumbs.php */