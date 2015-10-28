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
 * NeuroK course management page.
 *
 * @package    local
 * @subpackage neuromoodle
 * @copyright  2015 ASPgems
 * @license    https://github.com/aspgems/neuromoodle/blob/master/LICENSE
 */

require_once('../../config.php');
require_once('lib.php');

// Get course ID from URL
$id = required_param('id', PARAM_INT);
// Get course information
$course = get_course($id);
// Funcionality only available inside the course.
require_login($course);
// Only users with neuromoodle capability can see neuromoodle settings.
require_capability('local/neuromoodle:manage', context_course::instance($course->id));
// Needed URLs
$index_url = new moodle_url('/local/neuromoodle/index.php', array('id' => $course->id));
$course_url = new moodle_url('/course/view.php', array('id' => $course->id));
// Page basic information
$PAGE->set_pagelayout('incourse');
$PAGE->set_url($index_url);
$PAGE->set_title($course->shortname.': '. get_string('pluginname', 'local_neuromoodle'));
$PAGE->set_heading($course->fullname);

$create_course_form = new local_neuromoodle_createneurocourse_form();

if ($create_course_form->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
    redirect($course_url);   
} else if ($fromform = $create_course_form->get_data()) {
    //In this case you process validated data. $mform->get_data() returns data posted in form.
} else {
    // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
    // or on the first display of the form.

    //Set default data (if any)
    //$createcourseform->set_data($toform);
}
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('titlepage', 'local_neuromoodle'));
$create_course_form->display();
echo $OUTPUT->footer();
