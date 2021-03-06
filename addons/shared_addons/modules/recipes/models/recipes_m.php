<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Recipes\Models
 */
class Recipes_m extends MY_Model
{
	protected $_table = 'recipes';

	public function get_all()
	{
		$this->db
			->select('recipes.*, recipes_categories.title AS category_title, recipes_categories.slug AS category_slug')
			->select('users.username, profiles.display_name')
			->join('recipes_categories', 'recipes.category_id = recipes_categories.id', 'left')
			->join('profiles', 'profiles.user_id = recipes.author_id', 'left')
			->join('users', 'recipes.author_id = users.id', 'left')
			->order_by('created_on', 'DESC');

		return $this->db->get('recipes')->result();
	}

	public function get($id)
	{
		return $this->db
			->select('recipes.*, users.username, profiles.display_name')
			->join('profiles', 'profiles.user_id = recipes.author_id', 'left')
			->join('users', 'recipes.author_id = users.id', 'left')
			->where('recipes.id', $id)
			->get('recipes')
			->row();
	}

	public function get_by($key = null, $value = null)
	{
		$this->db
			->select('recipes.*, users.username, profiles.display_name')
			->join('profiles', 'profiles.user_id = recipes.author_id', 'left')
			->join('users', 'recipes.author_id = users.id', 'left');

		if (is_array($key))
		{
			$this->db->where($key);
		}
		else
		{
			$this->db->where($key, $value);
		}

		return $this->db->get($this->_table)->row();
	}

	public function get_many_by($params = array())
	{
		if ( ! empty($params['category']))
		{
			if (is_numeric($params['category']))
			{
				$this->db->where('recipes_categories.id', $params['category']);
			}
			else
			{
				$this->db->where('recipes_categories.slug', $params['category']);
			}
		}

		if ( ! empty($params['month']))
		{
			$this->db->where('MONTH(FROM_UNIXTIME('.$this->db->dbprefix('recipes').'.created_on))', $params['month']);
		}

		if ( ! empty($params['year']))
		{
			$this->db->where('YEAR(FROM_UNIXTIME('.$this->db->dbprefix('recipes').'.created_on))', $params['year']);
		}

		if ( ! empty($params['keywords']))
		{
			$this->db
				->like('recipes.title', trim($params['keywords']))
				->or_like('profiles.display_name', trim($params['keywords']));
		}

		// Is a status set?
		if ( ! empty($params['status']))
		{
			// If it's all, then show whatever the status
			if ($params['status'] != 'all')
			{
				// Otherwise, show only the specific status
				$this->db->where('status', $params['status']);
			}
		}

		// Nothing mentioned, show live only (general frontend stuff)
		else
		{
			$this->db->where('status', 'live');
		}

		// By default, dont show future posts
		if ( ! isset($params['show_future']) || (isset($params['show_future']) && $params['show_future'] == false))
		{
			$this->db->where('recipes.created_on <=', now());
		}

		// Limit the results based on 1 number or 2 (2nd is offset)
		if (isset($params['limit']) && is_array($params['limit']))
		{
			$this->db->limit($params['limit'][0], $params['limit'][1]);
		}
		elseif (isset($params['limit']))
		{
			$this->db->limit($params['limit']);
		}

		return $this->get_all();
	}

	public function count_tagged_by($tag, $params)
	{
		return $this->select('*')
			->from('recipes')
			->join('keywords_applied', 'keywords_applied.hash = recipes.keywords')
			->join('keywords', 'keywords.id = keywords_applied.keyword_id')
			->where('keywords.name', str_replace('-', ' ', $tag))
			->where($params)
			->count_all_results();
	}

	public function get_tagged_by($tag, $params)
	{
		return $this->db->select('recipes.*, recipes.title title, recipes.slug slug, recipes_categories.title category_title, recipes_categories.slug category_slug, profiles.display_name')
			->from('recipes')
			->join('keywords_applied', 'keywords_applied.hash = recipes.keywords')
			->join('keywords', 'keywords.id = keywords_applied.keyword_id')
			->join('recipes_categories', 'recipes_categories.id = recipes.category_id', 'left')
			->join('profiles', 'profiles.user_id = recipes.author_id', 'left')
			->where('keywords.name', str_replace('-', ' ', $tag))
			->where($params)
			->get()
			->result();
	}

	public function count_by($params = array())
	{
		$this->db->join('recipes_categories', 'recipes.category_id = recipes_categories.id', 'left')
		// we need the display name joined so we can get an accurate count when searching
			->join('profiles', 'profiles.user_id = recipes.author_id');

		if ( ! empty($params['category']))
		{
			if (is_numeric($params['category']))
			{
				$this->db->where('recipes_categories.id', $params['category']);
			}
			else
			{
				$this->db->where('recipes_categories.slug', $params['category']);
			}
		}

		if ( ! empty($params['month']))
		{
			$this->db->where('MONTH(FROM_UNIXTIME('.$this->db->dbprefix('recipes').'.created_on))', $params['month']);
		}

		if ( ! empty($params['year']))
		{
			$this->db->where('YEAR(FROM_UNIXTIME('.$this->db->dbprefix('recipes').'.created_on))', $params['year']);
		}

		if ( ! empty($params['keywords']))
		{
			$this->db
				->like('recipes.title', trim($params['keywords']))
				->or_like('profiles.display_name', trim($params['keywords']));
		}

		// Is a status set?
		if ( ! empty($params['status']))
		{
			// If it's all, then show whatever the status
			if ($params['status'] != 'all')
			{
				// Otherwise, show only the specific status
				$this->db->where('status', $params['status']);
			}
		}

		// Nothing mentioned, show live only (general frontend stuff)
		else
		{
			$this->db->where('status', 'live');
		}

		return $this->db->count_all_results('recipes');
	}

	public function update($id, $input, $skip_validation = false)
	{
		$input['updated_on'] = now();
		if ($input['status'] == "live" and $input['preview_hash'] != '') {
			$input['preview_hash'] = '';
		}

		return parent::update($id, $input);
	}

	public function publish($id = 0)
	{
		return parent::update($id, array('status' => 'live', 'preview_hash' => ''));
	}

	// -- Archive ---------------------------------------------

	public function get_archive_months()
	{
		$this->db->select('UNIX_TIMESTAMP(DATE_FORMAT(FROM_UNIXTIME(t1.created_on), "%Y-%m-02")) AS `date`', false);
		$this->db->from('recipes t1');
		$this->db->distinct();
		$this->db->select('(SELECT count(id) FROM '.$this->db->dbprefix('recipes').' t2
							WHERE MONTH(FROM_UNIXTIME(t1.created_on)) = MONTH(FROM_UNIXTIME(t2.created_on))
								AND YEAR(FROM_UNIXTIME(t1.created_on)) = YEAR(FROM_UNIXTIME(t2.created_on))
								AND status = "live"
								AND created_on <= '.now().'
							) as post_count');

		$this->db->where('status', 'live');
		$this->db->where('created_on <=', now());
		$this->db->having('post_count >', 0);
		$this->db->order_by('t1.created_on DESC');
		$query = $this->db->get();

		return $query->result();
	}

	public function check_exists($field, $value = '', $id = 0)
	{
		if (is_array($field))
		{
			$params = $field;
			$id = $value;
		}
		else
		{
			$params[$field] = $value;
		}
		$params['id !='] = (int)$id;

		return parent::count_by($params) == 0;
	}

	/**
	 * Searches recipes posts based on supplied data array
	 *
	 * @param $data array
	 *
	 * @return array
	 */
	public function search($data = array())
	{
		if (array_key_exists('category_id', $data))
		{
			$this->db->where('category_id', $data['category_id']);
		}

		if (array_key_exists('status', $data))
		{
			$this->db->where('status', $data['status']);
		}

		if (array_key_exists('keywords', $data))
		{
			$matches = array();
			if (strstr($data['keywords'], '%'))
			{
				preg_match_all('/%.*?%/i', $data['keywords'], $matches);
			}

			if ( ! empty($matches[0]))
			{
				foreach ($matches[0] as $match)
				{
					$phrases[] = str_replace('%', '', $match);
				}
			}
			else
			{
				$temp_phrases = explode(' ', $data['keywords']);
				foreach ($temp_phrases as $phrase)
				{
					$phrases[] = str_replace('%', '', $phrase);
				}
			}

			$counter = 0;
			foreach ($phrases as $phrase)
			{
				if ($counter == 0)
				{
					$this->db->like('recipes.title', $phrase);
				}
				else
				{
					$this->db->or_like('recipes.title', $phrase);
				}

				$this->db->or_like('recipes.body', $phrase);
				$this->db->or_like('recipes.intro', $phrase);
				$this->db->or_like('profiles.display_name', $phrase);
				$counter++;
			}
		}

		return $this->get_all();
	}

}
