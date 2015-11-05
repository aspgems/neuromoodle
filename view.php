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
 * Prints a particular instance of neurok
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package    mod
 * @subpackage neurok
 * @copyright  2015 ASPgems
 * @license    https://github.com/aspgems/neurok/blob/master/LICENSE
 */

require_once('../../config.php');
require_once($CFG->dirroot . '/mod/neurok/lib.php');

$id = optional_param('id', 0, PARAM_INT); // Course_module ID, or
$n  = optional_param('n', 0, PARAM_INT);  // Neuromoodle instance ID

if ($id) {
    $cm         = get_coursemodule_from_id('neurok', $id, 0, false, MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $neurok  = $DB->get_record('neurok', array('id' => $cm->instance), '*', MUST_EXIST);
} else if ($n) {
    $neurok  = $DB->get_record('neurok', array('id' => $n), '*', MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $neurok->course), '*', MUST_EXIST);
    $cm         = get_coursemodule_from_instance('neurok', $neurok->id, $course->id, false, MUST_EXIST);
} else {
    error('You must specify a course_module ID or an instance ID');
}

require_login($course, true, $cm);

$event = \mod_neurok\event\course_module_viewed::create(array(
    'objectid' => $PAGE->cm->instance,
    'context' => $PAGE->context,
));
$event->add_record_snapshot('course', $PAGE->course);
$event->add_record_snapshot($PAGE->cm->modname, $neurok);
$event->trigger();

// Print the page header.
$PAGE->set_url('/mod/neurok/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($neurok->name));
$PAGE->set_heading(format_string($course->fullname));

// Output starts here.
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('titlepage', 'neurok'));
// Conditions to show the intro can change to look for own settings or whatever.
if ($neurok->intro) {
    echo $OUTPUT->box(format_module_intro('neurok', $neurok, $cm->id), 'generalbox mod_introbox', 'neurokintro');
}
// Finish the page.
echo $OUTPUT->footer();
