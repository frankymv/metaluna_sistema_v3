<?php

namespace App\Livewire\Table;
use Illuminate\Support\Facades\Blade;
use App\Models\Venta;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class EstadoCuentaVentaTable extends PowerGridComponent
{
    public string $tableName = 'estadoCuentaVentaTable';

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
           return Venta::query()
        ->with([
            'productos',
            'abonos',
            'notacreditos',
            'cliente',
        ]);
    }

    public function relationSearch(): array
    {
        return [
            'cliente' => [
                'nombres_cliente',
                'codigo_interno',
            ],
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
            ->add('created_at')

            ->add('estado', function (Venta $venta) {
                return Blade::render(
                    '<x-powergrid.estado :venta="$venta"/>',
                    [
                        'venta' => $venta
                    ]
                );
            })

            ->add('fecha_venta_formatted', fn(Venta $venta) =>
                Carbon::parse($venta->fecha_venta)->format('d/m/Y')
            )
            ->add('cliente', function (Venta $venta) {
            return Blade::render(
                '<x-powergrid.cliente :row="$venta"/>',
                [
                    'venta' => $venta
                ]
            );
             })

            ->add('movimientos', function (Venta $venta) {

            return Blade::render(
                '<x-powergrid.movimientos :venta="$venta"/>',
                [
                    'venta' => $venta
                ]
            );

         })
          ->add('saldos', function (Venta $venta) {
            return Blade::render(
                '<x-powergrid.saldos :venta="$venta"/>',
                [
                    'venta' => $venta
                ]
            );
        });
    }

    public function columns(): array
    {
        return [
            Column::make('CLIENTE','cliente'),
            Column::make('MOVIMIENTOS', 'movimientos'),
            Column::make('SALDOS', 'saldos'),

            Column::make('No venta', 'no_venta')
                ->sortable()
                ->searchable(),

            Column::make('Fecha venta', 'fecha_venta_formatted', 'fecha_venta')
                ->sortable(),

            Column::make('Total venta', 'total_venta')
                ->sortable()
                ->searchable(),
            Column::make('ESTADO', 'estado'),
            Column::action('Action')

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

    public function header(): array
    {
        return [
            Button::add('exportar')
                ->slot('Exportar')
                ->class('bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-2 rounded mr-auto')
                ->dispatch('exportar', [])
        ];
    }






}
