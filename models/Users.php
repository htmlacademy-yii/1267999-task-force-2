<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int $city_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property float|null $rating
 * @property string $created_at
 * @property int|null $role
 * @property string|null $birthday
 * @property string|null $phone
 * @property string|null $telegram
 * @property string|null $information
 * @property int|null $avatar_file_id
 * @property int|null $done_orders
 * @property int|null $failed_orders
 * @property int|null $place_rank
 *
 * @property Files $avatarFile
 * @property Cities $city
 * @property Reviews[] $reviews
 * @property Tasks[] $tasks
 * @property UsersCategories[] $usersCategories
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'name', 'email', 'password', 'created_at'], 'required'],
            [['city_id', 'role', 'avatar_file_id', 'done_orders', 'failed_orders', 'place_rank'], 'integer'],
            [['rating'], 'number'],
            [['created_at', 'birthday'], 'safe'],
            [['name', 'email', 'telegram'], 'string', 'max' => 128],
            [['password', 'phone'], 'string', 'max' => 64],
            [['information'], 'string', 'max' => 1024],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::class, 'targetAttribute' => ['city_id' => 'id']],
            [['avatar_file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::class, 'targetAttribute' => ['avatar_file_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'rating' => 'Rating',
            'created_at' => 'Created At',
            'role' => 'Role',
            'birthday' => 'Birthday',
            'phone' => 'Phone',
            'telegram' => 'Telegram',
            'information' => 'Information',
            'avatar_file_id' => 'Avatar File ID',
            'done_orders' => 'Done Orders',
            'failed_orders' => 'Failed Orders',
            'place_rank' => 'Place Rank',
        ];
    }

    /**
     * Gets query for [[AvatarFile]].
     *
     * @return \yii\db\ActiveQuery|FilesQuery
     */
    public function getAvatarFile()
    {
        return $this->hasOne(Files::class, ['id' => 'avatar_file_id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery|CitiesQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::class, ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery|ReviewsQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Reviews::class, ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery|TasksQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UsersCategories]].
     *
     * @return \yii\db\ActiveQuery|UsersCategoriesQuery
     */
    public function getUsersCategories()
    {
        return $this->hasMany(UsersCategories::class, ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }
}
