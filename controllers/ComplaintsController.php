<?php
include_once ROOT.'/models/Complaints.php';
$db = Complaints::getInstance();
class ComplaintsController {
    public $captcha;
    public function actionIndex() {
        $db = Complaints::getInstance();
        $pages = $db->getPages();
        $this->actionCaptcha();
//        echo $captcha = $this->captcha;
//        echo '<br>'.$_SESSION['captcha'];
//        echo '<br>'.$_SESSION['admin'];
        //print_r($qe);
        require_once(ROOT.'/views/complaints/index.php');
        return TRUE;
        
    }
    public function actionAdd(){
       $db = Complaints::getInstance();
       $mysqli = $db->getConnection();
       $name =  htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['name']));
       $email =  htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['email']));
       $site =  htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['site']));
              session_start();
       $captcha = htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['captcha'])); 
       $text = htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['text']));
       $ip = $_SERVER['REMOTE_ADDR'];
       $browser = $_SERVER['HTTP_USER_AGENT'];
       if($captcha == $_SESSION['captcha']){
           $db->createOne($name,$email,$site,$text,$ip,$browser);
       }
        else {
           echo 'captcha';
       }
    }
    public function actionPagination(){
        $db = Complaints::getInstance();
        $records_per_page = 5;
        $output = '';
        if(isset($_POST['page'])){
            $page = $_POST['page'];
        }
        else{
            $page = 1;
        }
        session_start();
        $start_from = ($page - 1)*$records_per_page;
        $pagination = $db->getRecords($start_from,$records_per_page);
        $output .= "<table class='table'>";
        foreach ($pagination as $pagin):
            $output .= '<tr>'
                            . '<td>'.$pagin['id'].'</td>'
                            . '<td>'.$pagin['name'].'</td>'
                            . '<td>'.$pagin['site'].'</td>'
                . '<td>'.$pagin['text'].'</td>'
                            . '<td>'.$pagin['date'].'</td>'
                            . '<td>'.$pagin['ip'].'</td>'
                            . '<td>'.$pagin['browser'].'</td>';
                            if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
                               $output .= '<td><span class="delete" id="'.$pagin['id'].'">delete</span></td><td><span class="update" id="'.$pagin['id'].'">update</span></td>';
                            }
                    $output .= '<tr>';
        endforeach;
        $output .= '</table.<br /><div align="center">';
        echo $output;
    }
    public function randStr($length) {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        $i = 0;
        while($i<=$length){
            $num = rand(0,35);
            $tmp = substr($chars, $num, 1);
            $str = $str . $tmp;
            $i++;
        }
        return $str;
    }
    public function actionCaptcha() {
                session_start();
        $str = $this->randStr(5);
        $font_file = './templates/arial.ttf';
        $image = imagecreatetruecolor(100, 30);
        // colors
        $black   = imagecolorallocate($image, 0, 0, 0);
        $white = imagecolorallocate($image, 255, 255, 255);
        $red = imagecolorallocate($image, 255, 0, 0);
        $green = imagecolorallocate($image, 0, 255, 0);
        imagefill($image, 0, 0, $white);
        // lines
        imageline ($image, 0, 5, 90 , 30 ,  $red );
        imageline ($image, 0, 15, 100 , 10 ,  $green );
        imageline ($image, 0, 110, 700 , 110 ,  $white );
        imageline ($image, 0, 150, 700 , 150 ,  $white );
        imageline ($image, 40, 30, 40 , 190 ,  $white );
        imageline ($image, 660, 30, 660 , 190 ,  $white );
        imagefttext ($image , 14, 0, 25 , 20, $black, $font_file , $str);
        // show
        imagejpeg($image, './templates/images/captcha.jpg');
        imagedestroy($image);

        unset($_SESSION['captcha']);
        if (!isset($_SESSION['captcha'])) {
          $_SESSION['captcha'] = $str;
        }
        $this->captcha = $str;
    }
    public function actionAdmin(){
        $db = Complaints::getInstance();
        $mysqli = $db->getConnection();
        $login_cur = 'admin';
        $pass_cur = 'admin';
        $login =  htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['login']));
        $pass =  htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['pass']));
        session_start();
        unset($_SESSION['admin']);
        if($login == $login_cur && $pass == $pass_cur){
            $_SESSION['admin'] = 1;
            header("location: complaints");
        }
         else {
            echo 'error';
        }
    }
    public function actionUpdate(){
        $db = Complaints::getInstance();
        $mysqli = $db->getConnection();
        //print_r($_POST);
        $id =  htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['id']));
        $name =  htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['name']));
        $email =  htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['email']));
        $text =  htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['text']));
        $db->update($id,$name,$email,$text);
        
    }
    public function actionDelete(){
        $db = Complaints::getInstance();
        $mysqli = $db->getConnection();
        $id =  htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['id']));
        $db->delete($id);
        
    }
        public function actionLogout(){
            session_start();
        unset($_SESSION['admin']);
        
    }
}
