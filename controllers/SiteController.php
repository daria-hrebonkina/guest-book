<?php

namespace app\controllers;

use app\models\Comments;
use app\models\ImageUploader;
use app\models\Likes;
use yii\helpers\Json;
use yii\web\UploadedFile;
use Yii;
use yii\web\Controller;

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

    public function actionLikeReview()
    {
        $commentId = Yii::$app->request->post('review_id');
        $comment = Comments::findOne($commentId);
        $ip = ip2long(\Yii::$app->getRequest()->getUserIP());
        $like = Likes::findOne(['comment_id' => $commentId, 'ip' => $ip]);
        if($like) {
            $like->delete();
            if($comment->likes_counter > 0) {
                $comment->updateCounters(['likes_counter' => -1]);
            }
        } else {
            $like = new Likes();
            $like->comment_id = $commentId;
            $like->ip = $ip;
            if($like->save()) {
                $comment->updateCounters(['likes_counter' => 1]);
            }
        }
        $response = ['amount' => $comment->likes_counter];
        return Json::encode($response);

    }
}
