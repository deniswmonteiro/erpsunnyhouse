<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCosts extends Model
{
    use HasFactory;

    protected $table = 'project_costs';

    protected $fillable = [
        'engineering_project_id',
        'cost_category_id'
    ];

    /** Engineering Project */
    public function project()
    {
        return $this->belongsTo(EngineeringProject::class, 'engineering_project_id', 'id');
    }

    /** Costs Categories */
    public function cost_photovoltaic()
    {
        return $this->hasOne(CostPhotovoltaicKit::class, 'project_costs_id', 'id');
    }

    public function cost_project()
    {
        return $this->hasOne(CostProject::class, 'project_costs_id', 'id');
    }

    public function cost_labor()
    {
        return $this->hasOne(CostLabor::class, 'project_costs_id', 'id');
    }

    public function cost_supplies()
    {
        return $this->hasOne(CostSupplies::class, 'project_costs_id', 'id');
    }

    public function cost_services()
    {
        return $this->hasOne(CostServices::class, 'project_costs_id', 'id');
    }

    public function cost_others()
    {
        return $this->hasOne(CostOthers::class, 'project_costs_id', 'id');
    }
}
