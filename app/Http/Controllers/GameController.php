<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameResource;
use App\Http\Resources\PartnerResource;
use App\Http\Resources\ProivderReseource;
use App\Http\Resources\ProviderResource;
use App\Models\Game;
use App\Models\Partner;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class GameController extends Controller
{
    public function index(){
        $partners = PartnerResource::collection(Partner::select('provider_id as id','provider_name as name')->orderBy('provider_name','asc')->get());
        return inertia('Games/Index', compact('partners'));
    }

    public function store(){
        $games = GameResource::collection(Game::all());
        $partners = PartnerResource::collection(Partner::select('provider_id as id','provider_name as name')->orderBy('provider_name','asc')->get());
        return inertia('Games/Add', compact('partners'));
    }

    public function provider(Request $request){
        $providers = ProviderResource::collection(Provider::select('sub_provider_id as id','sub_provider_name as name')->where('provider_id',$request->id)->get());
        return $providers;
    }

    public function gameList(){
      
        $provider = request('provider');
        $partner = request('partner');
        $page = request('page');
        if($provider == '' || $provider == ''){
            $data = Game::where('provider_id',$partner)->orderBy(DB::raw('trim(game_name)'),'asc')->paginate(10);
        }
        if($provider != '' || $provider != ''){
            $data = Game::where('provider_id',$partner)->where('sub_provider_id',$provider)->orderBy(DB::raw('trim(game_name)'),'asc')->paginate(10);
        }
        $games = $data;
        return $games;
    }
}