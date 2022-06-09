<?php

class Calendar_model extends MY_Model
{
	protected $TK19;
	protected $TK20;
	protected $TK21;
	protected $TK22;
	protected $CAN;
	protected $CHI;
	protected $TUAN;
	protected $GIO;
	protected $TIETKHI;
	protected $dayofweek;
	protected $first_day;
	protected $last_day;

	public function __construct()
	{
		parent::__construct();
		$this->first_day = $this->jdn(25, 1, 1800); // Tet am lich 1800
		$this->last_day = $this->jdn(31, 12, 2199);
		$this->TK19 = [
			0x30baa3, 0x56ab50, 0x422ba0, 0x2cab61, 0x52a370, 0x3c51e8, 0x60d160, 0x4ae4b0, 0x376926, 0x58daa0,
			0x445b50, 0x3116d2, 0x562ae0, 0x3ea2e0, 0x28e2d2, 0x4ec950, 0x38d556, 0x5cb520, 0x46b690, 0x325da4,
			0x5855d0, 0x4225d0, 0x2ca5b3, 0x52a2b0, 0x3da8b7, 0x60a950, 0x4ab4a0, 0x35b2a5, 0x5aad50, 0x4455b0,
			0x302b74, 0x562570, 0x4052f9, 0x6452b0, 0x4e6950, 0x386d56, 0x5e5aa0, 0x46ab50, 0x3256d4, 0x584ae0,
			0x42a570, 0x2d4553, 0x50d2a0, 0x3be8a7, 0x60d550, 0x4a5aa0, 0x34ada5, 0x5a95d0, 0x464ae0, 0x2eaab4,
			0x54a4d0, 0x3ed2b8, 0x64b290, 0x4cb550, 0x385757, 0x5e2da0, 0x4895d0, 0x324d75, 0x5849b0, 0x42a4b0,
			0x2da4b3, 0x506a90, 0x3aad98, 0x606b50, 0x4c2b60, 0x359365, 0x5a9370, 0x464970, 0x306964, 0x52e4a0,
			0x3cea6a, 0x62da90, 0x4e5ad0, 0x392ad6, 0x5e2ae0, 0x4892e0, 0x32cad5, 0x56c950, 0x40d4a0, 0x2bd4a3,
			0x50b690, 0x3a57a7, 0x6055b0, 0x4c25d0, 0x3695b5, 0x5a92b0, 0x44a950, 0x2ed954, 0x54b4a0, 0x3cb550,
			0x286b52, 0x4e55b0, 0x3a2776, 0x5e2570, 0x4852b0, 0x32aaa5, 0x56e950, 0x406aa0, 0x2abaa3, 0x50ab50
		];
		$this->TK20 = [
			0x3c4bd8, 0x624ae0, 0x4ca570, 0x3854d5, 0x5cd260, 0x44d950, 0x315554, 0x5656a0, 0x409ad0, 0x2a55d2,
			0x504ae0, 0x3aa5b6, 0x60a4d0, 0x48d250, 0x33d255, 0x58b540, 0x42d6a0, 0x2cada2, 0x5295b0, 0x3f4977,
			0x644970, 0x4ca4b0, 0x36b4b5, 0x5c6a50, 0x466d50, 0x312b54, 0x562b60, 0x409570, 0x2c52f2, 0x504970,
			0x3a6566, 0x5ed4a0, 0x48ea50, 0x336a95, 0x585ad0, 0x442b60, 0x2f86e3, 0x5292e0, 0x3dc8d7, 0x62c950,
			0x4cd4a0, 0x35d8a6, 0x5ab550, 0x4656a0, 0x31a5b4, 0x5625d0, 0x4092d0, 0x2ad2b2, 0x50a950, 0x38b557,
			0x5e6ca0, 0x48b550, 0x355355, 0x584da0, 0x42a5b0, 0x2f4573, 0x5452b0, 0x3ca9a8, 0x60e950, 0x4c6aa0,
			0x36aea6, 0x5aab50, 0x464b60, 0x30aae4, 0x56a570, 0x405260, 0x28f263, 0x4ed940, 0x38db47, 0x5cd6a0,
			0x4896d0, 0x344dd5, 0x5a4ad0, 0x42a4d0, 0x2cd4b4, 0x52b250, 0x3cd558, 0x60b540, 0x4ab5a0, 0x3755a6,
			0x5c95b0, 0x4649b0, 0x30a974, 0x56a4b0, 0x40aa50, 0x29aa52, 0x4e6d20, 0x39ad47, 0x5eab60, 0x489370,
			0x344af5, 0x5a4970, 0x4464b0, 0x2c74a3, 0x50ea50, 0x3d6a58, 0x6256a0, 0x4aaad0, 0x3696d5, 0x5c92e0
		];
		$this->TK21 = [
			0x46c960, 0x2ed954, 0x54d4a0, 0x3eda50, 0x2a7552, 0x4e56a0, 0x38a7a7, 0x5ea5d0, 0x4a92b0, 0x32aab5,
			0x58a950, 0x42b4a0, 0x2cbaa4, 0x50ad50, 0x3c55d9, 0x624ba0, 0x4ca5b0, 0x375176, 0x5c5270, 0x466930,
			0x307934, 0x546aa0, 0x3ead50, 0x2a5b52, 0x504b60, 0x38a6e6, 0x5ea4e0, 0x48d260, 0x32ea65, 0x56d520,
			0x40daa0, 0x2d56a3, 0x5256d0, 0x3c4afb, 0x6249d0, 0x4ca4d0, 0x37d0b6, 0x5ab250, 0x44b520, 0x2edd25,
			0x54b5a0, 0x3e55d0, 0x2a55b2, 0x5049b0, 0x3aa577, 0x5ea4b0, 0x48aa50, 0x33b255, 0x586d20, 0x40ad60,
			0x2d4b63, 0x525370, 0x3e49e8, 0x60c970, 0x4c54b0, 0x3768a6, 0x5ada50, 0x445aa0, 0x2fa6a4, 0x54aad0,
			0x4052e0, 0x28d2e3, 0x4ec950, 0x38d557, 0x5ed4a0, 0x46d950, 0x325d55, 0x5856a0, 0x42a6d0, 0x2c55d4,
			0x5252b0, 0x3ca9b8, 0x62a930, 0x4ab490, 0x34b6a6, 0x5aad50, 0x4655a0, 0x2eab64, 0x54a570, 0x4052b0,
			0x2ab173, 0x4e6930, 0x386b37, 0x5e6aa0, 0x48ad50, 0x332ad5, 0x582b60, 0x42a570, 0x2e52e4, 0x50d160,
			0x3ae958, 0x60d520, 0x4ada90, 0x355aa6, 0x5a56d0, 0x462ae0, 0x30a9d4, 0x54a2d0, 0x3ed150, 0x28e952
		];
		$this->TK22 = [
			0x4eb520, 0x38d727, 0x5eada0, 0x4a55b0, 0x362db5, 0x5a45b0, 0x44a2b0, 0x2eb2b4, 0x54a950, 0x3cb559,
			0x626b20, 0x4cad50, 0x385766, 0x5c5370, 0x484570, 0x326574, 0x5852b0, 0x406950, 0x2a7953, 0x505aa0,
			0x3baaa7, 0x5ea6d0, 0x4a4ae0, 0x35a2e5, 0x5aa550, 0x42d2a0, 0x2de2a4, 0x52d550, 0x3e5abb, 0x6256a0,
			0x4c96d0, 0x3949b6, 0x5e4ab0, 0x46a8d0, 0x30d4b5, 0x56b290, 0x40b550, 0x2a6d52, 0x504da0, 0x3b9567,
			0x609570, 0x4a49b0, 0x34a975, 0x5a64b0, 0x446a90, 0x2cba94, 0x526b50, 0x3e2b60, 0x28ab61, 0x4c9570,
			0x384ae6, 0x5cd160, 0x46e4a0, 0x2eed25, 0x54da90, 0x405b50, 0x2c36d3, 0x502ae0, 0x3a93d7, 0x6092d0,
			0x4ac950, 0x32d556, 0x58b4a0, 0x42b690, 0x2e5d94, 0x5255b0, 0x3e25fa, 0x6425b0, 0x4e92b0, 0x36aab6,
			0x5c6950, 0x4674a0, 0x31b2a5, 0x54ad50, 0x4055a0, 0x2aab73, 0x522570, 0x3a5377, 0x6052b0, 0x4a6950,
			0x346d56, 0x585aa0, 0x42ab50, 0x2e56d4, 0x544ae0, 0x3ca570, 0x2864d2, 0x4cd260, 0x36eaa6, 0x5ad550,
			0x465aa0, 0x30ada5, 0x5695d0, 0x404ad0, 0x2aa9b3, 0x50a4d0, 0x3ad2b7, 0x5eb250, 0x48b540, 0x33d556
		];
		$this->CAN = ["Giáp", "Ất", "Bính", "Đinh", "Mậu", "Kỷ", "Canh", "Tân", "Nhâm", "Quý"];
		$this->CHI = ["Tý", "Sửu", "Dần", "Mão", "Thìn", "Tỵ", "Ngọ", "Mùi", "Thân", "Dậu", "Tuất", "Hợi"];
		$this->TUAN = ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"];
		$this->GIO = ["110100101100", "001101001011", "110011010010", "101100110100", "001011001101", "010010110011"];
		$this->TIETKHI = ["Xuân phân", "Thanh minh", "Cốc vũ", "Lập hạ", "Tiểu mãn", "Mang chủng", "Hạ chí", "Tiểu thử", "Đại thử", "Lập thu", "Xử thử", "Bạch lộ", "Thu phân", "Hàn lộ", "Sương giáng", "Lập đông", "Tiểu tuyết", "Đại tuyết", "Đông chí", "Tiểu hàn", "Đại hàn", "Lập xuân", "Vũ Thủy", "Kinh trập"];
		$this->dayofweek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
	}

	public function generalCalendar($month, $year)
	{
		$cache = "Data_calendar_all_{$month}_{$year}";
		$data = $this->getCache($cache);
		if (empty($data)) {
			$data['getMonth'] = $getMonth = $this->getMonth($month, $year);
			$data['emptyCells'] = $this->getEmptyCells($getMonth['DayInfo'][0]);
			if (count($getMonth) == 0) return "Error";
			$this->setCache($cache, $data, 9999);
		}
		return $data;
	}

	public function generalCalendarToLunar($day, $month, $year){

	}

	public function getMonth($month, $year)
	{
		if ($month <= 12) {
			$month_next = $month + 1;
			$year_next = $year;
		} else {
			$month_next = $month;
			$year_next = $year + 1;
		}
		$data['jdn1'] = $jdn1 = $this->jdn(1, $month, $year);
		$data['jdn2'] = $jdn2 = $this->jdn(1, $month_next, $year_next);
		$data['YearInfo'] = $YearInfo = $this->getYearInfo($year);
		$tet1 = $YearInfo[0]['Julius'];
		$data['DayInfo'] = [];
		if ($tet1 <= $jdn1) { /* tet(yy) = tet1 < jd1 < jd2 <= 1.1.(yy+1) < tet(yy+1) */
			for ($i = $jdn1; $i < $jdn2; $i++) {
				$data['DayInfo'][] = $this->findLunarDate($i, $YearInfo);
			}
		} else if ($jdn1 < $tet1 && $jdn2 < $tet1) { /* tet(yy-1) < jd1 < jd2 < tet1 = tet(yy) */
			$YearInfo = $this->getYearInfo($year - 1);
			for ($i = $jdn1; $i < $jdn2; $i++) {
				$data['DayInfo'][] = $this->findLunarDate($i, $YearInfo);
			}
		} else if ($jdn1 < $tet1 && $tet1 <= $jdn2) { /* tet(yy-1) < jd1 < tet1 <= jd2 < tet(yy+1) */
			$YearInfo1 = $this->getYearInfo($year - 1);
			for ($i = $jdn1; $i < $tet1; $i++) {
				$data['DayInfo'][] = $this->findLunarDate($i, $YearInfo1);
			}
			for ($i = $tet1; $i < $jdn2; $i++) {
				$data['DayInfo'][] = $this->findLunarDate($i, $YearInfo);
			}
		}
		foreach ($data['DayInfo'] as $key => $item) {
			$data['DayInfo'][$key]['data'] = $this->getEventInfo(($key + 1), $month, $year, $item);
		}
		return $data;
	}

	public function jdn($day, $month, $year)
	{//Đổi ngày dd/mm/yyyy ra số ngày Julius jd
		$day = (int) $day;
		$month = (int) $month;
		$year = (int) $year;
		$a = floor((14 - $month) / 12);
		$y = $year + 4800 - $a;
		$m = $month + 12 * $a - 3;
		$jd = $day + floor((153 * $m + 2) / 5) + 365 * $y + floor($y / 4) - floor($y / 100) + floor($y / 400) - 32045;
		return (int)$jd;
	}

	public function getYearInfo($year)
	{
		$year = (int) $year;
		$code = '';
		if ($year < 1900) {
			$code = $this->TK19[$year - 1800];
		} else if ($year < 2000) {
			$code = $this->TK20[$year - 1900];
		} else if ($year < 2100) {
			$code = $this->TK21[$year - 2000];
		} else {
			$code = $this->TK22[$year - 2100];
		}

		return $this->getLunarYearInfo($year, $code);
	}

	public function getEventInfo($day, $month, $year, $jdn)
	{
		$data = [];
		if (empty($jdn)) {
			$getMonth = $this->getMonth($month, $year);
			$emptyCells = $this->getEmptyCells($getMonth['result'][0]);
			$jdn = $getMonth[$day - 1];
		}
		$data = $this->getCanChi($jdn);
		$data['goi_dau_ngay'] = $this->getCanHour0($jdn['Julius']) . " " . $this->CHI[0];
		$data['tiet'] = $this->getTietKhi($jdn['Julius']);
		$data['gio_hoang_dao'] = $this->getGioHoangDao($jdn['Julius']);
		return $data;
	}

	public function getGioHoangDao($Julius)
	{
		$chiOfDay = ($Julius + 1) % 12;
		$gioHD = $this->GIO[$chiOfDay % 6]; // same values for Ty' (1) and Ngo. (6), for Suu and Mui etc.
		$data = [];
		$count = 0;
		for ($i = 0; $i < 12; $i++) {
			if (substr($gioHD, $i, 1) == '1') {
				$data[$i][] = $this->CHI[$i];
				$data[$i][] = ($i * 2 + 23) % 24;
				$data[$i][] = ($i * 2 + 1) % 24;
			}
		}
		return $data;
	}

	public function getTietKhi($Julius)
	{
		return $this->TIETKHI[$this->getSunLongitude($Julius + 1, 7.0)];
	}

	public function getSunLongitude($Julius, $GMT)
	{
		return (int)($this->SunLongitude($Julius - 0.5 - $GMT / 24.0) / pi() * 12);
	}

	public function SunLongitude($Julius)
	{
		$T = ($Julius - 2451545.0) / 36525; // Time in Julian centuries from 2000-01-01 12:00:00 GMT
		$T2 = $T * $T;
		$dr = pi() / 180; // degree to radian
		$M = 357.52910 + 35999.05030 * $T - 0.0001559 * $T2 - 0.00000048 * $T * $T2; // mean anomaly, degree
		$L0 = 280.46645 + 36000.76983 * $T + 0.0003032 * $T2; // mean longitude, degree
		$DL = (1.914600 - 0.004817 * $T - 0.000014 * $T2) * sin($dr * $M);
		$DL = $DL + (0.019993 - 0.000101 * $T) * sin($dr * 2 * $M) + 0.000290 * sin($dr * 3 * $M);
		$L = $L0 + $DL; // true longitude, degree
		$L = $L * $dr;
		$L = $L - pi() * 2 * ((int)($L / (pi() * 2))); // Normalize to (0, 2*PI)
		return $L;
	}

	public function getCanHour0($Julius)
	{
		return $this->CAN[($Julius - 1) * 2 % 10];
	}

	public function getCanChi($LunarDate)
	{
		$day = $this->CAN[($LunarDate['Julius'] + 9) % 10] . " " . $this->CHI[($LunarDate['Julius'] + 1) % 12];
		$month = $this->CAN[($LunarDate['lunar_year'] * 12 + $LunarDate['lunar_month'] + 3) % 10] . " " . $this->CHI[($LunarDate['lunar_month'] + 1) % 12];
		if ($LunarDate['leap'] == 1) {
			$month .= " (nhu\u1EADn)";
		}
		$year = $this->CAN[($LunarDate['lunar_year'] + 6) % 10] . " " . $this->CHI[($LunarDate['lunar_year'] + 8) % 12];

		return [
			'canchi_day' => $day,
			'canchi_month' => $month,
			'canchi_year' => $year
		];
	}

	private function getEmptyCells($LunarDate)
	{
		return ($LunarDate['Julius']) % 7; //vị trí bắt đầu của ngày đầu tiên trong tháng và t2->cn; ($ld1['Julius']+1) % 7 sẽ tính từ cn->t7
	}

	public function GregorianToJulian($day, $month, $year)
	{
		$jd = gregoriantojd($month, $day, $year);
		return $jd;
	}

	public function JulianToGregorian($Julian)
	{
		$gr = jdtogregorian($Julian);
		return $gr;
	}

	private function findLunarDate($Julius, $YearInfo)
	{
		if ($Julius > $this->last_day || $Julius < $this->first_day || $YearInfo[0]['Julius'] > $Julius) {
			return $this->LunarDate(0, 0, 0, 0, $Julius);
		};
		$i = count($YearInfo) - 1;
		while ($Julius < $YearInfo[$i]['Julius']) {
			$i--;
		}
		$off = $Julius - $YearInfo[$i]['Julius'];
		$ret = $this->LunarDate($YearInfo[$i]['lunar_day'] + $off, $YearInfo[$i]['lunar_month'], $YearInfo[$i]['lunar_year'], $YearInfo[$i]['leap'], $Julius);
		return $ret;
	}

	private function getLunarYearInfo($year, $code)
	{
		$data = [];
		$monthLengths = [29, 30];
		$regularMonths = [12];
		$offsetOfTet = $code >> 17;
		$leapMonth = $code & 0xf;
		$leapMonthLength = $monthLengths[$code >> 16 & 0x1];
		$solarNY = $this->jdn(1, 1, $year);
		$currentJD = $solarNY + $offsetOfTet;
		$j = $code >> 4;
		for ($i = 0; $i < 12; $i++) {
			$regularMonths[12 - $i - 1] = $monthLengths[$j & 0x1];
			$j >>= 1;
		}
		if ($leapMonth == 0) {
			for ($month = 1; $month <= 12; $month++) {
				$data[] = $this->LunarDate(1, $month, $year, 0, $currentJD);
				$currentJD = $currentJD + $regularMonths[$month - 1];
			}
		} else {
			for ($month = 1; $month <= $leapMonth; $month++) {
				$data[] = $this->LunarDate(1, $month, $year, 0, $currentJD);
				$currentJD = $currentJD + $regularMonths[$month - 1];
			}
			$data[] = $this->LunarDate(1, $month, $year, 1, $currentJD);
			$currentJD += $leapMonthLength;
			for ($month = $leapMonth + 1; $month <= 12; $month++) {
				$data[] = $this->LunarDate(1, $month, $year, 0, $currentJD);
				$currentJD = $currentJD + $regularMonths[$month - 1];
			}
		}
		return $data;
	}

	private function LunarDate($day, $month, $year, $leap, $currentJD)
	{
		$Gregorian = $this->JulianToGregorian($currentJD);
		$Gregorian = explode("/", $Gregorian);
		$dow = ($currentJD) % 7;

		$data = [
			'lunar_day' => (int)$day,
			'lunar_month' => (int)$month,
			'lunar_year' => (int)$year,
			'calen_day' => (int)$Gregorian[1],
			'calen_month' => (int)$Gregorian[0],
			'calen_year' => (int)$Gregorian[2],
			'dayofweek' => $this->dayofweek[$dow],
			'leap' => $leap,
			'Julius' => $currentJD
		];
		return $data;
	}

}
