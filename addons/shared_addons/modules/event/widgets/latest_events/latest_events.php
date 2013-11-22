<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Show Latest event in your site with a widget.
 *
 * Intended for use on cms pages. Usage :
 * on a CMS page add:
 *
 *     {widget_area('name_of_area')}
 *
 * 'name_of_area' is the name of the widget area you created in the  admin
 * control panel
 *
 * @author  Erik Berman
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Event\Widgets
 */
class Widget_Latest_events extends Widgets
{
	public $author = 'Erik Berman';

	public $website = 'http://www.nukleo.fr';

	public $version = '1.0.0';

	public $title = array(
		'en' => 'Events - latest posts',
		'br' => 'Artigos recentes do Event',
            'fa' => 'آخرین ارسال ها',
		'pt' => 'Artigos recentes do Event',
		'el' => 'Τελευταίες αναρτήσεις ιστολογίου',
		'fr' => 'Derniers articles',
		'ru' => 'Последние записи',
		'id' => 'Post Terbaru',
	);

	public $description = array(
		'en' => 'Display latest events posts with a widget',
		'br' => 'Mostra uma lista de navegação para abrir os últimos artigos publicados no Event',
            'fa' => 'نمایش آخرین پست های وبلاگ در یک ویجت',
		'pt' => 'Mostra uma lista de navegação para abrir os últimos artigos publicados no Event',
		'el' => 'Προβάλει τις πιο πρόσφατες αναρτήσεις στο ιστολόγιό σας',
		'fr' => 'Permet d\'afficher la liste des derniers posts du event dans un Widget',
		'ru' => 'Выводит список последних записей блога внутри виджета',
		'id' => 'Menampilkan posting event terbaru menggunakan widget',
	);

	// build form fields for the backend
	// MUST match the field name declared in the form.php file
	public $fields = array(
		array(
			'field' => 'limit',
			'label' => 'Number of posts',
		)
	);

	public function form($options)
	{
		$options['limit'] = ( ! empty($options['limit'])) ? $options['limit'] : 5;

		return array(
			'options' => $options
		);
	}

	public function run($options)
	{ 
		// load the event module's model
		class_exists('Event_m') OR $this->load->model('event/event_m');

		// sets default number of posts to be shown
		$options['limit'] = ( ! empty($options['limit'])) ? $options['limit'] : 5;

		// retrieve the records using the event module's model
		$event_widget = $this->event_m
			->limit($options['limit'])
			->get_many_by(array('status' => 'live'));

		// returns the variables to be used within the widget's view
		return array('event_widget' => $event_widget);
	}

}
