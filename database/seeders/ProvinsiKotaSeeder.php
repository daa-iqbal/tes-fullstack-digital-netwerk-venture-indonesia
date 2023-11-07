<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use GuzzleHttp\Client;
use DB;
use Illuminate\Database\QueryException;
use App\Models\Provinsi;
use App\Models\Kota;

class ProvinsiKotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinsis')->truncate();
        $this->command->info('truncating provinsis...');
        DB::table('kotas')->truncate();
        $this->command->info('truncating kotas...');
        //
        try{

            $headers  = [
                'Content-Type' => 'application/json',
                'key'          => config('rajaongkir.key')
            ];
            $client = new Client([
                'headers' => $headers
            ]);
            $response = $client->request('GET', 'https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json');

            $data = $response->getBody()->getContents();
            $datasProvinsi = json_decode($data);
            $arrCreateProvinsi = [];
            $createProvinsi = NULL;
            $arrCreateKota = [];
            $createKota = NULL;
            $datasKota = [];
            DB::beginTransaction();
            try {

                foreach ($datasProvinsi as $key => $dataProvinsi) {
                    $arrCreateProvinsi = [
                        'name' => $dataProvinsi->name,
                        'created_by_id' => 0,
                    ];
                    $createProvinsi = Provinsi::create($arrCreateProvinsi);

                    $response = $client->request('GET', 'https://emsifa.github.io/api-wilayah-indonesia/api/regencies/'.$dataProvinsi->id.'.json');
                    $data = $response->getBody()->getContents();
                    $datasKota = json_decode($data);
                    foreach ($datasKota as $keyChild => $dataKota) {
                        $arrCreateKota = [
                            'name' => $dataKota->name,
                            'provinsi_id' => $createProvinsi->id,
                            'created_by_id' => 0,
                        ];
                        $createKota = Kota::create($arrCreateKota);
                    }

                }
                DB::commit();

            } catch (QueryException $qe) {
                DB::rollback();
                echo 'Message: ' .$qe->getMessage();
            }
        }catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }

    }
}
