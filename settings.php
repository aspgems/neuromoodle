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

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $neuromoodlesettings = new admin_settingpage('local_neuromoodle', new lang_string('pluginname', 'local_neuromoodle'));
    $neuromoodlesettings->add(new admin_setting_configcheckbox('neurok_enableconnection', new lang_string('enableconnection', 'local_neuromoodle'), null, 0));
    $neuromoodlesettings->add(new admin_setting_configtext('neurok_apiurl', new lang_string('neurokapiurl', 'local_neuromoodle'), null, '', PARAM_URL));
    $neuromoodlesettings->add(new admin_setting_configtext('neurok_apikey', new lang_string('neurokapikey', 'local_neuromoodle'), null, '', PARAM_TEXT));
    
    $ADMIN->add('localplugins', $neuromoodlesettings);
}
