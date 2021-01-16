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
			<img class="img-fluid logo-dark mb-2" src="{$site_url}/assets/img/logo.png" alt="{$title}">
			<div class="loginbox">
				<div class="login-right">

				    <div class="login-right-wrap">
					    <h1>会员激活</h1>
                        <p class="account-subtitle">激活码已发送至您的电子邮箱</p>
						<form action="{$site_url}/active" method="post">
						    <div class="form-group"></div>
                            <div class="form-group">
								<div class="pass-group">
									<input type="text" class="form-control" name="nloginpwd" id="nloginpwd" value="" autocomplete="off" _input="true" tabindex="1" placeholder="激活验证码">
								</div>
							</div>
                            <div class="form-group"></div>
							<div class="form-group mb-0">
							    <input type="hidden" class="form-control" name="__hash__" id="__hash__" value="{$token}">
							    <input type="hidden" class="form-control" name="pubKey" id="pubKey" value="{$pubKey}">
								<button class="btn btn-lg btn-block btn-primary" type="submit" id="loginsubmit">下一步</button>
							</div>
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