<?php

namespace App\Http\Controllers\Entities\Polymorphics;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ProfileCreateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Repositories\Entities\Polymorphics\ProfileRepository;
use App\Validators\Entities\Polymorphics\ProfileValidator;

/**
 * Class ProfilesController.
 *
 * @package namespace App\Http\Controllers\Entities\Polymorphics;
 */
class ProfilesController extends Controller
{
    /**
     * @var ProfileRepository
     */
    protected $repository;

    /**
     * @var ProfileValidator
     */
    protected $validator;

    /**
     * ProfilesController constructor.
     *
     * @param ProfileRepository $repository
     * @param ProfileValidator $validator
     */
    public function __construct(ProfileRepository $repository, ProfileValidator $validator)
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
        $profiles = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $profiles,
            ]);
        }

        return view('profiles.index', compact('profiles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProfileCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ProfileCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $profile = $this->repository->create($request->all());

            $response = [
                'message' => 'Profile created.',
                'data'    => $profile->toArray(),
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
        $profile = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $profile,
            ]);
        }

        return view('profiles.show', compact('profile'));
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
        $profile = $this->repository->find($id);

        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProfileUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $profile = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Profile updated.',
                'data'    => $profile->toArray(),
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
                'message' => 'Profile deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Profile deleted.');
    }
}
