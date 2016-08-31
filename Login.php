<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;

/**
 * Login is the model to perform database queries for Login Form.
 */
class Login extends ActiveRecord
{

    public static function tableName()
{ 
       return 'user';
}
 public function checkLogin($data)
    {   
          $model = new self();
          $user=new User();
          $model->username = $data['LoginForm']['username']; 
           
          $model->password_hash = $data['LoginForm']['password'];
          // password entered by user is put into $hash variable
          $hash=$model->password_hash;
          // Extract password from database with the help of username that entered by user
           $model=Login::findOne([
           'username' => $model->username,
           

]);
         $hash1=$model->password_hash;
         //check passwords are same or not
         $model=$user->validatePassword($hash,$hash1);
          if($model)
            return true;
    }
}
