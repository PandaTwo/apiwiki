<?php

/**
 * Created by PhpStorm.
 * User: UserPC
 * Date: 2015/4/27
 * Time: 13:45
 */
class m_apiDescription extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('m_apiParams');
    }


    /*
     * 功能针对apiedit页面进行添加更新操作
     * */
    function editAndUpdateApiDesc($apiDesc = array(), $updateApiparams = array(), $addApiparams = array())
    {
        $this->db->trans_start();
        //更新apiDesc
        self:: updateApiDesc($apiDesc);
        //更新已经存在的apiparams
        if ($updateApiparams)
            $this->m_apiParams->updateBatchApiParams($updateApiparams);
        //添加新增加的api参数列表
        if($addApiparams)
            $this->m_apiParams->addApiParams($addApiparams);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return false;
        } else
            return true;
    }

    /*
     * insert
     *
     * return:new id
     * */
    function addApiDescription($postData = array())
    {
        if (!$postData) {
            return -1;
        }
        $this->db->trans_start();
        $apidesc = array(
            'categoryid' => $postData['categoryid'],
            'apiname' => $postData['apiname'],
            'apiurl' => $postData['apiurl'],
            'apidesc' => $postData['apidesc'],
            'response' => $postData['response']
        );

        $this->db->insert('api_description', $apidesc);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function updateApiDesc($postData = array())
    {
        if (!$postData) return -1;

        $this->db->where('id', $postData['id']);
        $res = $this->db->update('api_description', $postData);

        return $res ? true : false;
    }

    function getApiDescById($id = '')
    {
        if (!$id) return -1;
        $sql = 'select * from api_description where id=' . $id;

        $query = $this->db->query($sql);

        return $query->row();
    }

    function getapiDescByCid($cid = "")
    {
        if (!$cid) return -1;
        $sql = 'select * from api_description where categoryid=' . $cid;
        $query = $this->db->query($sql);

        return $query->result();
    }

    /*
     * 根据分类Id删除
     * */
    function deleteByCategoryId($cid = '')
    {
        if (!$cid) return -1;
        $res = $this->db->delete('api_description', array(
                'categoryid' => $cid
            )
        );
        if ($res) return true;
        else
            return false;
    }

    /*
     * 根据id删除
     * */
    function deleteById($id = '')
    {
        if (!$id) return -1;
        $this->db->trans_begin();
        $this->db->where('id', $id);
        $this->db->delete('api_description');
        $this->m_apiParams->deleteApiParamByDescId($id);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        } else
            return true;

    }
}