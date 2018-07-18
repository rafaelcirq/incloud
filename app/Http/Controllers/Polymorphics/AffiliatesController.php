<?php

namespace App\Http\Controllers\Polymorphics;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AffiliateCreateRequest;
use App\Http\Requests\AffiliateUpdateRequest;
use App\Repositories\Polymorphics\AffiliateRepository;
use App\Validators\Polymorphics\AffiliateValidator;

/**
 * Class AffiliatesController.
 *
 * @package namespace App\Http\Controllers\Polymorphics;
 */
class AffiliatesController extends Controller
{
    /**
     * @var AffiliateRepository
     */
    protected $repository;

    /**
     * @var AffiliateValidator
     */
    protected $validator;

    /**
     * AffiliatesController constructor.
     *
     * @param AffiliateRepository $repository
     * @param AffiliateValidator $validator
     */
    public function __construct(AffiliateRepository $repository, AffiliateValidator $validator)
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
        $affiliates = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $affiliates,
            ]);
        }

        return view('affiliates.index', compact('affiliates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AffiliateCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AffiliateCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $affiliate = $this->repository->create($request->all());

            $response = [
                'message' => 'Affiliate created.',
                'data'    => $affiliate->toArray(),
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
        $affiliate = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $affiliate,
            ]);
        }

        return view('affiliates.show', compact('affiliate'));
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
        $affiliate = $this->repository->find($id);

        return view('affiliates.edit', compact('affiliate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AffiliateUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(AffiliateUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $affiliate = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Affiliate updated.',
                'data'    => $affiliate->toArray(),
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
                'message' => 'Affiliate deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Affiliate deleted.');
    }
}
