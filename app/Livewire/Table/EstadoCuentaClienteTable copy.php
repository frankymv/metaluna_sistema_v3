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
use Livewire\Attributes\Reactive;

final class EstadoCuentaClienteTable extends PowerGridComponent
{
    public string $tableName = 'estadoCuentaClienteTable';
   #[Reactive]
    public $clienteId;


    public function setUp(): array
    {

        //$this->showCheckBox();

        return [
            PowerGrid::header(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        if($this->clienteId==0){
            return  Venta::query()->where('anulado', false)
                ->select('*')
                ->selectRaw('(total_venta - total_abono - total_nota_credito) as saldo')
                ->with([
                    'abonos',
                    'notacreditos',
                    'cliente',
                ]);
        }else{
            return  Venta::query()->where('cliente_id', $this->clienteId)->where('anulado', false)
                ->select('*')
                ->selectRaw('(total_venta - total_abono - total_nota_credito) as saldo')
                    ->with([
                        'abonos',
                        'notacreditos',
                        'cliente',
                    ]);
        }
    
        
      

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
            ->add('cliente_id', fn (Venta $model) => $model->Cliente?->nombres_cliente ?? 'N/A')
            ->add('saldo_venta')
            ->add('sucursal_id')
            ->add('anticipo_v')
            ->add('nuevo_saldo_v')
            ->add('saldo_anterior_v')
->add('estado_vencimiento', function (Venta $model) {

    $fechaLimite = Carbon::parse($model->fecha_limite_credito)->startOfDay();
    $hoy = Carbon::today();

    $dias = $fechaLimite->diffInDays($hoy, false);

    if ($dias > 0) {
        return "<span class='text-red-600 font-bold'>
                    Vencida hace {$dias} días
                </span>";
    }

    if ($dias < 0) {
        return "<span class='text-green-600 font-bold'>
                    Restan ".abs($dias)." días
                </span>";
    }

    return "<span class='text-yellow-600 font-bold'>
                Vence hoy
            </span>";
});

    }

    public function columns(): array
    {
        return [
            Column::make('No venta', 'no_venta')
                ->searchable(),

            Column::make('Cliente', 'cliente_id','cliente.nombres_cliente'),

            Column::make('Fecha venta', 'fecha_venta_formatted', 'fecha_venta')
                ,
            Column::make('Fecha limite', 'fecha_limite_credito_formatted', 'fecha_limite')
                ,
            Column::make('Vencimiento', 'estado_vencimiento')
            ->searchable(false),
            Column::make('Forma pago', 'forma_pago_venta')
                ->searchable(),

            Column::make('Total venta', 'total_venta')
                ->sortable()
                ->searchable()
                ->withSum('Total Venta', header: false, footer: true),

            Column::make('Total credito', 'total_credito')
                ->sortable()
                ->searchable()
                ->withSum('Total Credito', header: false, footer: true),

            Column::make('Total abono', 'total_abono')
                ->sortable()
                ->searchable()
                ->withSum('Total Abono', header: false, footer: true),

            Column::make('Total nota credito', 'total_nota_credito')
                ->sortable()
                ->searchable()
                ->withSum('Total Nota Credito', header: false, footer: true),

            Column::make('Saldo Actual', 'saldo_venta')
                ->sortable()
                ->searchable()
                ->withSum('Total Actual.', header: false, footer: true),




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

    protected function getListeners(): array
    {
        return [
            'exportar' => 'exportar',
            ...parent::getListeners(),
        ];
    }

}

/*


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
use Livewire\Attributes\Reactive;

final class EstadoCuentaClienteTable extends PowerGridComponent
{
    public string $tableName = 'estadoCuentaClienteTable';
   #[Reactive]
    public $clienteId;


    public function setUp(): array
    {

        //$this->showCheckBox();

        return [
            PowerGrid::header(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        
        if($this->clienteId===0){
            return  Venta::query()->where('anulado', false)
                ->select('*')
                ->selectRaw('(total_venta - total_abono - total_nota_credito) as saldo')
                ->with([
                    'abonos',
                    'notacreditos',
                    'cliente',
                ]);
        }else{
            return  Venta::query()->where('cliente_id', $this->clienteId)->where('anulado', false)
                ->select('*')
                ->selectRaw('(total_venta - total_abono - total_nota_credito) as saldo')
                    ->with([
                        'abonos',
                        'notacreditos',
                        'cliente',
                    ]);
        }
    
        
      

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
            ->add('cliente_id', fn (Venta $model) => $model->Cliente?->nombres_cliente ?? 'N/A')
            ->add('saldo_venta')
            ->add('sucursal_id')
            ->add('anticipo_v')
            ->add('nuevo_saldo_v')
            ->add('saldo_anterior_v')
->add('estado_vencimiento', function (Venta $model) {

    $fechaLimite = Carbon::parse($model->fecha_limite_credito)->startOfDay();
    $hoy = Carbon::today();

    $dias = $fechaLimite->diffInDays($hoy, false);

    if ($dias > 0) {
        return "<span class='text-red-600 font-bold'>
                    Vencida hace {$dias} días
                </span>";
    }

    if ($dias < 0) {
        return "<span class='text-green-600 font-bold'>
                    Restan ".abs($dias)." días
                </span>";
    }

    return "<span class='text-yellow-600 font-bold'>
                Vence hoy
            </span>";
});

    }

    public function columns(): array
    {
        return [
            Column::make('No venta', 'no_venta')
                ->searchable(),

            Column::make('Cliente', 'cliente_id','cliente.nombres_cliente'),

            Column::make('Fecha venta', 'fecha_venta_formatted', 'fecha_venta')
                ,
            Column::make('Fecha limite', 'fecha_limite_credito_formatted', 'fecha_limite')
                ,
            Column::make('Vencimiento', 'estado_vencimiento')
            ->searchable(false),
            Column::make('Forma pago', 'forma_pago_venta')
                ->searchable(),

            Column::make('Total venta', 'total_venta')
                ->sortable()
                ->searchable()
                ->withSum('Total Venta', header: false, footer: true),

            Column::make('Total credito', 'total_credito')
                ->sortable()
                ->searchable()
                ->withSum('Total Credito', header: false, footer: true),

            Column::make('Total abono', 'total_abono')
                ->sortable()
                ->searchable()
                ->withSum('Total Abono', header: false, footer: true),

            Column::make('Total nota credito', 'total_nota_credito')
                ->sortable()
                ->searchable()
                ->withSum('Total Nota Credito', header: false, footer: true),

            Column::make('Saldo Actual', 'saldo_venta')
                ->sortable()
                ->searchable()
                ->withSum('Total Actual.', header: false, footer: true),




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

    protected function getListeners(): array
    {
        return [
            'exportar' => 'exportar',
            ...parent::getListeners(),
        ];
    }

}



*/