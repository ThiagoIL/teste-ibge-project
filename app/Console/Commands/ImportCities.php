<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Models\City;

class ImportCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa as cidades do estado do RN';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cities = "https://servicodados.ibge.gov.br/api/v1/localidades/estados/rn/municipios";
        $json = json_decode(file_get_contents($cities));

        foreach ($json as $key=>$citie){
            if (City::where('id', $citie->id )->exists()) {
                $this->error('Cidades ja foram inseridas');
                return 'Cidades ja foram inseridas';
            }
            $dbcities = new City;

            $dbcities->id = $citie->id;
            $dbcities->name = $citie->nome;
            $dbcities->save();


        }

        $this->info("Cidades Importadas");
    }
}
