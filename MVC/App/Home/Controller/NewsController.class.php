<?php
//声明新闻控制器类，并继承基础控制器类
final class NewsController extends BaseController{

	//新闻首页
	public function index()
	{
		$modelObj = FactoryModel::getInstance("NewsModel");
		$arr = $modelObj->fetchAll();
		include VIEW_PATH . "index.html";
	}

	//删除新闻
	public function del()
	{
		//创建模型类对象
		$modelObj = FactoryModel::getInstance("NewsModel");
		//调用模型类的删除方法
		$id = $_GET['id'];
		$modelObj->del($id);
		$this->jump("id={$id}的记录删除成功！","?c=News");
	}

}
