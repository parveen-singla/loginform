<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Student is the model to perform database queries for student form.
 */
class Student extends ActiveRecord
{

    public static function tableName()
{
    return 'StudentForm';
}
 public function insertStudent($data,$username)
    {     
          $model = new self();
          $model->name = $data['StudentForm']['name']; 
          $model->fathername = $data['StudentForm']['fathername'];
          $model->mothername = $data['StudentForm']['mothername'];
          $model->username = $username;
          $model->contact = $data['StudentForm']['contact'];
          $model->course = $data['StudentForm']['course'];
          $model->save();
          return true;
    }
}
