/**
 * 演示程序当前的 “注册/登录” 等操作，是基于 “本地存储” 完成的
 **/
(function($, owner) {
	//获取网址
	var url=localStorage.getItem("url");
	//owner.url = url;
	//获取本地用户信息
	var users = JSON.parse(localStorage.getItem('$users') || "{}");
	/**
	 * 用户登录
	 **/
	owner.login = function(loginInfo, callback) {
		callback = callback || $.noop;
		loginInfo = loginInfo || {};
		loginInfo.identity = loginInfo.identity || '';
		loginInfo.school_id = loginInfo.school_id || '';
		loginInfo.password = loginInfo.password || '';
		if (!checkId(loginInfo.school_id)) {
			return callback('账号格式错误');
		}
		if (!checkPassword(loginInfo.password)) {
			return callback('密码长度或格式错误');
		}
		
		$.ajax(url+'DB/login.php',{//注册时的写法可以修改成这个样式
			data:{
				identity:loginInfo.identity,
				school_id:loginInfo.school_id,
				password:loginInfo.password
			},					
			dataType:'JSON',//服务器返回json格式数据
			type:'post',//HTTP请求类型
			timeout:10000,//超时时间设置为10秒；
			crossDomain: true,
			async:false,
			//headers:{'Content-Type':'application/json'},服务器设置错误,故注释掉	              
			success:function(data){
				console.log(data);
				console.log(JSON.stringify(data));
				//服务器返回响应，根据响应结果，分析是否登录成功；
				if(data.msg=="faile" || data==='null'){
					return callback('用户名或密码错误');
				}				
				var _data= joinJson(loginInfo, data);				
				users= joinJson(users, _data);								
				localStorage.setItem('$users', JSON.stringify(users));
				return callback();
			},
			error:function(xhr,type,errorThrown){
				//异常处理；
				//mui.toast('网络连接失败，请检查网络设置');	
				plus.nativeUI.closeWaiting();
				if(type=='timeout') {
	              	return callback("登录超时, 请检查网络")
	            } else {
	            	//console.log(xhr);console.log(type);console.log(errorThrown)
	              	return callback('请求失败：' + type + '\n err:' + errorThrown);
	            }
			}
		});
	};

	owner.createState = function(name, callback) {
		var state = owner.getState();
		state.school_id = name;
		state.token = "token123456789";
		owner.setState(state);
		return callback();
	};

	/**
	 * 新用户注册
	 **/
	owner.reg = function(regInfo, callback) {
		callback = callback || $.noop;
		regInfo = regInfo || {};
		regInfo.school_id = regInfo.school_id || '';
		regInfo.password = regInfo.password || '';
		regInfo.name = regInfo.name || '';
		regInfo.phone = regInfo.phone || '';
		regInfo._academy=regInfo._academy || '';
		regInfo._class=regInfo._class || '';
		regInfo.birth=regInfo.birth || '';
		regInfo.birthplace=regInfo.birthplace || '';
		if (!checkId(regInfo.school_id)) {
			return callback('账号格式错误');
		}
		if (!checkPassword(regInfo.password)) {
			return callback('密码长度或格式错误');
		}
		if (!checkEmail(regInfo.email)) {
			return callback('邮箱地址不合法');
		}
		if(!checkName(regInfo.name)){
			return callback('请正确输入姓名');
		}
		if(trim(regInfo.phone).length > 0 && !checkPhone(regInfo.phone)){
			return callback('手机号码错误');
		}
		if(regInfo.identity=="student"){
			if(regInfo._class.length<2){
				return callback('请选择学院专业及班级');
			}
			if(regInfo.birth.length<2){
				return callback('请选择出生日期');
			}
			if(regInfo.birth.length<2){
				return callback('请选择籍贯');
			}
		}else{
			if(regInfo._academy.length<3){
				return callback('请选择学院');
			}
		}
		//注册请求，接收返回值后处理
		var _ajax=function(){
			var _back=$.ajax(url+'DB/reg.php',{
				data:regInfo,
				dataType:'JSON',//服务器返回json格式数据
				type:'post',//HTTP请求类型
				timeout:5000,//超时时间设置为5秒；
				//headers:{'Content-Type':'application/json'},	              
				success:function(data){},//数据在注册界面处理
				error:function(xhr,type,errorThrown){
					//异常处理；
					if(type=='timeout') {
	          			return $.toast("注册失败了，请检查网络后再次尝试");
	        		}else{
			        	console.log(xhr);
			        	console.log(type);
			        	console.log(errorThrown);
			          	return $.toast('注册失败：' + type + '\n err:' + errorThrown);
					};
	    		},
				async:false //设置同步以获取数据
			});
			return JSON.parse(_back.responseText).msg;
			//return _back.responseJSON.msg;出错
		};
		/*使用localStorage无法跨域，plus比消耗性能,数据小于5M时尽量使用localStorage
		 * 网上有个框架，封装了localStorage 和 plus.storage
		 * https://github.com/phillyx/MUIDemos/tree/master/js/myStorage.js
		 */
		users=joinJson(users, regInfo);
		localStorage.setItem('$users', JSON.stringify(users));
		return callback(_ajax());
	};
	/**
	 * @description 获取当前状态
	 **/
	owner.getState = function() {
		var stateText = localStorage.getItem('$state') || "{}";
		return JSON.parse(stateText);
	};

	/**
	 * @description 设置当前状态
	 **/
	owner.setState = function(state) {
		state = state || {};
		localStorage.setItem('$state', JSON.stringify(state));
	};
	
	/**
	 * @param {String} str
	 * @description 剪切空格
	 */
	var trim = function(str) {
      return str.replace(/(^\s+)|(\s+$)/g,"");
    };
    
    /**
     * @description 验证
     **/
	var checkId = function(id){
		var reg = /^[0-9]{14}$/;
		return (reg.test(id));
	};
	var checkPassword = function(pwd){
		var reg = /^[a-z0-9_-]{6,12}$/;
		return (reg.test(pwd));
	};
	var checkName = function(name){
		var reg = /^[\u4e00-\u9fa5]{2,4}$/;
		return (reg.test(name));
	};
	var checkEmail = function(email){
		email = email || '';
		var reg = /^[a-z\d]+(\.[a-z\d]+)*@([\da-z](-[\da-z])?)+(\.{1,2}[a-z]+)+$/;
		return (reg.test(email));
	};
	var checkPhone = function(phone){
		var reg =/^1[3|4|5|8][0-9]\d{4,8}$/;
		return (reg.test(phone));
	};
	/**
	 * 找回密码，邮件
	 **/
	owner.forgetPassword = function(id, email, callback) {
		callback = callback || $.noop;
		if (!checkId(id)) {
			return callback('账号格式错误');
		}
		if (!checkEmail(email)) {
			return callback('邮箱地址不合法');
		}
		$.ajax(url+'DB/forgetPassword.php',{//修改密码
			data:{		
				school_id: id,
				email: email
			},					
			dataType:'JSON',//服务器返回json格式数据
			type:'post',//HTTP请求类型
			timeout:10000,//超时时间设置为10秒；
			crossDomain: true,
			//headers:{'Content-Type':'application/json'},
			//async:false,	              
			success:function(data){
				var data=JSON.parse(data);
				if(data.msg=='notfind'){
					return callback("邮箱与账号不匹配!");
				}
				if(data.msg=='faile'){
					return callback("服务器抽风了,请再次尝试!");
				}
				if(data.msg=='fail'){
					return callback("发送失败了!");
				}
				if(data.msg=='success'){
					//postMail(email,data.password);
					return callback("发送成功! 请前往邮箱查看!");
				}		
				console.log(data);
				return callback("未知错误!");
			},
			error:function(xhr,type,errorThrown){
				//异常处理；
				if(type=='timeout') {
          			return callback("发送失败了! 请检查网络环境!");
        		}else{
		        	//console.log(xhr);console.log(type);console.log(errorThrown);
		          	//return callback('发送失败：' + type + '\n err:' + errorThrown);
		          	return callback("~发送失败了! 请检查网络环境!");
				};
    		}
		});		
		return callback();
	};
	/**
	 * @description 发送邮箱，仅仅是本地
	 **/
	var postMail = function(email,pwd){
		var msg = plus.messaging.createMessage(plus.messaging.TYPE_EMAIL);
		msg.to = [email];
		msg.cc = ['test@163.com', 'test@173.com'];
		msg.bcc = ['test@163.com', 'test@173.com'];
		msg.subject = '花椒-密码找回';
		msg.body = pwd;
		msg.silent = true; // 设置为使用静默方式发送
		plus.messaging.sendMessage( msg, function () {
			$.toast( "发送成功，请前往邮箱查看!" );
		}, function () {
			$.toast( "这 发送失败了!" );
		} );
	};
	/**
	 * @description 合并JSON对象
	 **/
	var joinJson = function (JSONIn, JSONStr) {
		if(JSONIn instanceof Array){
			JSONIn = {};
		}
		if(typeof(JSONIn)=="string"){
			JSONIn = JSON.parse(JSONIn); 
		}
		if(typeof(JSONStr)=="string"){
			JSONStr = JSON.parse(JSONStr); 
		}//深度合并
		$.extend(JSONIn, JSONStr, true);
		return JSONIn;
	}
	/**
	 * @description 合并JSON对象
	 **/
	owner.joinJSON = joinJson;
	/**
	 * 设置应用本地配置
	 **/
	owner.setSettings = function(setting) {
		setting = setting || {};
		var settingsText = localStorage.getItem('$settings') || "{}",
			settings = joinJson(settingsText, setting);
		localStorage.setItem('$settings', JSON.stringify(settings));
	}

	/**
	 * 获取应用本地配置
	 **/
	owner.getSettings = function() {
		var settingsText = localStorage.getItem('$settings') || "{}";
		return JSON.parse(settingsText);
	}
	
}(mui, window.app = {}));