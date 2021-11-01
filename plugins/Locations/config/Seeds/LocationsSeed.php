<?php
use Migrations\AbstractSeed;
use Cake\ORM\Behavior\TreeBehavior;
use Cake\ORM\TableRegistry;
use Cake\Http\Client;
use Cake\Http\Client\Response;
use Cake\ORM\Query;
use Cake\ORM\Table;
/**
 * Locations seed.
 */
class LocationsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
//        $data = [];
//
//        $table = $this->table('locations');
//        $table->insert($data)->save();
        
        $this->Locations = TableRegistry::get('Locations');
        $this->Locations->addBehavior('Tree');
        $data = [];
        // Get country
        $http               =   new Client();
        $countryResponse    =   $http->get('https://restcountries.eu/rest/v2/all');
        $countryData        =   $countryResponse->json;
        if(isset($countryData[0])){
            foreach($countryData as $country_record){ 
                $data = [
                    'parent_id' => null,
                    'title' => isset($country_record['name']) ? $country_record['name']:'',
                    'latitude' => isset($country_record['latlng'][0]) ?$country_record['latlng'][0]:0,
                    'longitude' => isset($country_record['latlng'][1]) ?$country_record['latlng'][1]:0,
                    'iso_alpha2_code' => isset($country_record['alpha2Code']) ?$country_record['alpha2Code']:'',
                    'iso_alpha3_code' => isset($country_record['alpha3Code']) ?$country_record['alpha3Code']:'',
                    'iso_numeric_code' => isset($country_record['numericCode']) ?$country_record['numericCode']:'',
                    'formatted_address' => isset($country_record['name']) ?$country_record['name']:'',
                    'status' => 1,
                    'meta_title' => $country_record['name'],
                    'meta_keyword' => $country_record['name'],
                    'meta_description' => $country_record['name'],
                    'created' => date('Y-m-d h:i:s',time()),
                    'modified' => date('Y-m-d h:i:s',time()),
                ];
                $location   =   $this->Locations->newEntity();
                $location   =   $this->Locations->patchEntity($location, $data);
                $this->Locations->save($location);
            }
        }
        $conditions = ['parent_id' => 0];
        $query = $this->Locations->find();
        $query->select(['Locations.id', 'Locations.title', 'iso_alpha2_code']);
        $country_locations = $query->where($conditions)->all()->toArray();
       
        if(!empty($country_locations)){
            foreach($country_locations as $country_data){                
                $country_code       =   $country_data->iso_alpha2_code;
                $region_data_url    =   'https://battuta.medunes.net/api/region/'.$country_code.'/all/?key=c33b2bc2a9550caa7c6b26976519a32c';
                $curl_handle=curl_init();
                curl_setopt($curl_handle, CURLOPT_URL,$region_data_url);
                curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
                curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
                $query = curl_exec($curl_handle);
                $regionData = json_decode($query,true);
                
                if(isset($regionData[0])){
                    foreach($regionData as $region_record){ 
                        $region_save_data = [
                            'parent_id' => $country_data->id,
                            'title' => isset($region_record['region']) ? $region_record['region']:'',
                            'latitude' => 0,
                            'longitude' => 0,
                            'iso_alpha2_code' => '',
                            'iso_alpha3_code' => '',
                            'iso_numeric_code' => '',
                            'formatted_address' => isset($region_record['region']) ?$region_record['region']:'',
                            'status' => 1,
                            'meta_title' => isset($region_record['region']) ?$region_record['region']:'',
                            'meta_keyword' => isset($region_record['region']) ?$region_record['region']:'',
                            'meta_description' => isset($region_record['region']) ?$region_record['region']:'',
                            'created' => date('Y-m-d h:i:s',time()),
                            'modified' => date('Y-m-d h:i:s',time()),
                        ];
                        $region_location   =   $this->Locations->newEntity();
                        $region_location   =   $this->Locations->patchEntity($region_location, $region_save_data);
                        $this->Locations->save($region_location);
                    }
                }
            }
        }
        
        
    }
}
