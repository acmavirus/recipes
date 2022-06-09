<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends MY_Controller {

	public function index()
	{
		$this->load->model("calendar_model");
		$calendar = new Calendar_model();

		$dataRow	=	$this->input->get();
		$month		=	!empty($dataRow['month']) ? $dataRow['month'] : date('n');
		$year		=	!empty($dataRow['year']) ? $dataRow['year'] : date('Y');

		$data = $calendar->generalCalendar($month, $year);
		$data['month']	=	$month;
		$data['year']	=	$year;
		$data['previous_month']	=	date('d-m-Y', strtotime("-1 month", strtotime("$year-$month-01")));
		$data['next_month']	=	date('d-m-Y', strtotime("+1 month", strtotime("$year-$month-01")));
		$this->load->view('calendar', $data);
	}
}
