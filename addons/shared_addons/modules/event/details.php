<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Event module
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Event
 */
class Module_Event extends Module
{
	public $version = '2.0.0';

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Event',
				'ar' => 'المدوّنة',
				'br' => 'Event',
				'pt' => 'Event',
				'el' => 'Ιστολόγιο',
                            'fa' => 'بلاگ',
				'he' => 'בלוג',
				'id' => 'Event',
				'lt' => 'Eventas',
				'pl' => 'Event',
				'ru' => 'Блог',
				'tw' => '文章',
				'cn' => '文章',
				'hu' => 'Event',
				'fi' => 'Eventi',
				'th' => 'บล็อก',
				'se' => 'Eventg',
			),
			'description' => array(
				'en' => 'Post event entries.',
				'ar' => 'أنشر المقالات على مدوّنتك.',
				'br' => 'Escrever publicações de event',
				'pt' => 'Escrever e editar publicações no event',
				'cs' => 'Publikujte nové články a příspěvky na event.', #update translation
				'da' => 'Skriv eventindlæg',
				'de' => 'Veröffentliche neue Artikel und Event-Einträge', #update translation
				'sl' => 'Objavite event prispevke',
				'fi' => 'Kirjoita eventi artikkeleita.',
				'el' => 'Δημιουργήστε άρθρα και εγγραφές στο ιστολόγιο σας.',
				'es' => 'Escribe entradas para los artículos y event (web log).', #update translation
                                'fa' => 'مقالات منتشر شده در بلاگ',
				'fr' => 'Poster des articles d\'actualités.',
				'he' => 'ניהול בלוג',
				'id' => 'Post entri event',
				'it' => 'Pubblica notizie e post per il event.', #update translation
				'lt' => 'Rašykite naujienas bei event\'o įrašus.',
				'nl' => 'Post nieuwsartikelen en events op uw site.',
				'pl' => 'Dodawaj nowe wpisy na eventu',
				'ru' => 'Управление записями блога.',
				'tw' => '發表新聞訊息、部落格等文章。',
				'cn' => '发表新闻讯息、部落格等文章。',
				'th' => 'โพสต์รายการบล็อก',
				'hu' => 'Event bejegyzések létrehozása.',
				'se' => 'Inlägg i eventgen.',
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
					'name' => 'event:posts_title',
					'uri' => 'admin/event',
					'shortcuts' => array(
						array(
							'name' => 'event:create_title',
							'uri' => 'admin/event/create',
							'class' => 'add',
						),
					),
				),
				'categories' => array(
					'name' => 'cat:list_title',
					'uri' => 'admin/event/categories',
					'shortcuts' => array(
						array(
							'name' => 'cat:create_title',
							'uri' => 'admin/event/categories/create',
							'class' => 'add',
						),
					),
				),
			),
		);

		if (function_exists('group_has_role'))
		{
			if(group_has_role('event', 'admin_event_fields'))
			{
				$info['sections']['fields'] = array(
							'name' 	=> 'global:custom_fields',
							'uri' 	=> 'admin/event/fields',
								'shortcuts' => array(
									'create' => array(
										'name' 	=> 'streams:add_field',
										'uri' 	=> 'admin/event/fields/create',
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
		$this->dbforge->drop_table('event_categories');

		$this->load->driver('Streams');
		$this->streams->utilities->remove_namespace('events');

		// Just in case.
		$this->dbforge->drop_table('event');

		if ($this->db->table_exists('data_streams'))
		{
			$this->db->where('stream_namespace', 'events')->delete('data_streams');
		}

		// Create the event categories table.
		$this->install_tables(array(
			'event_categories' => array(
				'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true),
				'slug' => array('type' => 'VARCHAR', 'constraint' => 100, 'null' => false, 'unique' => true, 'key' => true),
				'title' => array('type' => 'VARCHAR', 'constraint' => 100, 'null' => false, 'unique' => true),
			),
		));

		$this->streams->streams->add_stream(
			'lang:event:event_title',
			'event',
			'events',
			null,
			null
		);

		// Add the intro field.
		// This can be later removed by an admin.
		$intro_field = array(
			'name'		=> 'lang:event:intro_label',
			'slug'		=> 'intro',
			'namespace' => 'events',
			'type'		=> 'wysiwyg',
			'assign'	=> 'event',
			'extra'		=> array('editor_type' => 'simple', 'allow_tags' => 'y'),
			'required'	=> true
		);
		$this->streams->fields->add_field($intro_field);

		// Ad the rest of the event fields the normal way.
		$event_fields = array(
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
		return $this->dbforge->add_column('event', $event_fields);
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
