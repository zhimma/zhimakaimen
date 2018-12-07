<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success([
            [
                'id'      => '1',
                'title'   => '分布式作业系统 Elastic-Job-Lite 源码分析 —— 作业事件追踪',
                'content' => '本文主要分享 Elastic-Job-Lite 作业事件追踪。

另外，Elastic-Job-Cloud 作业事件追踪 和 Elastic-Job-Lite 基本类似，不单独开一篇文章，记录在该文章里。如果你对 Elastic-Job-Cloud 暂时不感兴趣，可以跳过相应部分。

Elastic-Job 提供了事件追踪功能，可通过事件订阅的方式处理调度过程的重要事件，用于查询、统计和监控。Elastic-Job 目前订阅两种事件，基于关系型数据库记录事件。

',
            ],
            [
                'id'      => 2,
                'title'   => 'Vue 项目构建与开发入门',
                'content' => '从构建到开发，帮助 Vue 开发者提升项目构建与开发能力，基于 Vue CLI 3',
            ],
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
        //
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
