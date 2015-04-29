<div class="container ng-scope" ng-app="Bird">
    <h1><a href="/"><img src="/static/lib/logo.png" style="width: 80px;height: 80px;"></a>API WIKI</h1>
    <!-- ngView:  -->
    <div ng-view="" class="ng-scope">
        <ol class="breadcrumb ng-scope">
            <li><a href="/">Home</a></li>
            <?php if ($categoryModel): ?>
                <li class="active ng-binding"><?php echo $categoryModel[0]['categoryName'] ?></li>
            <?php endif; ?>
        </ol>
        <div style="position: fixed; left: 0; top: 100px;" class="ng-scope">
            <div class="btn-group-vertical">
                <a class="btn btn-success" href="/home/apiadd?id=<?php echo $_REQUEST['id'] ?>">Add</a>
                <button class="btn btn-default btn-xs ng-binding" ng-click="menu=!menu">目录</button>
                <?php
                foreach ($list as $items):
                    ?>
                    <!-- end ngRepeat: item in list -->
                    <a class="btn btn-default btn-xs ng-scope ng-binding"
                       href="#<?php echo $items['title']->apiurl; ?>"><?php echo $items['title']->apiname; ?></a>
                    <!-- end ngRepeat: item in list -->
                <?php endforeach; ?>
            </div>
        </div>

        <div class="ng-scope">

            <div ng-show="!current" class="">
                <!-- ngRepeat: item in list -->
                <?php
                if (!count($list)) {
                    echo '<p>分类下面没有任何API，请点击左侧添加</p>';
                }
                foreach ($list as $items):
                    ?>
                    <div class="panel panel-default ng-scope" ng-repeat="item in list">
                        <div id="<?php echo $items['title']->apiurl; ?>" class="panel-heading">
                            <h3 class="panel-title ng-binding"><?php echo $items['title']->apiname; ?>
                                <a class="btn btn-info btn-xs pull-right" href="/home/apiedit?id=<?php echo $items['title']->id; ?>">edit</a>
                                <a class="btn btn-danger btn-xs pull-right"
                                   href="/home/delete_description?id=<?php echo $items['title']->id; ?>&cid=<?php echo $items['title']->categoryid; ?>"
                                   style="margin-right: 5px;">delete</a>
                            </h3>
                            <h4><kbd class="ng-binding"><?php echo $items['title']->apiurl; ?></kbd></h4>
                        </div>
                        <div class="panel-body">
                            <div class="alert alert-info ng-binding"><?php echo $items['title']->apidesc; ?></div>
                            <div ng-show="item.params.length > 0" class="">
                                <h5>请求参数</h5>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>参数名</th>
                                        <th>必传</th>
                                        <th>默认值</th>
                                        <th>类型</th>
                                        <th>描述</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($items['apiParams'] as $item):
                                        if ($item->paramtype == 1):
                                            ?>
                                            <!-- ngRepeat: param in item.params -->
                                            <tr ng-repeat="param in item.params" class="ng-scope">
                                                <td class="ng-binding"><?php echo $item->paramname; ?></td>
                                                <td class="ng-binding"><?php echo $item->isNull; ?></td>
                                                <td class="ng-binding"><?php echo $item->defaultvalue; ?></td>
                                                <td class="ng-binding"><?php echo $item->sourcetype; ?></td>
                                                <td class="ng-binding"><?php echo $item->description; ?></td>
                                            </tr>
                                        <?php endif;endforeach; ?>
                                    <!-- end ngRepeat: param in item.params -->
                                    </tbody>
                                </table>
                            </div>
                            <div ng-show="item.response.length > 0">
                                <h5>返回值</h5>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>参数名</th>
                                        <th>必传</th>
                                        <th>默认值</th>
                                        <th>类型</th>
                                        <th>描述</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($items['apiParams'] as $item):
                                        if ($item->paramtype == 2):
                                            ?>
                                            <!-- ngRepeat: param in item.params -->
                                            <tr ng-repeat="param in item.params" class="ng-scope">
                                                <td class="ng-binding"><?php echo $item->paramname; ?></td>
                                                <td class="ng-binding"><?php echo $item->isNull; ?></td>
                                                <td class="ng-binding"><?php echo $item->defaultvalue; ?></td>
                                                <td class="ng-binding"><?php echo $item->sourcetype; ?></td>
                                                <td class="ng-binding"><?php echo $item->description; ?></td>
                                            </tr>
                                        <?php endif;endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <h4>Demo:</h4>

                            <div>
                    <pre class="ng-binding"><?php echo $items['title']->response; ?></pre>
                            </div>
                        </div>
                    </div>
                    <!-- end ngRepeat: item in list -->
                <?php endforeach; ?>

            </div>

        </div>
    </div>
