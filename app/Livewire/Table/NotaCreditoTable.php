<?php

namespace App\Livewire\Table;

use App\Models\NotaCredito;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class NotaCreditoTable extends PowerGridComponent
{
    public string $tableName = 'notaCreditoTable';

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
        return NotaCredito::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('no_nota_credito')
            ->add('venta_id')
            ->add('cliente_id', fn (NotaCredito $model) => $model->Cliente?->nombres_cliente ?? 'N/A')
            ->add('fecha_nota_credito_formatted', fn (NotaCredito $model) => Carbon::parse($model->fecha_nota_credito)->format('d/m/Y'))
            ->add('total_nota_credito', fn (NotaCredito $model) => 'Q. ' . number_format($model->venta?->total_nota_credito ?? 0,2))
            ->add('observaciones')
            ->add('correlativo')
            ->add('anulacion_venta', fn (NotaCredito $model) => $model->anulacion_venta ? 'Sí' : 'No')
            ->add('saldo_venta', fn (NotaCredito $model) =>($model->venta?->total_venta ?? 0) - $model->total_nota_credito);
    }

    public function columns(): array
    {
        return [
            Column::make('No nota credito', 'no_nota_credito')
                ->searchable(),
            Column::make('Fecha nota credito', 'fecha_nota_credito_formatted', 'fecha_nota_credito')
                ,
            Column::make('No Venta', 'venta_id','venta.id')
                ,
            Column::make('Cliente', 'cliente_id','cliente.nombre'),
            Column::make('Total nota credito', 'total_nota_credito')
                ,
            Column::make('Anulacion', 'anulacion_venta'),
            Column::make('Observaciones', 'observaciones')
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
            Filter::datepicker('fecha_nota_credito'),
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
        return exportarGeneralPDF('NotaCredito', [
            'data' => $datas,
        ]);
    }



    public function actions(NotaCredito $row): array
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
