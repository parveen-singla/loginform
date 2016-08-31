<?php

namespace frontend\models;

use Yii;
use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class StudentForm extends Model
{
    public $name;
    public $fathername;
    public $mothername;
    public $course;
    public $contact;
    public $username;

    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'fathername','mothername','course','contact'], 'required'],
          
            [['contact'],'integer', 'min' => 1111111111, 'max' => 9999999999],
            // contact needs to be entered correctly
            
        ];
    }








  }