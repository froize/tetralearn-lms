<?php

namespace app\controllers;

use app\controllers\SiteController;
use app\models\Report;
use app\models\UserReport;
use Yii;
use app\models\Chapter;
use app\models\CourseGroup;
use app\models\UserCourse;
use app\models\User;
use app\models\Gang;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Course;
use yii\web\HttpException;

/**
 * ChapterController implements the CRUD actions for Chapter model.
 */
class ChapterController extends SiteController
{
    /**
     * Displays a single Chapter model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionLearn($id)
    {
        $model = $this->findModel($id);
        $this->view->params['header'] = $model->name;
        $this->view->params['description'] = 'Просмотр главы';
        $course = Course::find()
            ->where([
                'id' => $model->course_id
            ])
            ->asArray()
            ->one();
        $chapter = Chapter::find()
            ->joinWith('lectures')
            ->joinWith('tasks')
            ->where(['chapter.id' => $model->id])
            ->asArray()
            ->one();

        $reports = Report::find()
            ->joinWith('userReports')
            ->where([
                'course_id' => $course['id']
            ])
            ->asArray()
            ->all();

        if (!Yii::$app->user->isGuest)
            return $this->render('learn', [
                'model' => $this->findModel($id),
                'chapter' => $chapter,
                'reports' => $reports,
            ]);
        else {
            throw new HttpException(403, 'Доступ запрещен');
        }
    }
    protected function findModel($id)
    {
        if (($model = Chapter::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
