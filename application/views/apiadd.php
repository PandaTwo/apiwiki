<div class="container ng-scope" ng-app="Bird">
<h1><a href="/"><img src="/static/lib/logo.png" style="width: 80px;height: 80px;"></a>API WIKI</h1>
<!-- ngView:  -->
<div ng-view="" class="ng-scope">
    <ol class="breadcrumb ng-scope">
        <li><a href="/">Home</a></li>
        <li class="active ng-binding">添加api</li>
    </ol>
    <div class="ng-scope">
        <div ng-show="current" class="">
            <form class="form-horizontal ng-pristine ng-valid ng-valid-required" method="post"
                  action="/home/apiadd_post" name="apiForm" role="form">
                <input type="hidden" name="categoryid" value="<?php echo $_REQUEST['id']; ?>">

                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">接口名:</label>

                    <div class="col-sm-10">
                        <input type="text" required="" class="form-control ng-pristine ng-valid ng-valid-required"
                               name="name" ng-model="current.name" id="name" placeholder="接口名称">
                    </div>
                </div>
                <div class="form-group">
                    <label for="url" class="col-sm-2 control-label">url:</label>

                    <div class="col-sm-10">
                        <input type="text" required="" class="form-control ng-pristine ng-valid ng-valid-required"
                               name="url" id="url" ng-model="current.url" placeholder="url">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <textarea name="description" ng-model="current.description"
                                  style="width: 100%; height: 100px;"
                                  placeholder="描述" class="ng-pristine ng-valid"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">请求参数:</label>

                    <div class="col-sm-10">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>参数名</th>
                                <th>默认值</th>
                                <th>必传</th>
                                <th>类型</th>
                                <th>描述</th>
                                <th>
                                    <input type="button" id="requestBtn" hidrow="hid_requestRow"
                                           tbody="request_tbody" class="addbtn btn btn-success" value="新增">
                                </th>
                            </tr>
                            </thead>
                            <tbody id="request_tbody">
                            <!-- ngRepeat: param in current.params -->
                            <tr class="ng-scope">
                                <td><input type="text" name="request_paramname[]" class="ng-pristine ng-valid"></td>
                                <td><input type="text" name="request_defaultvalue[]" class="ng-pristine ng-valid">
                                </td>
                                <td><input type="text" name="request_isnull[]" style="width: 50px;" value="Y"
                                           class="ng-pristine ng-valid"></td>
                                <td>
                                    <select class="ng-pristine ng-valid" name="request_sourcetype[]">
                                        <option value="string" class="ng-scope ng-binding">string</option>
                                        <option value="int" class="ng-scope ng-binding">int</option>
                                        <!-- end ngRepeat: item in TYPES -->
                                    </select>
                                </td>
                                <td><textarea name="request_description[]" style="width: 400px;"
                                              ng-model="param.Description" class="ng-pristine ng-valid"></textarea>
                                </td>
                                <td>
                                    <input type="button" value="删除" class="delbtn btn btn-danger">
                                </td>
                            </tr>
                            <!-- end ngRepeat: param in current.params -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">返回参数说明:</label>

                    <div class="col-sm-10">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>参数名</th>
                                <th>默认值</th>
                                <th>必传</th>
                                <th>类型</th>
                                <th>描述</th>
                                <th>
                                    <input type="button" hidrow="hid_responseRow" tbody="response_tbody"
                                           id="responseBtn" class="addbtn btn btn-success" value="新增">
                                </th>
                            </tr>
                            </thead>
                            <tbody id="response_tbody">
                            <!-- ngRepeat: param in current.response -->
                            <tr class="ng-scope">
                                <td><input type="text" name="response_paramname[]" class="ng-pristine ng-valid">
                                </td>
                                <td><input type="text" name="response_defaultvalue[]" class="ng-pristine ng-valid">
                                </td>
                                <td><input type="text" style="width: 50px;" name="response_isnull[]" value="Y"
                                           class="ng-pristine ng-valid"></td>
                                <td>
                                    <select class="ng-pristine ng-valid" name="response_sourcetype[]">
                                        <option value="string" class="ng-scope ng-binding">string</option>
                                        <option value="int" class="ng-scope ng-binding">int</option>
                                        <!-- end ngRepeat: item in TYPES -->
                                    </select>
                                </td>
                                <td><textarea name="response_description[]" style="width: 400px;"
                                              class="ng-pristine ng-valid"></textarea>
                                </td>
                                <td>
                                    <input type="button" value="删除" class="delbtn btn btn-danger">
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <textarea name="example" ng-model="current.demo" style="width: 100%;height: 300px;"
                                  class="ng-pristine ng-valid"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" class="btn btn-success" value="保存">
                    </div>
                </div>
            </form>
        </div>


    </div>
</div>

<script>
    $(function () {
        $(".delbtn").live("click", function () {
            var isdel = confirm('delete?');
            if (isdel) {
                var vbtnDel = $(this); //得到点击的按钮对象
                var vTr = vbtnDel.parent("td").parent("tr"); //得到父tr对象;
                vTr.remove();
            }
        });

        $(".addbtn").click(function () {
            var btn = $(this);
            var tbodyId = btn.attr("tbody");
            var hidRowId = btn.attr("hidrow");

            var htmlsource = $("#" + hidRowId).html().replace("<table>", "").replace("</table>", "").replace("<tbody>", "").replace("</tbody>", "");
            $("#" + tbodyId).append(htmlsource);

        });
    });


</script>
<div id="hid_requestRow" style="display: none;">
    <table>
        <tr class="ng-scope">
            <td><input type="text" name="request_paramname[]" class="ng-pristine ng-valid"></td>
            <td><input type="text" name="request_defaultvalue[]" class="ng-pristine ng-valid"></td>
            <td><input type="text" style="width: 50px;" name="request_isnull[]" value="Y" class="ng-pristine ng-valid">
            </td>
            <td>
                <select class="ng-pristine ng-valid" name="request_sourcetype[]">
                    <option value="string" class="ng-scope ng-binding">string</option>
                    <option value="int" class="ng-scope ng-binding">int</option>
                    <!-- end ngRepeat: item in TYPES -->
                </select>
            </td>
            <td><textarea name="request_description[]" style="width: 400px;" class="ng-pristine ng-valid"></textarea>
            </td>
            <td>
                <input type="button" value="删除" class="delbtn btn btn-danger"/>
            </td>
        </tr>
    </table>
</div>
<div id="hid_responseRow" style="display: none;">
    <table>
        <tr ng-repeat="param in current.params" class="ng-scope">
            <td><input type="text" name="response_paramname[]" class="ng-pristine ng-valid"></td>
            <td><input type="text" name="response_defaultvalue[]" class="ng-pristine ng-valid"></td>
            <td><input type="text" style="width: 50px;" name="response_isnull[]" value="Y" class="ng-pristine ng-valid">
            </td>
            <td>
                <select class="ng-pristine ng-valid" name="response_sourcetype[]">
                    <option value="string" class="ng-scope ng-binding">string</option>
                    <option value="int" class="ng-scope ng-binding">int</option>
                </select>
            </td>
            <td><textarea name="response_description[]" style="width: 400px;" class="ng-pristine ng-valid"></textarea>
            </td>
            <td>
                <input type="button" value="删除" class="delbtn btn btn-danger">
            </td>
        </tr>
    </table>
</div>