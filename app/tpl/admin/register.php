<?php die('Access Denied');?>
<!doctype html>
<html lang="cmn-Hans">
<head>
<meta charset="utf-8">
<title>{$title}</title>
{include('admin/_header.php')}

<noscript>你的浏览器没有打开JavaScript支持，无法正常使用本页面</noscript>
</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper login-body">
	<div class="login-wrapper">
		<div class="container">
			<img class="img-fluid logo-dark mb-2" src="/assets/img/logo.png" alt="{$title}">
			<div class="loginbox">
				<div class="login-right">

					<div class="login-right-wrap">
						<h1>注册</h1>
						<p class="account-subtitle">随时掌握职场资讯</p>
						<form action="/register" method="post">
							<div class="form-group">
								<label class="form-control-label">用户名</label>
								<input type="text" class="form-control" name="loginname" value="" tabindex="1" autocomplete="off" _input="true" placeholder="请设置用户名">
							</div>

							<div class="form-group">
								<label class="form-control-label">邮箱</label>
								<input type="text" class="form-control" name="loginmail" value="" tabindex="2" autocomplete="off" _input="true" placeholder="可用于找回密码">
							</div>

							<div class="form-group">
								<label class="form-control-label">密码</label>
								<div class="pass-group">
									<input type="password" class="form-control pass-input" name="nloginpwd" id="nloginpwd" value="" autocomplete="off" _input="true" tabindex="2" placeholder="请设置登陆密码">
									<span class="fa fa-eye toggle-password"></span>
								</div>
							</div>

							<input type="hidden" class="form-control" name="__hash__" id="__hash__" value="{$token}">
							<input type="hidden" class="form-control" name="pubKey" id="pubKey" value="{$pubKey}">

							<button class="btn btn-lg btn-block btn-primary" type="submit" id="loginsubmit">注册</button>

							<div class="text-center dont-have terms-privacy">点击登录和注册即代表同意《<a href="/terms" target="_blank">服务条例</a>》与《<a href="/privacy" target="_blank">隐私声明</a>》。</div>

							<div class="login-or">
								<span class="or-line"></span>
								<span class="span-or">or</span>
							</div>

							<!-- Social Login -->
							<div class="social-login mb-3">
								<span>直接登录</span>
								<a href="/login-weixin" class="wechat"><i class="fa fa-wechat"></i></a><a href="/login-github" class="github"><i class="fa fa-github"></i></a>
							</div>
							<!-- /Social Login -->
							<div class="text-center dont-have">已经有账户了？ <a href="/login">立即登陆</a></div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Main Wrapper -->

{include('admin/_footer.php')}

<script type="text/javascript">
$(function() {
    var t = $('#nloginpwd');
	var h = $('#__hash__');
    var k = $('#pubKey');
    t.focus(function() {
        t.val('');
    });
    $("#loginsubmit").click(function() {
        if(t.val()!==''){
            var res = new JSEncrypt();
            res.setPublicKey(window.atob(k.val()));
            var v = res.encrypt(t.val()+h.val());
            t.val(v);
        }
    });
});
</script>

</body>
</html>