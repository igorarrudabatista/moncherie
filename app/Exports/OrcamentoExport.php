<?php

namespace App\Exports;

use App\Models\Orcamento;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrcamentoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Orcamento::all();
    }
}
