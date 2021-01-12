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
						<h1>登录</h1>
						<p class="account-subtitle">随时掌握职场资讯</p>
						<form action="/login" method="post">
							<div class="form-group">
								<label class="form-control-label">用户名</label>
								<input type="text" class="form-control" name="loginname" value="" tabindex="1" autocomplete="off" _input="true" placeholder="用户名或邮箱">
							</div>

							<div class="form-group">
								<label class="form-control-label">密码</label>
								<div class="pass-group">
									<input type="password" class="form-control pass-input" name="nloginpwd" id="nloginpwd" value="" autocomplete="off" _input="true" tabindex="2" placeholder="密码">
									<span class="fa fa-eye toggle-password"></span>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-6">
										<div class="custom-control custom-checkbox">
										    <input type="hidden" class="form-control" name="__hash__" id="__hash__" value="{$token}">
							                <input type="hidden" class="form-control" name="pubKey" id="pubKey" value="{$pubKey}">
										</div>
									</div>
									<div class="col-6 text-right">
										<a class="forgot-link" href="/forgot-password">忘记密码 ?</a>
									</div>
								</div>
							</div>

							<button class="btn btn-lg btn-block btn-primary" type="submit" id="loginsubmit">登录</button>

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
							<div class="text-center dont-have">还没有帐号? <a href="/register">立即加入</a></div>
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