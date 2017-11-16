<?php

/**
 * Part of the Antares package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Antares Core
 * @version    0.9.2
 * @author     Antares Team
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017, Antares
 * @link       http://antaresproject.io
 */

namespace Antares\Users\Http\Filter;

use Yajra\Datatables\Contracts\DataTableScopeContract;
use Antares\Datatables\Filter\SelectFilter;

class UserStatusFilter extends SelectFilter implements DataTableScopeContract
{

    /**
     * name of filter
     *
     * @var String 
     */
    protected $name = 'Status';

    /**
     * column to search
     *
     * @var String
     */
    protected $column = 'status';

    /**
     * filter pattern
     *
     * @var String
     */
    protected $pattern = '<span class="filter-label">Status:</span> %value';

    /**
     * filter instance dataprovider
     * 
     * @return array
     */
    protected function options()
    {

        return ['0' => 'Inactive', '1' => 'Active'];
    }

    /**
     * filters data by parameters from memory
     * 
     * @param mixed $builder
     */
    public function apply($builder)
    {
//        $values = $this->getValues();
//        if (empty($values)) {
//            return $builder;
//        }
//        $builder->whereIn('type_id', $values);
    }

}
