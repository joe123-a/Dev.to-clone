<?php

namespace app\models;

use yii\db\ActiveRecord;

class Challenges extends ActiveRecord
{
    public static function tableName()
    {
        return 'challenges';
    }

    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['status'], 'string', 'max' => 20],
            [['tags', 'prize'], 'string', 'max' => 255],
            [['details'], 'text'],
            [['start_date', 'end_date'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'tags' => 'Tags',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'prize' => 'Prize',
            'details' => 'Details',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getTimeLeft()
    {
        if ($this->end_date && strtotime($this->end_date) > time()) {
            $days = ceil((strtotime($this->end_date) - time()) / 86400);
            return $days . ' day' . ($days > 1 ? 's' : '') . ' left';
        }
        return null;
    }

    public function getTagsArray()
    {
        return explode(',', $this->tags ?? '');
    }
}