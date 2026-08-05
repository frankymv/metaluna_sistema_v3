<?php

namespace App\Livewire\Table;

use App\Models\Vehiculo;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class VehiculoTable extends PowerGridComponent
{
    public string $tableName = 'vehiculoTable';

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
        return Vehiculo::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('codigo')
            ->add('tipo_vehiculo')
            ->add('tipo_placa')
            ->add('numero_placa')
            ->add('marca')
            ->add('modelo')
            ->add('linea')
            ->add('alias')
            ->add('estado')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Codigo', 'codigo')
                ->sortable()
                ->searchable(),

            Column::make('Tipo vehiculo', 'tipo_vehiculo')
                ->sortable()
                ->searchable(),

            Column::make('Tipo placa', 'tipo_placa')
                ->sortable()
                ->searchable(),

            Column::make('Numero placa', 'numero_placa')
                ->sortable()
                ->searchable(),

            Column::make('Marca', 'marca')
                ->sortable()
                ->searchable(),

            Column::make('Modelo', 'modelo')
                ->sortable()
                ->searchable(),

            Column::make('Linea', 'linea')
                ->sortable()
                ->searchable(),

            Column::make('Alias', 'alias')
                ->sortable()
                ->searchable(),

            Column::action('Acciones')
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


    public function filters(): array
    {
        return [
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
        return exportarGeneralPDF('Vehiculo', [
            'data' => $datas,
        ]);
    }



    public function actions(Vehiculo $row): array
    {
        return [
            Button::add('edit')
                ->icon('default-edit')
                ->class('bg-green-500 text-white rounded-md  px-1 py-1')
                ->dispatch('edit', ['rowId' => $row->id]),
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



    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
