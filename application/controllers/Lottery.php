<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lottery extends CI_Controller
{
    protected $_data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Lottery_model']);
        $this->_data = new Lottery_model();
    }

    public function index()
    {
        $datax = $this->_data->getByMonth(1, 2021, 04, 'data_result, displayed_time');
        $datax = $this->_data->returnData(1, $datax);
        $data  = $this->chartTKNN($datax);
        $this->load->view("default/lottery/layout", $data);
    }

    private function chart2S($data)
    {
        $data2 = [];
        foreach ($data as $key => $item) {
            foreach ($item['data_result_2s'] as $key2 => $item2) {
                $data2[] = $item2;
            };
        };
        sort($data2);
        $data2 = array_count_values($data2);
        return $data2;
    }

    private function chartTKNN($datax)
    {
        $data['data2'] = $data2 = $this->chart2S($datax);
        $dataxy = [];
        foreach ($data2 as $key => $value) {
            $dataxy[] = [
                'x' => $key,
                'y' => $value
            ];
        }

        $dataPoints = [];
        foreach ($data2 as $key => $value) {
            $dataPoints['x'][] = $key;
            $dataPoints['y'][] = $value;
        }
        $data['dataPoints'] = $dataPoints;

        usort($dataxy, function ($a, $b) {
            return $a['y'] < $b['y'] ? 1 : -1;
        });
        $dataPointsVNN = [];
        foreach ($dataxy as $key => $value) {
            if ($key <= 19) {
                $dataPointsVNN['x'][] = $value['x'];
                $dataPointsVNN['y'][] = $value['y'];
            }
        }
        $data['dataPointsVNN'] = $dataPointsVNN;
        $dataPointsIVN = [];
        foreach (array_reverse($dataxy) as $key => $value) {
            if ($key <= 19) {
                $dataPointsIVN['x'][] = $value['x'];
                $dataPointsIVN['y'][] = $value['y'];
            }
        }
        $data['dataPointsIVN'] = $dataPointsIVN;
        return $data;
    }
}
