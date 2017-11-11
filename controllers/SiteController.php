<?php

namespace app\controllers;

use app\models\Comments;
use app\models\ImageUploader;
use yii\web\UploadedFile;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $models = Comments::find()->where(['!=', 'status', 'draft'])->with('media')->orderBy('id DESC')->all();
        return $this->render('index', compact('models'));
    }

    /**
     * Displays create comment page.
     *
     * @return string
     */
    public function actionAddReview()
    {
        $session = Yii::$app->session;
        $model = Comments::findOne($session->get('id'));
        if(!$session->get('id')) {
            $model = new Comments();
            $model->save();
            $session->set('id', $model->id);
        }
        $imageModel = new ImageUploader();

        if($model->load(Yii::$app->request->post())) {
            $model->status = 'active';
            if(!$model->save()) {
                $errors = $model->errors;
                return $this->render('add-review', compact('errors'));
            }
            $imageModel->photos = UploadedFile::getInstances($imageModel, 'photos');
            $imageModel->instance = $model;
            $imageModel->upload();
            $session->set('id', '');
            return $this->redirect(['/site/index']);
        }
        return $this->render('add-review', compact('model', 'imageModel'));
    }
}
