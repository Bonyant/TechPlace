<?php
/**
 * Created by PhpStorm.
 * User: медведь
 * Date: 05.11.2017
 * Time: 22:44
 */
use yii\helpers\Html;
use yii\widgets\ListView;
?>
<table>
    <tr>
        <td>№ рекламы</td>
        <td>Дата клика</td>
    </tr>


    <?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'summary' => ''
])?>
</table>
