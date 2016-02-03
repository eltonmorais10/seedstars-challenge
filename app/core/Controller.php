<?php

// Controller's super class
class Controller{
	
	// function to call a model and returns its object
	public function model ($model)
	{
		require_once '../app/models/' . $model . '.php';
		return new $model();
	}

	// function to associate a method to a view
	public function view($view, $data = [])
	{
		require_once '../app/views/' . $view . '.phtml';
	}
}