<?php
/**
 * Created by PhpStorm.
 * User: karen
 * Date: 2/25/16
 * Time: 12:09 AM
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;


class PermissionController extends Controller
{
    public function beforeAction($action)
    {
        $permission = null;
        if ($this->id !== 'site') {
            $permission = $this->id . '.*';
        } else {
            $allowedActions = [
                'index',
                'chart',
                'tables'
            ];
            if(!in_array($this->action->id,$allowedActions)) {
                $permission = $this->id . '.' . $this->action->id;
            }
        }
        if ($permission && !\Yii::$app->user->can($permission)) {
            $this->redirect(['user/security/login']);
        }
        return parent::beforeAction($action);
    }
}