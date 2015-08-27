<?php

namespace frontend\modules\io\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "document_log".
 *
 * @property integer $id
 * @property integer $document_id
 * @property integer $user_id
 * @property string $diff
 * @property string $content
 * @property string $created_at
 *
 * @property Document $document
 * @property User $user
 */
class DocumentLog extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'document_log';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'document_id', 'user_id', 'diff'], 'required'],
            [['id', 'document_id', 'user_id'], 'integer'],
            [['diff', 'content'], 'string'],
            [['created_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'document_id' => 'Document ID',
            'user_id' => 'User ID',
            'diff' => 'Diff',
            'content' => 'Content',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocument() {
        return $this->hasOne(Document::className(), ['id' => 'document_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
