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
 * Add page to activity module menu.
 *
 * @package    mod
 * @subpackage neurok
 * @copyright  2015 ASPgems <info@aspgems.com>
 * @license    https://github.com/aspgems/neuromoodle/blob/master/LICENSE
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $neuroksettings = new admin_settingpage('neurok', new lang_string('modulename', 'neurok'));
    $neuroksettings->add(new admin_setting_configcheckbox('neurok_enableconnection', new lang_string('neurokenableconnection', 'neurok'), null, 0));
    $neuroksettings->add(new admin_setting_configtext('neurok_apiurl', new lang_string('neurokapiurl', 'neurok'), null, '', PARAM_URL));
    $neuroksettings->add(new admin_setting_configtext('neurok_apikey', new lang_string('neurokapikey', 'neurok'), null, '', PARAM_TEXT));
    
    $ADMIN->add('modules', $neuroksettings);
}
