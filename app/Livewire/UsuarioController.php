<?php

namespace App\Livewire;

use App\Constantes\DepartamentoMunicipio as ConstantesDepartamentoMunicipio;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Sucursal;
use App\Models\User;
use Constantes\DepartamentoMunicipio;
use Spatie\Permission\Models\Role;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Exception;

class UsuarioController extends Component
{
    use LivewireAlert;
    use WithPagination;


    public $title='Usuario';
    public $data, $per_page=10,  $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;
    public $departamentos,$municipios=[];
    public $departamento,$municipio;
    public $nombre_completo, $codigo, $nombres, $roles, $sucursales,$apellidos, $fecha_nacimiento, $cui, $telefono_principal, $telefono_secundario, $tipo_sangre, $no_licencia, $inicio_labores, $fin_labores, $usuario, $email, $password, $direccion_fisica, $direccion_departamento, $direccion_municipio,$sucursal_id, $visible=true,$estado=true,$role_id,$municipio_id=null;
    public $inputs=[],$nombresDetalle=[],$idSucursal=[],$i=0;
    public $filtroUsuario=null, $filtroNombres=null, $filtroApellidos=null;

   protected $listeners=['create','edit', 'delete','show','exportarFila'];

    public function render(){

        $data_temp=User::where('usuario','LIKE',"%{$this->filtroUsuario}%")
        ->where('nombres','LIKE',"%{$this->filtroNombres}%")
        ->where('apellidos','LIKE',"%{$this->filtroApellidos}%")
        ->paginate($this->per_page);
        $ultima_venta=User::latest()->first();
        if ( $ultima_venta) {
            $this->id=$ultima_venta->id+1;
            $this->codigo=$this->id;
        }else{
            $this->id=1;
            $this->codigo=$this->id;
        }
        return view('livewire.pages.usuario.index',[ 'users' => $data_temp]);
    }


    public function addSucursal(){
        foreach ($this->sucursales as $key => $value) {
            if($value['id']===intval($this->sucursal_id)){

                array_push($this->inputs,$this->i);
                array_push($this->idSucursal ,$value['id']);
                array_push($this->nombresDetalle ,$value['nombre']);
                $this->i +=1;
            }
        }

        $this->reset(['sucursal_id']);
    }




    public function create(){
      $this->departamentos=Departamento::all();
        $this->sucursales=Sucursal::all();
        $this->roles=Role::all();
        //dd($this->roles);
        $this->isCreate=true;
    }

        public function exportarGeneral()
    {

         $data_temp=User::where('usuario','LIKE',"%{$this->filtroUsuario}%")
        ->where('nombres','LIKE',"%{$this->filtroNombres}%")
        ->where('apellidos','LIKE',"%{$this->filtroApellidos}%")
        ->paginate($this->per_page);


        $data=exportarGeneralPDF('Usuario', [
            'datas' => $data_temp,
        ]);
        return $data;
    }

    public function exportarFila($rowId)
    {
        $data_temp=User::find($rowId);
         $data=exportarFilaPDF('Usuario', [
            'data' => $data_temp,
        ]);
        return $data;
    }


    public function store(){



        $this->validate([
            'codigo' => 'required',
            'nombres' => 'required',
            'apellidos'=>'required',
            'telefono_principal'=>'required',
            'email'=>'required',
            'usuario'=>'required',
            'password'=>'required',
            'role_id'=>'required',
        ]);



        $user= User::create(
            [
            'codigo'=>$this->codigo,
            'nombres'=>$this->nombres,
            'apellidos'=>$this->apellidos,
            'fecha_nacimiento'=>$this->fecha_nacimiento,
            'cui'=>$this->cui,
            'telefono_principal'=>$this->telefono_principal,
            'telefono_secundario'=>$this->telefono_secundario,
            'tipo_sangre'=>$this->tipo_sangre,
            'no_licencia'=>$this->no_licencia,
            'inicio_labores'=>$this->inicio_labores,
            'fin_labores'=>$this->fin_labores,
            'usuario'=>$this->usuario,
            'email'=>$this->email,
            'password'=>bcrypt($this->password),
            'direccion_fisica'=>$this->direccion_fisica,
            'direccion_departamento'=>$this->direccion_departamento,
            'direccion_municipio'=>$this->direccion_municipio,
            'sucursal_id'=>$this->sucursal_id,
            'estado'=>$this->estado,
            ]
        );


/*
        foreach ($this->idSucursal as $key => $value) {
            $user->sucursales()->attach($value);
        }
            */
        //$this->alert('success', 'Registro completo');

        $user->roles()->sync($this->role_id);



        $this->cancel();

    }


    public function removeDetalle($i){
        unset($this->inputs[$i]);
        unset($this->nombresDetalle[$i]);
        unset($this->idSucursal[$i]);
    }

    public function edit($rowId){

      $this->departamentos=Departamento::all();
        $this->sucursales=Sucursal::all();
        $this->roles=Role::all();

        $data=User::find($rowId);

        $this->municipios = Municipio::where('departamento_id',$data->direccion_departamento)->get();
        $this->id_data=$data->id;
        $this->codigo=$data->codigo;
        $this->nombres=$data->nombres;
        $this->apellidos=$data->apellidos;
        $this->fecha_nacimiento=$data->fecha_nacimiento;
        $this->cui=$data->cui;
        $this->telefono_principal=$data->telefono_principal;
        $this->telefono_secundario=$data->telefono_secundario;
        $this->tipo_sangre=$data->tipo_sangre;
        $this->no_licencia=$data->no_licencia;
        $this->inicio_labores=$data->inicio_labores;
        $this->fin_labores=$data->fin_labores;
        $this->usuario=$data->usuario;
        $this->email=$data->email;
        $this->role_id=$data->roles[0]->id;
        $this->direccion_fisica=$data->direccion_fisica;
        $this->direccion_departamento = $data->direccion_departamento;
        $this->direccion_municipio = $data->direccion_municipio;
        $this->sucursal_id=$data->sucursal_id;
        $this->estado=$data->estado;

        $this->isEdit=true;




    }

    public function show($rowId){

        $this->departamentos=Departamento::all();
        $this->municipios=Municipio::all();


        $this->disabled=true;
        $this->sucursales=Sucursal::all();
        $this->roles=Role::all();
        $data=User::find($rowId);
        //dd($data->municipio->nombre);

        $this->id_data=$data->id;
        $this->codigo=$data->codigo;
        $this->nombres=$data->nombres;
        $this->apellidos=$data->apellidos;
        $this->fecha_nacimiento=$data->fecha_nacimiento;
        $this->cui=$data->cui;
        $this->telefono_principal=$data->telefono_principal;
        $this->telefono_secundario=$data->telefono_secundario;
        $this->tipo_sangre=$data->tipo_sangre;
        $this->no_licencia=$data->no_licencia;
        $this->inicio_labores=$data->inicio_labores;
        $this->fin_labores=$data->fin_labores;
        $this->usuario=$data->usuario;
        $this->email=$data->email;

        $this->direccion_fisica=$data->direccion_fisica;
        $this->direccion_departamento = $data->direccion_departamento;
        $this->direccion_municipio = $data->direccion_municipio;
        $this->estado = $data->estado;
        $this->created_at = $data->created_at;
        $this->updated_at = $data->updated_at;
        $this->disabled=true;
        $this->isShow=true;
        $this->sucursal_id=$data->sucursal->nombre;
         $this->role_id=$data->getRoleNames();




    }


    public function update($rowId){


        $this->validate([
            'codigo' => 'required',
            'nombres' => 'required',
            'apellidos'=>'required',
            'telefono_principal'=>'required',
            'email'=>'required',
            'usuario'=>'required',

            'role_id'=>'required',
        ]);


        $data = User::find($this->id_data);
        $data->update([
            'codigo'=>$this->codigo,
            'nombres'=>$this->nombres,
            'apellidos'=>$this->apellidos,
            'fecha_nacimiento'=>$this->fecha_nacimiento,
            'cui'=>$this->cui,
            'telefono_principal'=>$this->telefono_principal,
            'telefono_secundario'=>$this->telefono_secundario,
            'tipo_sangre'=>$this->tipo_sangre,
            'no_licencia'=>$this->no_licencia,
            'inicio_labores'=>$this->inicio_labores,
            'fin_labores'=>$this->fin_labores,
            'usuario'=>$this->usuario,
            'email'=>$this->email,
            //'password'=> $this->password===null? $this->pass_old:bcrypt($this->password),
            'direccion_fisica'=>$this->direccion_fisica,
            'direccion_departamento'=>$this->direccion_departamento,
            'direccion_municipio'=>$this->direccion_municipio,
            'sucursal_id'=>$this->sucursal_id,
            'estado'=>$this->estado,
        ]);



        $data->roles()->sync($this->role_id);
       // $this->alert('success', 'Registro completo');

        $this->cancel();
    }

    public function delete($rowId){
        $data = User::find($rowId);
        $this->id_data=$data->id;
        $this->nombre_completo = $data->nombres.' '.$data->apellidos;
        $this->isDelete = true;
    }

    public function destroy($rowId){

        User::find($rowId)->delete();

        $this->isDelete = false;
       // $this->alert('error', 'Registro eliminado');
        $this->cancel();
    }


    public function updatedDireccionDepartamento($value){
        $this->municipios = Municipio::where('departamento_id',$value)->get();
        $this->reset('municipio_id');
    }

    public function cancel(){
        $this->dispatch('pg:eventRefresh-usuario-table-ecjycw-table');
        $this->resetInputFields();
        $this->resetValidation();
    }

    private function resetInputFields(){
        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','estado','created_at','updated_at']);
        ///////////////////
        $this->reset(['codigo', 'nombres', 'apellidos', 'fecha_nacimiento', 'cui', 'telefono_principal', 'telefono_secundario', 'tipo_sangre', 'no_licencia', 'inicio_labores', 'fin_labores', 'usuario', 'email', 'password', 'direccion_fisica', 'direccion_departamento','direccion_municipio','departamento','municipio','nombre_completo']);
        ////////////////////
    }





}
