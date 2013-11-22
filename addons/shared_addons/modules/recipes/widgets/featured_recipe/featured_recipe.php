<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Show Latest recipes in your site with a widget.
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
 * @package PyroCMS\Core\Modules\Recipes\Widgets
 */
class Widget_Featured_recipe extends Widgets
{

	public $author = 'Stuart Hallewell';

	public $website = 'http://www.blackpig.eu';

	public $version = '1.0.0';

	public $title = array(
		'en' => 'Featured recipe',
		'br' => 'Artigos recentes do Recipes',
            'fa' => 'آخرین ارسال ها',
		'pt' => 'Artigos recentes do Recipes',
		'el' => 'Τελευταίες αναρτήσεις ιστολογίου',
		'fr' => 'Derniers articles',
		'ru' => 'Последние записи',
		'id' => 'Post Terbaru',
	);

	public $description = array(
		'en' => 'Display the featured recipe',
		'br' => 'Mostra uma lista de navegação para abrir os últimos artigos publicados no Recipes',
            'fa' => 'نمایش آخرین پست های وبلاگ در یک ویجت',
		'pt' => 'Mostra uma lista de navegação para abrir os últimos artigos publicados no Recipes',
		'el' => 'Προβάλει τις πιο πρόσφατες αναρτήσεις στο ιστολόγιό σας',
		'fr' => 'Permet d\'afficher la liste des derniers posts du recipes dans un Widget',
		'ru' => 'Выводит список последних записей блога внутри виджета',
		'id' => 'Menampilkan posting recipes terbaru menggunakan widget',
	);

	// build form fields for the backend
	// MUST match the field name declared in the form.php file
	public $fields = array();

	public function form($options)
	{
			return null;
	}

	public function run($options)
	{
		// load the recipes module's model
		class_exists('Recipes_m') OR $this->load->model('recipes/recipes_m');

		// retrieve the records using the recipes module's model
		/*$recipes_widget = $this->recipes_m
			->limit(1)
			->where(array('status' => 'live', 'home_page_featured' => 'Yes'))
			->order_by('created', 'desc')
			->get();*/

			$rs =$this->streams->entries->get_entries(array(
			'stream'		=> 'recipes',
			'namespace'		=> 'recipess',
			'limit'			=> 1,
			'where'			=> "`status` = 'live' AND `home_page_featured` = 'Yes'",
			'order_by'		=> "`created",
			'sort'			=> "desc"
			));


		// returns the variables to be used within the widget's view
		return array('featured' => $rs['entries'][0]);
	}

}
