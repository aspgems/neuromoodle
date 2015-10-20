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
 * Add page to admin menu.
 *
 * @package    local
 * @subpackage neuromoodle
 * @copyright  2015 ASPgems
 * @license    https://github.com/aspgems/neuromoodle/blob/master/LICENSE
 */

require_once('../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/local/neuromoodle/locallib.php');

require_login();
require_capability('moodle/site:config', context_system::instance());

admin_externalpage_setup('local_neuromoodle', '', null);

$PAGE->set_heading($SITE->fullname);
$PAGE->set_title($SITE->fullname . ': ' . get_string('pluginname', 'local_neuromoodle'));
$PAGE->set_pagelayout('admin');

$mform = new local_neuromoodle_form(new moodle_url('/local/neuromoodle/'));

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('titleconfigpage', 'local_neuromoodle'));
$mform->display();
echo $OUTPUT->footer();
