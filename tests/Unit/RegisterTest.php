<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \Validator;

class RegisterTest extends TestCase
{
    /** @test */
    public function registerSuccessTest()
    {
    	$rules = [
            'mobile_number' => 'required|max:20|regex:/(^([+62])(\d{13})?$)/u',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'date_of_birth' => 'date_format:"Y/m/d"',
            'gender' => 'max:10',
            'email' => 'required|max:50'];

    	$attributes = array(
    		"mobile_number" => "+6281809567089",
    		"first_name" => "I Putu",
    		"last_name" => "Saputra",
    		"date_of_birth" => "1953/06/05",
    		"gender" => "Male",
			"email" => "pt@gmail.com"
    	);

		$validator = Validator::make($attributes, $rules);
		$success = $validator->passes();
		$this->assertEquals(true, $success);
    }

    /** @test */
    public function registerFailedTest()
    {
    	$rules = [
            'mobile_number' => 'required|max:20|regex:/(^([+62])(\d{13})?$)/u',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'date_of_birth' => 'date_format:"Y/m/d"',
            'gender' => 'max:10',
            'email' => 'required|max:50'];

    	$attributes = array(
    		"mobile_number" => "+62818095670898",
    		"first_name" => "I Putu",
    		"last_name" => "Saputra",
    		"date_of_birth" => "06/06/2000",
    		"gender" => "Male",
			"email" => "pt"
    	);

		$validator = Validator::make($attributes, $rules);
		$fail = $validator->passes();
		$this->assertEquals(false, $fail);
    }

   
    
}
