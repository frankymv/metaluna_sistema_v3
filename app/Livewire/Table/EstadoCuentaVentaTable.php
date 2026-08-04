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
            ->add('codigo_mayorista_cliente', fn (Venta $model) => $model->Cliente?->codigo_mayorista ?? 'N/A')
            ->add('nombre_cliente', fn (Venta $model) => $model->Cliente?->nombres_cliente ?? 'N/A')
            ->add('observaciones_venta')
            ->add('forma_pago_venta')
            ->add('cancelado_total_venta')
            ->add('fecha_cancelado_total_venta_formatted', fn (Venta $model) => Carbon::parse($model->fecha_cancelado_total_venta)->format('d/m/Y'))
            ->add('fecha_limite_credito_formatted', fn (Venta $model) => Carbon::parse($model->fecha_limite_credito)->format('d/m/Y'))
            ->add('fecha_cancelado_credito_formatted', fn (Venta $model) => Carbon::parse($model->fecha_cancelado_credito)->format('d/m/Y'))
            ->add('observaciones_credito')
            ->add('anulado', fn (Venta $model) => $model->anulado ? 'Sí' : 'No')

        ->add('cancelado', function ($venta) {
            return $venta->cancelado_total_venta == 0
                ? '<span class="text-gray-600">No</span>'
                : '<span class="text-green-600 font-semibold">Sí</span>';
        })
        ->add('anulado', function ($venta) {
            return $venta->anulado == 0
                ? '<span class="text-gray-600">No</span>'
                : '<span class="text-red-600 font-semibold">Sí</span>';
        })

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
            Column::make('No venta', 'no_venta')
                ->sortable()
                ->searchable(),

            Column::make('Fecha venta', 'fecha_venta_formatted', 'fecha_venta')
                ->sortable(),

            Column::make('Codigo May', 'codigo_mayorista_cliente')
                ->sortable()
                ->searchable(),

            Column::make('Cliente', 'nombre_cliente')
                ->sortable()
                ->searchable(),
            Column::make('Movimientos', 'movimientos'),
            Column::make('Saldos', 'saldos'),
            Column::make('Anulado', 'anulado'),
            Column::make('Cancelado', 'cancelado')
                ->sortable()
                ->searchable(),
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
        return exportarGeneralPDF('EstadoCuentaVenta', [
            'data' => $datas,
        ]);
    }

    protected function getListeners(): array
    {
        return [
            'exportar' => 'exportar',
            ...parent::getListeners(),
        ];
    }

}
