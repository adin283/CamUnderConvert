<?php

class CamUnderConvert
{
	function camel_to_underline($input)
	{
		preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
		$ret = $matches[0];
		foreach ($ret as &$match) {
			$match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
		}
		return implode('_', $ret);
	}

	function underline_to_camel($input)
	{
		$arr = explode("_", $input);
		$result = "";
		foreach ($arr as $value) {
			$upperFisrt = ucfirst($value);
			$result = $result . $upperFisrt;
		}
		return $result;
	}

	public function convert($query)
	{
		$isUnderLine = strpos($query, '_');

		if ($isUnderLine === false) {
			$output = $this->camel_to_underline($query);
			
			
		} else {
			$output = $this->underline_to_camel($query);
		}

		$json = [
			"items" => [
				[
					"uid" => "CamUnderConvert",
					"type" => "default",
					"title" => 'To: ' . $output,
					"subtitle" => 'From: ' . $query,
					"arg" => $output
				]
			]
		];

		echo json_encode($json);

	}
}


// $camUnderConvert = new CamUnderConvert();
// $camUnderConvert->convert('Test_Case');
// $camUnderConvert->convert('TestCase');
