<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * This is the model class for table "link".
 *
 * @property int $id
 * @property string $link
 * @property string $short_link
 * @property string $ip
 * @property string $created_at
 */
class Link extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'link'], 'required'],
            ['link', 'url', 'defaultScheme' => 'http'],
            [['short_link', 'ip'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Ссылка',
            'short_link' => 'Короткая ссылка',
            'ip' => 'IP',
            'created_at' => 'Дата создания',
        ];
    }
    
    /**
     * генерация короткой ссылки
     *
     * @param null $time
     * @return string
     */
    public static function generateShortLink($time = null)
    {
        if ($time === null) {
            $time = strtotime("now");
        }
        return Url::base(true) . '/' . base_convert($time, 10, 36);
    }
    
    /**
     * поиск по ссылке
     *
     * @param string $link
     * @return static|null
     */
    public static function findByLink($link)
    {
        return $this->find()->where(['link' => $link])->one();
    }
}