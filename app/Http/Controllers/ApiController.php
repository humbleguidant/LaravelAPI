<?php
/**
 * Author: Aubrey Nickerson
 * Date: May 25th, 2021
 * Program: ApiController.php
 * Project: Global Protection Code Challenge
*/

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use App\Models\Person;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

/**
 * This controller handles the
 * incoming requests from the client
 */
class ApiController extends Controller
{
    /**
     * @throws GuzzleException
     * Call the random person API and
     * return the data in JSON.
     */
    public function callApi(){
        $client = new Client();
        $url = "https://pipl.ir/v1/getPerson";
        $response = $client->request('GET', $url, [
           'verify' => false,
        ]);
        return json_decode($response->getBody());
    }

    /**
     * Call the robot avatar API to get a random image
     * for the person. Store the image in the public
     * folder.
     */
    public function storeImage($randomNumber){
        $url = 'https://robohash.org/'.$randomNumber.'.jpg';
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        Storage::disk('public')->put($name, $contents);
    }

    /**
     * @throws GuzzleException
     *
     * Create a new random person in the database.
     * Use the callApi() to get a random persons
     * personal data from the API and insert a new
     * row in the MySQL database. Call the storeImage()
     * function to store the avatar in the public folder.
     * When the new record is created then return a JSON
     * message that says 'New person successfully added.
     * The person ID is ' along with the newly generated
     * ID.
     */
    public function createPerson(): JsonResponse
    {
        $randomNumber = mt_rand();
        $personData = $this->callApi();
        $newPerson = Person::create(['age' => $personData->{'person'}->{'personal'}->{'age'},
                                     'blood' => $personData->{'person'}->{'personal'}->{'blood'},
                                     'born' => $personData->{'person'}->{'personal'}->{'born'},
                                     'born_place' => $personData->{'person'}->{'personal'}->{'born_place'},
                                     'cellphone' => $personData->{'person'}->{'personal'}->{'cellphone'},
                                     'city' => $personData->{'person'}->{'personal'}->{'city'},
                                     'country' => $personData->{'person'}->{'personal'}->{'country'},
                                     'eye_color' => $personData->{'person'}->{'personal'}->{'eye_color'},
                                     'father_name' => $personData->{'person'}->{'personal'}->{'father_name'},
                                     'gender' => $personData->{'person'}->{'personal'}->{'gender'},
                                     'height' => $personData->{'person'}->{'personal'}->{'height'},
                                     'last_name' => $personData->{'person'}->{'personal'}->{'last_name'},
                                     'name' => $personData->{'person'}->{'personal'}->{'name'},
                                     'national_code' => $personData->{'person'}->{'personal'}->{'national_code'},
                                     'religion' => $personData->{'person'}->{'personal'}->{'religion'},
                                     'system_id' => $personData->{'person'}->{'personal'}->{'system_id'},
                                     'weight' => $personData->{'person'}->{'personal'}->{'weight'},
                                     'avatar' => asset('storage/'.$randomNumber.'.jpg')
                                    ]);
        $this->storeImage($randomNumber);
        return response()->json([
            "message" => 'New person successfully added. The person ID is '.$newPerson->id
        ], 201);
    }

    /**
     * Get a persons record from the database
     * based off of their ID. If the id does not
     * exist then return a message in JSON that says
     * 'Person does not exist.'
     */
    public function getPerson($id){
        if(Person::where('id', $id)->exists()){
            $person = Person::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
            return response($person);
        } else {
            return response()->json([
                "message" => "Person does not exist."
            ], 404);
        }
    }

    /**
     * Get the first ten newly created people
     * from the database.
     */
    public function getFirstTenPeople(){
        $firstTenPeople = Person::orderBy('id', 'desc')->take(10)->get()->toJson(JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
        return response($firstTenPeople);
    }

    /**
     * Get the statistics of all people including
     * the list of all countries, the total number
     * of people, total for each different gender,
     * average age.
     */
    public function getStatistics(){
        $statistics = Person::selectRaw("DISTINCT country,
                                         COUNT(id) as Total_People,
                                         COUNT(case when gender='Male' then 1 end) as Total_Males,
                                         COUNT(case when gender='Female' then 1 end) as Total_Females,
                                         AVG(age) as Average_Age")
                                         ->groupBy('country')
                                         ->orderBy('country')
                                         ->get()
                                         ->toJson(JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
        return response($statistics);
    }
}
