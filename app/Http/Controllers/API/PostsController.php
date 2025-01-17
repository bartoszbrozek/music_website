<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Helper\ResponseHelper;
use App\Model\Posts;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $postQuery = Posts::query();

        $sorting = $request->get('sort');
        if (!empty($sorting)) {
            list($column, $direction) = explode("|", $sorting);

            $postQuery->orderByColumn($column, $direction);
        }

        $limit = $request->get('per_page');
        if (empty($limit)) {
            $limit = 10;
        }

        $filter = $request->get('filter');
        if (!empty($filter)) {
            $postQuery->search($filter);
        }

        return $postQuery->paginate($limit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Response $response)
    {
        $request->validate(
            [
                'title' => 'required|max:255',
                'content' => 'required|max:65550',
            ]
        );
        $post = new Posts();

        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->save();

        $responseHelper = new ResponseHelper($response);
        return $responseHelper->success()->setMsg("Post created succesfully")->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Response $response)
    {
        try {
            $post = Posts::find($id);

            if (empty($post)) {
                throw new Exception("Could not get post by id = {$id}");
            }

            return $post;
        } catch (Exception $ex) {
            $responseHelper = new ResponseHelper($response);
            return $responseHelper->error()->setMsg($ex->getMessage())->get();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Response $response)
    {
        $responseHelper = new ResponseHelper($response);

        try {
            $post = Posts::find($id);

            if (empty($post)) {
                throw new Exception("Could not update post by id = {$id}");
            }

            $post->title = $request['title'];
            $post->content = $request['content'];
            $post->save();
        } catch (Exception $ex) {
            return $responseHelper->error()->setMsg($ex->getMessage())->get();
        }

        return $responseHelper->success()->setMsg("Post updated succesfully")->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
