<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Infocan;
use App\Informacao;
use App\Macro;
use App\Registro;
use Illuminate\Http\Request;
use App\Carro;
use Carbon\Carbon;

class DataProcessController extends Controller
{
    //
    public function process(Request $request)
    {
        foreach ($request->positions as $data){

            $carro = Carro::where('placa', $data['placa'])->first();
            try{
                \DB::beginTransaction();
                if(!$carro) {

                    $carro = new Carro();
                    $carro->placa = $data['placa'];
                    $carro->numero_serial = $data['serialNumber'];
                    $carro->id_interno = $data['id'];

                    if(!$carro->save()){
                        throw new \Exception('Erro ao gravar os dados na tabela Carros.');
                    }
                }

                $this->gravarEvento($carro->id, $data);
                $this->gravarInfocan($carro->id, $data['can']);
                $this->gravarInformacao($carro->id, $data['info']);
                $this->gravarMacro($carro->id, $data);
                $this->gravarRegistro($carro->id, $data);

            }catch (\Exception $e){
                \DB::rollback();
                return response()->json(
                    [
                        'code' => 500 ,
                        'msg' => "Erro na gravação dos dados.",
                        'erroMsg' => $e->getMessage(),
                        'erroCode' => $e->getCode(),
                    ]
                );
            }finally{
                \DB::commit();
            }
        }//foreach

        return response()->json(
            [
                'code' => 200,
                'msg' => "Gravada com sucesso!"
            ]
        );
    }//process

    private function gravarEvento($carro_id, $data)
    {
        foreach ($data['eventos'] as $d){

            $evento = new Evento();
            $evento->carro_id = $carro_id;
            $evento->descricao = $d['desc'];
            $evento->src = $d['src'];

            if(!$evento->save()){
                throw new \Exception('Erro ao gravar os dados na tabela Eventos. ID carro -> {$carro_id}');
            }
        }
    }//gravarEvento

    private function gravarInfocan($carro_id, $data)
    {
        $infocan = new Infocan();
        $infocan->carro_id = $carro_id;
        $infocan->combustivel = $data['comb'];
        $infocan->cinto = $data['cinto'];
        $infocan->freio = $data['freio'];
        $infocan->limp = $data['limp'];

        if(!$infocan->save()){
            throw new \Exception('Erro ao gravar os dados na tabela Infocan. ID carro -> {$carro_id}');
        }

    }//gravarInfocan

    private function gravarInformacao($carro_id, $data)
    {
        $informacao = new Informacao();
        $informacao->carro_id = $carro_id;
        $informacao->odo = $data['odo'];
        $informacao->odo_total = $data['odoTotal'];
        $informacao->rpm = $data['rpm'];
        $informacao->velocidade = $data['vel'];
        $informacao->log = $data['log'];
        $informacao->ign = $data['ign'];
        $informacao->gps = $data['gps'];

        if(!$informacao->save()){
            throw new \Exception('Erro ao gravar os dados na tabela Informacoes. ID carro -> {$carro_id}');
        }
    }//gravarInformacao

    private function gravarMacro($carro_id, $data)
    {
        foreach ($data['macros'] as $d){

            $macro = new Macro();
            $macro->carro_id = $carro_id;
            $macro->descricao = $d['desc'];
            $macro->apr_proc = $d['aprProc'];

            if(!$macro->save()){
                throw new \Exception('Erro ao gravar os dados na tabela Macros. ID carro -> {$carro_id}');
            }
        }
    }//gravarMacro

    private function gravarRegistro($carro_id, $data)
    {
        $registro = new Registro();
        $registro->carro_id = $carro_id;
        $registro->motorista = $data['motorista'];
        $registro->endereco = $data['end'];
        $registro->data_inc = Carbon::parse($data['dInc'])->format('Y-m-d h:m:s');
        $registro->data_pos = Carbon::parse($data['dPos'])->format('Y-m-d h:m:s');
        $registro->latitude = $data['coord'][0];
        $registro->longitude = $data['coord'][1];

        if(!$registro->save()){
            throw new \Exception('Erro ao gravar os dados na tabela Registros. ID carro -> {$carro_id}');
        }
    }//gravarRegistro
}

