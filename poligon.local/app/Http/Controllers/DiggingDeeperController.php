<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateCatalog\GenerateCatalogMainJob;
use App\Jobs\ProcessVideoJob;
use App\Models\BlogPost;
use Carbon\Carbon;

class DiggingDeeperController extends Controller
{
    public function collections()
    {
        $result = [];
        /**
         * @var \Illuminate\Database\Eloquent\Collection $eloquentCollection
         */
        $eloquentCollection = BlogPost::withTrashed()->get();
//        dd(__METHOD__, $eloquentCollection, $eloquentCollection->toArray());
        /**
         * @var \Illuminate\Support\Collection $collection
         */
        $collection = collect($eloquentCollection->toArray());
//        dd(
//            get_class($eloquentCollection),
//            get_class($collection),
//            $collection
//        );

//        $result['first'] = $collection->first();
//        $result['last'] = $collection->last();

//        $result['where']['data'] = $collection
//            ->where('category_id', 10)
//            ->values()
//            ->keyBy('id');
//
//        $result['where']['count'] = $result['where']['data']->count();
//        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
//        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();

//        $result['where_first'] = $collection
//            ->firstWhere('created_at', '>', '2022-06-03 01:35:11');

//        //Базовая переменная не изменится. Просто вернутся измененная версия.
//        $result['map']['all'] = $collection->map(function (array $item) {
//            $newItem = new \stdClass();
//            $newItem->item_id = $item['id'];
//            $newItem->item_title = $item['title'];
//            $newItem->exists = is_null($item['deleted_at']);
//
//            return $newItem;
//        });
//
//        $result['map']['not_exists'] = $result['map']['all']->where('exists',
//            '=', false)
//            ->values()
//            ->keyBy('item_id');
//
//        // Базовая переменная изменится (трансформируется).
//        $collection->transform(function (array $item) {
//            $newItem = new \stdClass();
//            $newItem->item_id = $item['id'];
//            $newItem->item_name = $item['title'];
//            $newItem->exists = is_null($item['deleted_at']);
//            $newItem->created_at = Carbon::parse($item['created_at']);
//
//            return $newItem;
//        });
//
//        $newItem = new \stdClass();
//        $newItem->id = 9999;
//
//        $newItem2 = new \stdClass();
//        $newItem2->id = 8888;
//
////        dd($newItem, $newItem2);
//
//        //Установить элемент в начало коллекции
//        $newItemFirst = $collection->prepend($newItem)->first();
//        $newItemLast = $collection->push($newItem2)->last();
////        $pulledItem = $collection->pull(1);
//
//        dd(compact('collection', 'newItemFirst', 'newItemLast'));

        //фильтрация. Замена orWhere()

//        $filtered = $collection->filter(function ($item){
//            $byDay = $item->created_at->isFriday();
//            $byDate = $item->created_at->day == 3;
//            $result = $byDay && $byDate;
//
//            return $result;
//        });

//        dd(compact('filtered'));

//        $sortedSimpleCollection = collect([5, 3, 1, 2, 4])->sort()->values();
//        $sortedAsCollection = $collection->sortBy('created_at')->keyBy('item_id');
//        $sortedDescCollection = $collection->sortByDesc('item_id')->keyBy('item_id');
//
//        dd(compact('sortedSimpleCollection', 'sortedAsCollection',
//            'sortedDescCollection'));
    }

    public function processVideo(){
        ProcessVideoJob::dispatch()
            //Отсрочка выполнения задания от момента помещения в очередь.
            //Не влияет на паузу между попытками выполнять задачу.
//            ->delay(10)
//            ->onQueue('name_of_queue')
            ;
    }

    public function prepareCatalog(){
        GenerateCatalogMainJob::dispatch();
    }
}
