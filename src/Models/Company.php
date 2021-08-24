<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;



/**
 * Class Company
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\MonitorWeb[] $monitor_webs_company
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\MonitorStatus[] $monitor_statuses_company
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\MonitorIp[] $monitor_ips_company
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\MonitorDomain[] $monitor_domains_company
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\UserCompany[] $user_companies_company
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Monitor[] $monitors_company
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users_default_company
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\MonitorResultPing[] $monitor_result_pings_company
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\MonitorResultWeb[] $monitor_result_webs_company
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\UserRole[] $user_roles_company
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\MonitorResultTcpPing[] $monitor_result_tcp_pings_company
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\MonitorRun[] $monitor_runs_company
 * @package App\Models
 * @mixin IdeHelperCompany
 */
class Company extends \HaakCo\UserMultiCompanyRights\Models\BaseModels\BaseCompanyModel
{
    use \Illuminate\Database\Eloquent\SoftDeletes;



    protected $table = 'companies';

    protected $fillable = [
        'name',
        'slug'
    ];

    public function monitor_webs_company()
    {
        return $this->hasMany(\App\Models\MonitorWeb::class, 'company_id');
    }

    public function monitor_statuses_company()
    {
        return $this->hasMany(\App\Models\MonitorStatus::class, 'company_id');
    }

    public function monitor_ips_company()
    {
        return $this->hasMany(\App\Models\MonitorIp::class, 'company_id');
    }

    public function monitor_domains_company()
    {
        return $this->hasMany(\App\Models\MonitorDomain::class, 'company_id');
    }

    public function user_companies_company()
    {
        return $this->hasMany(\App\Models\UserCompany::class, 'company_id');
    }

    public function monitors_company()
    {
        return $this->hasMany(\App\Models\Monitor::class, 'company_id');
    }

    public function users_default_company()
    {
        return $this->hasMany(\App\Models\User::class, 'default_company_id');
    }

    public function monitor_result_pings_company()
    {
        return $this->hasMany(\App\Models\MonitorResultPing::class, 'company_id');
    }

    public function monitor_result_webs_company()
    {
        return $this->hasMany(\App\Models\MonitorResultWeb::class, 'company_id');
    }

    public function user_roles_company()
    {
        return $this->hasMany(\App\Models\UserRole::class, 'company_id');
    }

    public function monitor_result_tcp_pings_company()
    {
        return $this->hasMany(\App\Models\MonitorResultTcpPing::class, 'company_id');
    }

    public function monitor_runs_company()
    {
        return $this->hasMany(\App\Models\MonitorRun::class, 'company_id');
    }
}
