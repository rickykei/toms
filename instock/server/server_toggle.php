<?
$_SESSION['toggle_state']=!$_SESSION['toggle_state'];
if ($_SESSION['toggle_state']) 
	echo '<item><name>toggleState</name><value>true</value></item><item><name>toggleContent</name><value><![CDATA[This is a <b>test</b> of the emergency broadcast system.]]></value></item>';
else
	echo '<item><name>toggleState</name><value>false</value></item><item><name>toggleContent</name><value><![CDATA[This is a <b>test</b> of the emergency broadcast system.]]></value></item>';
