<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property string $id
 * @property string $master_id
 * @property string $date
 * @property integer $holiday
 * @property string $start_time
 * @property string $end_time
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['master_id', 'date'], 'required'],
            [['master_id', 'holiday'], 'integer'],
            [['date'], 'date', 'format'=>'php:Y-m-d'],
            [['start_time', 'end_time'], 'date', 'format'=>'php:H:i:s'],
            [['start_time', 'end_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'master_id' => 'Master ID',
            'date' => 'Date',
            'holiday' => 'Holiday',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
        ];
    }

    public static function items($schedule)
    {
        $data = array();
        foreach ($schedule as $k => $v) {
            $data[$k]['start'] = $v['date'];

            if ($v['start_time'] AND $v['end_time']) {
                $data[$k]['title'] = substr($v['start_time'],0,5).' - '.substr($v['end_time'],0,5);
                $data[$k]['start'] = $v['date'].'T'.$v['start_time'];
                $data[$k]['end'] = $v['date'].'T'.$v['end_time'];
            }
            else {
                $data[$k]['title'] = 'ВЫХОДНОЙ';
                $data[$k]['className'] = 'holiday';
            }
        }

        return $data;
    }
}
