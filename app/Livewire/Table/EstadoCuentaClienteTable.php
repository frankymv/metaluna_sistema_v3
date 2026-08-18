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


final class EstadoCuentaClienteTable extends PowerGridComponent
{
    public string $tableName = 'estadoCuentaClienteTable';

    public function setUp(): array
    {
        //$this->showCheckBox();
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
    /*
         return Venta::query()
            ->join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
            ->select('ventas.*')
            ->with(['abonos', 'notacreditos', 'cliente']);
*/
    }

    public function relationSearch(): array
    {
        return [
        'cliente' => [
            'nombres_cliente',
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
            ->add('codigo_interno', fn (Venta $model) => $model->Cliente?->codigo_interno ?? 'N/A')
            ->add('codigo_mayorista', fn (Venta $model) => $model->Cliente?->codigo_mayorista ?? 'N/A')
            ->add('cliente_id', fn (Venta $model) => $model->Cliente?->nombres_cliente ?? 'N/A')
            ->add('saldo_venta')
            ->add('tipo_cliente', fn (Venta $model) => $model->Cliente?->tipo_cliente ?? 'N/A')
            ->add('sucursal_id')
            ->add('anticipo_v')
            ->add('nuevo_saldo_v')
            ->add('saldo_anterior_v')
            ->add('estado_vencimiento', function (Venta $model) {
                $fechaLimite = $model->fecha_limite_credito
                    ? Carbon::parse($model->fecha_limite_credito)->startOfDay()
                    : null;

                $hoy = Carbon::today();

                if ($model->saldo_venta <= 0) {
                    return "<span class='text-gray-500 font-bold'>CANCELADO</span>";
                }

                if (!$fechaLimite) {
                    return "<span class='text-gray-500 font-bold'>SIN FECHA</span>";
                }

                if ($fechaLimite->lt($hoy)) {
                    $dias = (int) $fechaLimite->diffInDays($hoy);

                    return "<span class='text-red-600 font-bold'>
                                VENCIDA ({$dias} días)
                            </span>";
                }

                if ($fechaLimite->isSameDay($hoy)) {
                    return "<span class='text-yellow-600 font-bold'>
                                VENCE HOY
                            </span>";
                }

                $dias = (int) $hoy->diffInDays($fechaLimite);

                return "<span class='text-green-600 font-bold'>
                            RESTAN {$dias} días
                        </span>";
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Codigo Interno', 'codigo_interno')
             ->searchable(),
            Column::make('Codigo Mayorista', 'codigo_mayorista')
             ->searchable(),
            Column::make('Cliente', 'cliente_id','cliente')
             ->searchable(),
            Column::make('Tipo de Cliente', 'tipo_cliente'),
            Column::make('No venta', 'no_venta')
            ->searchable(),
            Column::make('Fecha venta', 'fecha_venta_formatted', 'fecha_venta'),
            Column::make('Fecha limite', 'fecha_limite_credito_formatted', 'fecha_limite'),
            Column::make('Vencimiento', 'estado_vencimiento'),
            Column::make('Forma pago', 'forma_pago_venta')
            ,
            Column::make('Total venta', 'total_venta')
            ->withSum('Total Venta', header: false, footer: true),
            Column::make('Total credito', 'total_credito')
            ->withSum('Total Credito', header: false, footer: true),
            Column::make('Total abono', 'total_abono')
            ->withSum('Total Abono', header: false, footer: true),
            Column::make('Total nota credito', 'total_nota_credito')
            ->withSum('Total Nota Credito', header: false, footer: true),
            Column::make('Saldo Actual', 'saldo_venta')
            ->withSum('Total Actual.', header: false, footer: true),
            Column::action('Acciones')  
        ];
    }

    public function filters(): array
    {
        return [
            Filter::select('tipo_cliente', 'tipo_cliente')
                ->datasource(collect([
                    ['id' => 'mino', 'name' => 'Minorista'],
                    ['id' => 'mayo', 'name' => 'Mayorista'],
                ]))
                ->optionValue('id')
                ->optionLabel('name'),// El texto legible que verá el usuario en el menú desplegable
            Filter::select('cliente_id', 'cliente_id')
            ->datasource(
                Cliente::orderBy('nombres_cliente')->get()
                )
                ->optionValue('id')
                ->optionLabel('nombres_cliente'),
            Filter::select('forma_pago_venta', 'forma_pago_venta')
                ->datasource(collect([
                        ['id'=>'1','nombre'=>'Efectivo','valor'=>'EFECT'],
                        ['id'=>'2','nombre'=>'Credito','valor'=>'CREDI'],
                        ['id'=>'3','nombre'=>'Cheque','valor'=>'CHEQ'],
                        ['id'=>'4','nombre'=>'Tarjeta de Credito','valor'=>'TCREDI'],
                        ['id'=>'5','nombre'=>'Tarjeta de Debito','valor'=>'TDEBITO'],
                        ['id'=>'6','nombre'=>'Transferencia','valor'=>'TRANSFER'],
                        ['id'=>'6','nombre'=>'Deposito','valor'=>'DEPOSIT'],
                ]))
                ->optionValue('valor')
                ->optionLabel('nombre'),
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
                ->dispatch('showDetalle', ['rowId' => $row->id]),

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
    $query = Venta::query()
        ->with([
            'abonos',
            'notacreditos',
            'cliente',
        ]);

        /*
    |--------------------------------------------------------------------------
    | SEARCH GLOBAL
    |--------------------------------------------------------------------------
    */

        if (!empty($this->search)) {
            $search = trim($this->search);
            $query->where(function ($q) use ($search) {
            $q->where('no_venta', 'like', "%{$search}%")
            ->orWhere('forma_pago_venta', 'like', "%{$search}%")
            ->orWhere('total_venta', 'like', "%{$search}%")
            ->orWhere('saldo_venta', 'like', "%{$search}%")
            ->orWhereHas('cliente', function ($cliente) use ($search) {
            $cliente->where('nombres_cliente', 'like', "%{$search}%")
            ->orWhere('tipo_cliente', 'like', "%{$search}%");
            });

        });

        }

    // Cliente
    if (!empty(data_get($this->filters, 'select.cliente_id'))) {
        $query->where(
            'cliente_id',
            data_get($this->filters, 'select.cliente_id')
        );
    }

    // Tipo de cliente
    if (!empty(data_get($this->filters, 'select.tipo_cliente'))) {
        $tipoCliente = data_get($this->filters, 'select.tipo_cliente');

        $query->whereHas('cliente', function ($q) use ($tipoCliente) {
            $q->where('tipo_cliente', $tipoCliente);
        });
    }

    // Forma de pago
    if (!empty(data_get($this->filters, 'select.forma_pago_venta'))) {
        $query->where(
            'forma_pago_venta',
            data_get($this->filters, 'select.forma_pago_venta')
        );
    }

    // Fecha venta
    if (!empty(data_get($this->filters, 'date.fecha_venta'))) {
        $query->whereDate(
            'fecha_venta',
            data_get($this->filters, 'date.fecha_venta')
        );
    }

    // Ordenamiento
    if (!empty($this->sortField)) {
        $query->orderBy(
            $this->sortField,
            $this->sortDirection ?? 'asc'
        );
    }

    $datas = $query->get();

    return exportarGeneralPDF('EstadoCuentaCliente', [
        'data' => $datas,
    ]);
}

    /*
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
        return exportarGeneralPDF('EstadoCuentaCliente', [
            'data' => $datas,
        ]);
    }
*/
    protected function getListeners(): array
    {
        return [
            'exportar' => 'exportar',
            ...parent::getListeners(),
        ];
    }

}



