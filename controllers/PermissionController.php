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
        if ($this->id !== 'site') {
            $permission = $this->id . '.*';
        } else {
            $permission = $this->id . '.' . $this->action->id;
        }
        if (!\Yii::$app->user->can($permission)) {
            throw new ForbiddenHttpException('You are not authorized to perform this action.');
        }
        return parent::beforeAction($action);
    }
}