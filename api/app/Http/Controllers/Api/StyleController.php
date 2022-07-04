<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Style;
use App\Actions\StyleActions;
use App\Http\Middleware\CORS;
use App\Http\Requests\StyleRequest;
use App\Http\Resources\Style\StyleResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class StyleController extends Controller
{

    public function __construct()
    {
        $this->middleware(CORS::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StyleRequest  $request
     * @return App\Http\Resources\Style\StyleResource
     */
    public function store(StyleRequest $request)
    {
        $data = $request->validated();
        $data['photo'] = StyleActions::save($data);
        $style = Style::create($data);

        Log::info("Added a new style with id: " . $style['id']);

        return new StyleResource($style);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Style $style)
    {
        Log::info("Style has been sent with id: " . $style['id']);

        return new StyleResource($style);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StyleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StyleRequest $request, Style $style)
    {
        $data = $request->validated();
        $data['photo'] = StyleActions::update($data, $style);
        $style->update($data);

        Log::info("Updated style with id: " . $style['id']);

        return new StyleResource($style);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Style $style)
    {
        StyleActions::delete($style);
        $style->delete();

        Log::info("Removed style with id: " . $style['id']);

        return response()->json([
            "message" => "Style deleted",
            "status" => Response::HTTP_NO_CONTENT
        ]);
    }
}
