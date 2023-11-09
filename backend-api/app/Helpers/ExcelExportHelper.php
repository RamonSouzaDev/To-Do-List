<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExcelExportHelper
{   
    /**
     * Gera um arquivo Excel.
     *
     * @param  Collection $data
     * @param string $fileName
     * @param string $exportClass
     * @return BinaryFileResponse
     */
    public static function exportToExcel(Collection $data, string $exportClass, string $fileName, $format = 'Xlsx'): BinaryFileResponse
    {
        $excel = app(Excel::class);
        return $excel->download(new $exportClass($data), $fileName, $format);
    }
}

