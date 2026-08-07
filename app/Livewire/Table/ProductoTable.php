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

final class ProductoTable extends PowerGridComponent
{

    public string $tableName = 'producto-table-qnfpyy-table';

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
        //return Producto::query()->with('disenio');
        /*
    return Producto::query()
        ->join('marcas', 'productos.marca_id', '=', 'marcas.id')
        ->join('tipos', 'productos.tipo_id', '=', 'tipos.id')
        ->join('materials', 'productos.material_id', '=', 'materials.id')
        ->join('disenios', 'productos.disenio_id', '=', 'disenios.id')

        ->select(
            'productos.*',
            'marcas.nombre as marca_nombre',
            'tipos.nombre as tipo_nombre',
            'materials.nombre as material_nombre',
            'disenios.nombre as disenio_nombre'
        );
        */
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
            ->add('codigo')
            ->add('nombre')
            ->add('nombre_completo', function ($row) {
            return "{$row->nombre} <br>{$row->nombre_venta}<br>{$row->descripcion}";
        })
            ->add('precio_venta')
            // Mapeos seguros con operador Nullsafe (?->) para evitar caídas si falta una relación
            ->add('marca_nombre', fn (Producto $model) => $model->Marca?->nombre ?? 'N/A')
            ->add('tipo_nombre', fn (Producto $model) => $model->Tipo?->nombre ?? 'N/A')
            ->add('material_nombre', fn (Producto $model) => $model->Material?->nombre ?? 'N/A')
            ->add('disenio_nombre', fn (Producto $model) => $model->Disenio?->nombre ?? 'N/A');



    }

    public function columns(): array
    {
        return [
            Column::make('Código', 'codigo')
                ->sortable()
                ->searchable(),

             Column::make('Nombre Completo', 'nombre_completo','nombre')
            // Reemplaza ->searchable() por esto:
            ->searchableRaw('CONCAT(nombre, " ", nombre_venta) LIKE ?')
            ->sortable(),

            // El tercer parámetro 'marca.nombre' resuelve el ordenamiento nativo en la BD
            Column::make('Marca', 'marca_nombre', 'marca.nombre'),

            Column::make('Tipo', 'tipo_nombre', 'tipo.nombre'),

            Column::make('Material', 'material_nombre', 'material.nombre'),

            Column::make('Diseño', 'disenio_nombre', 'disenio.nombre'),

                 Column::action('Acciones')
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




    /*

  Filter::inputText('marca_nombre')
                ->filterRelation('marca', 'nombre'),

            Filter::inputText('tipo_nombre')
                ->filterRelation('tipo', 'nombre'),

            Filter::inputText('material_nombre')
                ->filterRelation('material', 'nombre'),

    */

        ];
    }

    public function actions(Producto $row): array
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
        return exportarGeneralPDF('Producto', [
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
