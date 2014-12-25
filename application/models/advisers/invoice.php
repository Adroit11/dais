<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  NUMUN School DB functions
*/

class Invoice extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function get_invoice($schoolid){
		$query = $this->db->get_where('invoices', array('schoolid' => $schoolid));
		$row = $query->row();
		if($query->num_rows() > 0){
		if($row->approved == 1){
			//invoice has been approved
			if($row->pay_level == 'regular'){
			$date = array('date' => $this->get_deposit_deadline('regular'));
			}elseif($row->pay_level == 'early'){
			$date = array('date' => $this->get_deposit_deadline('early'));
			}
			$billed_quantities = array(
				'delegate_q' => $row->delegate_quantity,
				'adviser_q' => $row->adviser_quantity,
				'country_q' => $row->country_quantity
			);
			$billed_prices = $this->get_prices($row->pay_level);
			
			//determine single/multiple country assignments
			if($billed_quantities['country_q'] > 1){
				//charge fee; multiply by 1
				$multiple_countries = 1;
				$additional = $billed_quantities['country_q'] - 2;
			}else{
				//don't charge; multiply by 0
				$multiple_countries = 0;
				$additional = 0;
			}
			
			$totals = array(
				'delegates' => $billed_quantities['delegate_q'] * $billed_prices['delegate_fee'],
				'advisers' => $billed_quantities['adviser_q'] * $billed_prices['adviser_fee'],
				'first' =>	$billed_prices['country1_fee'],
				'second' => $multiple_countries * $billed_prices['country2_fee'],
				'additional' => $additional  //additional country assignments are free
			);
			$multi = array('multi' => $multiple_countries);
			$grand_total = array('grand_total' => $totals['delegates'] + $totals['advisers'] + $totals['first'] + $totals['second']);
			
			$payments = array('payments' => $this->get_payments($schoolid));
			if($payments['payments'] < ($grand_total['grand_total']/2)){
			//deposit not paid or partially paid
			//pay now: deposit - payments, pay later: balance
				$deposit = array('deposit' => ($grand_total['grand_total']/2) - $payments['payments'], 
								 'pay_later' => ($grand_total['grand_total']/2));
				
			}elseif($payments['payments'] == ($grand_total['grand_total']/2)){
			//deposit paid
			//pay now: 0
			//pay later: remaining = deposit_amt
			$deposit = array('deposit' => 0, 
							 'pay_later' => ($grand_total['grand_total']/2));
			
				
			}elseif($payments['payments'] > ($grand_total['grand_total']/2)){
			//deposit and part of balane paid
			//pay now: 0
			//pay later: remaining is total - payments 
			$deposit = array('deposit' => 0, 
						     'pay_later' => $grand_total['grand_total'] - $payments['payments']);
			}
			
			//check for payments/transactions and apply below grand total with "due now/10/1/2014" (amt up to deposit) and "due at conference"
			
			
			$response = array_merge($billed_quantities, $billed_prices, $totals, $grand_total, $date, $multi, $payments, $deposit);
			return $response;
		}elseif($row->approved == 0){
			//invoice not approved
			return false;
		}
		}else{
			//School doesn't exist. That's ok. Just say the invoice doesn't exist yet.
			return false;
		}
	}
	public function get_prices($level){
		$query = $this->db->get_where('conference', array('current' => 1));
		$row = $query->row();
		if($query->num_rows() > 0){
			//Current conference exists
			if($level == "regular"){
			$response = array(
				'delegate_fee' => $row->delegate_fee,
				'adviser_fee' => $row->adviser_fee,
				'country1_fee' => $row->first_country_fee,
				'country2_fee' => $row->second_country_fee
			);
			}elseif($level == "early"){
			$response = array(
				'delegate_fee' => $row->early_delegate_fee,
				'adviser_fee' => $row->early_adviser_fee,
				'country1_fee' => $row->early_first_country_fee,
				'country2_fee' => $row->early_second_country_fee
			);	
			}
			return $response;
		}else{
			//School doesn't exist. That's ok. Just say the invoice doesn't exist yet.
			return false;
		}
	}
	public function get_deposit_deadline($pay_level){
		$query = $this->db->get_where('conference', array('current' => 1));
		$row = $query->row();
		if($pay_level == "regular"){
		return $row->deposit_deadline;
		}elseif($pay_level == "early"){
		return $row->early_deposit_deadline;
		}
	}
	public function get_customer_number($schoolid){
		$query = $this->db->get_where('schools', array('id' => $schoolid));
		$row = $query->row();
		if($query->num_rows() > 0){
			//school exists
			$response = $row->customer;
			return $response;
		}else{
			//School doesn't exist. That's ok. Just say the invoice doesn't exist yet.
			return false;
		}

	}
	public function get_pdf($schoolid){
		//pass variables to be filled-in on template PDF
	}
	public function get_payments($schoolid){
		$query = $this->db->query('SELECT acctid, SUM(`amount`) `amount` FROM transactions WHERE `acctid` = '.$schoolid.' GROUP BY acctid');
		if ($query->num_rows() > 0){
		$row = $query->row();
		return $row->amount;
		}else{
		return "No payments have been processed.";
		}
	}
	
	/*public function get_account_status($schoolid){
		$paid_amount = $this->get_payments($schoolid);
		$deposit = 
		$total_raw =
		
		
	}
	/*
	$deposit = $this->get_invoice($schoolid);
		   if($paid_amount > 0){
		    	if($paid_amount < $deposit){
		    	//deposit not fully paid
		    	$pay_now = $deposit - $paid_amount;
		    	$result .= '<td>$ '.number_format($pay_now).'<br /><span class="label label-warning">Due '.$this->get_deposit_deadline().'</span></td><td>$ '.$deposit.'<br /><span class="label label-success">Due '.$this->get_balance_deadline().'</span></td>';
		    	}elseif($paid_amount == $deposit){
			    //deposit paid
			    $pay_later = $total_raw - $paid_amount;
			    $result .= '<td>$ 0.00</td><td>$ '.number_format($pay_later).'<br /><span class="label label-success">Due '.$this->get_balance_deadline().'</span></td>';
			    }elseif($paid_amount > $deposit){
			     $pay_later = $total_raw - $paid_amount;
			    $result .= '<td>$ 0.00</td><td>$ '.number_format($pay_later).'<br /><span class="label label-success">Due '.$this->get_balance_deadline().'</span></td>';
		    	}elseif($paid_amount == $total_raw){
		    	$result .= '<td><h4><span class="label label-success">Paid <i class="fa fa-check"></i></span></h4></td>';
				
		   }
		   }else{
			   $deposit = $this->get_deposit_amount($row->id, 'raw');
			   $result .= '<td>$ '.number_format($deposit).'<br /><span class="label label-warning">Due '.$this->get_deposit_deadline().'</span></td>';
			   
		   }*/

}