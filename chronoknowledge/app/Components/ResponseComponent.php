<?php

namespace App\Components;

use App\Http\Interfaces\ResponseInterface;

class ResponseComponent implements ResponseInterface
{
    /**
     * Returns success message
     *
     * @param  string  $data
     * @param  string  $type
     * @return array<string,integer>
     */
    public function succeed($data, $type, $route = '')
    {
        return [
            'data' => $data,
            'type' => $type,
            'status' => 'success',
            'code' => 200,
            'route' => $route,
        ];
    }

    /**
     * Returns success message
     *
     * @param  string  $data
     * @param  string  $type
     * @return array<string,integer>
     */
    public function fail($data, $type, $route = '')
    {
        return [
            'data' => $data,
            'type' => $type,
            'status' => 'error',
            'code' => 500,
            'route' => $route,
        ];
    }

    /**
     * Formats response sent to the user ajax request
     *
     * @param  array<string>  $data
     * @return Illuminate\Http\Response
     */
    public function format($data)
    {
        return response()->json($data['status'], $data['code']);
    }

    /**
     * Formats response sent to the user view
     *
     * @param  array<string>  $data
     * @return Illuminate\Http\Response
     */
    public function formatView($data)
    {
        return redirect()
            ->route($data['route'])
            ->with($data['status'], trans('messages.'.$data['status'].'.'.$data['type'], ['data' => $data['data']]));
    }
}
