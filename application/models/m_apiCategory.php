<?php

class m_apiCategory extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->load->model('m_apiDescription');
        $this->load->model('m_apiParams');
    }

    public function addCategory($postData = array())
    {
        if (!$postData) return -1;

        $categoryModel = array(
            'categoryName' => $postData['categoryName'],
            'categoryDesc' => $postData['categoryDesc']
        );

        $result = $this->db->insert('api_categories', $categoryModel);
        return $result ? 1 : 0;
    }

    function updateCategory($postData = array())
    {
        if (!$postData) return -1;

        $categoryModel = array(
            'categoryName' => $postData['categoryName'],
            'categoryDesc' => $postData['categoryDesc']
        );
        $this->db->where('id', $postData['id']);
        $res = $this->db->update('api_categories', $categoryModel);

        return $res ? true : false;
    }

    function getCategoryById($id = '')
    {
        if (!$id) return -1;

        $sql = 'select * from api_categories where id =' . $id;
        $query = $this->db->query($sql);

        return $query->result_array();
    }

    public function getCategoryList()
    {
        $sql = 'select * from api_categories';

        $query = $this->db->query($sql);

        return $query->result();
    }

    function delCategoryById($id = 0)
    {
        if (!$id) return -1;

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->delete('api_categories');
        $this->m_apiDescription->deleteByCategoryId($id);
        $this->m_apiParams->deleteApiParamByCategoryId($id);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        } else
            return true;
    }


}