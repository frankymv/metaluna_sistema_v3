<?php

namespace App\Livewire;

use App\Constantes\DataSistema;
use App\Models\Marca;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\WithPagination;
use Exception;


class MarcaController extends Component
{
    use LivewireAlert;
    use WithPagination;

    public $title='Marca';
    public $data, $per_page=10,  $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;

    ////////////////////
    public $nombre, $descripcion;
    public $estado = 'Activo';

    ////////////////////
    public $marcas=null;
    public $estados=null;
    public $filtroNombre=null;
    public $filtroEstado=null;
    ////////////////////
    protected $rules = [
        'nombre' => 'required',
    ];

    public $campos=['nombre','descripcion','estado'];

    protected $messages = [
        'nombre.unique' => 'Registro duplicado',
    ];

    ////////////////////

    protected $listeners=['create','edit', 'delete','show','exportarFila'];

    public function render()
    {
        $this->estados=DataSistema::$estados;
        $this->marcas=Marca::where('nombre','LIKE',"%{$this->filtroNombre}%")
        ->where('estado','LIKE',"%{$this->filtroEstado}%")
        ->get();
        return view('livewire.pages.marca.index');
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
            ValidationRule::unique('marcas')->where('nombre',$this->nombre)
            ]
        ]);
        Marca::create(
            ['nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
            'estado'=>$this->estado]
        );
        $this->cancel();
    }

    public function edit($rowId){
        $data = Marca::find($rowId);
        $this->id_data=$data->id;
        $this->nombre = $data->nombre;
        $this->descripcion = $data->descripcion;
        $this->estado = $data->estado;
        $this->isEdit=true;
    }

    public function show($rowId){

        //dd($rowId);
        $data = Marca::find($rowId);
        $this->id_data=$data->id;
        $this->nombre = $data->nombre;
        $this->descripcion = $data->descripcion;
        $this->estado = $data->estado;
        $this->disabled=true;
        $this->isShow=true;
    }

    public function update($rowId){
        $this->validate();
        $data = Marca::find($rowId);
        $data->update([
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
            'estado'=>$this->estado
        ]);
        $this->cancel();
    }

    public function delete($rowId){
        $data = Marca::find($rowId);
        $this->id_data=$data->id;
        $this->nombre = $data->nombre;
        $this->isDelete = true;
    }

    public function destroy($rowId)
    {
        $data=Marca::find($rowId);

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

    public function exportarFila($rowId)
    {
        $data_temp=Marca::find($rowId);
         $data=exportarFilaPDF('Marca', [
            'data' => $data_temp,
        ]);
        return $data;
    }


    public function cancel(){
        $this->dispatch('pg:eventRefresh-marca-table-ivgqr2-table');        $this->resetInputFields();
        $this->resetValidation();
    }


    private function resetInputFields(){

        $this->reset($this->campos);

        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','estado','created_at','updated_at']);
        ///////////////////

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
