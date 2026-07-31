<?php

namespace App\Livewire\Table;

use App\Models\Producto;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

use App\Models\Marca;
use App\Models\Tipo;
use App\Models\Material;
use App\Models\Disenio;


final class InventarioTable extends PowerGridComponent
{
    public string $tableName = 'inventarioTable';

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
        //return Producto::query();
        return Producto::query()->with(['Marca', 'Tipo', 'Material', 'Disenio']);
    }

    public function relationSearch(): array
    {
        return [
            'marca' => ['nombre'],    // Busca por el nombre de la marca
            'tipo' => ['nombre'],     // Busca por el nombre del tipo
            'material' => ['nombre'],
            'disenio' => ['nombre']// Busca por el nombre del material
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('id')
            ->add('codigo')
            ->add('nombre')
            ->add('nombre_venta')
            ->add('descripcion')
            ->add('calibre')
            ->add('longitud')
            ->add('tipo_longitud')
            ->add('diametro')
            ->add('tipo_diametro')
            ->add('peso')
            ->add('tipo_peso')
            ->add('divisible')
            ->add('existencia')
            ->add('estado')
            ->add('precio_unitario')
            ->add('precio_final')
            ->add('marca_nombre', fn (Producto $model) => $model->Marca?->nombre ?? 'N/A')
            ->add('tipo_nombre', fn (Producto $model) => $model->Tipo?->nombre ?? 'N/A')
            ->add('material_nombre', fn (Producto $model) => $model->Material?->nombre ?? 'N/A')
            ->add('disenio_nombre', fn (Producto $model) => $model->Disenio?->nombre ?? 'N/A')
            ->add('created_at')
            ->add('updated_at')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Codigo', 'codigo')
                ->sortable()
                ->searchable(),

            Column::make('Nombre', 'nombre')
                ->sortable()
                ->searchable(),

            Column::make('Nombre venta', 'nombre_venta')
                ->sortable()
                ->searchable(),
/*

            Column::make('Calibre', 'calibre')
                ->sortable()
                ->searchable(),

            Column::make('Longitud', 'longitud')
                ->sortable()
                ->searchable(),

            Column::make('Tipo longitud', 'tipo_longitud')
                ->sortable()
                ->searchable(),

            Column::make('Diametro', 'diametro')
                ->sortable()
                ->searchable(),

            Column::make('Tipo diametro', 'tipo_diametro')
                ->sortable()
                ->searchable(),

            Column::make('Peso', 'peso')
                ->sortable()
                ->searchable(),

            Column::make('Tipo peso', 'tipo_peso')
                ->sortable()
                ->searchable(),

            Column::make('Divisible', 'divisible')
                ->sortable()
                ->searchable(),
*/
            Column::make('Existencia', 'existencia')
                ->sortable()
                ->searchable(),


            Column::make('Marca', 'marca_nombre', 'marca.nombre'),

            Column::make('Tipo', 'tipo_nombre', 'tipo.nombre'),

            Column::make('Material', 'material_nombre', 'material.nombre'),

            Column::make('Diseño', 'disenio_nombre', 'disenio.nombre')
                ->sortable(),



            Column::action('Action')
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


    public function filters(): array
    {
        return [
            Filter::select('marca_nombre', 'marca_id')
            // Obtenemos los registros ordenados directamente de la base de datos
            ->dataSource(Marca::query()->orderBy('nombre')->get(['id', 'nombre']))
            ->optionValue('id')
            ->optionLabel('nombre')
            ->filterRelation('marca', 'id'),

        // Filtro Select para Tipo
        Filter::select('tipo_nombre', 'tipo_id')
            ->dataSource(Tipo::query()->orderBy('nombre')->get(['id', 'nombre']))
            ->optionValue('id')
            ->optionLabel('nombre')
            ->filterRelation('tipo', 'id'),

        // Filtro Select para Material
        Filter::select('material_nombre', 'material_id')
            ->dataSource(Material::query()->orderBy('nombre')->get(['id', 'nombre']))
            ->optionValue('id')
            ->optionLabel('nombre')
            ->filterRelation('material', 'id'),

                    // Filtro Select para Material
        Filter::select('disenio_nombre', 'disenio_id')
            ->dataSource(Disenio::query()->orderBy('nombre')->get(['id', 'nombre']))
            ->optionValue('id')
            ->optionLabel('nombre')
            ->filterRelation('disenio', 'id'),


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
        return exportarGeneralPDF('Inventario', [
            'data' => $datas,
        ]);
    }



    public function actions(Producto $row): array
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
