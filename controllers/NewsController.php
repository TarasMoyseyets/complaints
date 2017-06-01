<?php
include_once ROOT.'/models/News.php';

class NewsController {
    public function actionIndex() {
        $newsList = array();
        $newsList = News::getNewsList();
        echo 'news counter';
        print_r($newsList);
        return TRUE;
        
    }
    public function actionView($category, $number) {
        echo 'one new';
        echo $category. '---'.$number;
        return TRUE;
    }
}
