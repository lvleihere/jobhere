$(function(){
	var jobmsg = {},
		login = $('#login'),
		register = $('#register'),
		loginBox = $('.login-box'),
		registerBox = $('.register-box'),
		goRegister = $('#go-register'),
		goLogin = $('#go-login'),
		loginRegisterWrap = $('.login-register-wrap'),
		loginBtn = $('#login-btn'),
		registerBtn = $('#register-btn'),
		navLoginBox = $('#nav-login-box'),
		addMsgBtn = $('#add-msg-btn'),
		addMsgWrap = $('#add-msg-wrap'),
		addMsgBox = $('#add-msg-box'),
		msgSubmit = $('#msg-submit'),
		username,
		password,
		nick,
		adminLoginBtn=$('#admin-login-btn'),
		searchIpt = $('#search-ipt'),
		showUsername = $('#show-username'),
		loginOut = $('#login-out'),
		testPhone = /^1[34578]\d{9}$/;

	jobmsg = {
		init:function(){
			this.timeRec();
			this.beginHide();
			this.autoLogin();
			this.showTable();
			this.addMsgOpen();
			this.loginRegister();
			this.loginRegisterBtn();
			this.goLoginRegister();
			this.cutLoginRegisterBox();
			this.adminLogin();
			this.search();
			this.showusername();
			this.loginout();
		},
		timeRec:function(){
			setInterval(function(){
			var nowTime=+new Date();
			var tt=(new Date(parseInt(nowTime)).toLocaleString().substr(0,9)+'/ ').replace(/\//,'年').replace(/\//,'月').replace(/\//,'日')+new Date(parseInt(nowTime)).toLocaleString().substr(9, 20);
				// var tt = (new Date(parseInt(tm)).toLocaleString().substr(0, 20)).replace(/\//, '年').replace(/\//, '月').replace(/\//, '日');
			var lastTime=new Date('2017/8/22 00:00:00').getTime();
			var differTime = nowTime-lastTime; //两个时间相减，时间单位为毫秒
			var months = Math.floor(differTime / (1000 * 60 * 60 * 24 * 30));
			var days = Math.floor(differTime % (1000 * 60 * 60 * 24 * 30) / (1000 * 60 * 60 * 24));
			var hours = Math.floor(differTime % (1000 * 60 * 60 * 24 * 30) % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
			var minues = Math.floor(differTime % (1000 * 60 * 60 * 24 * 30) % (1000 * 60 * 60 * 24) % (1000 * 60 * 60) / (1000 * 60));
			var seconds = Math.floor(differTime % (1000 * 60 * 60 * 24 * 30) % (1000 * 60 * 60 * 24) % (1000 * 60 * 60) % (1000 * 60) / 1000);
			var last = months + "个月" + days + "天" + hours + "小时" + minues + "分" + seconds + "秒";
			$('.runTime').text(last);
			$('.nowTime').text(tt);
		},1000);
		},
		beginHide:function(){
			loginRegisterWrap.hide();
			addMsgWrap.hide();
		},
		showTable:function(){
			$.ajax({
				url:'./php/msg.php',
				type:'GET',
				success:function(data){
					$('#table-box tbody').html(data);
				}
			})
		},
		showData:function(data){
			var box = $('<div class="tips">'+data+'</div>');
				$('body').append(box);
				$('.tips').show(1000);
				setTimeout(function(){
					$('.tips').animate({
						top:'-40px'
					},1000,function(){
						$('.tips').remove();
					});
					
				},1000)
				
		},
		autoLogin:function(){
			var u = window.sessionStorage.getItem('u');
			if(u){
				$.ajax({
					url:'./php/autologin.php',
					type:'POST',
					data:{
						username:u
					},
					success:function(data){
						loginRegisterWrap.hide();
						login.hide();
						register.hide();
						navLoginBox.find('p').show();
						$('#show-username').text(data);
						jobmsg.showData('自动登录成功！');
					}
				})
			}
		},
		addMsgOpen:function(){
			addMsgBtn.click(function(event){
				event.stopPropagation();
				var u = window.sessionStorage.getItem('u');
				if(u==null){
					jobmsg.showData('您未登陆哦~');
				}else{
					addMsgWrap.show();
					addMsgBox.show();
					jobmsg.addMsg();
				}
				
			})
		},
		addMsg:function(){
			msgSubmit.click(function(){
				var incname = $('#add-msg-incname').val(),
					time = $('#add-msg-time').val(),
					incport = $('#add-msg-incport').val(),
					site = $('#add-msg-site').val(),
					ps = $('#add-msg-ps').val(),
					public = 'public';
				if(incname==''||time==''||incport==''||site==''||ps==''){
					jobmsg.showData('请填写完整！');
				}else{
					$.ajax({
						url:'./php/add.php',
						type:'POST',
						data:{
							incname:incname,
							time:time,
							incport:incport,
							site:site,
							ps:ps,
							belong:public
						},
						success:function(data){
							$('#add-msg-incname').val('');
							$('#add-msg-time').val('');
							$('#add-msg-incport').val('');
							$('#add-msg-site').val('');
							$('#add-msg-ps').val('');
							jobmsg.showData(data);
							addMsgWrap.hide();
							addMsgBox.hide();
							jobmsg.showTable();
							window.location.reload();
						}
					})
				}
			})
		},
		loginRegister:function(){
			login.click(function(){
				loginRegisterWrap.show();
				loginBox.show();
				registerBox.hide();
			})
			register.click(function(){
				loginRegisterWrap.show();
				loginBox.hide();
				registerBox.show();
			})
		},
		clearReg:function(){
			$('#register-username').val('');
			$('#register-password').val('');
			$('#register-nick').val('');
		},
		loginRegisterBtn:function(){
			loginBtn.click(function(){
				username = $('#login-username').val();
				password = $('#login-password').val();
				if(username==''||password==''){
					jobmsg.showData('输入不能为空！');
				}else{
					$.ajax({
						url:'./php/login.php',
						type:'POST',
						data:{
							username:username,
							password:password
						},
						success:function(data){
							if(data==0){
								jobmsg.showData('登录失败！');
							}else if(data==-1){
								jobmsg.showData('用户黑名单！');
							}else{
								jobmsg.showData('登录成功！');
								loginRegisterWrap.hide();
								login.hide();
								register.hide();
								navLoginBox.find('p').show();
								$('#show-username').text(data);
								window.sessionStorage.setItem('u',username);
								// window.sessionStorage.setItem('p',password);
							}
						}
					})
				}
			})
			registerBtn.click(function(){
				username = $('#register-username').val();
				password = $('#register-password').val();
				nick = $('#register-nick').val();
				if(username==''||password==''||nick==''){
					jobmsg.showData('输入不能为空！');
				}else{
					if(!testPhone.test(username)){
						jobmsg.showData('用户名不合法哦~');
						$('.must-phone').show();
						$('#register-username').val('');
					}else if(nick.length>10){
						jobmsg.showData('昵称不能大于10位！');
					}else{
						$.ajax({
							url:'./php/register.php',
							type:'POST',
							data:{
								username:username,
								password:password,
								nick:nick
							},
							success:function(data){
								$('.must-phone').hide();
								if(data==0){
									jobmsg.showData('账号已存在！');
									$('#register-username').val('');
								}else if(data==-1){
									jobmsg.showData('昵称已存在！');
									$('#register-nick').val('');
								}else{
									jobmsg.showData('注册成功！');
									loginBox.show();
									registerBox.hide(); 
									jobmsg.clearReg();
								}
							}
						})
					}
					
				}
			})
		},
		goLoginRegister:function(){
			goRegister.click(function(){
				loginBox.hide();
				registerBox.show(); 
			})
			goLogin.click(function(){
				registerBox.hide();
				loginBox.show();
			})

		},
		cutLoginRegisterBox:function(){
			loginBox.click(function(event){
				event.stopPropagation();
			})
			navLoginBox.click(function(event){
				event.stopPropagation();
			})
			registerBox.click(function(event){
				event.stopPropagation();
			})
			addMsgBox.click(function(event){
				event.stopPropagation();
			})
			$('#uesr-center').click(function(event){
				event.stopPropagation();
			})
			$(document).click(function(){
				loginRegisterWrap.hide();
				addMsgWrap.hide();
				$('#user-center').hide();
			})
			loginRegisterWrap.click(function(){
				loginRegisterWrap.hide();
				$('#login-username').val('');
				$('#login-password').val('');
				$('#register-username').val('');
				$('#register-password').val('');
				$('#register-nick').val('');
			})
			addMsgWrap.click(function(){
				addMsgWrap.hide();
				$('#add-msg-incname').val('');
				$('#add-msg-time').val('');
				$('#add-msg-incport').val('');
				$('#add-msg-site').val('');
				$('#add-msg-ps').val('');
				window.location.reload();
			})
		},
		adminLogin:function(){
			adminLoginBtn.click(function(){
				loginRegisterWrap.hide();
				var _pass = prompt('请输入密码');
				$.ajax({
					url:'./php/adminlogin.php',
					type:'POST',
					data:{
						pass:_pass
					},
					success:function(data){
						if(data==1){
							alert('验证成功！');
							window.location.href='admin.html';
						}else{
							alert('密码错误！');
						}
					}
				})
			})
		},
		search:function(){
			searchIpt.keyup(function(){
				var searchContent = $('.iptDiv>input').val();
				$('#table-box>table>tbody>tr').hide();
				$('#table-box>table>tbody>tr').filter(':contains("'+searchContent+'")').show().css('color','red');
				if(searchContent==''){
					$('#table-box>table>tbody>tr').css('color','black');
				}
			})
		},
		showusername:function(){
			showUsername.hover(function(){
				$('#user-center').show();
			})
		},
		loginout:function(){
			loginOut.click(function(){
				window.sessionStorage.removeItem('u');
				window.sessionStorage.removeItem('p');
				login.show();
				register.show();
				navLoginBox.find('p').hide();
				jobmsg.showData('成功退出！');
				$('#user-center').hide();
			})
		}
	}
	jobmsg.init();
	
})
