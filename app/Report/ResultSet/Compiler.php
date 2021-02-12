<?php


namespace App\Report\ResultSet;


use App\Report\Dataset;
use App\Report\ResultSet\Compiler\FormFilteredInstanceProvider;
use App\Report\ResultSet\Record\Compiler as RecordCompiler;
use App\Report\RuntimeValues;
use App\Report\ResultSet;
use App\Report\ResultSet\Compiler\BaseInstanceProvider;
use App\Report\ResultSet\Compiler\Operator;

class Compiler
{
    /**
     * @var Operator
     */
    private $queryOperator;

    /**
     * @var BaseInstanceProvider
     */
    private $baseInstanceProvider;

    /**
     * @var FormFilteredInstanceProvider
     */
    private $formFilteredInstanceProvider;

    private $recordCompiler;

    public function __construct(
        Operator $queryOperator,
        BaseInstanceProvider $baseInstanceProvider,
        FormFilteredInstanceProvider $formFilteredInstanceProvider,
        RecordCompiler $recordCompiler
    ) {
        $this->queryOperator = $queryOperator;
        $this->baseInstanceProvider = $baseInstanceProvider;
        $this->formFilteredInstanceProvider = $formFilteredInstanceProvider;
        $this->recordCompiler = $recordCompiler;
    }

    public function compileResultSet(Dataset $dataset, RuntimeValues $runtimeValues)
    {
        $resultSet = new ResultSet($dataset);



        $baseInstanceIds = $this->baseInstanceProvider->getBaseInstanceIdsForDataset($dataset, $runtimeValues);

        if (!$baseInstanceIds->count()) {

            return $resultSet;
        }



        $instanceIds = $this->formFilteredInstanceProvider->getFormFilteredInstanceIdsForDataset(
            $dataset,
            $runtimeValues,
            $baseInstanceIds
        );

        if (!$instanceIds->count()) {

            return $resultSet;
        }



        $datasetable = $dataset->datasetable;

        $fieldValueRelationshipIdentifier = $datasetable->instanceFieldValueRelationshipIdentifier();

        $instances = $datasetable->datasetableInstances()->find($instanceIds);

        $instances->load($fieldValueRelationshipIdentifier);

        foreach ($instances as $instance) {
            $resultSet->addRecord(
                $this->recordCompiler->compileRecord($instance, $dataset)
            );
        }


        return $resultSet;
    }
}
