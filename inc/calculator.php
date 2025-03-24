<?php
class CalculatorSavings {
public
	$c4, //Cost of unplanned wheelset maintenance accident
	$c5, //Unplanned maintenance events in 12 years
	$c6, //per wagon, Total gross profit loss of unplanned maintenance in 12 years
	$c7, //per fleet, Total gross profit loss of unplanned maintenance in 12 years
	$c10, //Healthy bearings until next overhaul
	$c11, //per fleet
	$c12, //per wagon
	$c13,

	$c16,
	$c17,
	$c18,
	$c19,

	$c22,
	$c23,
	$c24,
	$c25,

	$c28,
	$c29,
	$c30,
	$c31,

	$c34,
	$c35,
	$c36,
	$c37,
	$c38,
	$c39,
	$c40,


	$i4,
	$i5,
	$i6,
	$i7,
	$i8,
	$i9,
	$i10,
	$i11,
	$i12,
	$i13,
	$i14,
	$i15,

	$i18,
	$i19,
	$i20,
	$i21,

	$i25,
	$i26,

	$j25,
	$j26;

}

class CalculatorInputs {
	public
	$c5,
	$c6,
	$c7,
	$c10	= 60, //Average max capacity
	$c11	= 0.75, //%, Average loaded mileage
	$c12	= 0.05, //Average Tonn-kilometre price
	$c13	= 0.15, //%, Profitability (gross)
	$c16	= 144, //Lifetime months
	$c17	= 12, //Lifetime years
	$c18	= 12, //warranty
	$h5		= 100000, //Unplanned flat-spot/bearing/wheelset accident per wagon every
	$h6		= 5, //Unplanned vs scheduled maintenance duration difference
	$h10	= 6, //Overhaul routine every
	$h11	= 0.5, //%, Amount of bearings with no overhaul need until IS3
	$h12	= 200, //Cost of one bearing overhaul
	$h13	= 8, //Bearings per wagon
	$h17	= 50000000, //Derailment event due to wheelset issues once in
	$h18	= 200000, //Average cost per derailment
	$h22	= 10000000, //Flat-spot associated infrastructure damage every
	$h23	= 50000, //Average fee to cover damage
	$h27	= 12000, //Service disruption fee
	$h28	= 2, //Average disrupted hours per unplanned accident
	$h29	= 0.01, //%Disruptions per unplanned accident
	$h32 	= 0.02; //%, GPS-based efficiency increase
}



class CalculatorROI {
	public
	$perWagonIn12Years,
	$perWagonIn1Year,
	$in12Years,
	$in1Year;
}

class Calculator {

	private CalculatorInputs $inputs;

	private CalculatorSavings $savings;

	private $fleetSize;
	private $averageMileage;
	private $monthlyPricePerWagon;
	private $startingFee;

	public function __construct($fleetSize, $averageMileage, $monthlyPricePerWagon, $startingFee)
	{
		$this->fleetSize = $fleetSize;
		$this->averageMileage = $averageMileage;
		$this->monthlyPricePerWagon = $monthlyPricePerWagon;
		$this->startingFee = $startingFee;

		$this->savings = new CalculatorSavings;
		$this->inputs = new CalculatorInputs;


		$this->inputs->c5 = $this->fleetSize;
		$this->inputs->c6 = $this->averageMileage;
		$this->inputs->c7 = $this->averageMileage / 365;
	}

	public function calcSavings(){

		$s = $this->savings;
		$in = $this->inputs;

		//=($'Model inputs'.C7*$'Model inputs'.C10*$'Model inputs'.C11*$'Model inputs'.H6*$'Model inputs'.C12)*$'Model inputs'.C13
		$s->c4 = ($in->c7 * $in->c10 * $in->c11 * $in->h6 * $in->c12) * $in->c13;

		//=($'Model inputs'.C18*$'Model inputs'.C6)/$'Model inputs'.H5
		$s->c5 = ($in->c18 * $in->c6) / $in->h5;

		$s->c6 = $s->c4 * $s->c5;

		$s->c7 = $s->c6 * $in->c5;
		$s->c10 = $in->h13 * $in->h11;
		$s->c11 = $s->c10 * $s->c11;
		$s->c12 = $s->c10 * $in->h12;
		$s->c13 = $s->c12 * $in->c5;

		//=($'Model inputs'.C5*$'Model inputs'.C6*$'Model inputs'.C17)/$'Model inputs'.H17
		$s->c17 = ( $in->c5 * $in->c6 * $in->c17 ) / $in->h17;
		$s->c16 = $s->c17 / $in->c5;
		$s->c18 = $s->c16 * $in->h18;
		$s->c19 = $s->c18 * $in->c5;

		$s->c23 = ( $in->c5 * $in->c6 * $in->c17 ) / $in->h22;
		$s->c22 = $s->c23 / $in->c5;
		$s->c24 = $s->c22 * $in->h23;
		$s->c25 = $s->c24 * $in->c5;

		$s->c28 = $s->c5 * $in->h29;
		$s->c29 = $s->c28 * $in->c5;
		$s->c30 = $s->c28 * $in->h27 * $in->h28;
		$s->c31 = $s->c30 * $in->c5;

		$s->c34 = $in->c6 * $in->h32 * $in->c11;
		$s->c35 = $s->c34 * $in->c10 * $in->c12;
		$s->c36 = $s->c35 * $in->c5;
		$s->c37 = $s->c35 * $in->c13;
		$s->c38 = $s->c37 * $in->c5;
		$s->c39 = $s->c37 * $in->c17;
		$s->c40 = $s->c39 * $in->c5;

		$s->i4 = $s->c6;
		$s->i5 = $s->c7;
		$s->i6 = $s->c12;
		$s->i7 = $s->c13;
		$s->i8 = $s->c18;
		$s->i9 = $s->c19;
		$s->i10 = $s->c24;
		$s->i11 = $s->c25;
		$s->i12 = $s->c30;
		$s->i13 = $s->c31;
		$s->i14 = $s->c39;
		$s->i15 = $s->c40;

		$s->i18 = $s->i4 + $s->i6 + $s->i8 + $s->i10 + $s->i12;
		$s->i19 = $s->i5 + $s->i7 + $s->i9 + $s->i11 + $s->i13;
		$s->i20 = $s->i14;
		$s->i21 = $s->i15;

		$s->i25 = $s->i18 + $s->i14;
		$s->i26 = $s->i19 + $s->i15;

		$s->j25 = $s->i25 / 12;
		$s->j26 = $s->i26 / 12;


	}

	public function calcRoi(){
		$r = new CalculatorROI;
		$priceWagon12Years = $this->startingFee + $this->monthlyPricePerWagon * $this->inputs->c16;
		$priceWagon1Year = $this->startingFee + $this->monthlyPricePerWagon * 12;

		$totalFee12Years = $priceWagon12Years * $this->fleetSize;

		$perWagonROI = $this->savings->i25 - $priceWagon12Years;
		$totalROI = $this->savings->i26 - $totalFee12Years;
		$r->perWagonIn12Years = number_format($perWagonROI, 0, '.', '');
		$r->perWagonIn1Year = number_format($perWagonROI / 12, 0, '.', '');
		$r->in12Years = number_format($totalROI, 0, '.', '');
		$r->in1Year = number_format($totalROI / 12, 0, '.', '');

		return $r;
	}


}

add_action('after_setup_theme', function(){


});
