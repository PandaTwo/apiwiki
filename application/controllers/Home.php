<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: UserPC
 * Date: 2015/4/25
 * Time: 20:48
 */
class Home extends CI_Controller
{


    function __construct()
    {
        parent::__construct();

        $this->load->model('m_apiCategory');
        $this->load->model('m_apiDescription');
        $this->load->model('m_apiParams');
    }

    public function index()
    {
        $data['content_text'] = 'home';
        $data['listCategory'] = $this->m_apiCategory->getCategoryList();
        $this->load->view('template', $data);
    }

    public function add()
    {
        $data['content_text'] = 'addcategory';
        $this->load->view('template', $data);
    }

    function editCategory()
    {
        $data['content_text'] = 'editcategory';
        $id = $this->input->get('id', true);
        $categoryModel = $this->m_apiCategory->getCategoryById($id);
        $data['categoryModel'] = $categoryModel;
        $this->load->view('template', $data);
    }

    public function apiadd()
    {
        $data['content_text'] = 'apiadd';
        $this->load->view('template', $data);
    }

    public function apiedit()
    {
        $id = $this->input->get('id', true);
        $apidescModel = $this->m_apiDescription->getApiDescById($id);
        $apiParamModels = $this->m_apiParams->getApiParamsByDescId($id);
        $data['content_text'] = 'apiedit';
        $data['apidescModel'] = $apidescModel;
        $data['apiParamModels'] = $apiParamModels;
        $this->load->view('template', $data);
    }

    function  apilist()
    {
        $id = $this->input->get('id', true);
        $apiDescs = $this->m_apiDescription->getapiDescByCid($id);
        $list = $this->m_apiParams->getApiParams($apiDescs);
        $categoryArray = $this->m_apiCategory->getCategoryById($id);
        $data['content_text'] = 'apilist';
        $data['list'] = $list;
        $data['categoryModel'] = $categoryArray;
        $this->load->view('template', $data);
    }

    /*
     * =======================POST========================
     * */

    /*
     * 修改分类信息
     * */
    function updatecategory_post()
    {
        $postData = $this->input->post();
        if (!$postData) {
            echo '别瞎搞';
            exit;
        }
        $result = $this->m_apiCategory->updateCategory($postData);
        if ($result) {
            alert('修改成功', '/');
        } else {
            alert('修改失败');
        }
    }

    function addcategory_post()
    {

        $postData = $this->input->post();
        if (!$postData) {
            echo '别闹，输入点东西。';
            exit;
        }
        $result = $this->m_apiCategory->addCategory($postData);
        if ($result) {
            alert('添加成功', '/');
        } else {
            alert('添加失败');
        }
    }

    function delete_description()
    {
        $id = $this->input->get('id', true);
        $cid = $this->input->get('cid', true);
        if (!$id || !$cid) {
            echo '别闹，没参数怎么删除。';
            exit;
        }
        $res = $this->m_apiDescription->deleteById($id);
        if ($res) {
            alert('删除成功', '/');
        } else {
            alert('删除失败');
        }

    }

    function delcategory()
    {
        $id = $this->input->get('id', true);
        if (!$id) {
            echo '别闹，没参数怎么删除。';
            exit;
        }

        $res = $this->m_apiCategory->delCategoryById($id);

        if ($res) {
            alert('删除成功', '/');
        } else {
            alert('删除失败');
        }

    }

    function ajaxDelApiParamById()
    {
        $id = $this->input->get('id', true);
        if (!$id) {
            echo json_encode(array(
                'success' => 'false'
            ));
        }
        $res = $this->m_apiParams->deleteApiParamById($id);
        if ($res) {
            echo json_encode(array(
                'success' => 'true'
            ));
        } else {
            echo json_encode(array(
                'success' => 'false'
            ));
        }
    }

    function apiedit_post()
    {
        $postData = $this->input->post();
        if (!$postData) {
            echo '别闹';
            exit;
        }
        //step 1 先更新apidesc信息
        $apiDesc = array(
            'categoryid' => $postData['categoryid'],
            'apiname' => $postData['name'],
            'apiurl' => $postData['url'],
            'apidesc' => $postData['description'],
            'response' => $postData['example'],
            'id' => $postData['apidescid']
        );



        //step2 分别遍历出新增加和修改api参数信息
        //=======================修改====================
        $apiParms = array();
        $requestCount = $postData['request_paramname'] ? count($postData['request_paramname']) : 0;
        //echo $postData['request_paramname'][0];
        for ($i = 0; $i < $requestCount; $i++) {
            $tempArray = array(
                'paramname' => $postData['request_paramname'][$i],
                'isNull' => $postData['request_isnull'][$i],
                'defaultvalue' => $postData['request_defaultvalue'][$i],
                'sourceType' => $postData['request_sourcetype'][$i],
                'description' => $postData['request_description'][$i],
                'descid' => $postData['apidescid'],
                'paramtype' => 1,//1为请求参数
                'id' => $postData['request_id'][$i],
                'categoryid' => $postData['categoryid']

            );
            array_push($apiParms, $tempArray);
        }
        $responseCount = isset($postData['response_paramname']) ? count($postData['response_paramname']) : 0;
        //var_dump($postData['response_paramname']);
        //echo $responseCount;
        for ($j = 0; $j < $responseCount; $j++) {
            $tempArray = array(
                'paramname' => $postData['response_paramname'][$j],
                'isNull' => $postData['response_isnull'][$j],
                'defaultvalue' => $postData['response_defaultvalue'][$j],
                'sourceType' => $postData['response_sourcetype'][$j],
                'description' => $postData['response_description'][$j],
                'descid' => $postData['apidescid'],
                'paramtype' => 2,//2为返回参数
                'id' => $postData['response_id'][$j],
                'categoryid' => $postData['categoryid']

            );
            array_push($apiParms, $tempArray);
        }

        //================================新增加===============================
        $newapiParms = array();
        $newrequestCount = isset($postData['newrequest_paramname']) ? count($postData['newrequest_paramname']) : 0;
        //echo $postData['request_paramname'][0];
        for ($i = 0; $i < $newrequestCount; $i++) {
            $tempArray = array(
                'paramname' => $postData['newrequest_paramname'][$i],
                'isNull' => $postData['newrequest_isnull'][$i],
                'defaultvalue' => $postData['newrequest_defaultvalue'][$i],
                'sourceType' => $postData['newrequest_sourcetype'][$i],
                'description' => $postData['newrequest_description'][$i],
                'descid' => $postData['apidescid'],
                'paramtype' => 1,//1为请求参数
                'categoryid' => $postData['categoryid']
            );
            array_push($newapiParms, $tempArray);
        }
        $newresponseCount = isset($postData['newresponse_paramname']) ? count($postData['newresponse_paramname']) : 0;
        //echo $responseCount;
        for ($j = 0; $j < $newresponseCount; $j++) {
            $tempArray = array(
                'paramname' => $postData['newresponse_paramname'][$j],
                'isNull' => $postData['newresponse_isnull'][$j],
                'defaultvalue' => $postData['newresponse_defaultvalue'][$j],
                'sourceType' => $postData['newresponse_sourcetype'][$j],
                'description' => $postData['newresponse_description'][$j],
                'descid' => $postData['apidescid'],
                'paramtype' => 2,//2为返回参数
                'categoryid' => $postData['categoryid']
            );
            array_push($newapiParms, $tempArray);
        }


        //step3 开启事务进行提交操作

        //var_dump($newapiParms);
        //echo '<br>';
        //var_dump($apiParms);
        //echo '<br>';
        //var_dump($apiDesc);

        $res = $this->m_apiDescription->editAndUpdateApiDesc($apiDesc, $apiParms, $newapiParms);
        if ($res) {
            alert('操作成功','/home/apiedit?id='.$postData['apidescid']);
        } else
            alert('咦，出错了');

    }

    function apiadd_post()
    {
        $postData = $this->input->post();
        $apiDesc = array(
            'categoryid' => $postData['categoryid'],
            'apiname' => $postData['name'],
            'apiurl' => $postData['url'],
            'apidesc' => $postData['description'],
            'response' => $postData['example'],
        );
        $descid = $this->m_apiDescription->addApiDescription($apiDesc);
        $apiParms = array();
        $requestCount = count($postData['request_paramname']);
        //echo $postData['request_paramname'][0];
        for ($i = 0; $i < $requestCount; $i++) {
            $tempArray = array(
                'paramname' => $postData['request_paramname'][$i],
                'isNull' => $postData['request_isnull'][$i],
                'defaultvalue' => $postData['request_defaultvalue'][$i],
                'sourceType' => $postData['request_sourcetype'][$i],
                'description' => $postData['request_description'][$i],
                'descid' => $descid,
                'paramtype' => 1,//1为请求参数
                'categoryid' => $postData['categoryid']
            );
            array_push($apiParms, $tempArray);
        }
        $responseCount = count($postData['response_paramname']);
        //echo $responseCount;
        for ($j = 0; $j < $responseCount; $j++) {
            $tempArray = array(
                'paramname' => $postData['response_paramname'][$j],
                'isNull' => $postData['response_isnull'][$j],
                'defaultvalue' => $postData['response_defaultvalue'][$j],
                'sourceType' => $postData['response_sourcetype'][$j],
                'description' => $postData['response_description'][$j],
                'descid' => $descid,
                'paramtype' => 2,//2为返回参数
                'categoryid' => $postData['categoryid']
            );
            array_push($apiParms, $tempArray);
        }
        $result = $this->m_apiParams->addApiParams($apiParms);
        if ($result) {
            alert('添加成功。', "/");
        } else {
            alert('添加失败。');
        }

    }
}