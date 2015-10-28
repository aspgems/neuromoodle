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
 * NeuroMoodle Events
 *
 * @package    local
 * @subpackage neuromoodle
 * @copyright  2015 ASPgems
 * @since      Moodle 2.6
 * @license    https://github.com/aspgems/neuromoodle/blob/master/LICENSE
 */
 
defined('MOODLE_INTERNAL') || die();

$observers = array(
        // Course events
        array(
                'eventname'   => '\core\event\course_created',
                'callback'    => 'neurocourse_created',
                'includefile' => 'handlers.php',
        ),

        array(
                'eventname'   => '\core\event\course_deleted',
                'callback'    => 'neurocourse_deleted',
                'includefile' => 'handlers.php',
        ),
        
        array(
                'eventname'   => '\core\event\course_updated',
                'callback'    => 'neurocourse_updated',
                'includefile' => 'handlers.php',
        ),
        // User events
        array(
                'eventname'   => '\core\event\user_enrolment_created ',
                'callback'    => 'neurouser_enrolment_created',
                'includefile' => 'handlers.php',
        ),
        
        array(
                'eventname'   => '\core\event\user_enrolment_deleted',
                'callback'    => 'neurouser_enrolment_deleted',
                'includefile' => 'handlers.php',
        ),
        
        array(
                'eventname'   => '\core\event\user_enrolment_updated',
                'callback'    => 'neurouser_enrolment_updated',
                'includefile' => 'handlers.php',
        ),
);