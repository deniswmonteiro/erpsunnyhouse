<?php

namespace Database\Seeders;

use App\Models\EquipmentGenerator;
use App\Models\EquipmentCable;
use App\Models\EquipmentConnector;
use App\Models\EquipmentOther;
use App\Models\EquipmentSolarInverter;
use App\Models\EquipmentStringBox;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Equipamentos dos contratos
        $equipments_cable = [
            'Cabo Solar Nexans Energyflex BR 0,6/1kV (1500 V DC) Preto',
            'Cabo Solar Nexans Energyflex BR 0,6/1kV (1500 V DC) Vermelho',
            'Cabo Solar Nexans Energyflex BR 0,6/1kV (1500 V DC) Azul',
            'Cabo Solar Nexans Energyflex BR 0,6/1kV (1500 V DC) Verde',
            'Cabo Solar Nexans Energyflex BR 0,6/1kV (1500 V DC) Amarelo',
            'Cabo Solar Nexans Energyflex BR 0,6/1kV (1500 V DC) Laranja',
        ];
        $equipments_connector = [
            'Par de Conectores Femea/Macho Staubh MC4',
        ];
        $equipments_string_box = [
            //module,producer
            ['Ecosolys', '1000v'],
        ];
        $equipments_solar_inverter = [
            //producer,mppt,power,voltage
            ['ABB', 2, 20, 220],
            ['ABB', 2, 60, 380],
            ['ABB', 4, 50, 220],
            ['ABB', 4, 100, 380],
            ['Fronius Eco', 2, 25, 220],
            ['Fronius SYMO', 2, 12, 220],
            ['Fronius SYMO Brasil', 2, 15, 380],
            ['WEG SIW600', 4, 25, 380],
            ['WEG SMA', 4, 30, 220],
            ['WEG SIW500H ST012', 4, 100, 380],
            ['WEG SUN 2000–60KTL-MO', 2, 60, 220],
            ['WEG SUN 2000–40KTL-MO', 4, 40, 380],
        ];
        $equipmentsGenerator = [
            //module,producer,technology,power
            ['RS6E-150P', 'Resun', 'Monocristalino', 450],
            ['RS6E-150P', 'Resun', 'Policristalino', 150],
            ['TSM-PE15H', 'Trina Solar', 'Monocristalino', 405],
            ['RS6E-150P', 'Trina Solar', 'Monocristalino', 150],
            ['ODA400-36-M', 'OSDA', 'Monocristalino', 400],
            ['SA10-36P', 'Sinosola', 'Policristalino', 10],
        ];

        foreach ($equipments_cable as $equipment) {
            EquipmentCable::create(['name' => $equipment]);
        }

        foreach ($equipments_connector as $equipment) {
            EquipmentConnector::create(['name' => $equipment]);
        }

        foreach ($equipments_string_box as $equipment) {
            EquipmentStringBox::create([
                'producer' => $equipment[0],
                'model' => $equipment[1],
            ]);
        }

        foreach ($equipments_solar_inverter as $equipment) {
            EquipmentSolarInverter::create([
                'producer' => $equipment[0],
                'mppt' => $equipment[1],
                'power' => $equipment[2],
                'voltage' => $equipment[3],
                'guarantee' => rand(5, 7)
            ]);
        }

        foreach ($equipmentsGenerator as $equipment) {
            EquipmentGenerator::create([
                'module' => $equipment[0],
                'producer' => $equipment[1],
                'technology' => $equipment[2],
                'power' => $equipment[3],
                'guarantee' => rand(5, 7)
            ]);
        }
    }
}
