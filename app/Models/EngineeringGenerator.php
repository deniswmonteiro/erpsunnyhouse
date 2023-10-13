<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngineeringGenerator extends Model
{
    use HasFactory;

    protected $table = 'engineering_generator';

    protected $fillable = [
        'engineering_project_id',
        'client_id',
        'generator_project_type',
        'generator_status',
        'generator_cep',
        'generator_address',
        'generator_number',
        'generator_complement',
        'generator_neighborhood',
        'generator_city',
        'generator_state',
        'different_generator_contract_account',
        'generator_contract_account',
        'generator_power',
        'generator_consumption',
    ];

    public function project()
    {
        return $this->belongsTo(EngineeringProject::class, 'engineering_project_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function beneficiary_effective_date()
    {
        return $this->hasMany(BeneficiaryEffectiveDate::class, 'generator_id', 'id');
    }

    public function beneficiary()
    {
        return $this->hasMany(EngineeringBeneficiary::class, 'engineering_generator_id', 'id');
    }

    /** Project Documents */
    public function document()
    {
        return $this->hasOne(EngineeringGeneratorDocuments::class, 'engineering_generator_id', 'id');
    }

    public function newfile()
    {
        return $this->hasMany(EngineeringGeneratorDocumentsNewFile::class, 'engineering_generator_id', 'id');
    }

    /** Project Images */
    public function images()
    {
        return $this->hasMany(EngineeringGeneratorImages::class, 'engineering_generator_id', 'id');
    }

    /** Protocols */
    public function submission()
    {
        return $this->hasOne(ProtocolProjectSubmission::class, 'generator_id', 'id');
    }

    public function feedback()
    {
        return $this->hasOne(ProtocolRequestFeedback::class, 'generator_id', 'id');
    }

    public function issued()
    {
        return $this->hasOne(ProtocolFeedbackIssued::class, 'generator_id', 'id');
    }

    public function provisional()
    {
        return $this->hasOne(ProtocolProvisionalRequest::class, 'generator_id', 'id');
    }

    public function survey()
    {
        return $this->hasOne(ProtocolSurvey::class, 'generator_id', 'id');
    }

    public function homologated()
    {
        return $this->hasOne(ProtocolHomologated::class, 'generator_id', 'id');
    }

    /** Equipments */
    public function generator_equipment()
    {
        return $this->hasMany(EngineeringGeneratorEquipments::class, 'engineering_generator_id', 'id');
    }

    /** Document Request Up to Ten */
    public function document_request_up_to_ten()
    {
        return $this->hasOne(EngineeringDocumentRequestUpToTen::class, 'generator_id', 'id');
    }

    /** Document Request Above Ten Up to Seventy Five */
    public function document_request_above_ten_up_to_seventy_five()
    {
        return $this->hasOne(EngineeringDocumentRequestAboveTenUpToSeventyFive::class, 'generator_id', 'id');
    }

    /** Document Request Above Seventy Five */
    public function document_request_above_seventy_five()
    {
        return $this->hasOne(EngineeringDocumentRequestAboveSeventyFive::class, 'generator_id', 'id');
    }

    /** Document Access Request Form */
    public function document_request()
    {
        return $this->hasOne(EngineeringDocumentAccessRequestForm::class, 'generator_id', 'id');
    }

    /** Document ART */
    public function document_art()
    {
        return $this->hasOne(EngineeringDocumentArt::class, 'generator_id', 'id');
    }

    /** Document ANEEL */
    public function document_aneel()
    {
        return $this->hasOne(EngineeringDocumentAneel::class, 'generator_id', 'id');
    }

    /** Document Data Sheet Certificates */
    public function document_certificates()
    {
        return $this->hasOne(EngineeringDocumentDataSheetCertificates::class, 'generator_id', 'id');
    }

    /** Document Descriptive Memorial */
    public function document_memorial()
    {
        return $this->hasOne(EngineeringDocumentDescriptiveMemorial::class, 'generator_id', 'id');
    }

    /** Document Electrical Project */
    public function document_electrical()
    {
        return $this->hasOne(EngineeringDocumentElectricalProject::class, 'generator_id', 'id');
    }
}
