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
require_once ('lib.php');

$id = required_param('id', PARAM_INT); // Course ID.
$course = $DB->get_record('course', array('id'=>$id), '*', MUST_EXIST);
unset($id);

require_course_login($course, true);
require_capability('local/neuromoodle:manage', context_system::instance());

$PAGE->set_url('/local/neuromoodle/index.php', array('id' => $course->id));
$PAGE->set_heading($course->fullname);
$PAGE->set_title($course->shortname.': '. get_string('pluginname', 'local_neuromoodle'));
$PAGE->set_pagelayout('incourse');

$mform = new local_neuromoodle_createneurocourse_form(new moodle_url('/local/neuromoodle/neurocourse.php'));
$mform2 = new local_neuromoodle_createneurouser_form(new moodle_url('/local/neuromoodle/neurouser.php'));

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('titlepage', 'local_neuromoodle'));
$mform->display();
$mform2->display();
echo $OUTPUT->footer();
