<?php

namespace App\Http\Livewire;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class VendorTable extends LivewireTableComponent
{
    protected $model = Vendor::class;

    protected string $tableName = 'vendors';

    // for table header button
    public $showButtonOnHeader = true;

    public $buttonComponent = 'vendors.components.add-button';

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('vendors.created_at', 'desc');
        $this->setQueryStringStatus(false);

        $this->setThAttributes(function (Column $column) {
            if ($column->getField() == 'id') {
                return [
                    'style' => 'width:9%;text-align:center',
                ];
            }

            return [];
        });

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->getField() === 'first_name') {
                return [
                    'class' => 'w-75',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.vendor.vendor'), 'user.first_name')
                ->searchable(function (Builder $query, $direction) {
                    $query->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                })
                ->sortable()
                ->view('vendors.components.full_name'),
            Column::make('email', 'user.email')
                ->searchable()
                ->hideIf(1),
            Column::make(__('messages.common.invoice'), 'id')
                ->view('vendors.components.invoice-count'),
            Column::make(__('messages.common.action'), 'id')
                ->format(function ($value, $row, Column $column) {
                    return view('livewire.action-button')->with([
                        'editRoute' => route('vendors.edit', $row->id),
                        'dataId' => $row->id,
                        'editClass' => 'user-edit-btn',
                        'deleteClass' => 'vendor-delete-btn',
                    ]);
                }),
        ];
    }

    public function builder(): Builder
    {
        $query = Vendor::with(['user.media'])->whereHas('user');

        return $query;
    }

    public function resetPageTable()
    {
        $this->customResetPage('vendorsPage');
    }
}
