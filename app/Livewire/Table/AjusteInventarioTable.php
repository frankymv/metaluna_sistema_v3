<?php

namespace App\Livewire\Table;

use App\Models\AjusteInventario;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class AjusteInventarioTable extends PowerGridComponent
{
    public string $tableName = 'ajusteInventarioTable';

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
        return AjusteInventario::query()->with('sucursal');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('fecha_ajuste_inventario_formatted', fn (AjusteInventario $model) => Carbon::parse($model->fecha_ajuste_inventario)->format('d/m/Y'))
            ->add('ajuste_inventario_no')
            ->add('sucursal_nombre', fn (AjusteInventario $model) => $model->Sucursal?->nombre ?? 'N/A')
            ->add('tipo_ajuste')



            ->add('producto_nombre', fn (AjusteInventario $model) => $model->Producto?->nombre ?? 'N/A')
            ->add('tipo_ajuste')
            ->add('descripcion')
            ->add('cantidad_traslado')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [


            Column::make('Ajuste inventario no', 'ajuste_inventario_no')
                ->sortable()
                ->searchable(),

            Column::make('Fecha ajuste inventario', 'fecha_ajuste_inventario_formatted', 'fecha_ajuste_inventario')
                ->sortable(),

            Column::make('Sucursal', 'sucursal_nombre'),
            Column::make('Producto', 'producto_nombre','producto.nombre'),


            Column::make('Tipo ajuste', 'tipo_ajuste')
                ->sortable()
                ->searchable(),


            Column::make('Cantidad traslado', 'cantidad_traslado')
                ->sortable()
                ->searchable(),



            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_ajuste_inventario'),
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
        return exportarGeneralPDF('AjusteInventario', [
            'data' => $datas,
        ]);
    }

    public function actions(AjusteInventario $row): array
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
