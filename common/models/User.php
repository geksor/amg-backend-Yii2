<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $surname
 * @property string $first_name
 * @property string $last_name
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $role
 * @property int $created_at
 * @property int $updated_at
 * @property int $group
 * @property int $training_id
 * @property int $dealer_center_id
 * @property int $command_id
 * @property int $amgStatic
 * @property int $mixStatic
 * @property int $mbux
 * @property int $xClassDrive
 * @property int $amgDrive
 * @property int $intelligent
 * @property int $mixDrive
 * @property int $xClassLine
 * @property int $quiz
 * @property int $moderatorPoints
 *
 * @property AmgDrive[] $amgDrives
 * @property EndQuest[] $endQuests
 * @property MixDrive[] $mixDrives
 * @property Command $command
 * @property DealerCenter $dealerCenter
 * @property Training $training
 * @property MixStaticUser[] $mixStaticUsers
 * @property MixStatic[] $mixStatics
 * @property UserGalleryImage[] $userGalleryImages
 * @property GalleryImage[] $galleryImages
 * @property UserAmgStaticQuestion[] $userAmgStaticQuestions
 * @property AmgStaticQuestion[] $amgStaticQuestions
 *
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['email',], 'required'],
            [['status', 'role', 'created_at', 'updated_at', 'group', 'training_id', 'dealer_center_id', 'command_id', 'amgStatic', 'mixStatic', 'mbux', 'xClassDrive', 'amgDrive', 'intelligent', 'mixDrive', 'xClassLine', 'quiz', 'moderatorPoints'], 'integer'],
            [['username', 'surname', 'first_name', 'last_name', 'email'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['command_id'], 'exist', 'skipOnError' => true, 'targetClass' => Command::className(), 'targetAttribute' => ['command_id' => 'id']],
            [['dealer_center_id'], 'exist', 'skipOnError' => true, 'targetClass' => DealerCenter::className(), 'targetAttribute' => ['dealer_center_id' => 'id']],
            [['training_id'], 'exist', 'skipOnError' => true, 'targetClass' => Training::className(), 'targetAttribute' => ['training_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'surname' => 'Фамилия',
            'first_name' => 'Имя',
            'last_name' => 'Отчество',
            'email' => 'Email',
            'status' => 'Статус',
            'role' => 'Роль',
            'created_at' => 'Дата регистрации',
            'updated_at' => 'Дата редактирования',
            'group' => 'Группа',
            'training_id' => 'Training ID',
            'dealer_center_id' => 'Dealer Center ID',
            'command_id' => 'Command ID',
            'amgStatic' => 'AMG статика',
            'mixStatic' => 'Mix статика',
            'mbux' => 'MBUX теория и практика',
            'xClassDrive' => 'X-Класс Тест-Драйв',
            'amgDrive' => 'AMG Тест-Драйв',
            'intelligent' => 'Intelligent drive',
            'mixDrive' => 'Mix Тест-Драйв',
            'xClassLine' => 'X-Класс линии исполнения',
            'quiz' => 'Викторина',
            'moderatorPoints' => 'Очки от модератора',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmgDrives()
    {
        return $this->hasMany(AmgDrive::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEndQuests()
    {
        return $this->hasOne(EndQuest::className(), ['user_id' => 'id']);
    }

    /**
     * @param $testName
     * @return bool
     */
    public function isEndQuest($testName)
    {
       if (!empty($this->endQuests)){
           if ($this->endQuests->$testName){
               return true;
           }
       }
       return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMixDrives()
    {
        return $this->hasMany(MixDrive::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommand()
    {
        return $this->hasOne(Command::className(), ['id' => 'command_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDealerCenter()
    {
        return $this->hasOne(DealerCenter::className(), ['id' => 'dealer_center_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTraining()
    {
        return $this->hasOne(Training::className(), ['id' => 'training_id']);
    }

    /**
     * @return integer
     */
    public function getTotalCount()
    {
        $sum = $this->amgStatic
            + $this->mixStatic
            + $this->mbux
            + $this->xClassDrive
            + $this->amgDrive
            + $this->intelligent
            + $this->mixDrive
            + $this->xClassLine
            + $this->quiz
            + $this->moderatorPoints;
        return $sum;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMixStaticUsers()
    {
        return $this->hasMany(MixStaticUser::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMixStatics()
    {
        return $this->hasMany(MixStatic::className(), ['id' => 'mixStatic_id'])->viaTable('mixStatic_user', ['user_id' => 'id']);
    }

    /**
     * @param $mixStaticId
     */
    public function saveMixStatic($mixStaticId)
    {
        if ($mixStaticId)
        {
            $mixStatic = MixStatic::findOne($mixStaticId);
            $this->link('mixStatics', $mixStatic);
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGalleryImages()
    {
        return $this->hasMany(UserGalleryImage::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleryImages()
    {
        return $this->hasMany(GalleryImage::className(), ['id' => 'gallery_image_id'])->viaTable('user_gallery_image', ['user_id' => 'id']);
    }

    /**
     * @param $galleryImage
     */
    public function saveGalleryImage($galleryImage)
    {
        if ($galleryImage)
        {
            $galleryImage = GalleryImage::findOne($galleryImage);
            $this->link('galleryImages', $galleryImage);
        }
    }

    /**
     * @param $mixStaticId
     * @return bool
     */
    public function isMixStaticViewed($mixStaticId)
    {
        if (!empty($this->mixStatics))
        {
            foreach ($this->mixStatics as $mixStatic)
            {
                if ($mixStatic->id === $mixStaticId)
                {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAmgStaticQuestions()
    {
        return $this->hasMany(UserAmgStaticQuestion::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmgStaticQuestions()
    {
        return $this->hasMany(AmgStaticQuestion::className(), ['id' => 'amgStatic_question_id'])->viaTable('user_amgStatic_question', ['user_id' => 'id']);
    }

    /**
     * @param $amgTestId
     */
    public function saveAmgTest($amgTestId)
    {
        if ($amgTestId)
        $link = UserAmgStaticQuestion::find()->where(['amgStatic_question_id' => $amgTestId])->one();
        if ($link){
            $link->delete();
        }
        $amgTest = AmgStaticQuestion::findOne($amgTestId);

        $this->link('amgStaticQuestions', $amgTest);
    }

}
