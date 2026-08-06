<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;


class RolesController extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $title='Roles';
    public $data, $per_page=10,  $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;


    ////////////////////
    public $nombre, $descripcion, $estado='Activo';
    ////////////////////

    public $permisson=[],$roles=[];
        public $role_selected=[];
    public $role_selec;
    ////////////////////
    protected $rules = [
        'nombre' => 'required',
    ];
    ////////////////////

 protected $listeners=['create','edit', 'delete','show','exportarFila'];

    public function render()
    {
        $this->roles=Role::all();
        return view('livewire.pages.roles.index');
    }

    public function create(){
        $this->isCreate=true;
        $this->permisson=Permission::all();
    }

    public function borrarFiltros()
    {
        $this->reset();
    }

    public function store(){
        $this->validate();
        $data=Role::create(
            ['name'=>$this->nombre]);
        $data->permissions()->sync($this->role_selected);
        $this->cancel();


     
    }

    public function edit($rowId){
        $this->permisson=Permission::all();
        $data = Role::findOrFail($rowId);
        $this->id_data=$data->id;
        $this->nombre = $data->name;
        $this->estado = $data->estado;
        $this->isEdit=true;

        // 🔥 CLAVE: cargar permisos asignados
        $this->role_selected = $data->permissions
            ->pluck('id')
            ->toArray();

        $this->isEdit = true;



    }


public function show($rowId)
{
      $this->permisson=Permission::all();

        $data = Role::findOrFail($rowId);



        $this->id_data=$data->id;
        $this->nombre = $data->name;
        $this->estado = $data->estado;


        // 🔥 CLAVE: cargar permisos asignados
        $this->role_selected = $data->permissions
            ->pluck('id')
            ->toArray();

        $this->isShow = true;

    // Bloquear inputs
    $this->disabled = true;

    // Activar vista
    $this->isShow = true;
}


    public function update($rowId){
        $this->validate();

        $data = Role::find($rowId);
        $data->update([
            'nombre'=>$this->nombre,
        ]);

        $data->permissions()->sync($this->role_selected);


        $this->cancel();
    }

    public function delete($rowId){
        $data = Role::find($rowId);
        $this->id_data=$data->id;
        $this->nombre = $data->name;
        $this->isDelete = true;
    }

    public function destroy($rowId)
    {
        Role::find($rowId)->delete();
        $this->isDelete = false;
        $this->cancel();
    }


    public function exportarGeneral()
    {
        $fecha_reporte=Carbon::now()->toDateTimeString();
        $pdf = Pdf::loadView('/livewire/pdf/pdfMarcaGeneral',['data' => $this->marcas]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->setPaper('leter', 'landscape')->stream();
            }, "$this->title-$fecha_reporte.pdf");
    }

    public function exportarFilla($rowId)
    {


        $data=Role::find($rowId);
        $fecha_reporte=Carbon::now()->toDateTimeString();
        $pdf = Pdf::loadView('/livewire/pdf/pdfMarca',['data'=>$data]);
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->setPaper('leter')->stream();
            }, "$this->title-$fecha_reporte.pdf");
    }

        public function exportarFila($rowId)
    {
        $rol=Role::find($rowId);//->with('permissions');
//dd($rol);

         $data=exportarFilaPDF('Rols', [
            'data' => $rol,
        ]);
        return $data;
    }


    public function cancel(){
        
        $this->dispatch('pg:eventRefresh-rolesTable');        $this->resetInputFields();
        $this->resetValidation();
    }

    public function export_pdf(){



    }

    private function resetInputFields(){
        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','estado','created_at','updated_at']);
        ///////////////////
        $this->reset(['nombre', 'descripcion']);
        ////////////////////
    }


}
