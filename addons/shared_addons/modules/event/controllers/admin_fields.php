<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Event Fields
 *
 * Manage custom events fields for
 * your event.
 *
 * @author 		PyroCMS Dev Team
 * @package 	PyroCMS\Core\Modules\Users\Controllers
 */
class Admin_fields extends Admin_Controller {

	protected $section = 'fields';

	// --------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();

		// If they cannot administer profile fields,
		// then they can't access anythere here.
		role_or_die('users', 'admin_event_fields');

		$this->load->driver('streams');
		$this->lang->load(array('event', 'categories'));
	}

	// --------------------------------------------------------------------------
	
	/**
	 * List out profile fields
	 *
	 * @access 	public
	 * @return 	void
	 */
	public function index()
	{
		$buttons = array(
			array(
				'url'		=> 'admin/event/fields/edit/-assign_id-', 
				'label'		=> $this->lang->line('global:edit')
			),
			array(
				'url'		=> 'admin/event/fields/delete/-assign_id-',
				'label'		=> $this->lang->line('global:delete'),
				'confirm'	=> true
			)
		);

		$this->template->title(lang('global:custom_fields'));

		$this->streams->cp->assignments_table(
								'event',
								'events',
								Settings::get('records_per_page'),
								'admin/event/fields/index',
								true,
								array('buttons' => $buttons));
	}

	// --------------------------------------------------------------------------

	/**
	 * Create
	 *
	 * Create a new custom event field
	 *
	 * @access 	public
	 * @return 	void
	 */
	public function create()
	{
		$extra['title'] 		= lang('streams:add_field');
		$extra['show_cancel'] 	= true;
		$extra['cancel_uri'] 	= 'admin/event/fields';

		$this->streams->cp->field_form('event', 'events', 'new', 'admin/event/fields', null, array(), true, $extra);
	}

	// --------------------------------------------------------------------------

	/**
	 * Delete
	 *
	 * Delete a custom event profile field.
	 *
	 * @access 	public
	 * @return 	void
	 */
	public function delete()
	{
		if ( ! $assign_id = $this->uri->segment(5))
		{
			show_error(lang('streams:cannot_find_assign'));
		}
	
		// Tear down the assignment
		if ( ! $this->streams->cp->teardown_assignment_field($assign_id))
		{
		    $this->session->set_flashdata('notice', lang('streams:field_delete_error'));
		}
		else
		{
		    $this->session->set_flashdata('success', lang('streams:field_delete_success'));			
		}
	
		redirect('admin/event/fields');
	}

	// --------------------------------------------------------------------------

	/**
	 * Edit a profile field
	 *
	 * @access 	public
	 * @return 	void
	 */
	public function edit()
	{
		if ( ! $assign_id = $this->uri->segment(5))
		{
			show_error(lang('streams:cannot_find_assign'));
		}

		$extra = array(
			'title'			=> lang('streams:edit_field'),
			'show_cancel'	=> true,
			'cancel_uri'	=> 'admin/event/fields'
		);

		$this->streams->cp->field_form('event', 'events', 'edit', 'admin/event/fields', $assign_id, array(), true, $extra);
	}
}
