<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Widget_Keywords extends Widgets
{
    // The widget title,  this is displayed in the admin interface
    public $title = 'Keywords';

    //The widget description, this is also displayed in the admin interface.  Keep it brief.
    public $description =  'Display a list of keywords to filter a module by';

    // The author's name
    public $author = 'Black Pig Design';

    // The authors website for the widget
    public $website = 'http://blackpig.eu/';

    //current version of your widget
    public $version = '1.0';

    /**
     * $fields array forestoring widget options in the database.
     * values submited through the widget instance form are serialized and
     * stored in the database.
     */
    public $fields = array(
        array(
            'field' => 'module',
            'label' => 'Module name',
            'rules' => 'required'
        )
    );

    /**
     * the $options param is passed by the core Widget class.  If you have
     * stored options in the database,  you must pass the paramater to access
     * them.
     */
    public function run($options)
    {
        $this->load->model('keyword_m');
        $keywords = $this->keyword_m->order_by('name')->get_all();

        return array("module" => $options["module"], "keywords" => $keywords);

    }

    
}