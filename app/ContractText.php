<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class ContractText extends Model
{
    protected $table = 'contract_text';

    /**
     * Scope a query to only post lettter thank you in viet nam.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetLetterThankYou($query)
    {
        $data = $query->where('language', '=', 'vi')->orderBy('id')->get();
        if($data != null) {
            return $data;
        }
    }

    /**
     * Scope a query to only post lettter thank you in english.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetLetterThankYouEnglish($query)
    {
        $data = $query->where('language', '=', 'en')->orderBy('id')->get();
        if($data != null) {
            return $data;
        } else {
            return null;
        }
    }

}
