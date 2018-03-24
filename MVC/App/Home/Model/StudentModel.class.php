<?php
//定义单例的模型类文件
final class StudentModel extends BaseModel{
	
	//获取单行数据
	public function fetchOne($id)
	{
		//构建查询的SQL语句
		$sql = "SELECT * FROM student WHERE id=$id";
		//执行SQL语句，并返回一维数组
		return $this->db->fetchOne($sql);
	}

	//获取多行数据
	public function fetchAll()
	{
		//构建查询的SQL语句
		$sql = "SELECT * FROM student ORDER BY id DESC";
		//执行SQL语句，并返回二维数组
		return $this->db->fetchAll($sql);
	}

	//插入数据
	public function insert($data)
	{
		//$fields = "name,sex,age,edu,salary,bonus,city";
		//$values = "'$name','$sex','$age','$edu','$salary','$bonus','$city'";
		//构建字段列表字符串和值列表字符串
		$fields = "";
		$values = "";
		foreach($data as $key=>$value)
		{
			$fields .= "$key,";
			$values .= "'$value',";
		}
		//去除字符串末尾的逗号
		$fields = rtrim($fields,",");
		$values = rtrim($values,",");
		
		//构建插入的SQL语句
		$sql = "INSERT INTO student($fields) VALUES($values)";
		//执行SQL语句，并返回结果
		return $this->db->exec($sql);
	}

	//更新记录
	public function update($data,$id)
	{
		//构建更新字段名和字段值的字符串
		$str = "";
		foreach($data as $key=>$value)
		{
			$str .= "$key='$value',";
		}
		//去除末尾的逗号
		$str = rtrim($str,",");

		//构建更新的SQL语句
		$sql = "UPDATE student SET {$str} WHERE id={$id}";
		//执行SQL语句，返回执行结果
		return $this->db->exec($sql);
	}

	//删除记录的方法
	public function del($id)
	{
		//构建删除的SQL语句
		$sql = "DELETE FROM student WHERE id=$id";
		//执行SQL语句，并返回结果
		return $this->db->exec($sql);
	}

	//获取记录总数
	public function rowCount()
	{
		$sql = "SELECT * FROM student";
		return $this->db->rowCount($sql);
	}
}