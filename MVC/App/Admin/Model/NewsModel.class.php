<?php
//定义单例的模型类文件
final class NewsModel extends BaseModel{

	//获取多行数据
	public function fetchAll()
	{
		//构建查询的SQL语句
		$sql = "SELECT * FROM news ORDER BY nid DESC";
		//执行SQL语句，并返回二维数组
		return $this->db->fetchAll($sql);
	}

	//删除记录的方法
	public function del($id)
	{
		//构建删除的SQL语句
		$sql = "DELETE FROM news WHERE nid=$id";
		//执行SQL语句，并返回结果
		return $this->db->exec($sql);
	}
}