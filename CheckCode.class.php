<?php
	//验证码
	
	class CheckCode{
		//资源
		private $img;
		//画布宽高度
		public $width=100;
		public $height=30;
		//背景颜色
		public $bg_color='#DCDCDC';
		//验证码的随机种子
		public $code;
		public $code_str="123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
		//验证码的长度
		public $code_len=4;
		//验证码字体
		public $font;
		//验证码字体大小颜色
		public $font_color='#000000';
		public $font_size=16;
		/****
		**构造函数
		****/
		public function __construct(){
			$this->font='FZSTK.TTF';
		}
		/****
		**生成验证码
		****/
		private function create_code(){
			$code='';
			for($i=0; $i<$this->code_len; $i++){
				$code.=$this->code_str[mt_rand(0,strlen($this->code_str)-1)];
			}
			$this->code=$code;
		}
		/****
		**返回验证码
		****/
		public function getcode(){
			return strtolower($this->code);
		}
		/****
		**建画布
		****/
		public function getimage(){
			$w=$this->width;
			$h=$this->height;
			if(!$this->checkgd())		//检查gd库是否开启
				return false;  
			$img=imagecreatetruecolor($w,$h);
			$bg_color=imagecolorallocate($img,hexdec(substr($this->bg_color,1,2)),hexdec(substr($this->bg_color,3,2)),hexdec(substr($this->bg_color,5,2)));
			imagefill($img, 0, 0, $bg_color);
			$this->img = $img;
			$this->create_font();
			$this->create_pix();
			$this->show_code();
		}
		private function checkgd(){
			return extension_loaded('gd')&&function_exists('imagepng');
		}
		/****
		**写入验证码文字
		****/
		private function create_font(){
			$this->create_code();
			$font_color=imagecolorallocate($this->img,hexdec(substr($this->font_color,1,2)),hexdec(substr($this->font_color,3,2)),hexdec(substr($this->font_color,5,2)));
			$x=$this->width/$this->code_len;
			for($i=0; $i<$this->code_len; $i++){
				imagettftext($this->img, $this->font_size, mt_rand(-30,30), $x*$i+mt_rand(3,6),mt_rand($this->height/1.2,$this->height-5),$font_color, $this->font, $this->code[$i]);
			}
			$this->font_color=$font_color;
		}
		/****
		**画线
		****/
		private function create_pix(){
			//画点
			for($i=0; $i<100; $i++){
				imagesetpixel($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),$this->font_color);
			}
			//画线
			for($j=0; $j<2; $j++){
				imagesetthickness($this->img,1);
				imageline($this->img,mt_rand(0,$this->width-1),mt_rand(0,$this->height-1),mt_rand(0,$this->width-1),mt_rand(0,$this->height-1),$this->font_color);
			}
		}
		/****
		**显示验证码
		****/
		private function show_code(){
			header("Content-type:image/png");
			imagepng($this->img);
			//imagedestroy($this->$img);
		}

	}

?>