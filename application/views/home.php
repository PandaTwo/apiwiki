<div class="container ng-scope" ng-app="Bird">
    <h1><a href="/"><img src="/static/lib/logo.png" style="width: 80px;height: 80px;"></a>API WIKI</h1>
    <!-- ngView:  -->
    <div ng-view="" class="ng-scope">
        <ol class="breadcrumb ng-scope">
            <li class="active">Home-主要针对API文档进行说明-----<a style="text-decoration: none;cursor: pointer;" class="ng-binding" id="showmsg">点击查看约定说明：</a></li>
        </ol>
        <div id="msgDesc" style="display: none;" class="panel panel-default ng-scope">
            <div class="panel-heading">
                <h5>常用约定说明：</h5>

                <p>
                    1.所有api头请求操作分为:POST-GET-DELETE-PUT
                </p>
                <pre class="g-binding">
                    请求时请使用(Request Headers):
                    如：Request Method:GET or POST or DELETE
                </pre>
                <p>
                    2.请求用户相关信息使用Authorization身份验证(Request Headers):
                </p>
                <pre>
                  如： Authorization:173eb87d1a9a8ee6f9549e89a26e76f4
                </pre>
                <p>
                    3.返回类型分别支持json-xml-cvs-html(默认返回是json格式):
                </p>
                <pre>
                   如：请求url:v1/customer?format=json|xml|html 或：Content-Type:application/json
                </pre>
                <p>
                    4.返回http状态码是依据http标准来
                </p>
                <pre>
                    如：200 OK 401 身份验证错误 400 请求参数 500 程序内部错误等
                    详情信息可查看：http://www.ruanyifeng.com/blog/2011/09/restful.html
                </pre>
            </div>
        </div>
        <div class="panel panel-default ng-scope">
            <div class="panel-heading">
                <h3>API分类 -
                    <button class="btn btn-xs btn-info ng-binding" ng-click="show_edit = !show_edit">编辑分类</button>
                </h3>
            </div>
            <div class="panel-body">
                <ul class="media-list">
                    <!-- ngRepeat: item in list -->
                    <?php foreach ($listCategory as $row): ?>
                        <li class="media ng-scope" ng-repeat="item in list">
                            <a class="pull-left" href="#/api/123">
                                <img class="media-object" alt="..." style="width: 40px;height: 40px;"
                                     src="/static/lib/logo.png">
                            </a>

                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="/home/apilist?id=<?php echo $row->id; ?>"
                                       title="<?php echo $row->categoryDesc; ?>"
                                       class="ng-binding"><?php echo $row->categoryName; ?></a>
                                    <small title="当前分类的主键" class="ng-binding"> - <?php echo $row->id; ?></small>
                                    <a onclick="return confirm('确认删除会删除分类下所有api的所有记录，Leijun Say Are You OK?');"
                                       href="/home/delcategory?id=<?php echo $row->id; ?>"
                                       class="btn btn-danger btn-xs pull-right">删除</a>
                                    <a ng-show="show_edit" class="btn btn-info btn-xs pull-right"
                                       href="/home/editcategory?id=<?php echo $row->id; ?>" style="margin-right: 5px;">编辑</a>
                                </h4>
                                <p class="ng-binding"><?php echo $row->categoryDesc; ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="panel-footer">
                <a class="btn btn-default" href="/home/add">新建分类</a>
            </div>
        </div>
    </div>
<script>
    $(function(){
        $("#showmsg").click(function(){
            $("#msgDesc").toggle("slow");
        })
    });
</script>