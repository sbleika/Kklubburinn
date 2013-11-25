<?php

// Klasi sem heldur utan um hvaða field og hvaða villa kom upp
class ValidationError
{
	public $field;
	public $error;
}

// til hægðarauka, býr til nýjann villuhlut og skilar
function MakeError($field, $error)
{
	$o = new ValidationError();
	$o->field = $field;
	$o->error = $error;

	return $o;
}

/**
 * Klasi sem skilgreinir viðburð
 */
class Event
{
	public $nafn;
	public $star;
	public $end;
	public $uppskr;
	public $location;

	private $errors;

	// setjum villurnar okkar sem tómafylkið
	function __construct()
	{
		$this->errors = array();
	}

	// fyllir út í breytur hlutar með gildum úr associative array 
	public function populate($data)
	{
		$this->nafn 		= $this->get($data, 'nafn');
		$this->tegund 		= $this->get($data, 'tegund'));
		$this->uppskr 	= $this->get($data, 'uppskr');
	}

	// athugar nokkrar reglur um gögnin og bætir við í errors fylkið hverri villu. Skilar true ef engar villur, false annars
	public function valid()
	{
		if ($this->nafn === '')
		{
			$this->errors[] = MakeError('nafn', 'Skrá verður inn nafn');
		}

		if (strlen($this->nafn) > 100)
		{
			$this->errors[] = MakeError('nafn', 'Nafnið má ekki vera lengri en 100 stafir');
		}

		if ($this->tegund === '')
		{
			$this->errors[] = MakeError('Tegund', 'Skrá verður inn tegund');
		}

		if (strlen($this->nafn) > 100)
		{
			$this->errors[] = MakeError('nafn', 'Tegundin má ekki vera lengri en 100 stafir');
		}

		if ($this->uppskr === '')
		{
			$this->errors[] = MakeError('uppskr', 'Skrá verður inn uppskrift');
		}

		if (strlen($this->uppskr) > 2000)
		{
			$this->errors[] = MakeError('uppskr', 'uppskriftin má ekki vera lengri en 2000 stafir');
		}


		// ef engin villa hefur komið upp er fylkið okkar tómt
		return sizeof($this->errors) == 0;
	}

	// skilar gögnum úr hlut á því formi sem prepared statement býst við
	public function insert()
	{
		return array(	':nafn' 		=> $this->nafn,
						':tegund' 		=> $this->tegund,
						':uppskr'	=> $this->uppskr,
						':location' 		=> $this->location
			);
	}

	// skilar private breytunni errors
	public function errors()
	{
		return $this->errors;
	}

	// til hægðarauka - sækir gildi úr fylki ef það er skilgreint, annars skilar það tómastrengnum
	private function get($array, $key)
	{
		if (isset($array[$key]))
		{
			return $array[$key];
		}

		return '';
	}
}