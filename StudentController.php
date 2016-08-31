<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\models\StudentForm;
use frontend\models\Student;
use frontend\models\SubmitForm;
use frontend\models\LoginForm;
use frontend\models\Login;
use frontend\models\SignupForm;
/**
 * Student controller
 */
class StudentController extends Controller
{

	public function actionLogin()
    {
        $loginObj = new LoginForm();
        $logObj = new Login();
        $params=Yii::$app->request->post();
       
        if ($loginObj->load(Yii::$app->request->post())) {
 
        	$ret=$logObj->checkLogin($params); 
        	if($ret)
        	{    $session = Yii::$app->session;
        		$session['username'] = $_POST['LoginForm']['username'];
                $this->redirect('add');	
        	}
            else
            {
   	           Yii::$app->session->setFlash('success', 'User is already registered.');
               return $this->refresh();
            }
        }
        else {
                return $this->render('login', [
                'model' => $loginObj,
                 ]);
        }
    }
	 public function actionAdd()
    {
    	$session = Yii::$app->session;
    	$username=$session['username'];
        $formObj = new StudentForm();
        $studentObj = new Student();
        $params=Yii::$app->request->post();
        // insert details in database of student
        if ($formObj->load(Yii::$app->request->post()) && $formObj->validate()) {

        	try{
                 $ret=$studentObj->insertStudent($params,$username);
        	}
        	catch(\Exception $e)
        	{
        		echo $e->getMessage();die;
        	}
        	
          // if insertion successful redirect to submit page
          if ($ret)
          {
           $this->redirect('submit');
            }
        } else {
            return $this->render('add',[
                'model' => $formObj,
                'username'=>$username,
            ]);
        }
    }
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    $this->redirect('login');
                }
            }
        }

        return $this->render('signup',[
            'model' => $model,
        ]);
    }
    public function actionSubmit()
    {
    	$session = Yii::$app->session;
    	$username=$session['username'];
    	
    	if(!$username)
    	{
    		$this->redirect('login');
    	}
    	$session->destroy();

    	
    	Yii::$app->session->setFlash('success', 'Thank you for registering with us. We will respond to you as soon as possible.');

    	return $this->render('submit');
               
              
    }
}