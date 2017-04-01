/**
 * 演示程序当前的 “注册/登录” 等操作，是基于 “本地存储” 完成的
 * 当您要参考这个演示程序进行相关 app 的开发时，
 * 请注意将相关方法调整成 “基于服务端Service” 的实现。
 **/
(function($, owner) {
	//获取网址
	var url=localStorage.getItem("url");
	/**
	 * 用户登录
	 **/
	owner.login = function(loginInfo, callback) {
		callback = callback || $.noop;
		loginInfo = loginInfo || {};
		loginInfo.school_id = loginInfo.school_id || '';
		loginInfo.password = loginInfo.password || '';
		if (loginInfo.school_id.length < 14) {
			return callback('账号最短为 14 个字符');
		}
		if (loginInfo.password.length < 6) {
			return callback('密码最短为 6 个字符');
		}
		
		var users = JSON.parse(localStorage.getItem('$users') || '[]');
		var authed = users.some(function(user) {
			return loginInfo.school_id == user.school_id && loginInfo.password == user.password;
		});
		if (authed) {
			return owner.createState(loginInfo.school_id, callback);
		} else {
			return callback('用户名或密码错误');
		}
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
		regInfo._academy=regInfo._academy || '';
		regInfo._class=regInfo._class || '';
		regInfo.birth=regInfo.birth || '';
		regInfo.birthplace=regInfo.birthplace || '';
		if (regInfo.school_id.length < 14) {
			return callback('账号最短需要 14 个字符');
		}
		if (regInfo.password.length < 6) {
			return callback('密码最短需要 6 个字符');
		}
		if (!checkEmail(regInfo.email)) {
			return callback('邮箱地址不合法');
		}
		if(trim(regInfo.name).length < 2){
			return callback('请输入姓名');
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
			var _back=mui.ajax(url+'DB/reg.php',{
				data:regInfo,
				dataType:'JSON',//服务器返回json格式数据
				type:'post',//HTTP请求类型
				timeout:5000,//超时时间设置为5秒；
				//headers:{'Content-Type':'application/json'},	              
				success:function(data){
					//服务器返回响应，根据响应结果，分析是否注册成功；
					if(data.msg=='success'){return;}
					if(data.msg=='Already'){return '该账号已存在';}
					if(data.msg=='faile'){return '注册失败了，请再次尝试';}
				},
				error:function(xhr,type,errorThrown){
					//异常处理；
					if(type=='timeout') {
	          return "请求超时";
	        }else{
	        	console.log(xhr);
	        	console.log(type);
	        	console.log(errorThrown);
	          return '请求失败：' + type + '\n err:' + errorThrown;
					};
	     },
				async:false
			});
			return JSON.parse(_back.responseText).msg;
			//return _back.responseJSON.msg;出错
		};
		return callback(_ajax());
//		var users = JSON.parse(localStorage.getItem('$users') || '[]');
//		users.push(regInfo);
//		localStorage.setItem('$users', JSON.stringify(users));
//		return callback();
	};

	/**
	 * 获取当前状态
	 **/
	owner.getState = function() {
		var stateText = localStorage.getItem('$state') || "{}";
		return JSON.parse(stateText);
	};

	/**
	 * 设置当前状态
	 **/
	owner.setState = function(state) {
		state = state || {};
		localStorage.setItem('$state', JSON.stringify(state));
		//var settings = owner.getSettings();
		//settings.gestures = '';
		//owner.setSettings(settings);
	};
	//trim剪切空格　
	var trim=function(str) {
      return str.replace(/(^\s+)|(\s+$)/g,"");
   }
	var checkEmail = function(email) {
		email = email || '';
		return (email.length > 3 && email.indexOf('@') > -1);
	};

	/**
	 * 找回密码
	 **/
	owner.forgetPassword = function(email, callback) {
		callback = callback || $.noop;
		if (!checkEmail(email)) {
			return callback('邮箱地址不合法');
		}
		return callback(null, '新的随机密码已经发送到您的邮箱，请查收邮件。');
	};

	/**
	 * 获取应用本地配置
	 **/
	owner.setSettings = function(settings) {
		settings = settings || {};
		localStorage.setItem('$settings', JSON.stringify(settings));
	}

	/**
	 * 设置应用本地配置
	 **/
	owner.getSettings = function() {
			var settingsText = localStorage.getItem('$settings') || "{}";
			return JSON.parse(settingsText);
		}
		/**
		 * 获取本地是否安装客户端
		 **/
	/*owner.isInstalled = function(id) {
		if (id === 'qihoo' && mui.os.plus) {
			return true;
		}
		if (mui.os.android) {
			var main = plus.android.runtimeMainActivity();
			var packageManager = main.getPackageManager();
			var PackageManager = plus.android.importClass(packageManager)
			var packageName = {
				"qq": "com.tencent.mobileqq",
				"weixin": "com.tencent.mm",
				"sinaweibo": "com.sina.weibo"
			}
			try {
				return packageManager.getPackageInfo(packageName[id], PackageManager.GET_ACTIVITIES);
			} catch (e) {}
		} else {
			switch (id) {
				case "qq":
					var TencentOAuth = plus.ios.import("TencentOAuth");
					return TencentOAuth.iphoneQQInstalled();
				case "weixin":
					var WXApi = plus.ios.import("WXApi");
					return WXApi.isWXAppInstalled()
				case "sinaweibo":
					var SinaAPI = plus.ios.import("WeiboSDK");
					return SinaAPI.isWeiboAppInstalled()
				default:
					break;
			}
		}
	}*/
}(mui, window.app = {}));