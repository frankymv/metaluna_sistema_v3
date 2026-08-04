<?php

namespace App\Livewire\Table;

use App\Models\Compra;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class CompraTable extends PowerGridComponent
{
    public string $tableName = 'compraTable';

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
        return Compra::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('compra_no')
            ->add('no_recibo_compra')
            ->add('compra_fecha_formatted', fn (Compra $model) => Carbon::parse($model->compra_fecha)->format('d/m/Y'))
            ->add('proveedor_id', fn (Compra $model) => $model->proveedor->nombre ?? 'N/A')
            ->add('sucursal_id', fn (Compra $model) => $model->Sucursal->nombre ?? 'N/A')
            
->add('productos', function (Compra $model) {


return $model->productos

->map(fn ($producto) =>
$producto->nombre . ': ' . $producto->pivot->cantidad
)

->implode('<br>');

})
            ->add('created_at');
    }

    public function columns(): array
    {
        return [

            Column::make('Compra no', 'compra_no')
                ->sortable()
                ->searchable(),

            Column::make('No recibo compra', 'no_recibo_compra')
                ->sortable()
                ->searchable(),

            Column::make('Compra fecha', 'compra_fecha_formatted', 'compra_fecha')
                ->sortable(),

            Column::make('Proveedor id', 'proveedor_id'),
            Column::make('Sucursal id', 'sucursal_id'),
            Column::make('Productos', 'productos'),


            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('compra_fecha'),
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
        return exportarGeneralPDF('Compra', [
            'data' => $datas,
        ]);
    }



    public function actions(Compra $row): array
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

}
