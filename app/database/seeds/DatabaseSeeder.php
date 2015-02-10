<?php

use Powerhouse\Core\Configuration;
use Powerhouse\Core\Company;
use Powerhouse\Core\Usergroup;
use Powerhouse\Core\Project;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('ConfigurationSeeder');
		$this->call('CompanySeeder');
		$this->call('UsergroupSeeder');
		$this->call('UserSeeder');
        $this->call('ProjectSeeder');
	}

}

class ConfigurationSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('config')->delete();
        Configuration::create(array(
        	'key'=>'num_list_items',
        	'value'=>5
        	));
	}

}

class UsergroupSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('usergroup')->delete();
        Usergroup::create(array(
        	'name'=>'Administrator'
        	));

       	Usergroup::create(array(
        	'name'=>'Manager'
        	));

       	Usergroup::create(array(
        	'name'=>'Registered'
        	));
	}

}

class CompanySeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('company')->delete();

        Company::create(array(
            'name'=>'Powerhouse' ,
            'phone'=>'01685 785790',
            'email' => 'info@powerhouse.co.uk',
            'parent_id' => null
        ));

        Company::create(array(
        	'name'=>'Yorkshire LL' ,
        	'phone'=>'01923 299064',
        	'email' => 'info@yll.co.uk',
            'parent_id' => null
        ));

        Company::create(array(
            'name'=>'Northwest Housing Associates' ,
            'phone'=>'01260 299064',
            'email' => 'info@nwha.co.uk',
            'parent_id' => null
        ));
	}

}

class UserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();
        User::create(array(
        	'firstname'=>'Adrian',
        	'lastname'=>'Toomer',
        	'email' => 'adrian@toomer.com',
        	'company_id'=> Company::where('name', '=', 'Powerhouse')->first()->id,
        	'usergroup_id'=> Usergroup::where('name', '=', 'Administrator')->first()->id,
        	'password'=>Hash::make('testing')
        	));

        User::create(array(
            'firstname'=>'Joe',
            'lastname'=>'Bloggs',
            'email' => 'joe@bloggs.com',
            'company_id'=> Company::where('name', '=', 'Yorkshire LL')->first()->id,
            'usergroup_id'=> Usergroup::where('name', '=', 'Registered')->first()->id,
            'password'=>Hash::make('testing')
            ));

        User::create(array(
            'firstname'=>'Phil',
            'lastname'=>'Bloggs',
            'email' => 'phil@bloggs.com',
            'company_id'=> Company::where('name', '=', 'Northwest Housing Associates')->first()->id,
            'usergroup_id'=> Usergroup::where('name', '=', 'Registered')->first()->id,
            'password'=>Hash::make('testing')
            ));


	}

}

class ProjectSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project')->delete();

        Project::create(array(
            'name'=>'Housing Leeds' ,
            'company_id'=>Company::where('name', '=', 'Yorkshire LL')->first()->id
        ));

        Project::create(array(
            'name'=>'Manchester housing' ,
            'company_id'=>Company::where('name', '=', 'Northwest Housing Associates')->first()->id
        ));

        Project::create(array(
            'name'=>'Liverpool properties' ,
            'company_id'=>Company::where('name', '=', 'Northwest Housing Associates')->first()->id
        ));
    }

}