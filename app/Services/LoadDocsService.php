<?php


namespace App\Services;

use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class LoadDocsService
{

    public $table;
    public $columns;
    public $file;
    public $ids;
    protected $data;

    /**
     * @return string
     */
    protected function getDate() {
        return Carbon::now()->toDateTimeString();
    }

    /**
     * @param $file
     * @return mixed
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws Exception
     */
    public function readExcel($file) {
        $this->file = $file;
        $spreadsheet = IOFactory::load($this->file);
        $sheet = $spreadsheet->getActiveSheet();
        $coords = $sheet->getCellCollection()->getCoordinates();

        foreach ($coords as $coord) {
            $this->data[] = [
                is_array($this->columns) ?
                    : $this->columns => $sheet->getCell($coord)->getValue(),
                'created_at' => $this->getDate(),
                'updated_at' => $this->getDate(),
            ];
        }

        return $this->data;
    }

    /**
     * @param $table
     * @param $columns
     * @param $file
     * @return array
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function write($table, $columns, $file) {
        $this->table = $table;
        $this->columns = $columns;
        $this->readExcel($file);
        foreach ($this->data as $item) {
            $this->ids[] = DB::table($this->table)->insertGetId($item);
        }
        return $this->ids;
    }
}
