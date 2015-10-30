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
 * The main NeuroK configuration form
 *
 * It uses the standard core Moodle formslib. For more info about them, please
 * visit: http://docs.moodle.org/en/Development:lib/formslib.php
 *
 * @package    mod
 * @subpackage neurok
 * @copyright  2015 ASPgems <info@aspgems.com>
 * @license    https://github.com/aspgems/neuromoodle/blob/master/LICENSE
 */

defined('MOODLE_INTERNAL') || die();

/**
 * NeuroK course base URL
 */
define('NEUROKBASEURL', 'app.neurok.es');

require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_neurok_mod_form extends moodleform_mod {

    /**
     * Defines forms elements
     */
    public function definition() {

        $mform = $this->_form;

        // Adding the "general" fieldset, where all the common settings are showed.
        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Adding the standard "name" field.
        $mform->addElement('text', 'name', get_string('neurokcoursetitle', 'neurok'), array('size' => '64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEAN);
        }
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addHelpButton('name', 'neurokcoursetitle', 'neurok');
        
        $mform->addElement('text', 'url', get_string('neurokcourselink', 'neurok'), array('size' => '64'));
        $mform->setType('url', PARAM_URL);
        $mform->addRule('url', null, 'required', null, 'client');
        $mform->addHelpButton('url', 'neurokcourselink', 'neurok');

        // Adding the standard "intro" and "introformat" fields.
        $this->standard_intro_elements();

        // Add standard grading elements.
        $this->standard_grading_coursemodule_elements();

        // Add standard elements, common to all modules.
        $this->standard_coursemodule_elements();

        // Add standard buttons, common to all modules.
        $this->add_action_buttons();
    }
    
    function validation($data, $files) {
        $errors = parent::validation($data, $files);
    
        // Validating entered NeuroK course url.
        if (!empty($data['url'])) {
            $testurl = $data['url'];
            if (preg_match('|^https:|i', $testurl)) {
                if (!preg_match('|'. NEUROKBASEURL .'|i', $testurl)) {
                    $errors['url'] = get_string('invalidurl', 'neurok');
                }
            } else {
                $errors['url'] = get_string('invalidurl', 'neurok');
            }
        }
        return $errors;
    }
}
