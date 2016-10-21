<?php

namespace culturePnPsu\account\controllers;

use Yii;
use culturePnPsu\user\models\User;
use culturePnPsu\account\models\AccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use culturePnPsu\user\models\Person;

/**
 * DefaultController implements the CRUD actions for User model.
 */
class DefaultController extends Controller {

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
//        phpinfo();
//        exit();
        //Yii::$app->request->enableCsrfValidation = false;
        $model = Yii::$app->user->identity->profile;
        $model->scenario = 'update';

        $person = $model->person ? $model->person : new Person();

        if ($model->load(Yii::$app->request->post())) {
            $person->load(Yii::$app->request->post());
            $person->user_id = $model->user_id;
            if ($model->save()) {
                $person->save();
                Yii::$app->session->setFlash('success', 'บันทึกเรียบร้อย');
            } else {
                print_r($model->getErrors());
                print_r($person->getErrors());
                exit();
            }
            //if(!Yii::$app->request->isAjax)
            //return $this->redirect(['index']);
        }
        return $this->render('index', [
                    'model' => $model,
                    'person' => $person,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionAvatar() {
        $model = Yii::$app->user->identity->profile;
        $model->scenario = 'update';
        //$model->saveby = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            //print_r(Yii::$app->request->post());
            if ($model->save(false)) {
                echo 1;
            } else {
                echo 0;
            }            
        } else {
            return $this->renderAjax('avatar', [
                        'model' => $model,
            ]);
        }
    }

}
