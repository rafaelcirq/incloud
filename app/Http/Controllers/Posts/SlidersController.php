<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SliderCreateRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Repositories\Posts\SliderRepository;
use App\Validators\Posts\SliderValidator;

/**
 * Class SlidersController.
 *
 * @package namespace App\Http\Controllers\Posts;
 */
class SlidersController extends Controller
{
    /**
     * @var SliderRepository
     */
    protected $repository;

    /**
     * @var SliderValidator
     */
    protected $validator;

    /**
     * SlidersController constructor.
     *
     * @param SliderRepository $repository
     * @param SliderValidator $validator
     */
    public function __construct(SliderRepository $repository, SliderValidator $validator)
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
        $sliders = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $sliders,
            ]);
        }

        return view('sliders.index', compact('sliders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SliderCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SliderCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $slider = $this->repository->create($request->all());

            $response = [
                'message' => 'Slider created.',
                'data'    => $slider->toArray(),
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
        $slider = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $slider,
            ]);
        }

        return view('sliders.show', compact('slider'));
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
        $slider = $this->repository->find($id);

        return view('sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SliderUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SliderUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $slider = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Slider updated.',
                'data'    => $slider->toArray(),
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
                'message' => 'Slider deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Slider deleted.');
    }
}
