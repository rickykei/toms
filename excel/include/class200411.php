<?
class powerall_spam
{
	//function daemon_service(name_of_daemon,start:stop)
	function daemon_service($name_of_daemon,$action)
	{
		if ($name_of_daemon=="amavisd")
		$path=="/usr/local/sbin/amavisd";
		elseif ($name_of_daemon=="clamd")
		$path=="/usr/local/sbin/clamd";
		
	}
		
	function check_daemon_status($daemon_name)
	{
		$string_class=new string_class();
		get_class($string_class);
		
		$status=exec("/powerall/script/check_process.sh ".$daemon_name);
		$out=$string_class->string_to_boolean($status);
		return $out;
	}
		
	function check_comment_and_action($string_array,$action)
	{
	//extend class
	
	$string_class=new string_class();
	get_class($string_class);

	//check comment or not in conf
	//	$temp=$string_class->check_all_comment_at_first_char_each_line($powerallattachment,"#");
	
	/*
	echo "<P>array1:";
	echo $string_class->check_all_comment_at_first_char_each_line($string_array,"#");
	echo "<p>action2:";
	echo $action;
	echo "<p>";
	*/
	if ($string_class->check_all_comment_at_first_char_each_line($string_array,"#")==$action)
	//if action (enable)== config (disable)
	//if action (disable)==  config(enable)
	{
		/*
		echo "<p>action b4 check_comment and action<p> ";
		print_r($string_array);
		echo "<p>action b4 check_comment and action<p> ";
		*/
		
		if ($action==true)
		{
		//echo "action=enable ";	
			$string_array=$string_class->comment_at_first_char_each_line($string_array,"#","remove","#powerall");
		
		}
		else
		{
		//echo "action=disable ";
			$string_array=$string_class->comment_at_first_char_each_line($string_array,"#","add","#powerall");
		}
	}
	return $string_array;
	}
}
	
class string_class
{
	function string_to_boolean($string)
	{
		if ($string=="true")
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	/////////
	//$stringarray=inputarray,$actionchar,$action=remove|add,$except=noneedaction
	function comment_at_first_char_each_line($string_array,$char,$action,$except)
	{
		$line_counter=count($string_array);
	
		for ($i=0;$i<$line_counter;$i++)
		{
			
			if (preg_match("/".$except."/i", $string_array[$i])==false)
			{
				if ($action=="add")
				{
					//echo "add";
					$string_array[$i]="#".$string_array[$i];
					
				}
				else
				{
					//echo "remove";
					$string_array[$i]=substr($string_array[$i], 1);    
				}
			}
		}
			return $string_array;
	}
				
	//two dimension array string[0][0]
	//this function only check the str[0][0] str[1][0]....
	function check_all_comment_at_first_char_first_array($string_array,$char)
	{
		$count_char=0;
		$line_counter=count($string_array);
		for ($i=0;$i<$line_counter;$i++)
		{
			if (substr($string_array[$i][0],0,1)==$char)
			{
				$count_char++;
			}
		}
		if ($count_char==$line_counter)
		{
			
			return true;
		}
		else
		{
			
			return false;
		}
	}
	
	//one dimension array input string[0]
	function check_all_comment_at_first_char_each_line($string_array,$char)
	{
		$count_char=0;
		
		$line_counter=count($string_array);
		
		for ($i=0;$i<$line_counter;$i++)
		{
			if (substr($string_array[$i],0,1)==$char)
			{
				$count_char++;
			}
		}
		
		//echo "<p>".$count_char."_".$line_counter."<P>";
		if ($count_char==$line_counter)
		{
			//echo "commented all in config ";
			return true;
		}
		else
		{
			//echo "no comment in conifg ";
			return false;
		}
	}
	
	function  cov_3col_9col($string_array)
	{
		$out_array=array();
		
		$string_array_counter=count($string_array);
		$out_string_array_counter=$string_array_counter/3;
		
		$y=0;
		
		for ($i=0;$i<$out_string_array_counter;$i++)
		{
			for ($j=0;$j<9;$j+=3)
			{
			$out_array[$i][$j]=$string_array[$y][0];
			$out_array[$i][$j+1]=$string_array[$y][1];
			$out_array[$i][$j+2]=$string_array[$y][2];
			$y++;
			}
		}
		return ($out_array);
	}
	
	function  cov_9col_3col($string_array)
	{
		$string_array_counter=count($string_array);
		//echo "stringarracounter=".$string_array_counter;
		$y=0;
		for ($i=0;$i<$string_array_counter;$i++)
		{
			$countoffset=count($string_array[$i]);
		
			for ($z=0;$z<$countoffset;$z+=3)
			{
		
			$out_array[$y][0]=$string_array[$i][$z];
			$out_array[$y][1]=$string_array[$i][$z+1];
			$out_array[$y][2]=$string_array[$i][$z+2];
			$y++;
			}
			
		}
				
		return ($out_array);
	}
	function add_row($string_array,$add_string_array)
	{
		$add_string_counter=count($add_string_array);
		$string_array_counter=count($string_array);
		for ($i=0;$i<$add_string_counter;$i++)
		{
			$string_array[$string_array_counter][$i]=$add_string_array[$i];
		}
		return $string_array;
		
	}
	
	function drop_row($string_array,$line)
	{
		unset($string_array[$line]);
		$string_array = array_values($string_array);
		return $string_array;
	}
	function check_null($string_array)
	{
		$counter=count($string_array);
		for ($i=0;$i<$counter;$i++)
		{
			if ($string_array[$i]=="")
			{
				unset($string_array[$i]);
			}
		}
		return $string_array;
	}
  function check_null_fill_zero($string_array,$counter)
	{
		
		for ($i=0;$i<$counter;$i++)
		{
			if ($string_array[$i]=="")
			{
				$string_array[$i]=0;
			}
		}
		return $string_array;
	}
}

class file_io
{
	
	function get_conf_perl_line_per_array($file_name)
	{
		$out_array="";
		$chmod1="sudo chmod 777 ".$file_name;
		$chmod2="sudo chmod 644 ".$file_name;
		echo exec($chmod1);
		
		$fp1=fopen($file_name,'r');
		if (!$fp1)
		{
			echo $file_name;
			echo 'cant open';
		}
		else
		{
			$string_array=array();
			$out_array=array();
			$i=0;
			
			while (false !== ($line = fgets($fp1)))
 			{
				//preg_match('/(.*?)[\s]+(.*?)[\s]+(.*?)$/i',$line,$string_array[$i]);
				preg_match('/(.*?)$/i',$line,$string_array[$i]);
				//echo "aa";
				$i++;
			}
			
			//print_r($string_array);
			
			$no_of_line=count($string_array);
			//echo "hello=".$no_of_line."=";
			for ($i=0;$i<$no_of_line;$i++)
			{
				$out_array[$i]=$string_array[$i][0];
				/*
				$out_array[$i].="  ";
				$out_array[$i].=$string_array[$i][2];
				$out_array[$i].="  ";
				$out_array[$i].=$string_array[$i][3];
				*/
			}
			
			return $out_array;
		}
		
		fclose($fp1);
		echo exec($chmod2);
	}
		
	/////////////////////
	//get conf split
	//use for get the config file and divided to some parts
	
	function get_conf_perl($file_name,$no_row)
	{
		$out_array=array();
		$chmod1="sudo chmod 777 ".$file_name;
		$chmod2="sudo chmod 644 ".$file_name;
		echo exec($chmod1);
		
		$fp1=fopen($file_name,'r');
		if (!$fp1)
		{
			echo $file_name;
			echo 'cant open';
		}
		else
		{
			$string_array=array();
			$i=0;
			
			while (false !== ($line = fgets($fp1)))
 			{
				preg_match('/(.*?)[\s]+(.*?)[\s]+(.*?)$/i',$line,$string_array[$i]);
				$i++;
			}
			
			//print_r($string_array);
			
			$no_of_line=count($string_array);
			
			for ($i=0;$i<$no_of_line;$i++)
			{
				$out_array[$i][0]=$string_array[$i][1];
				$out_array[$i][1]=$string_array[$i][2];
				$out_array[$i][2]=$string_array[$i][3];
			}
			
			return $out_array;
		}
		
		fclose($fp1);
		echo exec($chmod2);
	}
	
	
	//get file and split it to diff array by div_string
	function get_conf_split($file_name,$div_string)
	{
		$chmod1="sudo chmod 777 ".$file_name;
		$chmod2="sudo chmod 644 ".$file_name;
		echo exec($chmod1);
		
		$fp1=fopen($file_name,'r');
		if (!$fp1) 
		{
   			echo $file_name;
   			echo 'Could not open file somefile.txt';
		}
		else
		{
			$i=0;
			$string_array="";
			while (false !== ($char = fgets($fp1)))
 			{
				$string_array.=$char;
				
			}
			$out_string=split($div_string,$string_array);
			
			return $out_string;
			
			
			
		}
		
		fclose($fp1);
		echo exec($chmod2);
	}
	
	////////////////////////
	//get_conf for two dimension array only
	function get_conf($file_name,$no_row)
	{
		$no_row--;
	//$chmod_command1="sudo chmod 777 ".$file_name;
	//$linexxx=system($chmod_command1,$retval);
	$fp1=fopen($file_name,'r');
	if (!$fp1) 
	{
   		echo $file_name;
   		echo 'Could not open file somefile.txt';
	}
	$disable_this_line=0;
	$linecounter;
	//global $linecounter=0;
        $linecounter=0;
	//global $string_array;
	$string_array=array();
		
	$offset=0;
	$spacecounter=0;
	$semicolcounter=0;
	$enter_counter=0;
	while (false !== ($char = fgetc($fp1)))
 	{

	switch ($char){
		case "#" :
			//$linecounter--;
			$disable_this_line=1;
			break;
		case "\n" :
			
			if ($buffer_linecounter==$no_row)
			{
			$disable_this_line=0;
			$linecounter++;
			$offset=0;
			$buffer_linecounter=0;
			}
			else
			{
			$buffer_linecounter++;
			$offset++;
			$spacecounter=1;
			}
					
			break;
		case " " :
			if ($spacecounter==0)
			{
			$offset++;
			$spacecounter=1;
			}
			break;
		/*case ":" :
			$semicolcounter++;
			//if ($spacecounter==0)
			//{
			
			$offset++;
			$spacecounter=1;
			//}
			break;*/
		/*case "/" :
			if ($spacecounter==0)
			{
			$offset++;
			$spacecounter=1;
			}
			break;*/
		case "\t" :
			if ($spacecounter==0)
			{
			$offset++;
			$spacecounter=1;
			}
			break;
	   		default :
			$spacecounter=0;
			if ($disable_this_line==0)
			{	
					//echo "$char\n";
					//echo "offset=".$offset." ";
			$string_array[$linecounter][$offset]=$string_array[$linecounter][$offset].$char;
			
			}
			
		}
		$buffer=$char;
	}	


		//print all array value for testing
		/*
		echo "<table border=2>";
		for ($i=0;$i<$linecounter;$i++)
		{
		echo "<tr>";
		for ($j=0;$j<10;$j++)
		{
		echo "<td>";
		echo $string_array[$i][$j];
		echo "</td>";
		}
		echo "</tr>";
	
		}
		echo "</table>";
		echo "i=".$i;
	
		//cut the last record for the 127.0.0.1
		//$temp = array_pop($string_array);
		//$string_array = array_values($string_array);
		$linecounter=count($string_array);
		*/
		fclose($fp1);
	return $string_array;
		//echo "linecounter".$linecounter;
	}


	function put_conf_directly($in_file,$content)
	{
		$chmod1="sudo chmod 777 ".$in_file;
		$chmod2="sudo chmod 644 ".$in_file;
		echo exec($chmod1);
		if (is_writable($in_file) )
		{
   			if (!$handle = fopen($in_file, 'w'))
   			{
   		   	echo "Cannot open file ($filename)";
  		       	exit;
 		  	}

  			if (fwrite($handle, $content) === FALSE)
  			{
  		     	echo "Cannot write to file ($in_file)";
 		      	exit;
	   		}

 		fclose($handle);
      		echo exec($chmod2);
   
		}
		else
		{
	   		echo "The file $filename is not writable";
		}

	}
		
	function put_conf($in_file,$in_array)
	{
	//	print_r($in_array);
	$chmod1="sudo chmod 777 ".$in_file;
	$chmod2="sudo chmod 644 ".$in_file;
	echo exec($chmod1);
	$in_array_counter=count($in_array);
	
	$somecontent="";
	$y=0;
	for ($i=0;$i<$in_array_counter;$i++)
	{
		$countoffset=count($in_array[$i]);
		for ($j=0;$j<$countoffset;$j++)
		{
			$somecontent.=$in_array[$i][$j];
			if ($countoffset!=$j+1)
			$somecontent.="\t";
		}
	$somecontent.="\n";
	}
	

	if (is_writable($in_file) )
	{
   	if (!$handle = fopen($in_file, 'w'))
   		{
   	   	echo "Cannot open file ($filename)";
  	       	exit;
 	  	}

  	if (fwrite($handle, $somecontent) === FALSE)
  		{
  	     	echo "Cannot write to file ($in_file)";
 	      	exit;
	   	}

 	fclose($handle);
        echo exec($chmod2);
   
	} else {
	   echo "The file $filename is not writable";
	}

	}



}//end class

class mysql 
{
  var $sql;
  var $result;
  var $row;
  var $debug;
  var $table_name,$checktotal,$no_of_rows;

  function mysql($sql,$debug)
  {
    if ($sql!="")
    {
      $this->sql=$sql;
    }
  }

  function ask_mysql()
  {	
    $sql=$this->sql;
    $result = mysql_query($sql);
    if ($result==true)
    {
    $no_of_rows= mysql_num_rows($result);
    $this->no_of_rows=$no_of_rows;
    }
    return $result;
  }
	
  function query_mysql()
  {
  	$sql=$this->sql;
  	$result= mysql_query($sql);
  	return $result;
  }
	
  function no_of_rows()
  {	
    return $this->no_of_rows;
  }
}

?>
