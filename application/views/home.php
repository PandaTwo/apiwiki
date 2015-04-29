<div class="container ng-scope" ng-app="Bird">
    <h1><a href="/"><img src="/static/lib/logo.png" style="width: 80px;height: 80px;"></a>API WIKI</h1>
    <!-- ngView:  -->
    <div ng-view="" class="ng-scope">
        <ol class="breadcrumb ng-scope">
            <li class="active">Home-主要针对API文档进行说明</li>
        </ol>

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
