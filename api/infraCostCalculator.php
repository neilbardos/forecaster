<?php

class infraCostCalculator {

	//PROPERTIES
	public $studyPerDay; //number of studies per day
	public $growthPercentage; //growth percentage per month
	public $numberOfMonthsToForecast; //number of months for cost forecast

	// private $numberOfStudiesPerMonthPerYear; //Total number of studies per month per year based on daily sutudies

	private $RamAllocation = 500; //500MB for 1000 studies
	private $RamCost1GbPerMonth = .00553; //1GB of RAM cost per hour in USD
	private $storageAllocationPerStudy = 10; //10MB of storage per 1 study
	private $storageCost1GBPerMonth = .10; //1GB of storage per month cost in USD

	//METHODS
	function __construct($studyPerDay, $growthPercentage, $numberOfMonthsToForecast) {
		$this->studyPerDay = $studyPerDay;
		$this->growthPercentage = $growthPercentage;
		$this->numberOfMonthsToForecast = $numberOfMonthsToForecast;
	}

	//calculate and prepare total cost per month per year
	function calculateCost() {

		$studiesPerMonthPerYear = $this->getStudiesDataPerMonth();
		$storageCost = $this->getTotalCost($studiesPerMonthPerYear);

		return $storageCost;
	}

	//calculate total cost per month
	function getTotalCost($studiesPerMonthPerYear) {

		foreach ($studiesPerMonthPerYear as $key => $studies) {

			//calculate RAM Cost
			$hoursPerMonth = $studies['days'] * 24;
			$RamUsedPerMonth = ($studies['numberOfStudies'] /1000) * $this->RamAllocation; //divide studies by 1000 since 1000 studioes require 500MB of RAM; Currently in MB
			$totalRamUsedPerMonth = $RamUsedPerMonth/1000; //convert RAM usage in MB to GB
			//calculate Ram Cost
			$totalRamCostPerMonth = ($totalRamUsedPerMonth * $this->RamCost1GbPerMonth) * $hoursPerMonth;

			//calculate Storage Cost
			$storageUsedPerMonth = $studies['numberOfStudies'] * $this->storageAllocationPerStudy; //get total storage of monthly studies in MB	
			$totalStorageUsedPerMonth = $storageUsedPerMonth/1000; //get total storage of monthly studies in GB	

			//get total cost
			$totalStorageCostPerMonth = $totalStorageUsedPerMonth * $this->storageCost1GBPerMonth;

			// $studiesPerMonthPerYear[$key]['RamCost'] = round($totalRamCostPerMonth,2);
			// $studiesPerMonthPerYear[$key]['storageCost'] = round($totalStorageCostPerMonth,2);
			
			$studiesPerMonthPerYear[$key]['totalCost'] = round($totalStorageCostPerMonth,2) + round($totalRamCostPerMonth,2);
		}

		return $studiesPerMonthPerYear;
	}
	
	//get number of studies per month considering the monthly growth percentage
	function getStudiesDataPerMonth(){
		$studiesData = $this->getDaysPerMonthYear();
		$studiesPerMonthPerYear = array();
		foreach ($studiesData as $key => $study) {
		
			$studiesPerMonth = $this->studyPerDay * $study['days']; //get studies per month without the growth percentage
			$totalStudiesPerMonth = $studiesPerMonth + ($studiesPerMonth * ($this->growthPercentage/100)); //get total studies per month with growth percentage
			$studiesData[$key]['numberOfStudies'] = $totalStudiesPerMonth;
			// array_push($studiesPerMonthPerYear, array('numberOfStudies'=>$totalStudiesPerMonth));
		}
		return $studiesData;
	}

	//get number of days per month per year
	function getDaysPerMonthYear(){
		$daysPerMonth = array();
		$numberOfMonthsToForecast = $this->numberOfMonthsToForecast;
		$year = date('Y'); //current year
		$month = date('n'); //current month in number format

		$remainingMonths = 12 - $month; //get the remaining months of the year including the current month
		
		$count = 0;
		$yearCounter = 1; //
		for ($x = 0; $x < $numberOfMonthsToForecast; $x++) {
			
			$newMonth = $month + $x;
			//reset to upcoming year
			if($count == 12){
				$count = 0;
				$yearCounter++;
			}
			//check if  year ends
			if($newMonth > 12){
				$count++;
				$newMonth = $newMonth - (12*$yearCounter);
			}
			
		    $daysPerMonth[$x]['monthYear'] = date('M Y', mktime(0,0,0,$month + $x,1));
		    $daysPerMonth[$x]['days'] = cal_days_in_month(CAL_GREGORIAN, $newMonth, $year);
			
		}
		return $daysPerMonth;
	}
}

?>