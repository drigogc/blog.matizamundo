<?php

class MainModel {
	
	// Form data
	public $form_data;

	// Feedback messages
	public $form_message; // $form_msg;

	// Confirmation message to delete form data
	public $form_confirm; // $form_confirma;

	// Pdo connection object
	public $db;

	// Controller that generated this model
	public $controller;

	// URL parameters
	public $parameters;

	// User data	
	public $userdata;

	// Gets the date and inverts its value
	// Example: d-m-Y H:i:s para Y-m-d H:i:s or the opposite
	public function inverts_date( $date_saved = null ) {
	
		// Configura uma variável para receber a nova data
		$new_date = null; // $new_date
		
		// If the date is sent
		if($date_saved) {
		
			// Explode date por -, /, : or space
			$date_saved = preg_split('/\-|\/|\s|:/', $date_saved);
			
			// Remove spaces from values
			$date_saved = array_map('trim', $date_saved);
			
			// Creates reverse date
			$new_date .= chk_array($date_saved, 2) . '-';
			$new_date .= chk_array($date_saved, 1 ) . '-';
			$new_date .= chk_array($date_saved, 0);
			
			// Sets the hour
			if (chk_array($date_saved, 3)) {
				$new_date .= ' ' . chk_array($date_saved, 3);
			}
			
			// Sets the minutes
			if (chk_array($date_saved, 4)) {
				$new_date .= ':' . chk_array($date_saved, 4);
			}
			
			// Sets the seconds
			if (chk_array( $date_saved, 5)) {
				$new_date .= ':' . chk_array($date_saved, 5);
			}
			
		}

		return $new_date;
	
	} // End of function inverts_date

} // MainModel