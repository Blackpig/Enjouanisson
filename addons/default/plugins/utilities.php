<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Utilities Plugin
 *
 * @author		Blackpig Design
 * @package		PyroCMS\Addon\Plugins
 * @copyright	Copyright (c) 2013, Blackpig
 */
class Plugin_Utilities extends Plugin
{
	public $version = '1.0.0';

	public $name = array(
		'en'	=> 'Utilities'
		);

	public $description = array(
		'en'	=> 'A collection of useful utilities.'
		);

	/**
	 * Returns a PluginDoc array that PyroCMS uses 
	 * to build the reference in the admin panel
	 *
	 * All options are listed here but refer 
	 * to the Blog plugin for a larger example
	 *
	 * @return array
	 */
	public function _self_doc()
	{
		$info = array(
			'truncate' => array(
				'description' => array(// a single sentence to explain the purpose of this method
					'en' => 'Reduces the inout text to the set number of words or characters'
					),
				'single' => true,// will it work as a single tag?
				'double' => false,// how about as a double tag?
				'variables' => '',// list all variables available inside the double tag. Separate them|like|this
				'attributes' => array(
					'text' => array(// this is the name="World" attribute
						'type' => 'text',// Can be: slug, number, flag, text, array, any.
						'flags' => '',// flags are predefined values like asc|desc|random.
						'default' => '',// this attribute defaults to this if no value is given
						'required' => true,// is this attribute required?
						),
					'type' => array(
						'type' => 'flag',// Can be: slug, number, flag, text, array, any.
						'flags' => 'word|character',// flags are predefined values like asc|desc|random.
						'default' => 'word',// this attribute defaults to this if no value is given
						'required' => false,// is this attribute required?
						),
					'limit' => array(// this is the name="World" attribute
						'type' => 'number',// Can be: slug, number, flag, text, array, any.
						'flags' => '',// flags are predefined values like asc|desc|random.
						'default' => '150',// this attribute defaults to this if no value is given
						'required' => false,// is this attribute required?
						),					
					'strip_tags' => array(// this is the name="World" attribute
						'type' => 'flag',// Can be: slug, number, flag, text, array, any.
						'flags' => 'true|false',// flags are predefined values like asc|desc|random.
						'default' => 'true',// this attribute defaults to this if no value is given
						'required' => false,// is this attribute required?
						),					
					'add_ellipsis' => array(// this is the name="World" attribute
						'type' => 'flag',// Can be: slug, number, flag, text, array, any.
						'flags' => 'true|false',// flags are predefined values like asc|desc|random.
						'default' => 'true',// this attribute defaults to this if no value is given
						'required' => false,// is this attribute required?
						),
					),
),
);

return $info;
}

	/**
	 * Truncate
	 *
	 * Usage:
	 * {{ utilities:truncate text="This is the text to truncate" type="word" limit="150" strip_tags="true" }}
	 *
	 * @return string
	 */
	function truncate()
	{ 
		$text = $this->attribute('text');
		$type = $this->attribute('type','word');		
		$limit = $this->attribute('limit',150);

		$strip_tags = $this->attribute('strip_tags',1);
		$add_ellipsis = $this->attribute('add_ellipsis','true');

		$text = ($strip_tags) ? strip_tags($text, "<b><i><em><strong><p><br><br/>") : $text;
		$ellipsis = ($add_ellipsis) ? "&#8230;" : "";

		$this->load->helper('text');

		return call_user_func_array($type . "_limiter", array($text, $limit, $ellipsis));
	}

	/**
	 * Looper
	 *
	 * Usage:
	 * {{ utilities:looper identifier="idx" step="1" true_every="2" show="false"} }}
	 *
	 * @return bool or number
	 */
	public function looper()
	{
		static $counter = array();

		$identifier = $this->attribute('identifier') ? $this->attribute('identifier') : 'default';

		if($this->attribute('start') != NULL) {
			$counter[$identifier] = (int)$this->attribute('start');
			return;
		}

    // calculate the step
		if($this->attribute('step') != NULL && is_numeric((int)$this->attribute('step'))) {
			$counter[$identifier] += (int)$this->attribute('step');
		}

		if($this->attribute('true_every')) {
        // this will return true every number of sequences
			if($counter[$identifier]%(int)$this->attribute('true_every') == 0){
            return true; // the counter is divisible by the number
        }

        return false;
    }

    if(!$this->attribute('show') || !$this->attribute('show') == 'false') {
    	return $counter[$identifier];
    }
}
}

/* End of file example.php */