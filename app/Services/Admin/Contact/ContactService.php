<?php

namespace App\Services\Admin\Contact;

use App\Exports\Admin\ContactExport;
use App\Models\User;
use App\Repositories\AgencyRepository;
use App\Repositories\CenterRepository;
use App\Repositories\ChannelRepository;
use App\Repositories\ContactRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\CustomerTagRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\StatusRepository;
use App\Services\Admin\Customer\CustomerService;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ContactService extends BaseService
{
    public function __construct(
        protected ContactRepository     $contactRepository,
        protected CenterRepository      $centerRepository,
        protected AgencyRepository      $agencyRepository,
        protected ChannelRepository     $channelRepository,
        protected CustomerTagRepository $customerTagRepository,
        protected StatusRepository      $statusRepository,
        protected ProvinceRepository    $provinceRepository,
        protected CustomerRepository    $customerRepository,

        protected CustomerService       $customerService
    )
    {
        parent::__construct($contactRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['centers'] = $this->centerRepository->get();
        $data['agencies'] = $this->agencyRepository->get();
        $data['channels'] = $this->channelRepository->get();
        $data['statuses'] = $this->statusRepository->getActiveByModule('contact');
        return $data;
    }

    public function filter(Request $request): array
    {
        $data = $request->all();
        $data['contacts'] = $this->contactRepository->get($request->all(), ['customer']);
        return $data;
    }

    public function create(Request $request): array
    {
        $data = $request->all();
        $data['centers'] = $this->centerRepository->get();
        $data['agencies'] = $this->agencyRepository->get();
        $data['channels'] = $this->channelRepository->get();
        $data['customerTags'] = $this->customerTagRepository->get();
        $data['statuses'] = $this->statusRepository->getActiveByModule('contact');
        $data['provinces'] = $this->provinceRepository->get();
        return $data;
    }

    public function store(Request $request): Model|array|null
    {
        $customer = $this->customerRepository->findByPhoneAndName($request->all());
        if ($customer) {
            $this->customerService->update($customer->id, $request);
            $customer = $this->customerRepository->find($customer->id);
        } else {
            $customer = $this->customerService->store($request);
        }
        return $this->storeByCustomer($customer->id, $request);
    }

    public function storeByCustomer(string|int $customerId, Request $request): Model|array|null
    {
        $createData = [
            'customer_id' => $customerId,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'note' => $request->input('note'),
            'status_id' => env('APP_DEFAULT_CONTACT_STATUS_ID')
        ];
        $contact = $this->contactRepository->create($createData);

        $contact->itemNotes()->create([
            'status_id' => env('APP_DEFAULT_CONTACT_STATUS_ID'),
            'note' => $request->note,
            'channel_id' => $request->channel_id,
            'created_by_id' => session('user_id'),
            'created_by_type' => User::class
        ]);

        return $contact;
    }

    public function edit(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['contact'] = $this->contactRepository->find($id, ['customer']);
        return $data;
    }

    public function showNote(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['contact'] = $this->contactRepository->find($id, ['itemNotes']);
        $data['statuses'] = $this->statusRepository->getActiveByModule('contact');
        $data['channels'] = $this->channelRepository->get();
        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        if ($request->status_id) {
            $contact = $this->contactRepository->find($id, ['customer']);
            if ($contact->customer->channel_id != $request->channel_id) {
                $customerDataUpdate = ['channel_id' => $request->channel_id];
                $this->customerRepository->update($contact->customer_id, $customerDataUpdate);
            }

            $contact->itemNotes()->create([
                'status_id' => $request->status_id,
                'note' => $request->note,
                'channel_id' => $request->channel_id,
                'created_by_id' => session('user_id'),
                'created_by_type' => User::class
            ]);

            $updateData = [
                'status_id' => $request->status_id,
                'note' => $request->note
            ];
            $updateData['schedule_at'] = $request->input('schedule_at') ? Carbon::parse($request->schedule_at)->format('Y-m-d H:i:s') : null;
            return $this->contactRepository->update($id, $updateData);
        }
        $updateData = $request->validated();
        return $this->contactRepository->update($id, $updateData);
    }

    public function export(Request $request): BinaryFileResponse
    {
        $data = $this->contactRepository->get($request->all());
        return Excel::download(new ContactExport($data), 'contacts.xlsx');
    }
}
