<?php
class CDate {
	//Private variables
	private $currentTimestampOriginal;
	private $currentTimestamp;
	private $days;

	/** 
	 * Name: __construct
	 * Description: Initiates class variables
	 * 
	 * Params:
	 * @today int optional, an integer Unix timestamp
	 */
	public function __construct($today = -1) {
		$this->days = array('monday' => 1, 'tuesday' => 2, 'wednesday' => 3, 'thursday' => 4, 'friday' => 5, 'saturday' => 6, 'sunday' => 7, );
		$this->currentTimestamp = $today === -1 ? time() : $today;

		$this->currentTimestampOriginal = $this->currentTimestamp;
	}

	public function resetDate() {
		$this->currentTimestamp = $this->currentTimestampOriginal;
	}
	public function getCurrentTimestamp() {
		return $this->currentTimestamp;
	}
	public function getCurrentDate($format = "Y-m-d") {
		return date($format, $this->currentTimestamp);
	}
	public function getCurrentDayName() {
		return $this->getCurrentDate("l");
	}
	public function getCurrentDayNumber() {
		return $this->getCurrentDate("N");
	}
	public function getCurrentWeekNumber() {
		return $this->getCurrentDate("W");
	}
	public function getNrOfDaysUntillWeekday($weekday) {
		$weekday = is_numeric($weekday) ? $weekday : $this->days[strtolower($weekday)];
		$currentDay = $this->getCurrentDayNumber();
		$daysLeft = $weekday - $currentDay;
		$daysLeft = ($daysLeft < 0) ? (7+$daysLeft) : $daysLeft;

		return $daysLeft;
	}
	public function getNrOfDaysInMonth() {
		return cal_days_in_month(CAL_GREGORIAN, $this->getCurrentDate("n"), $this->getCurrentDate("Y"));
	}
	public function addDays($nrOfDays = 1) {
		$this->currentTimestamp = strtotime("+$nrOfDays day", $this->currentTimestamp);
	}
	public function subtractDays($nrOfDays = 1) {
		$this->currentTimestamp = strtotime("-$nrOfDays day", $this->currentTimestamp);	
	}
	public function addMonths($nrOfMonths = 1) {
		$this->currentTimestamp = strtotime("+$nrOfMonths month", $this->currentTimestamp);	
	}
	public function subtractMonths($nrOfMonths = 1) {
		$this->currentTimestamp = strtotime("-$nrOfMonths month", $this->currentTimestamp);	
	}
	public function addYears($nrOfYears = 1) {
		$this->currentTimestamp = strtotime("+$nrOfYears year", $this->currentTimestamp);
	}
	public function subtractYears($nrOfYears = 1) {
		$this->currentTimestamp = strtotime("-$nrOfYears year", $this->currentTimestamp);
	}

	public function toString() {
		$output = "";
		$output .= "Timestamp: ". $this->getCurrentTimestamp() ."<br/>";
		$output .= "Today: ". $this->getCurrentDate() ."<br/>";
		$this->addDays();
		$output .= "Tomorrow: ". $this->getCurrentDate() ."<br/>";
		$this->subtractDays();
		$this->addMonths();
		$output .= "Next month: ". $this->getCurrentDate() ."<br/>";
		$this->subtractMonths();
		$this->addYears();
		$output .= "Next year: ". $this->getCurrentDate() ."<br/>";
		$this->subtractYears();
		$output .= "Current day name: ". $this->getCurrentDayName() ."<br/>";
		$output .= "Current day number: ". $this->getCurrentDayNumber() ."<br/>";
		$output .= "Days untill Friday: ". $this->getNrOfDaysUntillWeekday("friday") ."<br/>";
		$output .= "Days in month: ". $this->getNrOfDaysInMonth() ."<br/>";
		$output .= "Current Week Nr: ". $this->getCurrentWeekNumber() ."<br/>";
		return $output;
	}
}