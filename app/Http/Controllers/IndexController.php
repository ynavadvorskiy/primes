<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$amount = (int)$request->post('amount');
		$sqrtAmount = floor(sqrt($amount));
		/**
		 * Eratosthene sieve start
		 */
		$sieve = str_repeat("\1", $amount+1);
		for($i=2;$i<=$sqrtAmount;$i++){
			if($sieve[$i]==="\1"){
				for($j=$i*$i; $j<=$amount; $j+=$i){
					$sieve[$j]="\0";
				}
			}
		}
		/**
		 * Eratosthene sieve end
		 */

		$sum = 0;
		$maxCount= 0;
		/**
		 * we will have overhead on using array's here, but with input amount lower then 2.000.000 it will work fine,
		 * further improvements => use strings in replacement
		 */
		$consecutivePrimes = [];
		$maxConsecutivePrimes = [];
		for ($i=2;$i<mb_strlen($sieve);$i++) {
			if($sieve[$i]==="\1"){
				if ($sum + $i < $amount) {
					$sum += $i;
					$consecutivePrimes[] = $i;
					if($sieve[$sum]==="\1" && count($consecutivePrimes) >= $maxCount) {
						$maxCount = count($consecutivePrimes);
						$maxConsecutivePrimes = $consecutivePrimes;
					}
				} else {
					while ($sieve[$sum]!=="\1" && ($prime = array_shift($consecutivePrimes))) {
						$sum -= $prime;
						if ($sum + $i <= $amount) {
							$consecutivePrimes[] = $i;
							$sum += $i;
						}
					}
					if($sieve[$sum]==="\1" && count($consecutivePrimes) >= $maxCount) {
						$maxConsecutivePrimes = $consecutivePrimes;
						break;
					}
				}
			}
		}
		return view('index', [
			'elements' => $maxConsecutivePrimes,
			'amount' => $amount
		]);
    }
}
