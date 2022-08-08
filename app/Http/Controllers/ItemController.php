<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Item;
use App\Serializers\ItemSerializer;
use App\Serializers\ItemsSerializer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\CommonMarkConverter;

class ItemController extends BaseController
{
    private array $validationItems = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'url' => 'required|url',
        'description' => 'required|string',
    ];

    public function index(): JsonResponse
    {
        $items = Item::all();
        return new JsonResponse(['items' => (new ItemsSerializer($items))->getData()]);
    }

    /**
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(),$this->validationItems);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $converter = new CommonMarkConverter(['html_input' => 'escape', 'allow_unsafe_links' => false]);

        $item = Item::create([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'url' => $request->get('url'),
            'description' => $converter->convert($request->get('description'))->getContent(),
        ]);

        $serializer = new ItemSerializer($item);

        return new JsonResponse(['item' => $serializer->getData()]);
    }

    public function show($id): JsonResponse
    {
        $item = Item::findOrFail($id);

        $serializer = new ItemSerializer($item);

        return new JsonResponse(['item' => $serializer->getData()]);
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $validator = Validator::make($request->all(),$this->validationItems);

        if ($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $converter = new CommonMarkConverter(['html_input' => 'escape', 'allow_unsafe_links' => false]);

        $item = Item::findOrFail($id);
        $item->name = $request->get('name');
        $item->url = $request->get('url');
        $item->price = $request->get('price');
        $item->description = $converter->convert($request->get('description'))->getContent();
        $item->save();

        return new JsonResponse(
            [
                'item' => (new ItemSerializer($item))->getData()
            ]
        );
    }
}
