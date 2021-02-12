<?php


namespace App\Report\ResultSet\Compiler;


class BaseInstanceProvider
{
    /**
     * @var Operator
     */
    private $operator;

    /**
     * @var QueryValue
     */
    private $queryValue;

    public function __construct(Operator $operator, QueryValue $value)
    {
        $this->operator = $operator;
        $this->queryValue = $value;
    }

    public function getBaseInstanceIdsForDataset($dataset, $runtimeValues)
    {
        $datasetable = $dataset->datasetable;

        $instancesQueryBuilder = $datasetable->datasetableInstances();

        $dataset->loadMissing('fields');

        if ($runtimeValues->file_id) {

            // Will be the FormDoc query builder
            $instancesQueryBuilder->where('file_id', $runtimeValues->file_id);
        }

        // Apply instance field filters to dataset here, then get instance ids
        foreach ($dataset->instanceAttributeFilters() as $filter) {

            $valueColumn = $this->getAttributeValueColumn($filter);

            if (in_array($valueColumn, ['created_at'])) {

                $instancesQueryBuilder->whereBetween(
                    $valueColumn,
                    $this->queryValue->queryValueForFilter($filter, $runtimeValues)
                );

            } elseif (in_array($valueColumn, ['date'])) {

                $instancesQueryBuilder->whereBetween(
                    $valueColumn,
                    $this->queryValue->queryValueForFilter($filter, $runtimeValues)
                );

            } else {

                $instancesQueryBuilder->where(
                    $valueColumn,
                    $this->operator->queryOperatorForFilter($filter),
                    $this->queryValue->queryValueForFilter($filter, $runtimeValues)
                );
            }
        }

        $instances = $instancesQueryBuilder->get();

        $instanceIds = $instances->pluck('id');

        return $instanceIds;
    }



    private function getAttributeValueColumn($filter)
    {
        $map = [
            'created_date' => 'created_at',
            'created_by' => 'created_by',
            'creator_id' => 'creator_id',
            'date' => 'date',
        ];

        return $map[$filter->field_id] ?? null;
    }
}
