<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_user".
 *
 * @property int $id 主键
 * @property string $name 用户名称 
 * @property string $pass 密码 
 * @property string $salt 密码盐 
 * @property int $level
 * @property string $qq qq
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id', 'level'], 'integer'],
            [['name', 'pass', 'salt', 'qq'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'pass' => 'Pass',
            'salt' => 'Salt',
            'level' => 'Level',
            'qq' => 'Qq',
        ];
    }
}
