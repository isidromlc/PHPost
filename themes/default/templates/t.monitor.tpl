{include file='sections/main_header.tpl'}
				{if $tsAction == ''}
                    {include file='modules/m.monitor_content.tpl'}
                    {include file='modules/m.monitor_sidebar.tpl'}
                {else}
	                {include file='modules/m.monitor_menu.tpl'}
                    {include file='modules/m.monitor_listado.tpl'}
<style>
/* {literal} */
.btn_follow a {
/* {/literal} */
	background-image: url('{$tsConfig.images}/btn_follow.png');
/* {literal} */
	background-repeat: no-repeat;
	background-position: top left;
display:block;
height:26px;
padding-bottom:0;
padding-left:7px;
padding-right:12px;
padding-top:4px;
width:13px;
}

.btn_follow a:hover , .btn_follow a:focus{
	background-position: -33px 0;
}

.btn_follow a:active{
	background-position: -66px 0;
}

.btn_follow a span {
	display: block;
	width: 19px;
	height: 19px;
/* {/literal} */
	background-image: url('{$tsConfig.images}/follow_actions.png');
/* {literal} */
	background-repeat: no-repeat;
}

.btn_follow a span.remove_follow {
	background-position: top left;
}

.btn_follow a span.add_follow {
	background-position: 0 -20px;
}

.menu-tabs {
	background: #e1e1e1;
	padding: 10px 10px 0 10px ;
}

.menu-tabs li {
	float: left;
	margin-right: 10px;
}

.menu-tabs li a {
	display: block;
	padding: 10px 15px;
	background: #ebeaea;
	font-size: 14px;
	font-weight: bold;
	color: #2b3ed3!important;
}

.menu-tabs li.selected a,.menu-tabs li a:hover {
	background: #fafafa;
	color: #000!important;
}


.listado li {
	border-top: 1px solid #FFF;
	background: #fafafa;
	border-bottom: 1px dotted #CCC;
}

.listado li:first-child {
	border-top: none;
}



.listado li:hover {
	background: #EEE;
}

.listado a {
	color: #2b3ed3!important;
	font-weight: bold;
}

.listado .listado-avatar {
	float:left;
	margin-right: 10px;
}

.listado .listado-avatar img {
	padding: 1px;
	background: #FFF;
	border: 1px solid #CCC;	
	width: 32px;
	height: 32px;
}

.listado .listado-content {
	padding: 5px;
	float: left;
}

.listado .txt  {
	float: left;
	line-height:18px;
}

.listado .txt .grey {
	color: #999;
}

.listado .action {
	float: right;
	border-left: 1px solid #d6d6d6;
	background: #EEE;
	padding: 8px;
}

.listado-paginador {
	padding: 5px;
}

a.siguiente-listado, a.anterior-listado {
	display: block;
	padding: 5px 10px;
	-moz-border-radius: 15px;
	-webkit-border-radius: 15px;
	border-radius:15px;
	color: #000!important;
	font-size: 13px;
}


/* new clearfix */
.clearfix:after {
	visibility: hidden;
	display: block;
	font-size: 0;
	content: " ";
	clear: both;
	height: 0;
	}
* html .clearfix             { zoom: 1; } /* IE6 */
*:first-child+html .clearfix { zoom: 1; } /* IE7 */
/* {/literal} */
</style>
                {/if}
                <div style="clear: both;"></div>
                
{include file='sections/main_footer.tpl'}