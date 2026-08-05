<?php

namespace App\Livewire\Table;

use App\Models\Abono;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class AbonoTable extends PowerGridComponent
{
    public string $tableName = 'abonoTable';

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
        return Abono::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('no_abono')
            ->add('fecha_abono_formatted', fn (Abono $model) => Carbon::parse($model->fecha_abono)->format('d/m/Y'))
            //->add('total_abono', fn (Abono $model) => 'Q. ' . number_format($model->total_abono ?? 0,2))
            ->add('total_abono', fn (Abono $model) => ($model->total_abono ?? 0))
            ->add('observaciones')
            ->add('abono_anticipado', fn (Abono $model) => $model->abono_anticipado ? 'Sí' : 'No')
            ->add('abono_anticipado_asignado')
            ->add('fecha_abono_anticipado_asignado_formatted', fn (Abono $model) => Carbon::parse($model->fecha_abono_anticipado_asignado)->format('d/m/Y'))
            ->add('tipo_pago')
            ->add('detalle_pago')
            ->add('correlativo')
            ->add('venta_id')
            ->add('total_credito', fn (Abono $model) => $model->venta?->total_credito ?? 0)
            ->add('cliente_id', fn (Abono $model) => $model->Cliente?->nombres_cliente ?? 'N/A')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [

            Column::make('No abono', 'no_abono')
                ->sortable()
                ->searchable(),

            Column::make('Fecha abono', 'fecha_abono_formatted', 'fecha_abono')
                ->sortable(),

            Column::make('No Venta', 'venta_id'),
            Column::make('Cliente', 'cliente_id','cliente.nombre'),
            Column::make('Total abono', 'total_abono')
                ->sortable()
                ->searchable(),
            Column::make('Observaciones', 'observaciones')
                ->sortable()
                ->searchable(),
            Column::make('Tipo pago', 'tipo_pago')
                ->sortable()
                ->searchable(),


            Column::make('Abono Anticipado', 'abono_anticipado')
                ->sortable()
                ->searchable(),

            Column::action('Acciones')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_abono'),
            Filter::datepicker('fecha_abono_anticipado_asignado'),
        ];
    }
////////////////////////////////////////////////////////////////////////////////////

   ////////////////////////////////////////////////////////////////////////////////////

    public function header(): array
    {
        return [
            Button::add('exportar')
                ->slot('Exportar')
                ->class('bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-2 rounded mr-auto')
                ->dispatch('exportar', []),
            Button::add('agregar')
                ->slot('Agregar Abono')
                ->class('bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded mr-auto mx-1')
                ->dispatch('create', []),
            Button::add('agregar')
                ->slot('Agregar Abono Anticipado')
                ->class('bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded mr-auto mx-1')
                ->dispatch('abonoAnticipado', []),
            Button::add('agregar')
                ->slot('Asignado Abono Anticipado')
                ->class('bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded mr-auto mx-1')
                ->dispatch('abonoAnticipadoAsignar', []),
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
        return exportarGeneralPDF('Abono', [
            'data' => $datas,
        ]);
    }



    public function actions(Abono $row): array
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
