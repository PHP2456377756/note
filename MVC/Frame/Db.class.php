<?php
//最终的单例的数据库操作类
final class Db{
	//私有的静态的保存对象的属性
	private static $obj = NULL;
	
	//私有的成员属性
	private $db_host;
	private $db_user;
	private $db_pass;
	private $db_name;
	private $charset;

	//私有的构造方法：阻止类外new对象
	private function __construct()
	{
		$this->db_host	= $GLOBALS['config']['db_host'];
		$this->db_user	= $GLOBALS['config']['db_user'];
		$this->db_pass	= $GLOBALS['config']['db_pass'];
		$this->db_name	= $GLOBALS['config']['db_name'];
		$this->charset	= $GLOBALS['config']['charset'];
		$this->connMySQL();   //连接数据库
		$this->selectDb();    //选择数据库
		$this->setCharset();  //设置字符集
	}

	//私有的克隆方法：阻止类外clone对象
	private function __clone(){}

	//公共的静态的创建对象的方法
	public static function getInstance(){
		//判断对象是否存在
		if(!self::$obj instanceof self)
		{
			//如果对象不存在，则创建它
			self::$obj = new self;
		}
		//如果对象存在，则直接返回
		return self::$obj;
	}

	//私有的连接数据库方法
	private function connMySQL()
	{
		$link = @mysql_connect($this->db_host,$this->db_user,$this->db_pass);
		if(!$link) die("PHP连接MySQL失败！");
	}

	//私有的选择数据库方法
	private function selectDb()
	{
		if(!mysql_select_db($this->db_name)) 
			die("选择数据库{$this->db_name}失败了！");
	}

	//私有的设置字符集
	private function setCharset()
	{
		return $this->exec("set names $this->charset");
	}

	//公共的执行SQL语句的方法：insert、update、delete、set、create、drop
	//返回一个布尔值
	public function exec($sql)
	{
		//$sql = "select * from student"
		//将SQL语句转成全小写
		$sql = strtolower($sql);
		//判断是否是SELECT语句
		if(substr($sql,0,6)=="select")
		{
			die("请使用query()方法来执行当前的SQL语句");
		}else
		{
			//如果是非SELECT语句，则直接执行，并返回布尔值
			return mysql_query($sql);
		}
	}

	//私有的执行SQL语句的方法：select、show
	//返回结果集
	private function query($sql)
	{
		//将SQL语句转成全小写
		$sql = strtolower($sql);
		//判断是否是SELECT语句
		if(substr($sql,0,6)!="select")
		{
			die("请使用exec()方法来执行当前的SQL语句");
		}else
		{
			//如果是SELECT语句，则直接执行，并返回结果集
			return mysql_query($sql);
		}
	}

	//获取一行数据
	public function  fetchOne($sql,$type=3)
	{
		//执行SQL语句，并返回结果集
		$result = $this->query($sql);
		//常量数组
		$types = array(
			1	=> MYSQL_BOTH,
			2	=> MYSQL_NUM,
			3	=> MYSQL_ASSOC
		);
		//返回一维数组
		return mysql_fetch_array($result,$types[$type]);
	}

	//公共的获取多行结果数组：array_fetch_array($result,MYSQL_BOTH|MYSQL_ASSOC|MYSQL_NUM)
	public function fetchAll($sql,$type=3)
	{
		//执行SQL语句，并返回结果集
		$result = $this->query($sql);
		//常量数组
		$types = array(
			1	=> MYSQL_BOTH,
			2	=> MYSQL_NUM,
			3	=> MYSQL_ASSOC
		);

		//循环取出所有行，并生成二维数组
		while($row = mysql_fetch_array($result,$types[$type]))
		{
			$arr[] = $row;
		}

		//返回二维数组
		return $arr;
	}

	//获取查询记录数
	public function rowCount($sql)
	{
		//执行SQL语句，并返回结果集
		$result = $this->query($sql);
		//获取记录数
		return mysql_num_rows($result);
	}

	//公共的析构方法
	public function __destruct()
	{
		//关闭MySQL连接
		mysql_close();
	}
}
