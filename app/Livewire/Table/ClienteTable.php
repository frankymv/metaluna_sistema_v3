<?php

namespace App\Livewire\Table;

use App\Models\Cliente;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class ClienteTable extends PowerGridComponent
{
    public string $tableName = 'clienteTable';

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
        return Cliente::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('id')
            ->add('codigo_interno')
            ->add('codigo_mayorista')
            ->add('nombre_empresa')
            ->add('nombres_cliente')
            ->add('apellidos_cliente')
            ->add('cui')
            ->add('numero_patente')
            ->add('nit')
            ->add('telefono_principal')
            ->add('telefono_secundario')
            ->add('direccion_fisica')
            ->add('direccion_departamento')
            ->add('direccion_municipio')
            ->add('ubicacion_latitud')
            ->add('ubicacion_longitud')
            ->add('correo_electronico')
            ->add('limite_credito')
            ->add('dias_limite_credito')
            ->add('tipo_cliente')
            ->add('ruta_id')
            ->add('estado')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Codigo interno', 'codigo_interno')
                ->searchable(),

            Column::make('Codigo mayorista', 'codigo_mayorista')
                ->searchable(),

            Column::make('Tipo cliente', 'tipo_cliente')
                ->searchable(),

            Column::make('Nombre empresa', 'nombre_empresa')
                ->searchable(),

            Column::make('Nombres cliente', 'nombres_cliente')
                ->searchable(),

            Column::make('Apellidos cliente', 'apellidos_cliente')
                ->searchable(),
            Column::make('Telefono principal', 'telefono_principal'),
/*
            Column::make('Cui', 'cui')
                ->searchable(),

            Column::make('Numero patente', 'numero_patente')
                ->searchable(),

            Column::make('Nit', 'nit')
                ->searchable(),

        Column::make('Telefono secundario', 'telefono_secundario')
                ->searchable(),
              Column::make('Direccion fisica', 'direccion_fisica')
                ->searchable(),

            Column::make('Direccion departamento', 'direccion_departamento'),
            Column::make('Direccion municipio', 'direccion_municipio'),
            Column::make('Ubicacion latitud', 'ubicacion_latitud')
                ->searchable(),

            Column::make('Ubicacion longitud', 'ubicacion_longitud')
                ->searchable(),

                            Column::make('Ruta id', 'ruta_id'),
            Column::make('Estado', 'estado')
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ,

            Column::make('Created at', 'created_at')
                ->searchable(),
                     Column::make('Correo electronico', 'correo_electronico')
                ->searchable(),

                            Column::make('Limite credito', 'limite_credito')
                ->searchable(),

            Column::make('Dias limite credito', 'dias_limite_credito')
                ->searchable(),

 */

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
             Filter::select('tipo_cliente', 'tipo_cliente')
            ->dataSource([
                ['id' => 'MINO', 'nombre' => 'Minorista'],
                ['id' => 'MAYO', 'nombre' => 'Mayorista'],
            ])
            ->optionValue('id')
            ->optionLabel('nombre'),

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
        $data = $query->get();
        return exportarGeneralPDF('Cliente', [
            'data' => $data,
        ]);
    }



    public function actions(Cliente $row): array
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
