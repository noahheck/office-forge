<?php


namespace App\Report\ResultSet\Compiler;


use App\Report\Dataset\Filter;

class Operator
{
    public function __construct()
    {

    }

    public function queryOperatorForFilter($filter)
    {
        $operator = '';

        switch ($filter->operator):

            case Filter::FILTER_OPERATOR_HAS_VALUE:
                $operator = '!=';
                break;

            case Filter::FILTER_OPERATOR_DOES_NOT_HAVE_VALUE:
                $operator = '=';
                break;

            case Filter::FILTER_OPERATOR_CHECKED:
                $operator = '=';
                break;

            case Filter::FILTER_OPERATOR_NOT_CHECKED:
                $operator = '!=';
                break;

            case Filter::FILTER_OPERATOR_EQUALS:
                $operator = '=';
                break;

            case Filter::FILTER_OPERATOR_NOT_EQUALS:
                $operator = '!=';
                break;

            case Filter::FILTER_OPERATOR_GREATER_THAN:
                $operator = '>';
                break;

            case Filter::FILTER_OPERATOR_GREATER_THAN_EQUALS:
                $operator = '>=';
                break;

            case Filter::FILTER_OPERATOR_LESS_THAN:
                $operator = '<';
                break;

            case Filter::FILTER_OPERATOR_LESS_THAN_EQUALS:
                $operator = '<=';
                break;

            // This case should be handled in the calling method to change the query builder function to whereBetween
            case Filter::FILTER_OPERATOR_BETWEEN:
                $operator = '';
                break;

        endswitch;

        return $operator;
    }
}
