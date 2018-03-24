<?php
//最终的框架初始类文件
final class Frame{
	
	//公共的静态的初始化框架的方法
	public static function run()
	{
		self::initConfig();		//初始化配置文件
		self::initRoute();		//初始化路由参数
		self::initConst();		//初始化常量设置
		self::initAutoLoad();	//初始化类的加载
		self::initDispatch();	//初始化请求分发
	}

	//私有的静态的初始化配置文件方法
	private static function initConfig()
	{
		//将配置参数，保存到超全局数组中
		$GLOBALS['config'] = require_once("./App/Conf/Config.php");
	}

	//私有的静态的初始化路由参数
	private static function initRoute()
	{
		$p = isset($_GET['p']) ? $_GET['p'] : $GLOBALS['config']['default_platform']; //平台参数
		$c = isset($_GET['c']) ? $_GET['c'] : $GLOBALS['config']['default_controller']; //控制器名称参数
		$a = isset($_GET['a']) ? $_GET['a'] : $GLOBALS['config']['default_action'];   //用户动作参数
		define("PLAT",$p);
		define("CONTROLLER",$c);
		define("ACTION",$a);
	}

	//私有的静态的常量设置
	private static function initConst()
	{
		define("DS",DIRECTORY_SEPARATOR); //随操作系统变化(/\)
		define("ROOT_PATH",getcwd()); //网站根目录
		define("FRAME_PATH",ROOT_PATH . DS . "Frame" . DS); //Frame目录 
		define("APP_PATH",ROOT_PATH . DS . "App" . DS); //App目录
		define("MODEL_PATH",APP_PATH . PLAT . DS . "Model" . DS); //Model目录
		define("VIEW_PATH",APP_PATH . PLAT . DS . "View" . DS . CONTROLLER . DS);//视图目录
		define("CONTROLLER_PATH",APP_PATH . PLAT . DS . "Controller" . DS); //控制器目录
	}

	//私有的静态的类的自动加载
	private static function initAutoLoad()
	{
		spl_autoload_register(function($className){
			//构建类文件的数组
			$arr = array(
				FRAME_PATH . "$className.class.php",	
				MODEL_PATH . "$className.class.php",
				CONTROLLER_PATH . "$className.class.php"
			);
			//循环判断，类文件是否存在
			foreach($arr as $filename)
			{
				//如果类文件存在，则加载
				if(file_exists($filename))
				{
					require_once($filename);
				}
			}
		});
	}

	//私有的静态的请求分发：创建哪个控制器对象，调用哪个控制器对象方法
	private static function initDispatch()
	{
		//创建控制器类的对象
		$controllerClassName = CONTROLLER . "Controller"; //StudentController 
		$controllerObj = new $controllerClassName();
		//调用控制器对象的方法
		$action = ACTION;
		$controllerObj->$action();
	}
}