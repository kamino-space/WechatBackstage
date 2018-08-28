<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <title>后台管理 - 四维平面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/source/css/bootstrap.min.css">
    <link rel="stylesheet" href="/source/css/sw-admin.css">
    <script type="text/javascript" src="/source/js/jquery.min.js"></script>
    <script type="text/javascript" src="/source/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/source/js/layer.js"></script>
    <script type="text/javascript" src="/source/js/sw-admin.js"></script>
</head>
<body>

<!--导航-->
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#example-navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">四维平面</a>
        </div>
        <div class="collapse navbar-collapse" id="example-navbar-collapse">
            <ul class="nav navbar-nav mao" id="myTab">
                <li class="active"><a href="#index" data-toggle="tab">首页</a></li>
                <li><a href="#setting" data-toggle="tab">基本设置</a></li>
                <li><a href="#reply" data-toggle="tab">关键词回复</a></li>
                <li><a href="#user" data-toggle="tab">用户管理</a></li>
                <li><a href="#plugin" data-toggle="tab">插件管理</a></li>
                <li><a href="#about" data-toggle="tab">关于</a></li>
            </ul>
        </div>
    </div>
</nav>

<!--主体-->
<div class="container">
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="index">
            <div class="page-header">
                <h1>
                    <small>#导航</small>
                </h1>
            </div>
            <a href="javascript:" onclick="link('setting')" class="list-group-item">#基本设置</a>
            <a href="javascript:" onclick="link('reply')" class="list-group-item">#关键词回复</a>
            <a href="javascript:" onclick="link('user')" class="list-group-item">#用户管理</a>
            <a href="javascript:" onclick="link('plugin')" class="list-group-item">#插件管理</a>
        </div>
        <div class="tab-pane fade" id="setting">
            <div class="page-header">
                <h1>
                    <small>#基本设置</small>
                </h1>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">当前设置</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>设置项</th>
                            <th>值</th>
                            <th>上次修改</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php
						foreach ( \sw\sw_config::getAll() AS $value ) {
							echo "<tr>";
							echo "<td>{$value["id"]}</td>";
							echo "<td>{$value["name"]}</td>";
							echo "<td>{$value["value"]}</td>";
							echo "<td>" . time2date( $value["time"] ) . "</td>";
							echo "</tr>";
						}

						?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="reply">
            <div class="page-header">
                <h1>
                    <small>#关键词回复</small>
                </h1>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">当前设置</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>关键词</th>
                            <th>回复</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php
						foreach ( \sw\sw_diyreply::selectAll() AS $value ) {
							echo "<tr>";
							echo "<td>{$value["id"]}</td>";
							echo "<td>{$value["keyword"]}</td>";
							echo "<td>{$value["reply"]}</td>";
							echo "</tr>";
						}
						?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="user">
            <div class="page-header">
                <h1>
                    <small>#用户管理</small>
                </h1>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">用户列表</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>用户名</th>
                            <th>用户ID</th>
                            <th>关注时间</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php
						foreach ( \sw\sw_user::userList() AS $value ) {
							echo "<tr>";
							echo "<td>{$value["id"]}</td>";
							echo "<td>{$value["name"]}</td>";
							echo "<td>" . md5( $value["uid"] ) . "</td>";
							echo "<td>" . time2date( $value["time"] ) . "</td>";
							echo "</tr>";
						}
						?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="plugin">
            <div class="page-header">
                <h1>
                    <small>#插件设置</small>
                </h1>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">插件列表</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>状态</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php
						foreach ( \sw\sw_setplug::allPlug() AS $n => $value ) {
							echo "<tr>";
							echo "<td>{$n}</td>";
							echo "<td>{$value["name"]}</td>";
							echo "<td>{$value["status"]}</td>";
							echo "</tr>";
						}
						?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="about">
            <div class="page-header">
                <h1>
                    <small>#关于本站</small>
                </h1>
            </div>
            <div class="list-group">
                <div class="list-group-item active">更新日志</div>
                <div class="list-group-item">v1.0 beta (2018-04-29) 测试版上线</div>
            </div>
        </div>
    </div>
</div>


<!--页脚-->
<div id="footer" class="container">
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="navbar-inner navbar-content-center">
            <p class="text-muted credit k-foot">
                WECHAT.AIKAMINO.CN<br><a href="http://www.miitbeian.gov.cn/" target="_blank">鲁ICP备17010228号</a>
            </p>
        </div>
    </nav>
</div>

<script>
    let hash = document.location.hash;
    if (hash) {
        $('.mao a[href="' + hash + '"]').tab('show');
    }
    $('.mao a').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;
    });

    function link(id) {
        $('.mao a[href="#' + id + '"]').tab('show');
    }
</script>

</body>
</html>

<?php
function time2date( $time ) {
	return date( "Y-m-d H:i:s", $time );
}

?>