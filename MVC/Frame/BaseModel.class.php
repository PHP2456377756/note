<?php
//定义基础模型类
abstract class BaseModel{
	
	//爱保护的成员属性
	protected $db = NULL;
	//构造方法：创建数据库对象
	public function __construct()
	{
		//创建数据库对象
		$this->db = Db::getInstance();
	}
}