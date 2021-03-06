<?php

namespace backend\controllers;

use common\models\Broker;
use common\models\BrokerSearch;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BrokerController implements the CRUD actions for Broker model.
 */
class BrokerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Broker models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BrokerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Broker model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Broker model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Broker();
        $user = new User();

        $user->group_id = 2;

        $model->type_id = Yii::$app->request->get('type_id');

        if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {
            $model->user_id = 1;
            if ($model->validate() && $user->validate()) {
                if ($user->save()) {
                    $model->user_id = $user->id;
                    if ($model->save()) {
                        return $this->redirect(['/broker']);
                    }
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * Updates an existing Broker model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user = User::findOne($model->user_id);

        if (Yii::$app->request->post('ok')) $model->edit = '';

        if ($model->load(Yii::$app->request->post()) && $user->load(Yii::$app->request->post())) {
            if ($user->save() && $model->save()) {
                return $this->redirect(['/broker']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'user' => $user,
        ]);
    }

    /**
     * Deletes an existing Broker model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Broker model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Broker the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Broker::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
