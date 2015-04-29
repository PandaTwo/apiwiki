<div class="container ng-scope" ng-app="Bird">
    <h1><a href="#/"><img src="/static/lib/logo.png" style="width: 80px;height: 80px;"></a>API WIKI</h1>
    <!-- ngView:  -->
    <div ng-view="" class="ng-scope">
        <ol class="breadcrumb ng-scope">
            <li><a href="/">Home</a></li>
            <li class="active ng-binding">添加分类</li>
        </ol>

        <form class="form-horizontal ng-scope ng-pristine ng-invalid ng-invalid-required" method="post"
              action="/home/addcategory_post" name="typeForm" role="form">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">分类名:</label>

                <div class="col-sm-10">
                    <input type="text" name="categoryName"
                           class="form-control ng-pristine ng-invalid ng-invalid-required"
                           required="" ng-model="current.name" id="name" placeholder="分类(in chinese)">
                    <span class="error" ng-show="typeForm.name.$error.required">请填写分类名</span>
                </div>
            </div>
            <!-- end ngIf: !href -->
            <div class="form-group">
                <label for="module" class="col-sm-2 control-label">描述:</label>

                <div class="col-sm-10">
                    <textarea name="categoryDesc" ng-model="current.description" style="width: 100%; height: 100px;"
                              placeholder="描述" class="ng-pristine ng-valid"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" value="保存">
                </div>
            </div>
        </form>
    </div>
