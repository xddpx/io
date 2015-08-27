<?php

namespace frontend\modules\book\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property integer $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property string $thumbnail
 * @property string $publication_date
 * @property integer $user_id
 * @property integer $author_id
 *
 * @property User $user
 * @property Author $author
 */
class Book extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'created_at', 'user_id'], 'required'],
            [['created_at', 'updated_at', 'publication_date'], 'safe'],
            [['user_id', 'author_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['thumbnail'], 'string', 'max' => 2083]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'thumbnail' => 'Thumbnail',
            'publication_date' => 'Publication Date',
            'user_id' => 'User ID',
            'author_id' => 'Author ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor() {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

}
