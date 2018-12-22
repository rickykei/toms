<?PHP

   class TIMESTAMP {

       var $now_day;
       var $now_time;
       var $now_hour;
       var $now_min;
       var $now_sec;
       var $now_whole;

       function splitStamps() {
		
           list ($this->now_day, $this->now_time) = split(" ", $this->now_whole);
           list ($this->now_hour, $this->now_min,$this->now_sec) = split(":", $this->now_time);

           return true;

       }

		function getDate($abc){
			$this->now_whole=$abc;
			$this->splitStamps();
			echo $this->now_day." ".$this->now_hour.":".$this->now_min;
   		}
}
?>
