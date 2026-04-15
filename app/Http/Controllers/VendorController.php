<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use App\Models\Vendor;
use App\Repositories\VendorRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class VendorController extends AppBaseController
{
    /**
     * @var VendorRepository
     */
    private $vendorRepository;

    public function __construct(VendorRepository $vendorRepo)
    {
        $this->vendorRepository = $vendorRepo;
    }

    /**
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index(Request $request): \Illuminate\View\View
    {
        return view('vendors.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): \Illuminate\View\View
    {
        $data = $this->vendorRepository->getData();
        $countries = $data['countries'];
        $vatNoLabel = getVatNoLabel();

        return view('vendors.create', compact('countries','vatNoLabel'));
    }

    public function store(CreateVendorRequest $request): RedirectResponse
    {
        $input = $request->all();
        try {
            $this->vendorRepository->store($input);
            Flash::success(__('messages.flash.vendor_created_successfully'));
        } catch (Exception $exception) {
            Flash::error($exception->getMessage());

            return redirect()->route('vendors.create')->withInput();
        }

        return redirect()->route('vendors.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function show(Vendor $vendor, Request $request): \Illuminate\View\View
    {
        $vendor->load('user.media');
        $activeTab = $request->get('Active', 'overview');
        $data = $this->vendorRepository->getData();
        $vatNoLabel = getVatNoLabel();

        return view('vendors.show', compact('vendor', 'activeTab','vatNoLabel'));
    }

    /**
     * @return Application|Factory|View
     */
    public function edit(Vendor $vendor)
    {
        $data = $this->vendorRepository->getData();
        $countries = $data['countries'];
        $vatNoLabel = getVatNoLabel();
        $vendor->load('user.media');

        return view('vendors.edit', compact('vendor', 'countries','vatNoLabel'));
    }

    public function update(Vendor $vendor, UpdateVendorRequest $request)
    {
        $input = $request->all();
        $vendor->load('user');

        try {
            $this->vendorRepository->updateVendor($input, $vendor);
            Flash::success(__('messages.flash.vendor_updated_successfully'));
        } catch (Exception $exception) {
            Flash::error($exception->getMessage());

            return redirect()->back()->withInput();
        }

        return redirect()->route('vendors.index');
    }

    public function destroy(Vendor $vendor, Request $request): JsonResponse
    {
        $vendor->user()->delete();
        $vendor->delete();

        return $this->sendSuccess(__('messages.flash.vendor_deleted_successfully'));
    }

    public function getStates(Request $request): mixed
    {
        $countryId = $request->get('countryId');
        $states = getStates($countryId);

        return $this->sendResponse($states,__('messages.flash.status_retrieved_successfully'));
    }

    /**
     * @return mixed
     */
    public function getCities(Request $request)
    {
        $stateId = $request->get('stateId');
        $cities = getCities($stateId);

        return $this->sendResponse($cities, __('messages.flash.cities_retrieved_successfully'));
    }
}
