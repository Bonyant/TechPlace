<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 12.08.2017
 * Time: 14:29
 */

namespace app\commands;
use yii\console\Controller;
use app\models\User;
use Yii;


class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Удалить все старые данные из БД
        $auth->removeAll();

        // Создаём роли
        $admin = $auth->createRole('admin');
        $user = $auth->createRole('user');

        // Записываем роли в БД
        $auth->add($admin);
        $auth->add($user);

        // Создаём разрешения
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $editUser = $auth->createPermission('editUser');
        $editUser->description = 'Редоктирование пользователя';

        $addLeson = $auth->createPermission('addLeson');
        $addLeson->description = 'Создание Урока';

        $editLeson = $auth->createPermission('editLeson');
        $editLeson->description = 'Редактирование Урока';

        $deleteLeson = $auth->createPermission('deleteLeson');
        $deleteLeson->description = 'Удаление Урока';

        // Записываем разрешение в БД
        $auth->add($viewAdminPage);
        $auth->add($editUser);
        $auth->add($addLeson);
        $auth->add($editLeson);
        $auth->add($deleteLeson);

        // Добавим наследование
        $auth->addChild($user, $editUser);

        // Админ налседут разрешения редоктировать пользователя
        $auth->addChild($admin, $user);

        // У администратора есть свои разрешения
        $auth->addChild($admin, $viewAdminPage);
        $auth->addChild($admin, $addLeson);
        $auth->addChild($admin, $editLeson);
        $auth->addChild($admin, $deleteLeson);

        // Назначаем пользователя с ID 1 администратором сайта
        $auth->assign($admin, 1);


    }
}