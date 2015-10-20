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

class local_neuromoodle_form extends moodleform {
    protected function definition() {
        $mform = $this->_form;

        $mform->addElement('static', '', '', get_string('info', 'local_neuromoodle'));

        $mform->addElement('advcheckbox', 'enabled', get_string('enableconnection', 'local_neuromoodle'),
                get_string('enableinfo', 'local_neuromoodle'), null, array(0, 1));

        $mform->addElement('text', 'neurokapiurl', get_string('neurokapiurl', 'local_neuromoodle'), array('size' => '48'));
        $mform->setType('neurokapiurl', PARAM_NOTAGS);
        $mform->addRule('neurokapiurl', null, 'required', null, 'client');
        $mform->setDefault('neurokapiurl', 'https://app.neurok.es/');

        $mform->addElement('submit', 'submitbutton', get_string('save', 'local_neuromoodle'));
    }
}
