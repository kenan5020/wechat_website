<?php
class Math
{
	private $expression = array();   //需要转换的中缀表达式
	private $rpnexp = array();		//处理后的逆波兰式
	private $stack = array('#');   //储存临时运算符栈
	private $priority = array('#'=>0, '('=>10, '+' => 20, '-'=>20, '*'=>30, '/'=>30); //运算符优先级
	private $operator = array('(', '+', '-', '*', '/', ')'); //四则运算符
	public function __construct($expression)
	{
		$this->_init($expression);
	}
	private function get_token_array($string)
	{
		/* 构造记号流*/
		$token = array();
		$str_len = 0;
		while (true)
		{
			if (1 === preg_match('/^([%,\\^\\+\\-\\*\\/\\(\\)]).*$/',$string,$sub))
			{
				array_push($token,$sub[1]);
				$string = substr($string,strlen($sub[1]));
				$str_len += strlen($sub[1]);
				continue;
			}
			elseif (1 === preg_match('/^(([0-9]+[\\.]?[0-9]*)|([0-9]*[\\.]?[0-9]+)).*$/',$string,$sub))
			{
				array_push($token,floatval($sub[1]));
				$string = substr($string,strlen($sub[1]));
				$str_len += strlen($sub[1]);
				continue;
			}
			elseif (1 === preg_match('/^([a-zA-Z_][0-9a-zA-Z_]*\\().*$/',$string,$sub))
			{
				array_push($token,$sub[1]);
				$string = substr($string,strlen($sub[1]));
				$str_len += strlen($sub[1]);
				continue;
			}
			elseif (1 === preg_match('/^(\\s+).*$/',$string,$sub))
			{
				$string = substr($string,strlen($sub[1]));
				$str_len += strlen($sub[1]);
				continue;
			}
			else 
			{
				break;
			}
		}
		if ($string != '') 
		{
			return $str_len;
		}
		return $token;
	}
	private function _init($expression)
	{
		$exp = array();
		//$expression = deleteHtml($expression); 
		$exp = $this->get_token_array($expression);
		if(!is_array($exp))
		{
			$str = substr($expression, $exp,1);
			echo $expression,'表达式错误在',$str;
			exit;
		}
		$this->expression = $exp;
	}
	public function exp2rpn()
	{
		$count = count($this->expression);
		for($i = 0; $i<$count; $i++)
		{
			$char  = $this->expression[$i]; //获取表达式中的每一个字符串
			if ($char == '(') //如果字符为(,则直接存入$stack的栈顶
			{
				$this->stack[] = $char;
				continue;
			}
			else if (!in_array($char, $this->operator)) //如果字符不为运算符，则压入$rpnexp中
			{
				$this->rpnexp[] = $char;
				continue;
			}
			else if ($char == ')') //在$stack中查找最近"("之间的运算符，逐个出栈.送入栈$rpnexp中
			{
				for ($j =count($this->stack); $j >= 0; $j++)
				{
					$tmp = array_pop($this->stack);
					if ($tmp == '(') //跳出循环
						break;
					else
						$this->rpnexp[] = $tmp;
				}
				continue;
			}
			else if ($this->priority[$char] <= $this->priority[end($this->stack)])
			{
				$this->rpnexp[] = array_pop($this->stack);
				$this->stack[] = $char;
				continue;
			}
			else
			{
				$this->stack[] = $char;
				continue;
			}
		}
		//将存在临时的运算符栈剩余的内容存入rpnexp栈中
		for($i=count($this->stack); $i>=0; $i++)
		{
			if(end($this->stack) == '#')
				break;
			else
				$this->rpnexp[] = array_pop($this->stack);
		}
		return $this->rpnexp;
	}
	public function getResult($rpnexp)
	{
		$result = array();
		$rpnexp = array_reverse($rpnexp); //将值倒叙
		$count = count($rpnexp);
		//如果有运算符就计算，否则将数据压入$result结果栈中
		while($count>0)
		{
			$v = array_pop($rpnexp); 
			if(in_array($v, $this->operator))
			{
				$a = array_pop($result);
				$b = array_pop($result);
				switch($v)
				{
					case '+':
						array_push($result, ($a+$b));
						break;
					case '-':
						array_push($result, ($b-$a));
						break;
					case '*':
						array_push($result, ($a*$b));
						break;
					case '/':
						array_push($result, ($b/$a));
						break;
					default:
						break;
				}
			}
			else
				array_push($result, $v);
			$count--;
		}
		return array_pop($result);
	}
}
?>