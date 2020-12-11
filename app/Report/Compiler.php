<?php


namespace App\Report;


use App\Report;
use App\Report\ResultSet\Compiler as ResultSetCompiler;

class Compiler
{
    /**
     * @var ResultSetCompiler
     */
    private $resultSetCompiler;

    public function __construct(ResultSetCompiler $resultSetCompiler)
    {
        $this->resultSetCompiler = $resultSetCompiler;
    }

    public function compileReport(Report $report, RuntimeValues $runtimeValues)
    {
        $compiledReport = new CompiledReport($report);

        foreach ($report->datasets as $dataset) {
            $compiledReport->addResultSet(
                $this->resultSetCompiler->compileResultSet($dataset, $runtimeValues)
            );
        }

        return $compiledReport;
    }
}
