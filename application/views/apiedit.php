<div class="container ng-scope" ng-app="Bird">
<h1><a href="/"><img src="/static/lib/logo.png" style="width: 80px;height: 80px;"></a>API WIKI</h1>
<!-- ngView:  -->
<div ng-view="" class="ng-scope">
    <ol class="breadcrumb ng-scope">
        <li><a href="/">Home</a></li>
        <li class="active ng-binding">修改API</li>
    </ol>
    <div class="ng-scope">
        <div ng-show="current" class="">
            <form class="form-horizontal ng-pristine ng-valid ng-valid-required" method="post"
                  action="/home/apiedit_post" name="apiForm" role="form">
                <input type="hidden" name="apidescid" value="<?php echo $_REQUEST['id']; ?>">
                <input type="hidden" name="categoryid" value="<?php echo $apidescModel->categoryid; ?>">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">接口名:</label>

                    <div class="col-sm-10">
                        <input type="text" required="" class="form-control ng-pristine ng-valid ng-valid-required"
                               name="name" value="<?php echo $apidescModel->apiname; ?>" ng-model="current.name" id="name" placeholder="接口名称">
                    </div>
                </div>
                <div class="form-group">
                    <label for="url" class="col-sm-2 control-label">url:</label>

                    <div class="col-sm-10">
                        <input type="text" required="" class="form-control ng-pristine ng-valid ng-valid-required"
                               name="url" id="url" value="<?php echo $apidescModel->apiurl; ?>" ng-model="current.url" placeholder="url">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <textarea name="description" ng-model="current.description"
                                  style="width: 100%; height: 100px;"
                                  placeholder="描述" class="ng-pristine ng-valid"><?php echo $apidescModel->apidesc; ?></textarea>
                    </div>
                </div>
                <?php
                $requestArray = array();
                $responseArray = array();
                 foreach($apiParamModels as $apiModel){
                     if($apiModel->paramtype == '1')
                     {
                         array_push($requestArray,$apiModel);
                     }
                     if($apiModel->paramtype =='2')
                     {
                         array_push($responseArray,$apiModel);
                     }
                 }
                ?>
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
                            <?php foreach($requestArray as $row): ?>
                            <!-- ngRepeat: param in current.params -->
                            <tr class="ng-scope" apiparamid="<?php echo $row->id; ?>">
                                <input type="hidden" name="request_id[]" value="<?php echo $row->id; ?>" >
                                <td><input type="text" name="request_paramname[]" value="<?php echo $row->paramname; ?>" class="ng-pristine ng-valid"></td>
                                <td><input type="text" name="request_defaultvalue[]" value="<?php echo $row->defaultvalue; ?>" class="ng-pristine ng-valid">
                                </td>
                                <td><input type="text" name="request_isnull[]" value="<?php echo $row->isNull; ?>" style="width: 50px;" class="ng-pristine ng-valid"></td>
                                <td>
                                    <select class="ng-pristine ng-valid" name="request_sourcetype[]">
                                        <option value="string" <?php echo $row->sourcetype == 'string' ? 'selected' :''; ?> class="ng-scope ng-binding">string</option>
                                        <option value="int" <?php echo $row->sourcetype == 'int' ? 'selected' :''; ?> class="ng-scope ng-binding">int</option>
                                        <!-- end ngRepeat: item in TYPES -->
                                    </select>
                                </td>
                                <td><textarea name="request_description[]" style="width: 400px;"
                                              ng-model="param.Description" class="ng-pristine ng-valid"><?php echo $row->description; ?></textarea>
                                </td>
                                <td>
                                    <input type="button" value="删除" class="delbtn btn btn-danger">
                                </td>
                            </tr>
                            <!-- end ngRepeat: param in current.params -->
                            <?php endforeach; ?>
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
                            <?php foreach($responseArray as $row): ?>
                            <!-- ngRepeat: param in current.response -->
                            <tr class="ng-scope" apiparamid="<?php echo $row->id; ?>">
                                <input type="hidden" name="response_id[]" value="<?php echo $row->id; ?>" >
                                <td><input type="text" name="response_paramname[]" value="<?php echo $row->paramname; ?>" class="ng-pristine ng-valid">
                                </td>
                                <td><input type="text" name="response_defaultvalue[]" value="<?php echo $row->defaultvalue; ?>" class="ng-pristine ng-valid">
                                </td>
                                <td><input type="text" style="width: 50px;" name="response_isnull[]" value="<?php echo $row->isNull; ?>"
                                           class="ng-pristine ng-valid"></td>
                                <td>
                                    <select class="ng-pristine ng-valid" name="response_sourcetype[]">
                                        <option value="string" <?php echo $row->sourcetype == 'string' ? 'selected' :''; ?> class="ng-scope ng-binding">string</option>
                                        <option value="int" <?php echo $row->sourcetype == 'int' ? 'selected' :''; ?> class="ng-scope ng-binding">int</option>
                                        <!-- end ngRepeat: item in TYPES -->
                                    </select>
                                </td>
                                <td><textarea name="response_description[]" style="width: 400px;"
                                              class="ng-pristine ng-valid"><?php echo $row->description; ?></textarea>
                                </td>
                                <td>
                                    <input type="button" value="删除" class="delbtn btn btn-danger">
                                </td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <textarea name="example" ng-model="current.demo" style="width: 100%;height: 300px;"
                                  class="ng-pristine ng-valid"><?php echo $apidescModel->response; ?></textarea>
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
        /*
        * 删除数据库里面的内容
        * */
        $(".delbtn").live("click", function () {
            var isdel = confirm('当前会删除数据库里面的记录，确定?');
            if (isdel) {
                var vbtnDel = $(this); //得到点击的按钮对象
                var vTr = vbtnDel.parent("td").parent("tr"); //得到父tr对象;
                var apiParamid = vTr.attr('apiparamid');
                var res = delParamById(apiParamid);
                if(res){
                    vTr.remove();
                }else{
                    alert('del source error.');
                }
            }
        });

        function delParamById(id)
        {
            var result;
            $.ajax({
                type:"GET",
                async:false,
                url:"/home/ajaxDelApiParamById?id="+id,
                success:function(msg){
                    var jsonMsg = eval('('+msg+')');
                    result=jsonMsg.success;
                    //alert(result);
                }
            });
            return result;
        }

        /*
        * 假删除
        * */
        $(".newdelbtn").live("click", function () {
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
            <td><input type="text" name="newrequest_paramname[]" class="ng-pristine ng-valid"></td>
            <td><input type="text" name="newrequest_defaultvalue[]" class="ng-pristine ng-valid"></td>
            <td><input type="text" style="width: 50px;" name="newrequest_isnull[]" value="Y" class="ng-pristine ng-valid">
            </td>
            <td>
                <select class="ng-pristine ng-valid" name="newrequest_sourcetype[]">
                    <option value="string" class="ng-scope ng-binding">string</option>
                    <option value="int" class="ng-scope ng-binding">int</option>
                    <!-- end ngRepeat: item in TYPES -->
                </select>
            </td>
            <td><textarea name="newrequest_description[]" style="width: 400px;" class="ng-pristine ng-valid"></textarea>
            </td>
            <td>
                <input type="button" value="删除" class="newdelbtn btn btn-danger"/>
            </td>
        </tr>
    </table>
</div>
<div id="hid_responseRow" style="display: none;">
    <table>
        <tr ng-repeat="param in current.params" class="ng-scope">
            <td><input type="text" name="newresponse_paramname[]" class="ng-pristine ng-valid"></td>
            <td><input type="text" name="newresponse_defaultvalue[]" class="ng-pristine ng-valid"></td>
            <td><input type="text" style="width: 50px;" name="newresponse_isnull[]" value="Y" class="ng-pristine ng-valid">
            </td>
            <td>
                <select class="ng-pristine ng-valid" name="newresponse_sourcetype[]">
                    <option value="string" class="ng-scope ng-binding">string</option>
                    <option value="int" class="ng-scope ng-binding">int</option>
                </select>
            </td>
            <td><textarea name="newresponse_description[]" style="width: 400px;" class="ng-pristine ng-valid"></textarea>
            </td>
            <td>
                <input type="button" value="删除" class="newdelbtn btn btn-danger">
            </td>
        </tr>
    </table>
</div>