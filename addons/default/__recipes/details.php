<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Recipes module
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Recipes
 */
class Module_Recipes extends Module
{
	public $version = '2.0.0';

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Recipes',
				'ar' => 'المدوّنة',
				'br' => 'Recipes',
				'pt' => 'Recipes',
				'el' => 'Ιστολόγιο',
                            'fa' => 'بلاگ',
				'he' => 'בלוג',
				'id' => 'Recipes',
				'lt' => 'Recipesas',
				'pl' => 'Recipes',
				'ru' => 'Блог',
				'tw' => '文章',
				'cn' => '文章',
				'hu' => 'Recipes',
				'fi' => 'Recipesi',
				'th' => 'บล็อก',
				'se' => 'Recipesg',
			),
			'description' => array(
				'en' => 'Post recipes entries.',
				'ar' => 'أنشر المقالات على مدوّنتك.',
				'br' => 'Escrever publicações de recipes',
				'pt' => 'Escrever e editar publicações no recipes',
				'cs' => 'Publikujte nové články a příspěvky na recipes.', #update translation
				'da' => 'Skriv recipesindlæg',
				'de' => 'Veröffentliche neue Artikel und Recipes-Einträge', #update translation
				'sl' => 'Objavite recipes prispevke',
				'fi' => 'Kirjoita recipesi artikkeleita.',
				'el' => 'Δημιουργήστε άρθρα και εγγραφές στο ιστολόγιο σας.',
				'es' => 'Escribe entradas para los artículos y recipes (web log).', #update translation
                                'fa' => 'مقالات منتشر شده در بلاگ',
				'fr' => 'Poster des articles d\'actualités.',
				'he' => 'ניהול בלוג',
				'id' => 'Post entri recipes',
				'it' => 'Pubblica notizie e post per il recipes.', #update translation
				'lt' => 'Rašykite naujienas bei recipes\'o įrašus.',
				'nl' => 'Post nieuwsartikelen en recipess op uw site.',
				'pl' => 'Dodawaj nowe wpisy na recipesu',
				'ru' => 'Управление записями блога.',
				'tw' => '發表新聞訊息、部落格等文章。',
				'cn' => '发表新闻讯息、部落格等文章。',
				'th' => 'โพสต์รายการบล็อก',
				'hu' => 'Recipes bejegyzések létrehozása.',
				'se' => 'Inlägg i recipesgen.',
			),
			'frontend' => true,
			'backend' => true,
			'skip_xss' => true,
			'menu' => 'content',

			'roles' => array(
				'put_live', 'edit_live', 'delete_live'
			),

			'sections' => array(
				'posts' => array(
					'name' => 'recipes:posts_title',
					'uri' => 'admin/recipes',
					'shortcuts' => array(
						array(
							'name' => 'recipes:create_title',
							'uri' => 'admin/recipes/create',
							'class' => 'add',
						),
					),
				),
				'categories' => array(
					'name' => 'cat:list_title',
					'uri' => 'admin/recipes/categories',
					'shortcuts' => array(
						array(
							'name' => 'cat:create_title',
							'uri' => 'admin/recipes/categories/create',
							'class' => 'add',
						),
					),
				),
			),
		);

		if (function_exists('group_has_role'))
		{
			if(group_has_role('recipes', 'admin_recipes_fields'))
			{
				$info['sections']['fields'] = array(
							'name' 	=> 'global:custom_fields',
							'uri' 	=> 'admin/recipes/fields',
								'shortcuts' => array(
									'create' => array(
										'name' 	=> 'streams:add_field',
										'uri' 	=> 'admin/recipes/fields/create',
										'class' => 'add'
										)
									)
							);
			}
		}

		return $info;
	}

	public function install()
	{
		$this->dbforge->drop_table('recipes_categories');

		$this->load->driver('Streams');
		$this->streams->utilities->remove_namespace('recipess');

		// Just in case.
		$this->dbforge->drop_table('recipes');

		if ($this->db->table_exists('data_streams'))
		{
			$this->db->where('stream_namespace', 'recipess')->delete('data_streams');
		}

		// Create the recipes categories table.
		$this->install_tables(array(
			'recipes_categories' => array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true),
				'slug' => array('type' => 'VARCHAR', 'constraint' => 100, 'null' => false, 'unique' => true, 'key' => true),
				'title' => array('type' => 'VARCHAR', 'constraint' => 100, 'null' => false, 'unique' => true),
			),
		));

		$this->streams->streams->add_stream(
			'lang:recipes:recipes_title',
			'recipes',
			'recipess',
			null,
			null
		);

		// Add the intro field.
		// This can be later removed by an admin.
		$intro_field = array(
			'name'		=> 'lang:recipes:intro_label',
			'slug'		=> 'intro',
			'namespace' => 'recipess',
			'type'		=> 'wysiwyg',
			'assign'	=> 'recipes',
			'extra'		=> array('editor_type' => 'simple', 'allow_tags' => 'y'),
			'required'	=> true
		);
		$this->streams->fields->add_field($intro_field);

		// Ad the rest of the recipes fields the normal way.
		$recipes_fields = array(
				'title' => array('type' => 'VARCHAR', 'constraint' => 200, 'null' => false, 'unique' => true),
				'slug' => array('type' => 'VARCHAR', 'constraint' => 200, 'null' => false),
				'category_id' => array('type' => 'INT', 'constraint' => 11, 'key' => true),
				'body' => array('type' => 'TEXT'),
				'parsed' => array('type' => 'TEXT'),
				'keywords' => array('type' => 'VARCHAR', 'constraint' => 32, 'default' => ''),
				'author_id' => array('type' => 'INT', 'constraint' => 11, 'default' => 0),
				'created_on' => array('type' => 'INT', 'constraint' => 11),
				'updated_on' => array('type' => 'INT', 'constraint' => 11, 'default' => 0),
				'comments_enabled' => array('type' => 'ENUM', 'constraint' => array('no','1 day','1 week','2 weeks','1 month', '3 months', 'always'), 'default' => '3 months'),
				'status' => array('type' => 'ENUM', 'constraint' => array('draft', 'live'), 'default' => 'draft'),
				'type' => array('type' => 'SET', 'constraint' => array('html', 'markdown', 'wysiwyg-advanced', 'wysiwyg-simple')),
				'preview_hash' => array('type' => 'CHAR', 'constraint' => 32, 'default' => ''),
		);
		return $this->dbforge->add_column('recipes', $recipes_fields);
	}

	public function uninstall()
	{
		// This is a core module, lets keep it around.
		return false;
	}

	public function upgrade($old_version)
	{
		return true;
	}
}
