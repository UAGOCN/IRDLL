<?php die('Access Denied');?>
<!doctype html>
<html lang="zh-cmn-Hans">
<head>
<meta charset="utf-8">
<title>{$title}</title>
{include('admin/_header.php')}

<noscript>你的浏览器没有打开JavaScript支持，无法正常使用本页面</noscript>
<style>
body {font-size: .875rem;}
.feather {width: 16px;height: 16px;vertical-align: text-bottom;}
.sidebar {position: fixed;top: 0;bottom: 0;left: 0;z-index: 100;padding: 48px 0 0;box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);}
@media (max-width: 767.98px) {.sidebar {top: 5rem;}}
.sidebar-sticky {position: relative;top: 0;height: calc(100vh - 48px);padding-top: .5rem;overflow-x: hidden;overflow-y: auto;}
@supports ((position: -webkit-sticky) or (position: sticky)) {.sidebar-sticky {position: -webkit-sticky;position: sticky;}}
.sidebar .nav-link {font-weight: 500;color: #333;}
.sidebar .nav-link .feather {margin-right: 4px;color: #999;}
.sidebar .nav-link.active {color: #007bff;}
.sidebar .nav-link:hover .feather,
.sidebar .nav-link.active .feather {color: inherit;}
.sidebar-heading {font-size: .75rem;text-transform: uppercase;}
.navbar-brand {padding-top: .75rem;padding-bottom: .75rem;font-size: 1rem;background-color: rgba(0, 0, 0, .25);box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);}
.navbar .navbar-toggler {top: .25rem;right: 1rem;}
.navbar .form-control {padding: .75rem 1rem;border-width: 0;border-radius: 0;}
.form-control-dark {color: #fff;background-color: rgba(255, 255, 255, .1);border-color: rgba(255, 255, 255, .1);}
.form-control-dark:focus {border-color: transparent;box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);}
.bd-placeholder-img {font-size: 1.125rem;text-anchor: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;}
@media (min-width: 768px) {.bd-placeholder-img-lg {font-size: 3.5rem;}}
</style>
</head>
<body>

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/admin-index">{$title}</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="/logout">Sign out</a>
        </li>
    </ul>
</nav>

</body>
</html>