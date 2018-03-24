<?php
//声明学生控制器类，并继承基础控制器类
final class StudentController extends BaseController{

	//显示首页方法
	public function index()
	{
		$modelObj = FactoryModel::getInstance("StudentModel");
		$arr = $modelObj->fetchAll();
		$records = $modelObj->rowCount();
		include VIEW_PATH . "index.html";
	}

	//删除学生方法
	public function del()
	{
		$modelObj = FactoryModel::getInstance("StudentModel");
		$id = $_GET['id'];
		$modelObj->del($id);
		$this->jump("id={$id}的记录删除成功！","?c=Student");
	}

	//显示添加的表单
	public function add()
	{
		//包含添加学生的视图文件
		include VIEW_PATH . "add.html";
	}

	//插入数据
	public function insert()
	{
		//获取表单提交数据
		$data['name']	= $_POST['name'];
		$data['sex']	= $_POST['sex'];
		$data['age']	= $_POST['age'];
		$data['edu']	= $_POST['edu'];
		$data['salary']	= $_POST['salary'];
		$data['bonus']	= $_POST['bonus'];
		$data['city']	= $_POST['city'];

		//调用模型类对象的insert()方法
		$modelObj = FactoryModel::getInstance("StudentModel");
		$modelObj->insert($data);
		$this->jump("学生信息添加成功！","?c=Student");
	}

	//显示修改的表单
	public function edit()
	{
		$id = $_GET['id'];
		$modelObj = FactoryModel::getInstance("StudentModel");
		$arr = $modelObj->fetchOne($id);
		include VIEW_PATH . "edit.html";
	}

	//更新学生信息
	public function update()
	{
		//获取表单提交数据
		$id				= $_POST['id'];
		$data['name']	= $_POST['name'];
		$data['sex']	= $_POST['sex'];
		$data['age']	= $_POST['age'];
		$data['edu']	= $_POST['edu'];
		$data['salary'] = $_POST['salary'];
		$data['bonus']	= $_POST['bonus'];
		$data['city']	= $_POST['city'];

		//调用模型类对象更新数据
		FactoryModel::getInstance("StudentModel")->update($data,$id);
		//跳转方法
		$this->jump("id={$id}的记录修改成功！","?c=Student");
	}
}
