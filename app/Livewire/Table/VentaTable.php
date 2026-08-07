<?php

namespace App\Livewire\Table;

use App\Models\Venta;
use App\Models\Cliente;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class VentaTable extends PowerGridComponent
{
    public string $tableName = 'venta-table-kyrlef-table';

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
        return Venta::query()->with('cliente');
    }

    public function relationSearch(): array
    {
            return [
                'cliente' => ['codigo_interno','codigo_mayorista','nombres_cliente'], // 'relación' => ['columna']
                ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('no_venta')
            ->add('fecha_venta_formatted', fn (Venta $model) => Carbon::parse($model->fecha_venta)->format('d/m/Y'))
            ->add('total_venta')
            ->add('observaciones_venta')
            ->add('cliente_codigo_interno', fn (Venta $model) => $model->Cliente?->codigo_interno ?? 'N/A')
            ->add('cliente_codigo_mayorista', fn (Venta $model) => $model->Cliente?->codigo_mayorista ?? 'N/A')
            ->add('cliente_nombres_cliente', fn (Venta $model) => $model->Cliente?->nombres_cliente ?? 'N/A')
            ->add('forma_pago_venta')
            ->add('cancelado_total_venta')
            ->add('fecha_cancelado_total_venta_formatted', fn (Venta $model) => Carbon::parse($model->fecha_cancelado_total_venta)->format('d/m/Y'))
            ->add('credi')
            ->add('total_credito')
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
            Column::make('Codigo Interno', 'cliente_codigo_interno')
                ->searchable(),
            Column::make('Codigo Mayorista', 'cliente_codigo_mayorista')
                ->searchable(),
            Column::make('Cliente', 'cliente_nombres_cliente')
                ->searchable(),
            Column::make('Forma pago venta', 'forma_pago_venta')
                ,
            Column::make('Envio', 'envio')
                ,
            Column::make('Estado envio', 'estado_envio')
                ,
            Column::make('Total venta', 'total_venta')
                ,
            Column::action('Acciones')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_venta'),
            Filter::datepicker('fecha_cancelado_total_venta'),
            //Filter::datepicker('fecha_limite_credito'),
            Filter::datepicker('fecha_cancelado_credito'),
            Filter::datepicker('fecha_anulado'),
        ];
    }
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
        return exportarGeneralPDF('Venta', [
            'data' => $datas,
        ]);
    }



    public function actions(Venta $row): array
    {
        return [
            Button::add('show')
                ->icon('default-edit')
                ->class('bg-green-500 text-white rounded-md  px-1 py-1')
                ->dispatch('Envio', ['rowId' => $row->id]),

            Button::add('show')
                ->icon('default-show')
                ->class('bg-orange-500 text-white rounded-md  px-1 py-1')
                ->dispatch('showDetalle', ['rowId' => $row->id]),

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
            //'envio' => 'envio',
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
