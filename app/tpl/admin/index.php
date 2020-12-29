<!doctype html>
<html lang="zh-cmn-Hans">
<head>
<meta charset="utf-8">
<title>{$title}</title>
<link href="/assets/bootstrap/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
<link href="/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" crossorigin="anonymous" />
<script type="text/javascript" src="/assets/jquery/jquery.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="/assets/jquery/jquery.cookie.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="/assets/bootstrap/bootstrap.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="/assets/jsencrypt/jsencrypt.min.js" crossorigin="anonymous"></script>
<noscript>你的浏览器没有打开JavaScript支持，无法正常使用本页面</noscript>
<style type="text/css">
.middle {margin-top: 110px;margin-bottom: 110px;padding: 60px 50px 50px 50px;background-color: white;border-radius: 15px;box-shadow: 10px 10px 10px 10px rgb(0,0,0,0.1);}
.login {margin-left: 20px;}
.font2 {font-size: 0.8em;}
.btn {border-radius: 28px;}
i {color:rgb(0,102,204);}
</style>
</head>
<body>
<div class="container">
	<div class="middle mx-auto h-75 w-75">
		<div class="row">
			<div class="col col-12 col-md-6">
				<i class="fa fa-cubes fa-15x" aria-hidden="true"></i>
			</div>
			<div class="col col-12 col-md-6">
				<div class="login">
					<h5 class="font-weight-bold">{$title}</h5>
					<p class="font-weight-light font2">一个AI技术交流的平台</p>
					<form action="/login" method="post">
						<div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>
                            </div>
							<input type="text" class="form-control" name="loginname" value="" tabindex="1" autocomplete="off" _input="true" placeholder="Username">
						</div>
						<div class="input-group mb-3">
						    <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock fa-fw" aria-hidden="true"></i></span>
                            </div>
    						<input type="password" class="form-control" name="nloginpwd" id="nloginpwd" value="" autocomplete="off" _input="true" tabindex="2" placeholder="Password">
						</div>
						<div class="input-group mb-3">
							<input type="hidden" class="form-control" name="__hash__" id="__hash__" value="{$token}">
							<input type="hidden" class="form-control" name="pubKey" id="pubKey" value="{$pubKey}">
						</div>
						<button type="submit" class="btn btn-primary btn-block w-75 mx-auto" id="loginsubmit">登 录</button>
					</form>
				</div>
			</div>
		</div>
		<div class="row">
		    <div class="col text-center">
			    <i class="fa fa-copyright fa-fw" aria-hidden="true"></i> {:date("Y")}

			</div>
		</div>
	</div>
</div>
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