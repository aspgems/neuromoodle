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
        $title = get_string('neurocoursemenu', 'local_neuromoodle');
        $url = new moodle_url('/local/neuromoodle/neurocourse.php', array('id' => $PAGE->course->id));
        $managecoursenode = navigation_node::create(
                $title,
                $url,
                navigation_node::NODETYPE_LEAF,
                'neurocourse',
                'neurocourse');
        $title = get_string('neurousersmenu', 'local_neuromoodle');
        $url = new moodle_url('/local/neuromoodle/neurousers.php', array('id' => $PAGE->course->id));
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
        $settingnode->add_node($indexnode);
    }
}

// Form to create neurocourses
class local_neuromoodle_createneurocourse_form extends moodleform {
    protected function definition() {
        $mform = $this->_form;

        $mform->addElement('static', '', '', get_string('infocreatecourse', 'local_neuromoodle'));
/*
        $mform->addElement('advcheckbox', 'enabled', get_string('enableconnection', 'local_neuromoodle'),
                get_string('enableinfo', 'local_neuromoodle'), null, array(0, 1));

        $mform->addElement('text', 'neurokapiurl', get_string('neurokapiurl', 'local_neuromoodle'), array('size' => '64'));
        $mform->setType('neurokapiurl', PARAM_NOTAGS);
        $mform->addRule('neurokapiurl', null, 'required', null, 'client');
        $mform->setDefault('neurokapiurl', 'https://app.neurok.es/');

        $mform->addElement('text', 'neurokapikey', get_string('neurokapikey', 'local_neuromoodle'), array('size' => '64'));
        $mform->setType('neurokapikey', PARAM_NOTAGS);
        $mform->addRule('neurokapikey', null, 'required', null, 'client');
*/
        $mform->addElement('submit', 'submitbutton', get_string('save', 'local_neuromoodle'));
    }
}

// Form to create neurousers
class local_neuromoodle_createneurouser_form extends moodleform {
    protected function definition() {
        $mform = $this->_form;

        $mform->addElement('static', '', '', get_string('infocreateuser', 'local_neuromoodle'));
/*
        $mform->addElement('advcheckbox', 'enabled', get_string('enableconnection', 'local_neuromoodle'),
                get_string('enableinfo', 'local_neuromoodle'), null, array(0, 1));

        $mform->addElement('text', 'neurokapiurl', get_string('neurokapiurl', 'local_neuromoodle'), array('size' => '64'));
        $mform->setType('neurokapiurl', PARAM_NOTAGS);
        $mform->addRule('neurokapiurl', null, 'required', null, 'client');
        $mform->setDefault('neurokapiurl', 'https://app.neurok.es/');

        $mform->addElement('text', 'neurokapikey', get_string('neurokapikey', 'local_neuromoodle'), array('size' => '64'));
        $mform->setType('neurokapikey', PARAM_NOTAGS);
        $mform->addRule('neurokapikey', null, 'required', null, 'client');
*/
        $mform->addElement('submit', 'submitbutton', get_string('save', 'local_neuromoodle'));
    }
}
