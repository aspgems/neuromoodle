<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * NeuroMoodle library code.
 *
 * @package    local
 * @subpackage neuromoodle
 * @copyright  2015 ASPgems
 * @license    https://github.com/aspgems/neuromoodle/blob/master/LICENSE
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir . '/formslib.php');

// Course menu management
function local_neuromoodle_extend_settings_navigation($settingsnav, $context) {
    global $CFG, $PAGE;

    // Only add this settings item on non-site course pages.
    if (!$PAGE->course or $PAGE->course->id == 1) {
        return;
    }

    // Only let users with the appropriate capability see this settings item.
    if (!has_capability('local/neuromoodle:manage', context_course::instance($PAGE->course->id))) {
        return;
    }
    
    // Adding menu item to provide access to NeuroK funcionality.
    if ($settingnode = $settingsnav->find('courseadmin', navigation_node::TYPE_COURSE)) {
        $title = get_string('pluginname', 'local_neuromoodle');
        $url = new moodle_url('/local/neuromoodle/index.php', array('id' => $PAGE->course->id));
        $indexnode = navigation_node::create(
                $title,
                $url,
                navigation_node::NODETYPE_BRANCH,
                'neuromoodle',
                'neuromoodle'
        );
        // Submenu items to provide access to course and users settings.
        /*
        $title = get_string('neurocoursemenu', 'local_neuromoodle');
        $url = new moodle_url('/local/neuromoodle/managecourse.php', array('id' => $PAGE->course->id));
        $managecoursenode = navigation_node::create(
                $title,
                $url,
                navigation_node::NODETYPE_LEAF,
                'neurocourse',
                'neurocourse');
        $title = get_string('neurousersmenu', 'local_neuromoodle');
        $url = new moodle_url('/local/neuromoodle/manageusers.php', array('id' => $PAGE->course->id));
        $manageusersnode = navigation_node::create(
                $title,
                $url,
                navigation_node::NODETYPE_LEAF,
                'neurousers',
                'neurousers');
        if ($PAGE->url->compare($url, URL_MATCH_BASE)) {
            $indexnode->make_active();
        }
        $indexnode->add_node($managecoursenode);
        $indexnode->add_node($manageusersnode);
        */
        $settingnode->add_node($indexnode);
    }
}

// Form to create neurocourses
class local_neuromoodle_createneurocourse_form extends moodleform {
    
    function definition() {
        global $DB, $USER;
               
        // Get teacher details.
        $teacheremail = null;
        $teacheremail = $USER->email;
        
        $mform = $this->_form;
        // Course header text
        $mform->addElement('header', 'createcourseformheader', get_string('infocreatecourse', 'local_neuromoodle'));
        // Course name element
        $mform->addElement('text', 'coursename', get_string('coursename', 'local_neuromoodle'), array('size'=>'64'));
        $mform->addHelpButton('coursename', 'coursename', 'local_neuromoodle');
        $mform->setType('coursename', PARAM_TEXT);
        $mform->addRule('coursename', null, 'required');
        // Course description element
        //$mform->addElement('editor', 'coursedescription', get_string('coursedescription', 'local_neuromoodle'), null, $this->_customdata['editoroptions']);
        $mform->addElement('textarea', 'coursedescription', get_string('coursedescription', 'local_neuromoodle'), 'wrap="virtual" rows="10" cols="62"');
        $mform->addHelpButton('coursedescription', 'coursedescription', 'local_neuromoodle');
        $mform->setType('coursedescription', PARAM_RAW);
        $mform->addRule('coursedescription', null, 'required');
        // Course creator email element
        // NOTE: try to change this field by a hidden field. 
        $mform->addElement('text', 'coursecreatoremail', get_string('coursecreatoremail', 'local_neuromoodle'));
        $mform->setType('coursecreatoremail', PARAM_EMAIL);
        $mform->addRule('coursecreatoremail', null, 'required');
        $mform->setDefault('coursecreatoremail', $USER->email);
        // Course start date
        $mform->addElement('date_selector', 'coursestartdate', get_string('coursestartdate', 'local_neuromoodle'));
        $mform->addRule('coursestartdate', null, 'required');

        //$mform->addElement('submit', 'save', get_string('save', 'local_neuromoodle'));
        // Form action buttons
        $buttonarray = array();
        $buttonarray[] = &$mform->createElement('submit', 'save', get_string('save', 'local_neuromoodle'));
        $buttonarray[] = &$mform->createElement('cancel');
        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);

        $mform->closeHeaderBefore('createcourseformheader');
    }
}

class local_neuromoodle_manageneurocourse_form extends moodleform {
    function definition() {
        $mform = $this->_form;

        $mform->addElement('static', '', '', get_string('infocreatecourse', 'local_neuromoodle'));
        $mform->addElement('submit', 'submitbutton', get_string('save', 'local_neuromoodle'));
    }
}

// Form to manage neurousers
class local_neuromoodle_createneurouser_form extends moodleform {
    function definition() {
        $mform = $this->_form;

        $mform->addElement('static', '', '', get_string('infocreateuser', 'local_neuromoodle'));
        $mform->addElement('submit', 'submitbutton', get_string('save', 'local_neuromoodle'));
    }
}
