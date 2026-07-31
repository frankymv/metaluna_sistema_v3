<?php

namespace App\Livewire\Table;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class UsuarioTable extends PowerGridComponent
{
    public string $tableName = 'usuario-table-ecjycw-table';

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
        return User::query()->with('Sucursal');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('codigo')
            ->add('nombres')
            ->add('apellidos')
            ->add('fecha_nacimiento_formatted', fn (User $model) => Carbon::parse($model->fecha_nacimiento)->format('d/m/Y'))
            ->add('cui')
            ->add('telefono_principal')
            ->add('telefono_secundario')
            ->add('tipo_sangre')
            ->add('no_licencia')
            ->add('inicio_labores_formatted', fn (User $model) => Carbon::parse($model->inicio_labores)->format('d/m/Y'))
            ->add('fin_labores_formatted', fn (User $model) => Carbon::parse($model->fin_labores)->format('d/m/Y'))
            ->add('direccion_fisica')
            ->add('direccion_departamento')
            ->add('direccion_municipio')
            ->add('usuario')
            ->add('sucursal_id', fn (User $model) => $model->Sucursal?->nombre ?? 'N/A')
            ->add('email')
            ->add('email_verified_at')
            ->add('estado')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Codigo', 'codigo')
                ->sortable()
                ->searchable(),
            Column::make('Nombres', 'nombres')
                ->sortable()
                ->searchable(),
            Column::make('Apellidos', 'apellidos')
                ->sortable()
                ->searchable(),
            Column::make('Fecha nacimiento', 'fecha_nacimiento_formatted', 'fecha_nacimiento'),
            Column::make('Cui', 'cui')
                ->sortable()
                ->searchable(),
            Column::make('Usuario', 'usuario'),
            Column::make('Sucursal id', 'sucursal_id','Sucursal.nombre'),
            Column::make('Email', 'email'),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('fecha_nacimiento'),
            Filter::datepicker('inicio_labores'),
            Filter::datepicker('fin_labores'),
        ];
    }


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
                $q->where('codigo', 'like', '%' . $this->search . '%')
                ->orWhere('nombreS', 'like', '%' . $this->search . '%')
                ->orWhere('apellidos', 'like', '%' . $this->search . '%')
                ->orWhere('cui', 'like', '%' . $this->search . '%');
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
        return exportarGeneralPDF('Usuario', [
            'data' => $datas,
        ]);
    }



    public function actions(User $row): array
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
