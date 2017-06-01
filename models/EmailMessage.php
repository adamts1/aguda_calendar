<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "email_message".
 *
 * @property int $id
 * @property int $active
 * @property string $name
 * @property string $slug
 * @property string $subject
 * @property string $body
 * @property string $from_name
 * @property string $from_email
 * @property string $cc
 * @property string $bcc
 * @property string $reply_to
 * @property int $created
 * @property int $modified
 */
class EmailMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active', 'name', 'slug', 'subject', 'body', 'from_name', 'from_email', 'cc', 'bcc', 'reply_to', 'created', 'modified'], 'required'],
            [['active', 'created', 'modified'], 'integer'],
            [['body'], 'string'],
            [['name', 'from_name', 'from_email'], 'string', 'max' => 200],
            [['slug'], 'string', 'max' => 100],
            [['subject', 'cc', 'bcc', 'reply_to'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'active' => 'Active',
            'name' => 'Name',
            'slug' => 'Slug',
            'subject' => 'Subject',
            'body' => 'Body',
            'from_name' => 'From Name',
            'from_email' => 'From Email',
            'cc' => 'Cc',
            'bcc' => 'Bcc',
            'reply_to' => 'Reply To',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
    
}
