<?php

require_once 'memberonlyevent.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function memberonlyevent_civicrm_config(&$config) {
  _memberonlyevent_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function memberonlyevent_civicrm_xmlMenu(&$files) {
  _memberonlyevent_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function memberonlyevent_civicrm_install() {
  _memberonlyevent_civix_civicrm_install();
  /* create custom group and custom field for member only event */
  $params_group = array(
    'title' => 'Member only event?',
    'name' => 'member_only_event',
    'extends' => "Event",
    'weight' => 4,
    'collapse_display' => 1,
    'style' => 'Inline',
    'help_pre' => 'If selected, only users with one of the set membership statuses (Administer > CiviEvent > Member Only Event Settings) and those that have a website account will be able to register for this event.',
    // 'help_post' => 'This field is used to set-up member only events',
    'is_active' => 1,
    'is_public' => 0
  );

  $group_id = custom_group_get_id('member_only_event');
  if (!$group_id) {
    $customGroup = civicrm_api3('CustomGroup', 'create', $params_group);
  }
  if (isset($customGroup)) {
    $params_field = array(
      'custom_group_id' => $customGroup['id'],
      'label' => 'Is this a member only event?',
      'name' => 'is_member_only_event',
      'html_type' => 'CheckBox',
      'data_type' => 'String',
      'weight' => 4,
      'is_required' => 0,
      'is_searchable' => 0,
      'is_active' => 1,
      'option_label' => array(
        'Yes'
      ),
      'option_value' => array(
        1
      ),
      'option_weight' => array(
        1
      ),
      'option_status' => array(
        1
      )
    );

    $field_id = custom_field_get_id($customGroup['id'], 'is_member_only_event');
    if (!$field_id) {
      $customField = civicrm_api3('CustomField', 'create', $params_field);
    }
  }
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function memberonlyevent_civicrm_uninstall() {
  _memberonlyevent_civix_civicrm_uninstall();
  $group_id = custom_group_get_id('member_only_event');
  $field_id = custom_field_get_id($group_id, 'is_member_only_event');
  $params_field = array(
    'id' => $field_id
  );
  if ($field_id) {
    civicrm_api3('CustomField', 'delete', $params_field);
  }

  $params_group = array(
    'id' => $group_id
  );
  if ($group_id) {
    civicrm_api3('CustomGroup', 'delete', $params_group);
  }
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function memberonlyevent_civicrm_enable() {
  _memberonlyevent_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function memberonlyevent_civicrm_disable() {
  _memberonlyevent_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string,
 *          the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue,
 *          (for 'enqueue') the modifiable list of pending up upgrade tasks
 *          
 * @return mixed Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *         for 'enqueue', returns void
 *        
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function memberonlyevent_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _memberonlyevent_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function memberonlyevent_civicrm_managed(&$entities) {
  _memberonlyevent_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function memberonlyevent_civicrm_caseTypes(&$caseTypes) {
  _memberonlyevent_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function memberonlyevent_civicrm_angularModules(&$angularModules) {
  _memberonlyevent_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function memberonlyevent_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _memberonlyevent_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * check whether member only event or not
 */
function memberonlyevent_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Event_Form_Registration_Register') {
    $settingsStr = CRM_Core_BAO_Setting::getItem('Member Only Event Settings', 'custom_memberonlyevent_settings');
    $settingsArray = unserialize($settingsStr);
    $event_id = $form->_eventId;
    if (check_membership_for_event_register($event_id)) {
      $settingsStr = CRM_Core_BAO_Setting::getItem('Member Only Event Settings', 'custom_memberonlyevent_settings');
      $settingsArray = unserialize($settingsStr);
      //$member_only_message = '<br/>' . $settingsArray['memberonly_message'];
      //CRM_Core_Session::setStatus($member_only_message, 'Event Registration', 'alert');
      $url_params = 'id=' . $event_id . '&reset=1';
      CRM_Utils_System::redirect(CRM_Utils_System::url('civicrm/event/info', $url_params));
    }
  }
}

/**
 * Implementation of pageRun hooks
 */
function memberonlyevent_civicrm_pageRun(&$page) {
  if ($page->getVar('_name') == 'CRM_Event_Page_EventInfo') {
    $settingsStr = CRM_Core_BAO_Setting::getItem('Member Only Event Settings', 'custom_memberonlyevent_settings');
    $settingsArray = unserialize($settingsStr);

    $event_id = $page->getVar('_id');
    if (check_membership_for_event_register($event_id)) {
      $page->assign('mark_inactive', 1);
    }

    if ($settingsArray['display_memberonly_message']) {
      $page->assign('memberonly_message', $settingsArray['memberonly_message']);
    } else {
      $page->assign('memberonly_message', '');
    }

    $templatePath = realpath(dirname(__FILE__) . "/templates");
    CRM_Core_Region::instance('page-footer')->add(array(
      'template' => "{$templatePath}/CRM/Event/Page/EventInfoCustom.tpl"
    ));
  }
}

/**
 * check membership for event register
 */
function check_membership_for_event_register($event_id) {
  $group_id = custom_group_get_id('member_only_event');
  if ($group_id) {
    $field_id = custom_field_get_id($group_id, 'is_member_only_event');
    if ($field_id) {
      $result = civicrm_api3('Event', 'get', array(
        'sequential' => 1,
        'id' => $event_id,
        'return.custom_' . $field_id => 1,
        'check_permissions' => FALSE
      ));
      if ($result['count'] > 0) {
        if (isset($result['values'][0]['custom_' . $field_id][0])) {
          $member_only = $result['values'][0]['custom_' . $field_id][0];
          $session = CRM_Core_Session::singleton();
          $contact_id = $session->get('userID');

          $settingsStr = CRM_Core_BAO_Setting::getItem('Member Only Event Settings', 'custom_memberonlyevent_settings');
          $settingsArray = unserialize($settingsStr);
          if (!empty($settingsArray['memberonly_statuses'])) {
            $result_membership = civicrm_api3('Membership', 'get', array(
              'sequential' => 1,
              'contact_id' => $contact_id,
              'status_id' => array(
                'IN' => $settingsArray['memberonly_statuses']
              ),
              'active_only' => 1
            ));
            if (($member_only && $result_membership['count'] == 0) || ($member_only && $contact_id == null)) {
              return TRUE;
            }
          }
        }
      }
    }
  }
  return FALSE;
}

/**
 * See if a CiviCRM custom field group exists
 *
 * @param string $group_name
 *          custom field group name to look for, corresponds to field civicrm_custom_group.name
 * @return integer custom field group id if it exists, else zero
 */
function custom_group_get_id($group_name) {
  $result = 0;

  // This is an empty array we pass in to make the retrieve() function happy
  $def = array();
  $params = array(
    'name' => $group_name
  );

  require_once ('CRM/Core/BAO/CustomGroup.php');

  $custom_group = CRM_Core_BAO_CustomGroup::retrieve($params, $def);

  if (!empty($custom_group)) {
    $result = $custom_group->id;
  }
  return $result;
}

/**
 * See if a CiviCRM custom field exists
 *
 * @param integer $custom_group_id
 *          custom group id that the field is expected to belong to
 * @param string $field_label
 *          custom field name to look for, corresponds to field civicrm_custom_field.label
 * @return integer custom field id if it exists, else zero
 */
function custom_field_get_id($custom_group_id, $field_name) {
  $result = 0;

  // This is an empty array we pass in to make the retrieve() function happy
  $def = array();
  $params = array(
    'custom_group_id' => $custom_group_id,
    'name' => $field_name
  );

  require_once ('CRM/Core/BAO/CustomField.php');

  $custom_field = CRM_Core_BAO_CustomField::retrieve($params, $def);

  if (!empty($custom_field)) {
    $result = $custom_field->id;
  }
  return $result;
}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 */
function memberonlyevent_civicrm_navigationMenu(&$params) {
  // get the ids of Administer Menu & CiviEvent Menu
  $defaults = [];
  $admItem = CRM_Core_BAO_Navigation::retrieve([
      'name' => 'Administer'
      ], $defaults);
  $administerMenuId = (int) $admItem->id;
  $evItem = CRM_Core_BAO_Navigation::retrieve([
      'name' => 'CiviEvent'
      ], $defaults);
  $eventMenuId = (int) $evItem->id;
  // skip adding menu if there is no administer menu
  if ($administerMenuId && $eventMenuId) {
    // get the maximum key under CiviEvent menu
    $maxKey = max(array_keys($params[$administerMenuId]['child'][$eventMenuId]['child']));
    $params[$administerMenuId]['child'][$eventMenuId]['child'][$maxKey + 1] = array(
      'attributes' => array(
        'label' => 'Member Only Event Settings',
        'name' => 'Member Only Event Settings',
        'url' => 'civicrm/memberonlyevent/setting?reset=1',
        'permission' => 'administer CiviCRM',
        'operator' => NULL,
        'separator' => TRUE,
        'parentID' => $eventMenuId,
        'navID' => $maxKey + 1,
        'active' => 1
      )
    );
  }
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function memberonlyevent_civicrm_preProcess($formName, &$form) {

}

*/
