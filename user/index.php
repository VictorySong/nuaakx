<?php 
require_once "../wx/jssdk.php";
require_once "../SaeMysql.php";
session_start();
if(!isset($_SESSION["openid"])){
	header("Location: ../wx/scope.php");
	die();
}
$mysql=new SaeMysql();
$app=$mysql->getLine("SELECT `appid`,`secret` FROM `wxappid` WHERE 1");
$jssdk = new JSSDK($app["appid"], $app["secret"]);
$signPackage = $jssdk->GetSignPackage();
?>

<html lang="zh-CN"><head>
    <meta http-equiv="Content-type" content="text/html">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>南航学生科协</title>

    <!-- Bootstrap core CSS -->
    <!-- 仍可以用 本以为能减轻服务器压力 结果 这个服务器不稳定 <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    

    <!-- Custom styles for this template -->
    

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link href="css/index.css" rel="stylesheet">

  </head>
  <body>
	<div style="max-width:500px; margin:0 auto; position:relative; background-color:#f5f5f5; font-size:12px; min-width:347;">
		<div id="index">
			<div id="headback" style="width:100%; max-width:500px;" cont="head">
				
			</div>
			<div style="width:100%; top:0px; display:table;" id="head" cont="head">
				<div style="font-size:30px; margin-left:20px; color:rgb(221, 221, 221); display:table-row; padding-bottom:10px;padding-left:10px;" to="login">
					<div style="display:table-cell; vertical-align:top;">
						<!--<span class="glyphicon glyphicon-user" style="margin-bottom:20px; margin-left:20px;font-size:40px;"></span> -->
						<div class="img-circle" onclick="javascript:window.history.back(-1);" style="width: 40px;height: 40px;margin-top: 15px;margin-left:15px;overflow: hidden;float:left;color:rgb(221, 221, 221);">
							<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
						</div>
						<!--//不要头像
						<div id="logoutbutton" class="img-circle"  style="width: 40px;height: 40px;margin-top: 10px;margin-right:20px;overflow: hidden;float:right;">
						<img class="" id="headimgurl" src="getimg.php" style="width: 40px;margin-top: -2px;"></div>
						-->
					</div>
				</div>
			</div>
			
			
			<!--  下边是个人主页菜单列表  -->
			<div id="accordion" cont="content" style="display:none;">
				<div style="width:100%;" cont="head">
				</div>
				
				 
				<div class="panel panel-default">
					<a class="panel-title" href="#recruit"  data-parent="#accordion">
						<div class="panel-heading">
							<table style="box-sizing:border-box;min-width:180px;">
								<tbody>
									<tr>
										<td valign="middle">
											<span class="glyphicon glyphicon-heart" style="color:red;" ></span>
										</td>
										<td>
											<span ></span>
											<br>招新报名
										</td>
										<td align="right">
											<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</a>
				</div>
				
				
				<div class="panel panel-default">
					
					<a class="panel-title" href="#personalinf"  data-parent="#accordion">
						<div class="panel-heading">
							<table>
								<tbody>
									<tr>
										<td valign="top">
											<span class="glyphicon glyphicon-edit" ></span>
										</td>
										<td>
											<span id="name"></span>
											 <br>个人资料
										</td>
										<td align="right">
											<span class="glyphicon glyphicon-chevron-right"  changed="false"></span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</a>
				</div>
				
	<!--			
				<div class="panel panel-default" style="display:none;">
					<a class="panel-title" href="../Forum/index.html"  data-parent="#accordion">
						<div class="panel-heading">
							<table>
								<tbody>
									<tr>
										<td valign="top">
											<span class="glyphicon glyphicon-cog" ></span>
										</td>
										<td>
											<span id="posts"></span>
											<br>技术帖
										</td>
										<td align="right">
											<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</a>
				</div>
				
		-->
				<div class="panel panel-default">
					<a class="panel-title" href="#notice"  data-parent="#accordion">
						<div class="panel-heading">
							<table>
								<tbody>
									<tr>
										<td valign="top">
											<span class="glyphicon glyphicon-envelope" ></span>
										</td>
										<td>
											<span ></span>
											<br>个人通知
										</td>
										<td align="right">
											<span class="glyphicon glyphicon-chevron-right" id="noreadnotice" changed="false"></span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</a>
				</div>
			<!--
				<div class="panel panel-default">
					<a class="panel-title" href="#actvote"  data-parent="#accordion">
						<div class="panel-heading">
							<table>
								<tbody>
									<tr>
										<td valign="top">
											<span class="glyphicon glyphicon-cog" ></span>
										</td>
										<td>
											<span ></span>
											<br>活动投票
										</td>
										<td align="right">
											<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</a>
				</div>
			-->
			
	<!--		
				<div class="panel panel-default">
					<a class="panel-title" href="#fixform"  data-parent="#accordion">
						<div class="panel-heading">
							<table>
								<tbody>
									<tr>
										<td valign="top">
											<span class="glyphicon glyphicon-tag" style="color:red;" ></span>
										</td>
										<td>
											<span ></span>
											<br>义务维修编号
										</td>
										<td align="right">
											<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</a>
				</div>
	-->
  
	
				<div class="panel panel-default">
					<a class="panel-title" href="#fixcomputer"  data-parent="#accordion">
						<div class="panel-heading">
							<table>
								<tbody>
									<tr>
										<td valign="top">
											<span class="glyphicon glyphicon-tag"></span>
										</td>
										<td>
											<span ></span>
											<br>电脑报修
										</td>
										<td align="right">
											<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</a>
				</div>
				
				<div class="panel panel-default">
					<a class="panel-title" href="#fixcheck"  data-parent="#accordion">
						<div class="panel-heading">
							<table>
								<tbody>
									<tr>
										<td valign="top">
											<span class="glyphicon glyphicon-tag" ></span>
										</td>
										<td>
											<span ></span>
											<br>查看预约
										</td>
										<td align="right">
											<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</a>
				</div>
				
				
				
				<div class="panel panel-default">
					<a class="panel-title" href="#kxhd"  data-parent="#accordion">
						<div class="panel-heading">
							<table style="box-sizing:border-box;min-width:180px;">
								<tbody>
									<tr>
										<td valign="top">
											<span class="glyphicon glyphicon-heart"></span>
										</td>
										<td>
											<span ></span>
											<br>活动/赛事/讲座
										</td>
										<td align="right">
											<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</a>
				</div>
				
				<div class="panel panel-default" >
					<a class="panel-title" href="#kxts"  data-parent="#accordion">
						<div class="panel-heading">
							<table style="box-sizing:border-box;min-width:180px;">
								<tbody>
									<tr>
										<td valign="top">
											<span class="glyphicon glyphicon-pencil" ></span>
										</td>
										<td>
											<span ></span>
											<br>投诉与建议
										</td>
										<td align="right">
											<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</a>
				</div>
				
				
			  <div id="Kx" style="display:none;">
				
				<div class="panel panel-default">
					<a class="panel-title" href="../manager/"  data-parent="#accordion">
						<div class="panel-heading">
							<table>
								<tbody>
									<tr>
										<td valign="top">
											<span class="glyphicon glyphicon-cog" ></span>
										</td>
										<td>
											<span ></span>
											<br>线上管理系统
										</td>
										<td align="right">
											<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</a>
					
				</div>
			  </div>
			  <div class="panel panel-default" id="logout" style="margin-top:10px;">
					<a class="panel-title"   data-parent="#accordion">
						<div class="panel-heading" style="padding-top: 0px;">
							<table>
								<tbody>
									<tr>
										<td valign="top">
											
										</td>
										<td align="center">
											<span ></span>
											<br>退出登录
										</td>
										<td align="right">
											
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</a>
				</div>
			</div>
			<p>&nbsp;</p>
		</div>
		<!--  ...................................   -->
		
		<!-- 下边是个人信息菜单  -->
		<div class="opacity" id="personalinf" cont="content" style="display:none;">
			<div style="width:100%;" cont="head">
			</div>
			<div class="panel panel-default">
				<a class="panel-title" href="#changenickname"  >
					<div class="panel-heading">
						<table>
							<tbody>
								<tr>
									<td valign="top">
										<span  class="" >昵称</span>
									</td>
									<td>
										<span cont="nickname" >无</span>
										
									</td>
									<td align="right">
										<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</a>
				
			</div>
			<div class="panel panel-default">
				<a class="panel-title" href="#changename"  >
					<div class="panel-heading">
						<table>
							<tbody>
								<tr>
									<td valign="top">
										<span class="" >姓名</span>
									</td>
									<td>
										<span cont="name" >无</span>
										
									</td>
									<td align="right">
										<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</a>
				
			</div>
			<div class="panel panel-default">
				<a class="panel-title" href="#changestId"  >
					<div class="panel-heading">
						<table>
							<tbody>
								<tr>
									<td valign="top">
										<span class="" >学号/账号</span>
									</td>
									<td>
										<span cont="stId" >无</span>
										
									</td>
									<td align="right">
										<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</a>
				
			</div>
			<div class="panel panel-default">
				<a class="panel-title" href="#changephone"  >
					<div class="panel-heading">
						<table>
							<tbody>
								<tr>
									<td valign="top">
										<span class="" >手机</span>
									</td>
									<td>
										<span cont="phone" >无</span>
										
									</td>
									<td align="right">
										<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</a>
				
			</div>
			<div class="panel panel-default">
				<a class="panel-title" href="#changeemail" >
					<div class="panel-heading">
						<table>
							<tbody>
								<tr>
									<td valign="top">
										<span class="" >邮箱</span>
									</td>
									<td>
										<span cont="email" >无</span>
										
									</td>
									<td align="right">
										<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</a>
				
			</div>
			<div class="panel panel-default">
				<a class="panel-title" href="javascript:void(0)" >
					<div class="panel-heading">
						<table>
							<tbody>
								<tr>
									<td valign="top">
										<span class="" >微信绑定</span>
									</td>
									<td>
										<span cont="bound" >无</span>
										
									</td>
									<td align="right">
										<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</a>
				
			</div>
		</div>
		<!-- .,................................   -->
		<div id="changeperinf" style="padding-left:15px; padding-right:15px;">
		<!-- 修改昵称     -->
		<div id="changenickname" cont="content" style="display:none; padding-bottom:30px;">
			<div style="width:100%;" cont="head">
				</div>
			<form class="form" action="" >
				<div class="form-group">
					<label class="" >昵称: </label>
				
						<input type="text" class="form-control" disabled placeholder="输入新昵称" cont="nickname">
					
				</div>
			
				<!--<button type="submit" class="btn btn-default" style="width:100%;" onclick="javascript:window.history.go(-1);">提交</button>-->
			</form>

			
		</div>
		
		
		<!--     .................................  -->
		
		<!-- 修改姓名     -->
		<div id="changename" cont="content" style="display:none; padding-bottom:30px;">
			<div style="width:100%;" cont="head">
				</div>
			<form class="form" action="" >
				<div class="form-group">
					<label class="" >姓名: </label>
				
						<input type="text" class="form-control" placeholder="输入新姓名" disabled cont="name">
					
				</div>
				
				<!--<button type="submit" class="btn btn-default" style="width:100%;">提交</button>-->
			</form>

			
		</div>
		
		
		<!--     .................................  -->
		<!-- 修改姓名     -->
		<div id="changestId" cont="content" style="display:none; padding-bottom:30px;">
			<div style="width:100%;" cont="head">
				</div>
			<form class="form" action="" >
				<div class="form-group">
					<label class="" >学号/账号: </label>
				
						<input type="text" class="form-control" placeholder="输入新账号" disabled cont="stId">
					
				</div>
				
				<!--<button type="submit" class="btn btn-default" style="width:100%;">提交</button-->
			</form>

			
		</div>
		
		
		<!--     .................................  -->
		<!-- 修改手机    -->
		<div id="changephone" cont="content" style="display:none; padding-bottom:30px;">
			<div style="width:100%;" cont="head">
				</div>
			<form class="form" action="" >
				<div class="form-group">
					<label class="" >手机: </label>
					
						<input type="text" class="form-control" placeholder="输入新手机号" cont="phone">
					
				</div>
			
				
					  <button type="submit" class="btn btn-default" style="width:100%;" onclick="javascript:window.history.go(-1);">提交</button>
				

			</form>

			
		</div>
		
		
		<!--     .................................  -->
		<!-- 修改邮箱     -->
		<div id="changeemail" cont="content" style="display:none; padding-bottom:30px;">
			<div style="width:100%;" cont="head">
				</div>
			<form class="form" action="" >
				<div class="form-group">
					<label class="" >邮箱: </label>
					
						<input type="text" class="form-control" placeholder="输入新邮箱" cont="email">
					
				</div>
				
				<button type="submit" class="btn btn-default" style="width:100%;" onclick="javascript:window.history.go(-1);">提交</button>

			</form>

			
		</div>
		</div>
		
		<!--     .................................  -->
		<!-- 查看义务维修编号     -->
		<div id="fixform" style="padding-left:15px; padding-right:15px; padding-bottom:30px; display:none;" cont="content">
			<div style="width:100%;" cont="head">
			</div>
			<div id="fixform0">
			
			
			</div>
			
				
		</div>
		
		<!--     .................................  -->
		<!--  维修预约    -->
		<div id="fixcomputer" style="padding-left:15px; padding-right:15px; padding-bottom:30px; display:none;" cont="content">
			<div style="width:100%;" cont="head">
			</div>
			<form class="form" action="" >
				
					<div class="form-group">
						<label >学号:</label>
						<input type="text" class="form-control" disabled cont="stId">
					</div>
					<div class="form-group">
						<label >姓名:</label>
						<input type="text" class="form-control" disabled cont="name">
					</div>
					<div class="form-group">
						<label >手机:</label>
						<input type="text" class="form-control"  cont="phone" id="p">
					</div>
					<div class="form-group">
						<label >邮箱:</label>
						<input type="text" class="form-control"  cont="email"  id="e">
					</div>
					<div class="form-group">
						<label>问题描述:</label>
						<div class="" style="padding-left:10px;">
							<div class="radio">
							  <label>
								<input type="radio" name="problem" value="重装系统" checked>重装系统
							  </label>
							</div>
							<div class="radio">
								<label>
								<input type="radio" name="problem" value="电脑清灰">电脑清灰
								</label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="problem" value="3">其他
							  </label>
							</div>
							<div id="other" style="display:none;">
								<textarea class="form-control" placeholder="请输入问题描述"></textarea>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>预约时间:(不可选表示已约满，请过几日重试)</label>
						<div id="fixtime" class="" style="padding-left:10px;">
							
						</div>
					</div>
					<div class="form-group">
						<label>维修地点:</label>
						<div class="" style="padding-left:10px;">
							<div >
							  <label>
								<input type="radio" name="place" value="东区大学生发展中心508" checked>东区大学生发展中心508
							  </label>
							</div>
							<!--
							<div >
								<label>
								<input type="radio" name="place" value="西区1号教学楼5楼信息化处">西区1号教学楼5楼信息化处

								</label>
							</div>
							-->
						</div>
					</div>
			
				<button type="submit" class="btn btn-default" style="width:100%;">提交</button>

			</form>
			
			
			
			
			
		</div>
		<!-- ............................................    -->
		

		
		
		<!-- 招新报名    -->
		<div id="recruit" style="padding-left:15px; padding-right:15px; padding-bottom:30px; display:none;" cont="content">
			<div style="width:100%;" cont="head">
			</div>
			<form class="form" action="" >
				
					<div class="form-group">
						<label >学号:</label>
						<input type="text" class="form-control" disabled cont="stId">
					</div>
					<div class="form-group">
						<label >姓名:</label>
						<input type="text" class="form-control" disabled cont="name">
					</div>
					<div class="form-group">
						<label >手机:</label>
						<input id="p" type="text" class="form-control" placeholder="请输入手机号" cont="phone">
					</div>
					<div class="form-group">
						<label >邮箱:</label>
						<input id="e" type="text" class="form-control" placeholder="请输入邮箱" cont="email">
					</div>
					<div class="form-group">
						<label>部门选择（最多选择三个部门）</label>
						<div class="" style="padding-left:10px;">
							<div class="checkbox">
							  <label>
								<input type="checkbox" name="department" value="KxXqChy" >创意设计部
							  </label>
							</div>
							<div class="checkbox">
								<label>
								<input type="checkbox" name="department" value="KxXqTs">网络宣传部
								</label>
							</div>
							<div class="checkbox">
							  <label>
								<input type="checkbox" name="department" value="KxXqDm">WEB研发部
							  </label>
							</div>
							<div class="checkbox">
							  <label>
								<input type="checkbox" name="department" value="KxJsJf">技术服务部
							  </label>
							</div>
							<div class="checkbox">
							  <label>
								<input type="checkbox" name="department" value="KxJsKy">科技研究部
							  </label>
							</div>
							<div class="checkbox">
							  <label>
								<input type="checkbox" name="department" value="KxShwGl">管理部
							  </label>
							</div>
							<div class="checkbox">
							  <label>
								<input type="checkbox" name="department" value="KxShwWl">外联部
							  </label>
							</div>
							<div class="checkbox">
							  <label>
								<input type="checkbox" name="department" value="KxHdXj">学术交流部
							  </label>
							</div>
							<div class="checkbox">
							  <label>
								<input type="checkbox" name="department" value="KxHdKh">科创活动部
							  </label>
							</div>
							
						</div>
					</div>
					<div class="form-group">
						<label>个人简介:</label>
						<textarea class="form-control" placeholder="请输入..."></textarea>
					</div>
			
				<button type="submit" class="btn btn-default" style="width:100%;">提交</button>

			</form>
			
			
			
			
			
		</div>
		<!-- ............................................    -->
		
		<!--  活动投票    -->
		<div id="actvote" style="padding-left:25px; padding-right:15px; padding-bottom:30px; display:none;" cont="content">
			<div style="width:100%;" cont="head">
			</div>
		
			<form class="form" action="">  
			
			<div class="page-header">
				<h4>投票规则：每个人可以进行一次投票，一次投票可以勾选1~3个节目。快来为你喜欢的节目，投上你宝贵的一票吧！</h4>
			</div>
			
			  <!-- two columns-->
			  <div class="row">
		<!--		<div class="col-xs-6" style="padding-bottom:15px;">
				  <img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
				  <h2>Heading</h2>
				  <div class="btn btn-default" role="button" style="padding-bottom:0px;"><p>投票<span class="badge" id="noreadnotice" changed="false style" style="background-color:#5bc0de;">0</span>
					排名<span class="badge" id="noreadnotice" changed="false" style="background-color:#5bc0de;">0</span></p>
				  </div>
				</div>
		 -->
		 
				<div class="col-xs-6" style="padding-bottom:15px;">
				  <img class="img-circle" src="votephotos/jiemu8.jpg" alt="Generic placeholder image" width="140" height="140">
				  <h2>1.梦灯笼</h2>
				  <p> 那振翅欲飞的蝴蝶 是我心中对自由的向往<br/>
					  你手中舞动的流光 是此生唯一不变的信仰<br/>
					  而心中闪烁的萤火 是少年肆意绽放的青春<br/>
					  下面请欣赏技术服务部带来的节目 梦灯笼
				  </p>
				 <label><p><div class="btn btn-default" role="button"><input type="checkbox" name="vote" value="1" ><i>1.</i>梦灯笼</div></p></label>
				</div>
				
				<div class="col-xs-6" style="padding-bottom:15px;">
				  <img class="img-circle" src="votephotos/jiemu2.jpg" alt="Generic placeholder image" width="140" height="140">
				  <h3>2.新生看点<br/>播报</h3>
				  <p>这里有最纯粹的欢声笑语，这里有最疯狂的呐喊，军训虽短，却也刻骨铭心。<br/>在这里，我们将用不寻常的方式展现出军训的欢乐，在这里，我们将以另一种姿态带你重温军训的温情。</p>
				  <label><p><div class="btn btn-default" role="button"><input type="checkbox" name="vote" value="2" ><i>2.</i>新生看点播报</div></p></label>
				</div>
				
				<div class="col-xs-6" style="padding-bottom:15px;">
				  <img class="img-circle" src="votephotos/jiemu3.jpg" alt="Generic placeholder image" width="140" height="140">
				  <h3>3.Mad again</h3>
				  <p>歌曲的串烧，舞蹈的喜感<br/>给大家带来欢快愉悦</p>
				  <label><p><div class="btn btn-default" role="button"><input type="checkbox" name="vote" value="3" ><i>3.</i>Mad again</div></p></label>
				</div>
				
				<div class="col-xs-6" style="padding-bottom:15px;">
				  <img class="img-circle" src="votephotos/jiemu4.jpg" alt="Generic placeholder image" width="140" height="140">
				  <h3>4.博物馆<br/>奇妙夜</h3>
				  <p>你见过凌晨两点的博物馆吗?</br></p>
				  <label><p><div class="btn btn-default" role="button"><input type="checkbox" name="vote" value="4" ><i>4.</i>博物馆奇妙夜</div></p></label>
				</div>
				
				<div class="clearfix visible-xs-block"></div>
				
				<div class="col-xs-6" style="padding-bottom:15px;">
				  <img class="img-circle" src="votephotos/jiemu5.jpg" alt="Generic placeholder image" width="140" height="140">
				  <h4>5.像我这样的人</h4>
				  <p>欲戴王冠，先承其重。无论我们多么骄傲也会被现实无情击垮，不可避免陷入沮丧，黯然神伤。希望这首《像我这样的人》可以帮助你我在迷茫中寻到最初的信仰，孤独但坚定地走向前方。</p>
				  <label><p><div class="btn btn-default" role="button"><input type="checkbox" name="vote" value="5" ><i>5.</i>像我这样的人</div></p></label>
				</div>
				
				<div class="col-xs-6" style="padding-bottom:15px;">
				  <img class="img-circle" src="votephotos/jiemu6.jpg" alt="Generic placeholder image" width="140" height="140">
				  <h3>6.极乐山鬼</h3>
				  <p> 汉舞，柔美;汉舞山鬼，优雅温婉。宅舞，欢脱；极乐净土，妩媚动人。汉舞与宅舞，于此齐聚一堂，极乐山鬼，就此上演。</p>
				  <label><p><div class="btn btn-default" role="button"><input type="checkbox" name="vote" value="6" ><i>6.</i>极乐山鬼</div></p></label>
				</div>
				
				<div class="clearfix visible-xs-block"></div>
				
				<div class="col-xs-6" style="padding-bottom:15px;">
				  <img class="img-circle" src="votephotos/jiemu7.jpg" alt="Generic placeholder image" width="140" height="140">
				  <h3>7.武林内传</h3>
				  <p>莫小贝上大学回客栈的各种问事搞事～/滑了个稽/</p>
				  <label><p><div class="btn btn-default" role="button"><input type="checkbox" name="vote" value="7" ><i>7.</i>武林内传</div></p></label>
				</div>
				
				<div class="col-xs-6" style="padding-bottom:15px;">
				  <img class="img-circle" src="votephotos/jiemu1.jpg" alt="Generic placeholder image" width="140" height="140">
				  <h3>8.荧光舞</h3>
				  <p>荧光的迷乱舞步，线条的妖娆变幻，把黑夜的寂寞，奏成激荡心灵的狂想曲。</p>
				  <label><p><div class="btn btn-default" role="button"><input type="checkbox" name="vote" value="8" ><i>8.</i>荧光舞</div></p></label>
				</div>
				
				
			  </div>
			  <!-- /.row -->
			  
			  <div class="col-xs-12" style="padding-bottom:25px;text-align:center;">
		
			  <button type="submit" class="btn btn-lg btn-primary" >点击提交</button>
			  </div>
			</form> 
	  


      
		</div>
		<!-- ............................................    -->
		
		
		<!-- 查看预约维修情况 -->
		<div id="fixcheck" style="padding-left:15px; padding-right:15px; padding-bottom:30px; display:none;" cont="content" >
			<div style="width:100%;" cont="head">
			</div>
			<div class="panel panel-default">
				<a class="panel-title" href="#fixcheckcomment"  data-parent="#fixcheck">
					<div class="panel-heading">
						<table>
							<tbody>
								<tr>
									<td valign="top">
										<span class="glyphicon glyphicon-cog" ></span>
									</td>
									<td>
										<span ></span>
										<br>待评价
									</td>
									<td align="right">
										<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</a>
			</div>
			<div class="panel panel-default">
				<a class="panel-title" href="#hfixcheckcomment"  data-parent="#fixcheck">
					<div class="panel-heading">
						<table>
							<tbody>
								<tr>
									<td valign="top">
										<span class="glyphicon glyphicon-cog" ></span>
									</td>
									<td>
										<span ></span>
										<br>历史评价
									</td>
									<td align="right">
										<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</a>
			</div>
			
		<!--
			<div class="panel panel-default">
				<a class="panel-title" href="#"  data-parent="#fixcheck">
					<div class="panel-heading">
						<table>
							<tbody>
								<tr>
									<td valign="top">
										<span class="glyphicon glyphicon-cog" ></span>
									</td>
									<td>
										<span ></span>
										<br>维修论坛
									</td>
									<td align="right">
										<span class="glyphicon glyphicon-chevron-right" changed="false"></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</a>
			</div>
			
		-->	
			
			
		</div>
		<!--...................................................... -->
		
		<!--       维修待评价     -->
		<div id="fixcheckcomment" style="padding-left:15px; padding-right:15px; padding-bottom:30px; display:none;" cont="content">
			<div style="width:100%;" cont="head">
			</div>
		</div>
		<!--   ........................................   -->
		<!--       维修已评价   -->
		<div id="hfixcheckcomment" style="padding-left:15px; padding-right:15px; padding-bottom:30px; display:none;" cont="content">
			<div style="width:100%;" cont="head">
			</div>
		</div>
		<!--   ........................................   -->
		
		
		<!--  活动赛事  讲座   -->
		<div id="kxhd" style="padding-left:15px; padding-right:15px; padding-bottom:30px; display:none;" cont="content">
			<div style="width:100%;" cont="head">
			</div>
			<div class="panel-group" id="kxhd1" style="margin-bottom:0px;">
				<div class="panel panel-default" >
					<div class="panel-heading">
						<h3 class="panel-title" role="button" cont="name" data-toggle="collapse" data-parent="#kxhd1" data-target="#stId">
						活动名称
						</h3>
					</div>
					<div id="stId" class="panel-collapse collapse">
						<div class="panel-body">
							<div>活动详情
							</div>
							
							<button class="form-control" ></button>
						</div>
					</div>
				</div>
					
				
			</div>
				
			
		</div>
		<!-- ............................................    -->
		
		
		<!--   投诉与建议-->
		<div id="kxts" style="padding-left:15px; padding-right:15px; padding-bottom:30px; display:none;" cont="content">
			<div style="width:100%;" cont="head">
			</div>
			<form class="form" action="" >
				
					<div class="form-group">
						<label >学号:</label>
						<input type="text" class="form-control" disabled cont="stId">
					</div>
					<div class="form-group">
						<label >姓名:</label>
						<input type="text" class="form-control" disabled cont="name">
					</div>
					<div class="form-group">
						<label >手机:</label>
						<input type="text" class="form-control"  cont="phone" id="p">
					</div>
					<div class="form-group">
						<label >邮箱:</label>
						<input type="text" class="form-control"  cont="email"  id="e">
					</div>
					
					<div class="form-group">
						<label>问题与建议:</label>
						<textarea class="form-control" placeholder="请输入..."></textarea>
					</div>
			
				<button type="submit" class="btn btn-default" style="width:100%;">提交</button>

			</form>
			
			
			
			
			
		</div>
			
		<!-- ............................................    -->
		

			
		</div>
		<!-- ............................................    -->
		<!--  个人通知   -->
		<div id="notice" style="padding-left:15px; padding-right:15px; padding-bottom:30px; display:none;" cont="content">
			<div style="width:100%;" cont="head">
			</div>
				
			
		</div>
		<!-- ............................................    -->
	</div>
	
	<!--输入-->
	<div id="rootinput" style="width:100%; position:fixed; bottom:0px; left:0px; z-index:3; display:none; " >
		<form id="" class="" style="display:table; width:100%; background-color:#fff; margin-bottom:0px; padding-left:10px; padding-top:5px; padding-bottom:5px; padding-right:5px;" action="" role="form">
		  <div class="form-group" style="display:table-row;" >
			<div style="display:table-cell; width:100%; vertical-align:middle;"><textarea class="form-control" style="height:50px;  " placeholder="内容"></textarea></div>
			<div style="display:table-cell; width:50px; text-align:center; vertical-align:center;">
				<button type="submit" class="btn btn-default" style="border:0px; display:table-cell;height:50px; vertical-align:middle;" ><span class="glyphicon glyphicon-send" style=" font-size:35px; display:table-cell; vertical-align:middle;" ></span></button>
		    </div>
		  </div>
		  
		 
		</form>
		
	</div>
	<div id="background" style="position:fixed; top:0px; left:0px; z-index:2; width:100%; display:none;">
	</div>
	<!-- ......................  -->
	
	
	
	<!-- ...........................................    -->
	 <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- 或者用 <script src="../js/jquery-3.2.1.min.js"></script> -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- 或者用 <script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> -->	
	<script src="../js/md5.js"></script>
	
	<script src="js/index.js"></script>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
	<script>
		$(document).ready(function(){
			wx.config({
			debug: false,
			appId: '<?php echo $signPackage["appId"];?>',
			timestamp: <?php echo $signPackage["timestamp"];?>,
			nonceStr: '<?php echo $signPackage["nonceStr"];?>',
			signature: '<?php echo $signPackage["signature"];?>',
			jsApiList: [
			  "onMenuShareQQ",
			  "onMenuShareTimeline",
			  "onMenuShareAppMessage"
			]
		  });
		});
		
		
	</script>
	<script src="js/wx.js"></script>
	
  </body>
</html>