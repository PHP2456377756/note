<?php
//抽象的基础控制器类
abstract class BaseController{

	//构造方法
	public function __construct()
	{
		//声明页面字符集
		header("content-type:text/html;charset=utf-8");
	}

	//跳转方法
	protected function jump($msg="",$url="?",$time=3)
	{
		echo "<h2>$msg</h2>";
		header("refresh:$time;url=$url");
		exit();
	}
}