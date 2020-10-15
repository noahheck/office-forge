<?php


namespace App\FormDoc\Transformer;


use App\Form\DataMapper;
use App\FormDoc;
use App\FormDoc\Template;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Spreadsheet as SpreadsheetWorkbook;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Spreadsheet
{
    /**
     * @var Template
     */
    private $template;

    /**
     * @var DataMapper
     */
    private $dataMapper;

    public function __construct(Template $template, DataMapper $dataMapper)
    {
        $this->template = $template;
        $this->dataMapper = $dataMapper;
    }

    /**
     * @param $formDocs \Illuminate\Database\Eloquent\Collection
     */
    public function transform($formDocs)
    {
        $workbook = new SpreadsheetWorkbook();

        $templateIds = $formDocs->pluck('form_doc_template_id')->unique();

        $templates = $this->template->find($templateIds);

        /**
         * $worksheets = [
         *      'template_XX' => [
         *          'worksheet' => $worksheet,
         *          'columnMap' => [
         *              'field_id' => 'spreadsheet column number',
         *          ],
         *      }
         * ]
         */
        $worksheets = [];

        $templates->load('activeFields', 'fileType')->each(function($template) use (&$worksheets) {
            $worksheets['template_' . $template->id] = $this->setUpWorksheetForTemplates($template);
        });



        $formDocs->load('fields')->each(function($formDoc) use (&$worksheets) {
            $sheetData = $worksheets['template_' . $formDoc->form_doc_template_id];

            $this->addFormDocDataToWorksheet($formDoc, $sheetData['worksheet'], $sheetData['columnMap']);
        });



        foreach ($worksheets as $worksheet) {
            $workbook->addSheet($worksheet['worksheet']);
        }

        // Get rid of initial, blank worksheet
        $workbook->removeSheetByIndex(0);

        return $workbook;
    }


    /**
     * Creates a new worksheet and sets up the column headers for it - we also create a field_id => column map
     *
     * @param Template $template
     * @return array
     */
    private function setUpWorksheetForTemplates($template)
    {
        $worksheet = new Worksheet(null, $template->name);

        $columns = [];

        $worksheet->setCellValueByColumnAndRow(1, 1, __('app.dateTime'));
        $worksheet->setCellValueByColumnAndRow(2, 1, __('formDoc.creator'));

        $column = 3;

        if ($template->file_type_id) {
            $worksheet->setCellValueByColumnAndRow(3, 1, $template->fileType->name);
            $column = 4;
        }

        foreach ($template->activeFields as $field) {

            $columns[$field->id] = $column;

            $worksheet->setCellValueByColumnAndRow($column, 1, $field->label);
            $column++;
        }

        return [
            'worksheet' => $worksheet,
            'columnMap' => $columns,
        ];
    }


    /**
     * @param FormDoc $formDoc
     * @param Worksheet $worksheet
     * @param array $columnMap
     */
    private function addFormDocDataToWorksheet($formDoc, $worksheet, $columnMap)
    {
        $row = $worksheet->getHighestRow() + 1;

        $worksheet->setCellValueByColumnAndRow(1, $row, $formDoc->date . ' ' . $formDoc->time);
        $worksheet->setCellValueByColumnAndRow(2, $row, $formDoc->creator->name);

        if ($file = $formDoc->file) {
            $worksheet->setCellValueByColumnAndRow(3, $row, $formDoc->file->name);
        }


        foreach ($formDoc->fields as $field) {

            $column = $columnMap[$field->form_doc_template_field_id] ?? false;

            // Column inactivated after the formDoc was created (probably)
            if (!$column) {
                continue;
            }

            $value = $this->dataMapper->getFieldValue($field);

            switch ($field->field_type):

                case 'file':
                    $value = optional($value)->name;
                    break;

                case 'user':
                    $value = optional($value)->name;
                    break;

                case 'address':
                    $value = implode("\n", $value);
                    break;

                default:

            endswitch;

            $worksheet->setCellValueByColumnAndRow($column, $row, $value);
        }
    }
}
