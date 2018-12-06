<?php

namespace App\Http\Controllers\Api;

use App\Models\Banners;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BannerController extends BaseController
{
    protected $model;

    public function __construct(Banners $bannerModel)
    {
        $this->model = $bannerModel;
    }

    /**
     * 获取banner
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @author  maxiongfei <maxiongfei@vchangyi.com>
     * @date    2018/12/6 2:02 PM
     */
    public function index(Request $request)
    {
        $position = $request->get('position', 1);

        return $this->success($this->model->where([
            ['show_time', '>=', Carbon::now()],
            ['disable_time', '<=', Carbon::now()],
            ['position', '=', $position],
        ])->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if (empty($data)) {
            return $this->failed('参数为空');
        }
        $res = $this->model->create($data);

        return $this->success([$res]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
