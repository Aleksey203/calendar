<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "masters".
 *
 * @property string $id
 * @property string $name
 * @property integer $display
 * @property string $status
 */
class Masters extends \yii\db\ActiveRecord
{
    const INACTIVE = 0;
    const ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'masters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'display', 'status'], 'required'],
            [['display'], 'integer'],
            [['name', 'status'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Фамилия',
            'display' => 'Активен',
            'status' => 'Должность',
        ];
    }
}
