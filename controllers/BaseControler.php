<?php
use yii\base\Controller;


/**
 * Created by JetBrains PhpStorm.
 * User: mark
 * Date: 8/16/15
 * Time: 1:19 PM
 * To change this template use File | Settings | File Templates.
 */

class BaseController extends Controller
{

    public function behaviors()
{
    return [
        'ghost-access'=> [
            'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
        ],
    ];
}

}