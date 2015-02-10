<?php
namespace Powerhouse\Core;

use Powerhouse\Core\Configuration;
use Powerhouse\Core\Project;

class PWR {

    public static function getModuleName() {
        return strtolower(strstr(\Route::currentRouteName(),'.', true));
    }

    public static function getActionName() {
        return strtolower(strstr(\Route::currentRouteName(),'.'));
    }

    public static function formatDate($date) {
        return \DateTime::createFromFormat('Y-m-d', $date)->format('d/m/Y');
    }

    public static function getPriorityList() {
    	return json_decode(Configuration::find('priority_list')->value);
    }

    public static function getClean($var) {
        $var = \Input::get($var);

        if (!is_array($var)) {
            return trim(strip_tags($var));
        } else {
            $clean = array();
            
            foreach ($var as $key=>$value) {
                $clean[$key] = trim(strip_tags($value));
            }

            return $clean;
        }
    }

    public static function getTypeFromCollection($collection) {
        if ($collection && !$collection->isEmpty()) {
            return str_replace('Powerhouse\\Core\\', '', get_class($collection->first()));
        } elseif ($collection && isset($collection->type)) {
            return $collection->type;
        } else {
            return self::getModuleName();
        }
    }

    public static function log($data) {
        file_put_contents(dirname(__FILE__).'/log.txt', print_r($data, true));
    }

    public static function logActivity($message, $project_id, $type = null) {

        $user = Auth::user();
        $name = $user->firstname.' '.$user->lastname[0];

        $activity = new \Powerhouse\Core\Activity;
        $activity->message = sprintf($message, $name);
        $activity->project_id = $project_id;
        $activity->user_id = $user->id;
        $activity->type = $type;
        $activity->save();
    }
}