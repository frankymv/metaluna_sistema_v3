<?php

namespace App\Livewire;

use App\Constantes\DataSistema;
use App\Models\Tipo;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\WithPagination;
use Exception;

class TipoController extends Component
{
    use LivewireAlert;
    use WithPagination;


    public $title='Tipo';
    public $data, $per_page=10,  $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;

    ////////////////////
    public $nombre, $descripcion, $estado='Activo';
    ////////////////////

    public $tipos=null;
    public $estados=null;
    public $filtroNombre=null;
    public $filtroEstado=null;


    protected $rules = [
        'nombre' => 'required',
    ];

    protected $messages = [
        'nombre.unique' => 'Registro duplicado',
    ];


protected $listeners=['create','edit', 'delete','show','exportarFila'];

    public function render()
    {
        $this->estados=DataSistema::$estados;


        $this->tipos=Tipo::where('nombre','LIKE',"%{$this->filtroNombre}%")
        ->where('estado','LIKE',"%{$this->filtroEstado}%")
        ->get();
        return view('livewire.pages.tipo.index');
    }

    public function create(){
        $this->isCreate=true;
    }

    public function borrarFiltros()
    {
        $this->reset();

    }


    public function store(){

        $this->validate([
            'nombre' => [
                'required',
            ValidationRule::unique('tipos')->where('nombre',$this->nombre)
            ]
        ]);

        Tipo::create(
            [
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
            'estado'=>$this->estado
            ]
        );

        $this->cancel();
    }

    public function edit($rowId){

        $data = Tipo::find($rowId);
        $this->id_data=$data->id;
        $this->nombre = $data->nombre;
        $this->descripcion = $data->descripcion;
        $this->estado = $data->estado;
        $this->isEdit=true;
    }

    public function show($rowId){

        $data = Tipo::find($rowId);
        $this->id_data=$data->id;
        $this->nombre = $data->nombre;
        $this->descripcion = $data->descripcion;
        $this->estado = $data->estado;
        $this->created_at = $data->created_at;
        $this->updated_at = $data->updated_at;
        $this->disabled=true;
        $this->isShow=true;
    }


    public function update($rowId){
        $this->validate();

        $data = Tipo::find($rowId);
        $data->update([
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
            'estado'=>$this->estado
        ]);

        $this->cancel();
    }

    public function delete($rowId){
        $data = Tipo::find($rowId);
        $this->id_data=$data->id;
        $this->nombre = $data->nombre;
        $this->isDelete = true;
    }

    public function destroy($rowId)
    {

        $data=Tipo::find($rowId);


        try {
            $data->delete();
            $this->alertaNotificacion("destroy");
        } catch (Exception $e) {
            if($e->getCode()=="23000"){
                $this->alertaNotificacion("23000");
            }else{
                $this->alertaNotificacion("error");
            }
        }


      $this->isDelete = false;
        $this->cancel();
    }





    public function exportarGeneral()
    {
        $data=exportarGeneralPDF('Tipo', [
            'data' => $this->tipos,
        ]);
        return $data;
    }


    public function exportarFila($rowId)
    {
        $data_temp=Tipo::find($rowId);
         $data=exportarFilaPDF('Tipo', [
            'data' => $data_temp,
        ]);
        return $data;
    }




    public function cancel(){
        $this->dispatch('pg:eventRefresh-tipo-table-qkz3kr-table');
        $this->resetInputFields();
        $this->resetValidation();
    }

    private function resetInputFields(){
        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','estado','created_at','updated_at']);
        ///////////////////
        $this->reset(['nombre', 'descripcion']);
        ////////////////////
    }

    function alertaNotificacion($tipo){

        if($tipo==="store"){
            $title="Agregar";
            $texto="Registro agregado";
            $alert="success";

        }elseif($tipo==="update"){
            $title="Editar";
            $texto="Registro editado";
            $alert="success";

        }elseif($tipo==="destroy"){
            $title="Borrar";
            $texto="Registro borrado";
            $alert="success";
        }elseif($tipo==="error"){
            $title="Error";
            $texto="No se completo la operación";
            $alert="error";
        }elseif($tipo==="23000"){
            $title="Error";
            $texto="El registro esta asociado a otro registro";
            $alert="error";
        }
        return $this->alert("$alert", "$title", [
            'position' => 'center',
            'timer' => '2000',
            'toast' => true,
            'showConfirmButton' => false,
            'onConfirmed' => '',
            'timerProgressBar' => true,
            'text' => "$texto"
        ]);

    }




}
