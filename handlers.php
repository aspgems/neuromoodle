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
 * NeuroMoodle handlers code.
*
* @package    local
* @subpackage neuromoodle
* @copyright  2015 ASPgems
* @license    https://github.com/aspgems/neuromoodle/blob/master/LICENSE
*/

defined('MOODLE_INTERNAL') || die();

/**
 * Handle the neurocourse_created event.
 *
 * This creates a course in NeuroK using NeuroK API.
 *
 * @param object $event the event object.
 */
function neurocourse_created($event) {
    global $DB;
    $course  = $DB->get_record('course', array('id' => $event->courseid));
    if ($course->format == 'singleactivity') {
        $activity_type = $DB->get_record('course_format_options', array('courseid' => $event->courseid), 'value');
        if ($activity_type->value == 'neurok'){
            // Create NeuroK course using NeuroK API
        }
    }
}

/**
 * Handle the neurocourse_deleted event.
 *
 * This deletes a course in NeuroK using NeuroK API.
 *
 * @param object $event the event object.
 */
function neurocourse_deleted($event) {
    global $DB;
}

function neurocourse_updated($event) {
    global $DB;
}

function neurouser_enrolment_created($event) {
    global $DB;
}

function neurouser_enrolment_deleted($event) {
    global $DB;
}

function neurouser_enrolment_updated($event) {
    global $DB;
}
