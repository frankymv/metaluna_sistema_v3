<?php

namespace App\Livewire\Table;

use App\Models\Traslado;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class TrasladoTable extends PowerGridComponent
{
    public string $tableName = 'trasladoTable';

    public function setUp(): array
    {


        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Traslado::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('traslado_no')
            ->add('traslado_fecha_formatted', fn (Traslado $model) => Carbon::parse($model->traslado_fecha)->format('d/m/Y'))
            ->add('sucursal_origen_id', fn (Traslado $model) => $model->SucursalOrigen?->nombre ?? 'N/A')
            ->add('sucursal_destino_id', fn (Traslado $model) => $model->SucursalDestino?->nombre ?? 'N/A')
            ->add('estado')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [

            Column::make('Traslado no', 'traslado_no')
                ->sortable()
                ->searchable(),

            Column::make('Traslado fecha', 'traslado_fecha_formatted', 'traslado_fecha')
                ->sortable(),

            Column::make('Sucursal origen ', 'sucursal_origen_id'),
            Column::make('Sucursal destino ', 'sucursal_destino_id'),


            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('traslado_fecha'),
        ];
    }
////////////////////////////////////////////////////////////////////////////////////

    public function header(): array
    {
        return [
            Button::add('exportar')
                ->slot('Exportar')
                ->class('bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-2 rounded mr-auto')
                ->dispatch('exportar', []),
            Button::add('agregar')
                ->slot('Agregar')
                ->class('bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded mr-auto')
                ->dispatch('create', []),
        ];
    }



	public function exportar()
    {
        //dd("caaa");
        $query = $this->datasource();

        // Búsqueda global
        if (!empty($this->search)) {
            $query->where(function (Builder $q) {
                $q->where('nombre', 'like', '%' . $this->search . '%')
                ->orWhere('descripcion', 'like', '%' . $this->search . '%')
                ->orWhere('estado', 'like', '%' . $this->search . '%');
            });
        }

        // Filtros por columna (PowerGrid los guarda en $this->filters['input_text'])
        if (!empty($this->filters['input_text'])) {
            foreach ($this->filters['input_text'] as $field => $value) {
                if (!empty($value)) {
                    $query->where($field, 'like', '%' . $value . '%');
                }
            }
        }
    // Ordenamiento
        if (!empty($this->sortField)) {
            $query->orderBy($this->sortField, $this->sortDirection ?? 'asc');
        }
        $datas = $query->get();
        return exportarGeneralPDF('Traslado', [
            'data' => $datas,
        ]);
    }



    public function actions(Traslado $row): array
    {
        return [

            Button::add('show')
                ->icon('default-show')
                ->class('bg-orange-500 text-white rounded-md  px-1 py-1')
                ->dispatch('show', ['rowId' => $row->id]),
            Button::add('delete')
                ->icon('default-trash')
                ->class('bg-red-500 text-white rounded-md  px-1 py-1')
                 ->dispatch('delete', ['rowId' => $row->id]),
            Button::add('export')
                ->icon('default-export')
                ->class('bg-yellow-500 text-white rounded-md  px-1 py-1')
                ->dispatch('exportarFila', ['rowId' => $row->id]),
        ];
    }

    protected function getListeners(): array
    {
        return [
            'exportar' => 'exportar',
            ...parent::getListeners(),
        ];
    }

}
