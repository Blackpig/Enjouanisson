<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* This file is part of FireSale, a PHP based eCommerce system built for
* PyroCMS.
*
* Copyright (c) 2013 Moltin Ltd.
* http://github.com/firesale/firesale
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*
* @package firesale/core
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Widget_FireSale_Single_Category extends Widgets
{

    // Details
    public $title       = 'FireSale Single Category';
    public $description = 'Display a single details';
    public $author      = 'Stuart Hallewell';
    public $website     = 'http://www.blackpif.eu';
    public $version     = '1.1.0';

    // Form Fields
    public $fields = array(
        'title'  => array('field' => 'title', 'label' => 'Title', 'rules' => 'required'),
        'parent' => array('field' => 'parent', 'label' => 'Parent', 'rules' => 'numeric'),
        ''
    );

    // Element Build
    public function run($options)
    { 
        // Load in the model
        $this->load->model('firesale/categories_m');
        
        // Get all categories
        $category = $this->categories_m->get_category($options['parent']);

        // Store the feed items
        return array('cat' => $category, 'controller' => $this);
    }

    // Options
    public function form()
    {

        // Get all categories
        $this->load->model('firesale/categories_m');
        $categories = array('0' => '-----') + $this->categories_m->dropdown_values();

        // Return
        return array('categories' => $categories);
    }

}
