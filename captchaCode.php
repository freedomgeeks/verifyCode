<?php
/**
 * 验证码
 * by freegeek
 * 附gd库调试技巧：如果发现生成的图片没有显示出来，只有一个小方块，去掉header图片输出流类型声明，页面就会显示错误信息
 * */
class captchaCode{
    public $width;
    public $height;
    

    function __construct() {
        session_start();
        $this->width=150;
        $this->height=40;

    }


    function letterCode(){
        header("content-type:image/png");

        $wd=$this->width;
        $hg=$this->height;
        $image=imagecreatetruecolor($wd,$hg);
        $white=imagecolorallocate($image,255,255,255);
        $co=imagecolorallocate($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
        imagefilledrectangle($image,0,0,150,60,$white);

        //生成随机字符串
        $str = "a0b1c2d3e4f5g6h7i8j9kLmaop66qRstu138vw56xyz";
        $checkStrin='';
        for($i=0;$i<5;$i++){//$i表示验证码的位数
            $checkStrin = $checkStrin.$str[mt_rand(0,23)];
        }

        $_SESSION['verifyCode']=strtolower($checkStrin);

        $font='font/SIMPBDO.TTF';
        // $cp=rand(10000,99999);
        imagettftext($image, 25, mt_rand(-5,5), 20, 30, $co,$font,$checkStrin);



        //绘制糙点
        for($i=0;$i<=100;$i++){
            imagesetpixel($image, mt_rand(0,150), mt_rand(0,60), $co);
        }

        //绘制干扰线
        for($i=0;$i<5;$i++){
            imageline($image, mt_rand(0,150), mt_rand(0,60), mt_rand(0,150), mt_rand(0,60), $co);
        }

        imagepng($image);
        imagedestroy($image);
     }

     function captchaCN(){


         $image=imagecreatetruecolor(200, 60);
         $bgcolor=imagecolorallocate($image, 255, 255, 255);
         imagefill($image, 0, 0, $bgcolor);

         // for($i=0;$i<4;$i++){
         //     $fontsize=6;
         //     $fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));
         //     $fontcontent=rand(0,9);
         //     $x=($i*100/4)+rand(5,10);
         //     $y=rand(0,10);

         //     imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);

         // }
         $fontface='font/SIMHEI.TTF';
         $str="从当两些还天资事队批如应形想制心样干都向变关点育重其思与间内去因件日利相由压员气业代全组数果期实际上计算机说的是假的时代科技大家看水电开发简单快速的减肥看电视技术的开发四大皆空发色大家看世界的看法四大皆空发色打击开发商的";
         $strdb=str_split($str,3);
         $captch_code='';
         for($i=0;$i<4;$i++){
             $fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));

             $index=rand(0,count($strdb));
             $cn=$strdb[$index];
             $captch_code.=$cn;

             imagettftext($image,mt_rand(20,24),mt_rand(-60,60),(40*$i+20),mt_rand(30,35),$fontcolor,$fontface,$cn);

         }
         $_SESSION['verifyCode']=$captch_code;


         for($i=0; $i<200;$i++){
             $pointcolor=imagecolorallocate($image,rand(50,200),rand(50,200),rand(50,200));
             imagesetpixel($image, rand(1,199),rand(1,59),$pointcolor);
         }

         for($i=0;$i<3;$i++){
             $lor=imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
             imageline($image,rand(1,199),rand(1,59),rand(1,199),rand(1,59),$lor);
         }


         header('content-type:image/png');
         imagepng($image);

         imagedestroy($image);
     }

     function captchaImage(){
         $table=array(
             'pic0'=>'虎',
             'pic1'=>'猪',
             'pic2'=>'猴',
             'pic3'=>'鸡',
             'pic4'=>'蛇',

         );
         $index=rand(0,count($table));

         $value=$table['pic'.$index];
         $_SESSION['verifyCode']=$value;

         $filename=dirname('__FILE__').'\\img\pic'.$index.'.jpg';
         $contents=file_get_contents($filename);

         header('content-type:image/jpg');

         echo $contents;

     }
     
    
}


(new captchaCode())->captchaImage();


