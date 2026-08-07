<?php

namespace App\Livewire\Table;

use App\Models\Venta;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class CreditoTable extends PowerGridComponent
{
    public string $tableName = 'creditoTable';

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
        return Venta::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('no_venta')
            ->add('fecha_venta_formatted', fn (Venta $model) => Carbon::parse($model->fecha_venta)->format('d/m/Y'))
            ->add('total_venta')
            ->add('observaciones_venta')
            ->add('forma_pago_venta')
            ->add('cancelado_total_venta')
            ->add('fecha_cancelado_total_venta_formatted', fn (Venta $model) => Carbon::parse($model->fecha_cancelado_total_venta)->format('d/m/Y'))
            ->add('credi') 
            //->add('total_credito',fn (Venta $model) => number_format($model->total_credito ?? 0, 2)

//->add('total_credito', fn (Venta $model) => 'Q. ' . number_format($model->total_credito ?? 0, 2))

            ->add('total_credito', function ($model) {return ($model->total_credito ?? 0);})
            ->add('fecha_limite_credito_formatted', fn (Venta $model) => Carbon::parse($model->fecha_limite_credito)->format('d/m/Y'))
            ->add('fecha_cancelado_credito_formatted', fn (Venta $model) => Carbon::parse($model->fecha_cancelado_credito)->format('d/m/Y'))
            ->add('observaciones_credito')
            ->add('anulado')
            ->add('fecha_anulado_formatted', fn (Venta $model) => Carbon::parse($model->fecha_anulado)->format('d/m/Y'))
            ->add('nota_credito')
            ->add('total_nota_credito')
            ->add('correlativo_nota_credito')
            ->add('abono')
            ->add('total_abono')
            ->add('correlativo_abono')
            ->add('envio')
            ->add('estado_envio')
            ->add('visible')
            ->add('cliente_id', fn (Venta $model) => $model->Cliente?->nombres_cliente ?? 'N/A')
            ->add('sucursal_id')
            ->add('anticipo_v')
            ->add('nuevo_saldo_v')
            ->add('saldo_anterior_v')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('No venta', 'no_venta')
                ->searchable(),

            Column::make('Fecha venta', 'fecha_venta_formatted', 'fecha_venta')
                ,


      Column::make('Total Credito', 'total_credito') // Muestra el campo formateado y permite ordenar por el original 'precio'
            ,

            Column::make('Fecha limite credito', 'fecha_limite_credito_formatted', 'fecha_limite_credito')
                ,

            Column::make('Cliente', 'cliente_id','cliente.nombres_cliente')
                ->searchable(),


            Column::make('Observaciones credito', 'observaciones_credito')
                ->searchable(),





            Column::action('Acciones')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_venta'),
            Filter::datepicker('fecha_cancelado_total_venta'),
            Filter::datepicker('fecha_limite_credito'),
            Filter::datepicker('fecha_cancelado_credito'),
            Filter::datepicker('fecha_anulado'),
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
        return exportarGeneralPDF('Credito', [
            'data' => $datas,
        ]);
    }



    public function actions(Venta $row): array
    {
        return [
            Button::add('show')
                ->icon('default-show')
                ->class('bg-orange-500 text-white rounded-md  px-1 py-1')
                ->dispatch('show', ['rowId' => $row->id]),
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
