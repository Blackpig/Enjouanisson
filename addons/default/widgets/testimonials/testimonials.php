<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Widget_Testimonials extends Widgets
{
    // The widget title,  this is displayed in the admin interface
    public $title = 'Testimonials';

    //The widget description, this is also displayed in the admin interface.  Keep it brief.
    public $description =  'Display testimonials';

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
            'field' => 'number',
            'label' => 'Number of items',
            'rules' => 'numeric'
        )
    );

    /**
     * the $options param is passed by the core Widget class.  If you have
     * stored options in the database,  you must pass the paramater to access
     * them.
     */
    public function run($options)
    {
        $this->load->driver('Streams');

        $params = array(
            'stream' => 'testimonials',
            'namespace' => 'streams'
            );
        
        if (!empty($options['number']))
        {
            $params['limit'] = (int)$options['number'];
        }

        $rs = $this->streams->entries->get_entries($params);
        $items = array();
        $haystack=array('name','town','country','blurb');

        foreach ($rs['entries'] as $entry) {
            $item = new stdClass();
            foreach($entry as $name=>$value) {     
                if (in_array($name, $haystack)) {
                    if(is_array($value)) {
                        $item->$name = $value['name'];
                    } else {
                        $item->$name = $value;
                    }
                }
            }
            $items[] = $item;
        }

        return array("items" => $items);

    }

    
}