<?php

namespace App\Services;

use App\Contracts\ListProductInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ListProductService implements ListProductInterface
{
    public function listProduct($data)
    {
        $list = Product::paginate(
            $perPage = $data->get('page',10), 
            $columns = ['*'], 
            $pageName = 'product',
            $current_page = $data->get('current_page') ?? 1);

        return $list;
    }

    public function headerApi()
    {
        $response = Http::get('https://challenges.coode.sh/food/data/json/index.txt');

        return $response->headers();
    }

    public function fileLogSchedule()
    {
        $contents = Storage::get('public/logs/schedule.log');

        $collection = Str::of($contents)->explode('\n');
        $arrayData = explode('\n',$collection);

        $penultimate = $arrayData[count($arrayData)-2];
        $antepenultimate = $arrayData[count($arrayData)-3];

        return $data = [$penultimate,$antepenultimate];
    }

    public function timeOnline(){
        $dataLog = $this->fileLogSchedule();

        $getEndTime = strstr($dataLog[0],' local',true);
        $getEndTimeSecond = strtotime(substr($getEndTime, 1, -1));

        $getStartTime = strstr($dataLog[1],' local',true);
        $getStartTimeSecond = strtotime(substr($getStartTime, 1, -1));

        if (strstr($dataLog[1],' Uso')) {
            return 'ainda está online';
        }

        return gmdate('H:i:s',$getEndTimeSecond-$getStartTimeSecond);
    }

    public function infoCron()
    {
        $dataLog = $this->fileLogSchedule();
        $data = [strstr($dataLog[0],'Uso'),strstr($dataLog[1],'Ultimo')];
        
        return $data;
    }

    public function infoApi()
    {
        $dataLogSchedule = $this->infoCron();

        $data = [
            'Detalhes da API' => $this->headerApi(),
            'state' => [ 1 => $dataLogSchedule[0], 2 => $dataLogSchedule[1] ],
            'Time Online' => $this->timeOnline()
        ];

        return $data;
    }
}