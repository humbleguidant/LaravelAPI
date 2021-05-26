<?php

/**
 * Author: Aubrey Nickerson
 * Date: May 25th, 2021
 * Program: Person.php
 * Project: Global Protection Code Challenge
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Person
 * Create a model from the database
 * table called people.
 *
 */

class Person extends Model
{
    use HasFactory;
    // Create a blueprint from the 'people' table
    protected $table = 'people';
    // No timestamps for newly created person
    public $timestamps = false;
    // Use fields based off of the random fake person API.
    // Last field will grab a random robot avatar for the
    // new person
    protected $fillable = [ 'age',
                            'blood',
                            'born',
                            'born_place',
                            'cellphone',
                            'city',
                            'country',
                            'eye_color',
                            'father_name',
                            'gender',
                            'height',
                            'last_name',
                            'name',
                            'national_code',
                            'religion',
                            'system_id',
                            'weight',
                            'avatar'];
}
