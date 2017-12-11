<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Response;
use App\Employee;

class EmployeesController extends Controller
{
	public function GetEmployees(Request $request) 
	{
		$data = Employee::all();
		return Response::json(['data' => $data]);
	}
}