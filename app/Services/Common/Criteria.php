<?php
/**
 * Created by PhpStorm.
 * User: gibanez
 * Date: 15/9/2025
 * Time: 23:55
 */

namespace App\Services\Common;



use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Criteria
{
    protected Request $request;
    protected Builder $query;

    private array $columnsAvaible;

    public function __construct(Request $request)
    {
        $this->request = $request;

    }

    public function apply(Builder $query): Builder
    {
        $this->query   = $query;

        $this->setColumnAvaible($query);

        $this->applyFilters();
        $this->applySorting();
        $this->applyPagination();
//        dd($this->query->toRawSql());
        return $this->query;
    }

    protected function applyFilters(): void
    {
        $filters = $this->request->query('filter', []);

        foreach ($filters as $filter) {
            $field     = $filter['field'] ?? null;
            $condition = $filter['condition'] ?? 'eq';
            $value     = $filter['value'] ?? null;

            if (!$field || is_null($value) || !in_array($field, $this->columnsAvaible)) {
                continue;
            }

            switch ($condition) {
                case 'eq':
                    $this->query->where($field, '=', $value);
                    break;

                case 'neq':
                    $this->query->where($field, '!=', $value);
                    break;

                case 'gt':
                    $this->query->where($field, '>', $value);
                    break;

                case 'lt':
                    $this->query->where($field, '<', $value);
                    break;

                case 'gte':
                    $this->query->where($field, '>=', $value);
                    break;

                case 'lte':
                    $this->query->where($field, '<=', $value);
                    break;

                case 'in':
                    $this->query->whereIn($field, explode(',', $value));
                    break;

                case 'like':
                    $this->query->where($field, 'LIKE', "%{$value}%");
                    break;
            }
        }
    }

    protected function applySorting(): void
    {
        $sort = $this->request->query('sort', null);

        if ($sort) {
            $fields = explode(',', $sort);
            foreach ($fields as $field) {

                if (!$field || !in_array($field, $this->columnsAvaible)) continue;

                $direction = 'asc';
                if (str_starts_with($field, '-')) {
                    $direction = 'desc';
                    $field     = ltrim($field, '-');
                }
                $this->query->orderBy($field, $direction);
            }
        }
    }

    protected function applyPagination(): void
    {
        $offset = (int) $this->request->query('page.offset', 0);
        $limit  = (int) $this->request->query('page.limit', 15);

        $this->query->skip($offset)->take($limit);
    }

    /**
     * @param Builder $query
     */
    protected function setColumnAvaible(Builder $query)
    {
        $model = $query->getModel();
        $table = $model->getTable();
        $this->columnsAvaible = Schema::getColumnListing($table);
    }
}