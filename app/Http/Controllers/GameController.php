<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameResource;
use App\Http\Resources\GameTypeResource;
use App\Http\Resources\PartnerResource;
use App\Http\Resources\ProviderResource;
use App\Models\Game;
use App\Models\GameType;
use App\Models\Partner;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function index(){
        $partners = PartnerResource::collection(Partner::select('provider_id as id','provider_name as name')->orderBy('provider_name','asc')->get());
        return inertia('Games/Index', compact('partners'));
    }

    public function store(){
        $partners = PartnerResource::collection(Partner::select('provider_id as id','provider_name as name')->orderBy('provider_name','asc')->get());
        return inertia('Games/Add', compact('partners'));
    }

    public function update(Request $request){
        Game::where('game_id',$request->game_id)->update([
            'game_type_id' => $request->game_type_id,
            'provider_id' => $request->provider_id,
            'sub_provider_id' => $request->sub_provider_id,
            'game_name' => $request->game_name,
            'game_code' => $request->game_code,
            'secondary_game_code' => $request->secondary_game_code,
            'min_bet' => $request->min_bet,
            'max_bet' => $request->max_bet,
            'pay_lines' => $request->pay_lines,
            'info' => $request->info,
            'remarks' => $request->remarks,
            'on_maintenance' => $request->on_maintenance
        ]);   
    }

    public function status(Request $request){
        $games = GameResource::collection(Game::where('game_id',$request->id)->update(['on_maintenance'=>$request->value]));
        return $games;
    }

    public function provider(Request $request){
        $providers = ProviderResource::collection(Provider::select('sub_provider_id as id','sub_provider_name as name')->where('provider_id',$request->id)->get());
        return $providers;
    }

    public function game(){
        $game = GameResource::collection(Game::where('game_id',request('id'))->get());
        return $game[0];
    }

    public function gameList(){
      
        $provider = request('provider');
        $partner = request('partner');
        $per_page = request('per_page');
        $search = request('search');
       
        $data = Game::where('provider_id',$partner)
        ->when(request('provider') != '',function($q)use($provider){
            return $q->where("sub_provider_id",$provider);
        })
        ->when(request('search') != '',function($q)use($search){
            return $q->where("game_name","LIKE","%".$search."%");
        })->orderBy(DB::raw('trim(game_name)'),'asc')->paginate($per_page);
       
        $games = GameResource::collection($data);
        return $games;
    }

    public function gameType(){
        $gameType = GameType::select('game_type_id as id','game_type_name as name')->get();
        return GameTypeResource::collection($gameType);
    }
}
