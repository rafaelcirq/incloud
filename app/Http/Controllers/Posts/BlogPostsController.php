<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Repositories\Posts\BlogPostRepository;
use App\Validators\Posts\BlogPostValidator;

/**
 * Class BlogPostsController.
 *
 * @package namespace App\Http\Controllers\Posts;
 */
class BlogPostsController extends Controller
{
    /**
     * @var BlogPostRepository
     */
    protected $repository;

    /**
     * @var BlogPostValidator
     */
    protected $validator;

    /**
     * BlogPostsController constructor.
     *
     * @param BlogPostRepository $repository
     * @param BlogPostValidator $validator
     */
    public function __construct(BlogPostRepository $repository, BlogPostValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $blogPosts = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $blogPosts,
            ]);
        }

        return view('blogPosts.index', compact('blogPosts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BlogPostCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BlogPostCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $blogPost = $this->repository->create($request->all());

            $response = [
                'message' => 'BlogPost created.',
                'data'    => $blogPost->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $blogPost = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $blogPost,
            ]);
        }

        return view('blogPosts.show', compact('blogPost'));
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
        $blogPost = $this->repository->find($id);

        return view('blogPosts.edit', compact('blogPost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogPostUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $blogPost = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'BlogPost updated.',
                'data'    => $blogPost->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'BlogPost deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'BlogPost deleted.');
    }
}
