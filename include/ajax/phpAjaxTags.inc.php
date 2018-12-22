<?
/**
 * Copyright 2006 Marek J. Bisz
 * Version:20060124 
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 * http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

function pat_Empty($var){ return ((!isset($var)) || ($var==''));}

/*
 * diplays js tags for ajax
 */
function pat_js($arg){
	$jsPath=$arg['jsPath'];
?>	
<script src="<?=$jsPath?>/prototype-1.3.1.js" type="text/javascript">A</script>
<script src="<?=$jsPath?>/ajaxtags-1.1.5.js" type="text/javascript">A</script>
<?	
}

function pat_gen($arg,$name, $req){
?>
new AjaxJspTag.<?=$name?>(
 "<?=$arg['baseUrl']?>", {
<?
unset($arg['baseUrl']); 
$i=1;	
$l=count($arg);
foreach ($arg as $k=>$v){
$con=($i<$l)?',':'';
$i++;
switch ($k){
	case 'postFunction':
	case 'errorFunction':
	case 'emptyFunction':	
		?><?=$k?>: <?=$v?><?=$con?>
		<?
		break;
	default:
		?><?=$k?>: "<?=$v?>"<?=$con?>
		<?
	}
}
?>
});
<?
}


function pat_selectx($arg){
	$baseUrl=$arg['baseUrl'];
	$parameters=$arg['parameters'];
	$emptyFunction=$arg['emptyFunction'];
	$postFunction=$arg['postFunction'];
	$target=$arg['target'];
	$source=$arg['source'];
	$eventType=$arg['eventType'];
	$errorFunction=$arg['errorFunction'];
?>
<script type="text/javascript">
new AjaxJspTag.Select(
"<?=$baseUrl?>", {
parameters: "<?=$parameters?>",
<? if (!pat_Empty($emptyFunction)) { ?>
emptyFunction: <?=$emptyFunction?>,
<? } ?><? if (!pat_Empty($postFunction)) { ?>
	postFunction: <?=$postFunction?>,
<? } ?><? if (!pat_Empty($eventType)) { ?>
	eventType: <?=$eventType?>,
<? } ?><? if (!pat_Empty($errorFunction)) { ?>
	errorFunction: <?=$errorFunction?>,
<? } ?>	
target: "<?=$target?>",
source: "<?=$source?>"
});
</script>	
<?
}


function pat_autocompletex($arg){
	$baseUrl=$arg['baseUrl'];
	$parameters=$arg['parameters'];
	$emptyFunction=$arg['emptyFunction'];
	$postFunction=$arg['postFunction'];
	$errorFunction=$arg['errorFunction'];
	$target=$arg['target'];
	$source=$arg['source'];
	$className=$arg['className'];
	$progressStyle=$arg['progressStyle'];
	$forceSelection=$arg['forceSelection'];
	$minimumCharacters=$arg['minimumCharacters'];
	$appendValue=$arg['appendValue'];
	$appendSeparator=$arg['appendSeparator'];
?>
<script type="text/javascript">
new AjaxJspTag.Autocomplete(
"<?=$baseUrl?>", {
parameters: "<?=$parameters?>",
<? if (!pat_Empty($emptyFunction)) { ?>
emptyFunction: <?=$emptyFunction?>,
<? } ?><? if (!pat_Empty($postFunction)) { ?>
	postFunction: <?=$postFunction?>,
<? } ?><? if (!pat_Empty($errorFunction)) { ?>
	errorFunction: <?=$errorFunction?>,
<? } ?><? if (!pat_Empty($className)) { ?>
	className: "<?=$className?>",
<? } ?><? if (!pat_Empty($progressStyle)) { ?>
	progressStyle: "<?=$progressStyle?>",
<? } ?><? if (!pat_Empty($forceSelection)) { ?>
	forceSelection: <?=$forceSelection?>,
<? } ?><? if (!pat_Empty($minimumCharacters)) { ?>
	minimumCharacters: "<?=$minimumCharacters?>",
<? } ?><? if (!pat_Empty($appendValue)) { ?>
	appendValue: <?=$appendValue?>,
<? } ?><? if (!pat_Empty($appendSeparator)) { ?>
	eventType: <?=$appendSeparator?>,
<? } ?>	
target: "<?=$target?>",
source: "<?=$source?>"
});
</script>	
<?
}

function pat_select($arg){pat_gen($arg,'Select',array());}
function pat_autoComplete($arg){pat_gen($arg,'Autocomplete',array());}
function pat_callout($arg){pat_gen($arg,'Callout',array());}

function pat_updateField($arg){pat_gen($arg,'UpdateField',array());}
function pat_updateField1($arg){pat_gen($arg,'UpdateField',array());}
function pat_htmlContent($arg){pat_gen($arg,'HtmlContent',array());}
function pat_portlet($arg){pat_gen($arg,'Portlet',array());}


function pat_tabPanel($arg){
	$panelStyleId=$arg['panelStyleId'];
	$contentStyleId=$arg['contentStyleId'];
	$currentStyleId=$arg['currentStyleId'];
?>	
<div id="<?=$panelStyleId?>">
<ul>
<? 
$defaultId='';
$defaultBaseUrl='';
$defaultParameters='';
foreach ($arg['tabs'] as $k => $v) {
	$default='';
	if ($v['defaultTab']){
		$default='id="'.$currentStyleId.'"';
		$defaultId=$currentStyleId;
		$defaultBaseUrl=$v['baseUrl'];
		$defaultParameters=$v['parameters'];
	}
	?>
  <li id="<?=$k?>"><a <?=$default?> href="javascript://nop/" onclick="executeAjaxTab(this, '<?=$v['baseUrl']?>', '<?=$v['parameters']?>'); return false;"><?=$v['caption']?></a></li>
<? } //foreach ?>
</ul>
</div>
<div id="<?=$contentStyleId?>"></div>
<script type="text/javascript">
function executeAjaxTab(elem, url, params) {
  var myAjax = new AjaxJspTag.TabPanel(url, {
parameters: params,
currentStyleId: "<?=$currentStyleId?>",
target: "<?=$contentStyleId?>",
source: elem
});
}
<? if ($defaultBaseUrl!='') { ?>
	addOnLoadEvent(executeAjaxTab($('<?=$defaultId?>'), '<?=$defaultBaseUrl?>', '<?=$defaultParameters?>'));
<? } ?>	
</script>
<?
}

function pat_toggle($arg){pat_gen($arg,'Toggle',array());}