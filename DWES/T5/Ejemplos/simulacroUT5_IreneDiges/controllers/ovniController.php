<?php
include_once 'models/OvniModel.php';
include_once 'views/ovniView.php';

class ovniController
{
    public function main()
    {
        $model = new OvniModel();
        $years = $model->get_element_years();
        $view = new ovniView();

        $view->Header();

        $view->select($years);

        $view->Footer();

        echo $view->getPhtml();
    }

    public function datos()
    {

        $id = $_GET['id'] ?? null;

        $model = new OvniModel();
        $view = new ovniView();

        $view->Header();

        $years = $model->get_element_years();
        $view->select($years);

        if ($id !== null) {
            $headers = $model->get_info_header();
            $data = $model->get_element_info((int)$id);

            if (!empty($data)) {
                $view->showData($headers, $data);
            } else {
                $view->not_found("avistamiento", $id);
            }
        } else {
            $view->error("No se especificó un ID válido.");
        }

        $view->Footer();

        echo $view->getPhtml();
    }
}
