<?php
/**
 * Created by PhpStorm.
 * User: Abhimanyu
 * Date: 18-02-2015
 * Time: 22:07
 */

namespace app\models;


use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;



class Reports extends \yii\base\Object
{
    public $appName;
    public $appBackendTheme;
    public $appFrontendTheme;
    public $cacheClass;
    public $appTour;

    public function rules()
    {
        return [
            // Application Name
            ['appName', 'required'],
            ['appName', 'string', 'max' => 150],

            // Application Backend Theme
            ['appBackendTheme', 'required'],

            // Application Frontend Theme
            ['appFrontendTheme', 'required'],

            // Cache Class
            ['cacheClass', 'required'],
            ['cacheClass', 'string', 'max' => 128],

            // Application Tour
            ['appTour', 'boolean']
        ];
    }

    public function attributeLabels()
    {
        return [
            'appName'          => 'Application Name',
            'appFrontendTheme' => 'Frontend Theme',
            'appBackendTheme'  => 'Backend Theme',
            'cacheClass' => 'Cache Class',
            'appTour'    => 'Show introduction tour for new users'
        ];
    }
}