<?php

namespace App\Services\Admin\Batch;

use App\Models\User;
use App\Repositories\AgencyRepository;
use App\Repositories\ConfigRepository;
use App\Repositories\DefendantRepository;
use App\Repositories\EthnicityRepository;
use App\Repositories\JudgmentDocumentRepository;
use App\Repositories\JudgmentRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\NationalityRepository;
use App\Repositories\OldAgencyRepository;
use App\Repositories\OldDistrictRepository;
use App\Repositories\OldProvinceRepository;
use App\Repositories\OldWardRepository;
use App\Repositories\PoliceRepository;
use App\Repositories\ProcuracyRepository;
use App\Repositories\ProvinceRepository;
use App\Repositories\ReligionRepository;
use App\Repositories\StatusRepository;
use App\Repositories\WardRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class JudgmentDocumentService extends BaseService
{
    public function __construct(
        protected JudgmentDocumentRepository $judgmentDocumentRepository,
        protected JudgmentRepository         $judgmentRepository,
        protected StatusRepository           $statusRepository,
        protected ConfigRepository           $configRepository,
        protected LanguageRepository         $languageRepository,
        protected NationalityRepository      $nationalityRepository,
        protected EthnicityRepository        $ethnicityRepository,
        protected ReligionRepository         $religionRepository,

        protected AgencyRepository           $agencyRepository,
        protected OldAgencyRepository        $oldAgencyRepository,
        protected ProvinceRepository         $provinceRepository,
        protected OldProvinceRepository      $oldProvinceRepository,
        protected OldDistrictRepository      $oldDistrictRepository,
        protected WardRepository             $wardRepository,
        protected OldWardRepository          $oldWardRepository,
        protected PoliceRepository $policeRepository,
        protected ProcuracyRepository $procuracyRepository,
        protected DefendantRepository $defendantRepository
    )
    {
        parent::__construct($judgmentDocumentRepository);
    }

    public function index(Request $request): array
    {
        $data = $request->all();
        $data['judgment'] = $this->judgmentRepository->find($request->input('judgment_id') ?: 0);
        return $data;
    }

    public function filter(Request $request): array
    {
        $filter = ['id' => $request->input('judgment_id')];
        $judgment = $this->judgmentRepository->getSum($filter, ['batch'], ['judgmentDocuments'])->first();

        $data = $request->all();
        $data['judgment'] = $judgment;
        $data['judgmentDocuments'] = $this->judgmentDocumentRepository->get($request->all());
        $view = $request->input('is_after_merge') ? 'filter.ssn' : 'filter.tsn';

        switch ($judgment->batch->type->code) {
            case 'DANG':
                $data['view'] = $view . '.dang';
                break;
            case 'HINH SU':
                $data['view'] = $view . '.hinh_su';
                break;
            case 'HON NHAN GIA DINH':
                $data['view'] = $view . '.hon_nhan_gia_dinh';
                break;
            case 'THI HANH AN HINH SU':
            case 'THI HANH AN TU HINH':
            case 'XOA AN TICH':
                $data['view'] = $view . '.thi_hanh_an';
                break;
            case 'HANH CHINH':
            case 'DAN SU':
            case 'LAO DONG':
            case 'KINH DOANH THUONG MAI':
            case 'PHA SAN':
            default:
                $data['view'] = $view . '.hanh_chinh';
                break;
        }
        return $data;
    }

    public function edit(int|string $id, Request $request): array
    {
        $judgmentDocument = $this->judgmentDocumentRepository->find($id, ['judgment']);

        $data = $request->all();
        $data['judgmentDocument'] = $judgmentDocument;
        return $data;
    }

    public function editByFilePath(Request $request): ?array
    {
        $judgmentDocument = $this->judgmentDocumentRepository->findByFilePath($request->input('file_path'));
        $judgment = $judgmentDocument->judgment;
        $jds = $this->judgmentDocumentRepository->get(['judgment_id' => $judgment->id], null);
        foreach ($jds as $jd) {
            $jd->href = route('admin.judgment_document.edit', ['judgment_document' => $jd->id, 'action_type' => $request->input('action_type')]);
        }

        $data = $request->all();
        $data['jds'] = $jds;
        $data['judgmentDocument'] = $judgmentDocument;
        $data['languages'] = $this->languageRepository->get();
        $data['physicalConditions'] = $this->configRepository->getByModule('physical_condition');
        $data['documentTypes'] = $this->configRepository->getByModule('document_type');
        $data['documentGenres'] = $this->configRepository->getByModule('document_genre');
        $data['confidentialityLevels'] = $this->configRepository->getByModule('confidentiality_level');
        $data['copyTypes'] = $this->configRepository->getByModule('copy_type');
        $data['usageModes'] = $this->configRepository->getByModule('usage_mode');
        $data['tenurePeriods'] = $this->configRepository->getByModule('tenure_period');
        $data['retentionPeriods'] = $this->configRepository->getByModule('retention_period');
        $data['fonts'] = $this->configRepository->getByModule('font');

        return $data;
    }

    public function update(string|int $id, Request $request): array|bool|null
    {
        $updateData = $this->handleFormatDate($request->validated(), ['issue_date']);
        unset($updateData['language_id']);

        $this->judgmentDocumentRepository->update($id, $updateData);

        $judgmentDocument = $this->judgmentDocumentRepository->find($id);

        $judgmentDocument->languages()->sync($request->input('language_id'));

        $judgmentDocument->itemNotes()->create([
            'status_id' => $judgmentDocument->status_id,
            'note' => $request->input('note') ?: __('app.update'),
            'created_by_id' => session('user_id'),
            'created_by_type' => User::class
        ]);
        return true;
    }

    public function showNote(string|int $id, Request $request): array
    {
        $data = $request->all();
        $data['judgmentDocument'] = $this->judgmentDocumentRepository->find($id, ['itemNotes']);
        $data['statuses'] = $this->statusRepository->getActiveByModule('judgment');
        return $data;
    }

    public function updatePdf2(Request $request): ?bool
    {
        return true;
    }

    public function processPdf2(string|int $batchId): ?bool
    {
        return true;
    }

    public function showCopyDefendant(string|int $id, Request $request): array
    {
        return [true];

        $data = $request->all();
        $judgmentDocument = $this->judgmentDocumentRepository->find($id);
        $judgment = $this->judgmentRepository->find($judgmentDocument->judgment_id);

        $defendants = $judgment->defendants()->where('judgment_document_id', '<>', $id)->get();
        $data['judgmentDocument'] = $judgmentDocument;
        $data['defendants'] = $defendants;
        return $data;
    }

    public function copyDefendant(string|int $id, Request $request): bool|null
    {
        return true;

        $oldDefendants = $this->defendantRepository->get(['id' => $request->input('defendant_id')]);
        foreach ($oldDefendants as $oldDefendant) {
            $createData = $oldDefendant->replicate()->toArray();
            $createData['judgment_document_id'] = $id;
            $newDefendant = $this->defendantRepository->create($createData);

            if ($oldDefendant->nationalities->isNotEmpty()) {
                $nationalityIds = $oldDefendant->nationalities->pluck('id')->toArray();
                $newDefendant->nationalities()->attach($nationalityIds);
            }
            if ($oldDefendant->judicialMeasureNames->isNotEmpty()) {
                $judicialMeasureNameIds = $oldDefendant->judicialMeasureNames->pluck('id')->toArray();
                $newDefendant->judicialMeasureNames()->attach($judicialMeasureNameIds);
            }
            if ($oldDefendant->legalRelationships->isNotEmpty()) {
                $legalRelationshipIds = $oldDefendant->legalRelationships->pluck('id')->toArray();
                $newDefendant->legalRelationships()->attach($legalRelationshipIds);
            }

            if ($oldDefendant->mainPenalties->isNotEmpty()) {
                $mainPenaltiesData = $oldDefendant->mainPenalties->mapWithKeys(function ($penalty) {
                    return [
                        $penalty->id => $penalty->pivot->only(['is_main'])
                    ];
                })->toArray();
                $newDefendant->mainPenalties()->attach($mainPenaltiesData);
            }
            if ($oldDefendant->additionalPenalties->isNotEmpty()) {
                $additionalPenaltiesData = $oldDefendant->additionalPenalties->mapWithKeys(function ($penalty) {
                    return [
                        $penalty->id => $penalty->pivot->only(['is_main'])
                    ];
                })->toArray();
                $newDefendant->additionalPenalties()->attach($additionalPenaltiesData);
            }
        }
        return true;
    }
}
