<?php
//最终的单例工厂模型类
final class FactoryModel{
	
	//私有的静态的保存对象的数组
	private static $obj = array();

	//公共的静态的创建不同模型类对象的方法
	public static function getInstance($className)
	{
		/*
			$obj[StudentModel] = 学生模型类对象
			$obj[NewsModel]    = 新闻模型类对象
			$obj[ProductModel] = 产品模型类对象
		*/
		//判断对应的模型类对象是否存在
		if(!isset(self::$obj[$className]))
		{
			self::$obj[$className] = new $className;
		}
		//返回对应的模型类对象
		return self::$obj[$className];
	}
}