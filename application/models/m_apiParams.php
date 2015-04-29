<?php

/**
 * Created by PhpStorm.
 * User: UserPC
 * Date: 2015/4/27
 * Time: 13:54
 */
class m_apiParams extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    /*
     * 批量更新记录
     * */
    function updateBatchApiParams($postData = array())
    {
        if(!$postData) return -1;
        $res = $this->db->update_batch('api_params',$postData,'id');
        return $res ? true : false;
    }

    /*
     * 批量添加
     * */
    function addApiParams($postData = array())
    {
        if (!$postData) {
            return -1;
        }
        $result = $this->db->insert_batch('api_params', $postData);
        return $result;
    }

    function getApiParamsByDescId($descid='')
    {
        if(!$descid)return -1;
        $sql = 'select * from api_params where descid='.$descid;
        $query = $this->db->query($sql);

        return $query->result();
    }


    function getApiParams($apiDesc = array())
    {
        if (!$apiDesc) return array();
        $returnArray = array();
        $index = 1;
        foreach ($apiDesc as $rows) {
            $sql = 'select * from api_params where descid=' . $rows->id;
            $query = $this->db->query($sql);
            $returnArray['array' . $index] = array(
                'title' => $rows,
                'apiParams' => $query->result()
            );
            $index++;
        }
        return $returnArray;
    }

    /*
     * 根据Id删除内容
     * */
    function deleteApiParamById($id = '')
    {
        if (!$id) return -1;
        $res = $this->db->delete('api_params', array(
            'id' => $id
        ));
        return $res ? true : false;
    }

    /*
     * 根据api信息ID删除明细
     * */
    function deleteApiParamByDescId($descId = '')
    {
        if (!$descId) return -1;
        $res = $this->db->delete('api_params', array(
            'descid' => $descId
        ));
        return $res ? true : false;
    }

    /*
     * 根据api信息ID删除明细
     * */
    function deleteApiParamByCategoryId($cid = '')
    {
        if (!$cid) return -1;
        $res = $this->db->delete('api_params', array(
            'categoryid' => $cid
        ));
        return $res ? true : false;
    }
}